<?php

namespace Controllers;

use Core\Controller;
use Core\Session;
use Helpers\Auth;
use Helpers\Flash;
use Helpers\ViewHelper;
use Models\Order;
use Models\OrderItem;
use Models\Product;
use Models\AuditLog;

class CheckoutController extends Controller
{
    public function index(): void
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            Flash::warning('Your cart is currently empty. Please add products before checking out.');
            $this->redirect('our-products');
            return;
        }

        $subtotal = 0.0;
        foreach ($cart as $item) {
            $subtotal += ((float)$item['price'] * (int)$item['quantity']);
        }

        $coupon = Session::get('coupon', null);
        $discount = 0.0;
        if ($coupon) {
            if ($coupon['type'] === 'percent') {
                $discount = round(($subtotal * ($coupon['value'] / 100)), 2);
            } elseif ($coupon['type'] === 'fixed') {
                $discount = min($subtotal, (float)$coupon['value']);
            }
        }

        $shipping = ($subtotal > 0 && ($subtotal - $discount) < 50.0) ? 5.99 : 0.0;
        $total = max(0.0, ($subtotal - $discount) + $shipping);

        $user = Auth::user() ?? [];

        $this->render('shop.checkout', [
            'pageTitle' => 'Secure Checkout & Payment — PetGuard',
            'cart' => $cart,
            'subtotal' => $subtotal,
            'coupon' => $coupon,
            'discount' => $discount,
            'shipping' => $shipping,
            'total' => $total,
            'user' => $user
        ]);
    }

    public function process(): void
    {
        $this->validateCsrf();

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            if ($this->request->isAjax()) {
                $this->json(['success' => false, 'message' => 'Your cart is empty.'], 400);
                return;
            }
            Flash::warning('Your cart is empty.');
            $this->redirect('our-products');
            return;
        }

        $firstName = trim((string)$this->request->input('first_name', ''));
        $lastName = trim((string)$this->request->input('last_name', ''));
        $email = trim((string)$this->request->input('email', ''));
        $phone = trim((string)$this->request->input('phone', ''));
        $address = trim((string)$this->request->input('address', ''));
        $city = trim((string)$this->request->input('city', ''));
        $postcode = trim((string)$this->request->input('postcode', ''));
        $notes = trim((string)$this->request->input('notes', ''));
        $paymentMethod = trim((string)$this->request->input('payment_method', 'card'));

        if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($address) || empty($city)) {
            $err = 'Please fill in all required shipping and contact fields.';
            if ($this->request->isAjax()) {
                $this->json(['success' => false, 'message' => $err], 422);
                return;
            }
            Flash::error($err);
            $this->redirect('checkout');
            return;
        }

        // Subtotal & discount calculation
        $subtotal = 0.0;
        foreach ($cart as $item) {
            $subtotal += ((float)$item['price'] * (int)$item['quantity']);
        }

        $coupon = Session::get('coupon', null);
        $discount = 0.0;
        if ($coupon) {
            if ($coupon['type'] === 'percent') {
                $discount = round(($subtotal * ($coupon['value'] / 100)), 2);
            } elseif ($coupon['type'] === 'fixed') {
                $discount = min($subtotal, (float)$coupon['value']);
            }
        }

        $shipping = ($subtotal > 0 && ($subtotal - $discount) < 50.0) ? 5.99 : 0.0;
        $total = max(0.0, ($subtotal - $discount) + $shipping);

        // Normalize payment method for database enum ('card','cod','bank')
        $dbPaymentMethod = in_array($paymentMethod, ['card', 'stripe', 'credit_card']) ? 'card' : ($paymentMethod === 'bank' ? 'bank' : 'cod');
        $paymentStatus = ($dbPaymentMethod === 'cod' || $dbPaymentMethod === 'bank') ? 'pending' : 'paid';

        $orderNumber = Order::generateOrderNumber();
        $userId = Auth::id() ?: null;

        $orderId = Order::create([
            'order_number' => $orderNumber,
            'user_id' => $userId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'postcode' => $postcode,
            'notes' => $notes,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'payment_method' => $dbPaymentMethod,
            'payment_status' => $paymentStatus,
            'status' => 'received'
        ]);

        // Insert line items & decrement stock
        foreach ($cart as $item) {
            $productId = !empty($item['id']) ? (int)$item['id'] : null;
            $qty = (int)($item['quantity'] ?? 1);

            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $productId,
                'name' => $item['name'] ?? 'Product',
                'price' => (float)$item['price'],
                'quantity' => $qty,
                'img' => $item['img'] ?? ''
            ]);

            // Decrement product inventory
            if ($productId) {
                $prod = Product::find($productId);
                if ($prod) {
                    $newStock = max(0, (int)$prod['stock'] - $qty);
                    Product::update($productId, [
                        'stock' => $newStock,
                        'in_stock' => $newStock > 0 ? 1 : 0
                    ]);
                }
            }
        }

        AuditLog::log('ORDER_PLACED', 'orders', $orderId, [
            'order_number' => $orderNumber,
            'total' => $total,
            'payment_method' => $dbPaymentMethod,
            'payment_status' => $paymentStatus
        ]);

        // Clear cart and coupons
        Session::remove('cart');
        Session::remove('coupon');

        $redirectUrl = ViewHelper::url("order-success/{$orderNumber}");

        if ($this->request->isAjax()) {
            $this->json([
                'success' => true,
                'order_number' => $orderNumber,
                'redirect' => $redirectUrl,
                'message' => "Order #{$orderNumber} placed successfully!"
            ]);
            return;
        }

        Flash::success("Order #{$orderNumber} placed successfully!");
        $this->redirect("order-success/{$orderNumber}");
    }

    public function success(string $orderNumber): void
    {
        $order = Order::firstWhere('order_number = :num', ['num' => $orderNumber]);

        if (!$order) {
            $this->redirect('our-products');
            return;
        }

        $order = Order::getWithItems((int)$order['id']);

        $this->render('shop.order-success', [
            'pageTitle' => "Order #{$orderNumber} Confirmed — PetGuard",
            'order' => $order
        ]);
    }
}
