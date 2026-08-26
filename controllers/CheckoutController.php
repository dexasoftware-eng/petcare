<?php

namespace Controllers;

use Core\Controller;
use Core\Session;
use Helpers\Auth;
use Helpers\Flash;
use Models\Order;
use Models\OrderItem;
use Models\AuditLog;

class CheckoutController extends Controller
{
    public function index(): void
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            Flash::warning('Your cart is currently empty. Please add products before checking out.');
            $this->redirect('our-products');
        }

        $subtotal = 0.0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        $this->render('shop.checkout', [
            'pageTitle' => 'Cart Checkout & Order Finalization — PetGuard',
            'cart' => $cart,
            'subtotal' => $subtotal,
            'user' => Auth::user()
        ]);
    }

    public function process(): void
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            Flash::warning('Your cart is empty.');
            $this->redirect('our-products');
        }

        $data = $this->validate($this->request->all(), [
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'email' => 'required|email',
            'phone' => 'required|min:6',
            'address' => 'required|min:4',
            'city' => 'required',
            'postcode' => 'required',
            'payment_method' => 'required|in:card,cod,bank'
        ]);

        $subtotal = 0.0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        $orderNumber = Order::generateOrderNumber();
        $userId = Auth::id();

        $orderId = Order::create([
            'order_number' => $orderNumber,
            'user_id' => $userId,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'postcode' => $data['postcode'],
            'notes' => $this->request->post('notes', ''),
            'subtotal' => $subtotal,
            'discount' => 0.00,
            'total' => $subtotal,
            'payment_method' => $data['payment_method'],
            'payment_status' => 'paid',
            'status' => 'received'
        ]);

        // Insert line items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $item['id'] ?? null,
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'img' => $item['img'] ?? ''
            ]);
        }

        AuditLog::log('ORDER_PLACED', 'orders', $orderId, ['order_number' => $orderNumber, 'total' => $subtotal]);

        // Clear cart
        Session::remove('cart');

        Flash::success("Order #{$orderNumber} placed successfully!");
        $this->redirect("order-success/{$orderNumber}");
    }

    public function success(string $orderNumber): void
    {
        $order = Order::firstWhere('order_number = :num', ['num' => $orderNumber]);

        if (!$order) {
            $this->redirect('our-products');
        }

        $order = Order::getWithItems($order['id']);

        $this->render('shop.order-success', [
            'pageTitle' => 'Order Confirmation — PetGuard',
            'order' => $order
        ]);
    }
}
