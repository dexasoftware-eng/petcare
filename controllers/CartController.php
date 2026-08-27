<?php

namespace Controllers;

use Core\Controller;
use Core\Session;
use Helpers\Flash;
use Helpers\ViewHelper;
use Models\Product;

class CartController extends Controller
{
    public function index(): void
    {
        $cart = Session::get('cart', []);
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

        $this->render('shop.cart', [
            'pageTitle' => 'Shopping Cart — PetGuard',
            'cart' => $cart,
            'subtotal' => $subtotal,
            'coupon' => $coupon,
            'discount' => $discount,
            'shipping' => $shipping,
            'total' => $total
        ]);
    }

    public function add(): void
    {
        $productId = (int)$this->request->post('product_id');
        $quantity = max(1, (int)$this->request->post('quantity', 1));

        $product = Product::find($productId);
        if (!$product) {
            if ($this->request->isAjax()) {
                $this->json(['success' => false, 'message' => 'Product not found.'], 404);
                return;
            }
            Flash::error('Product not found.');
            $this->back();
            return;
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => (int)$product['id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'category' => $product['category'] ?? '',
                'price' => (float)$product['price'],
                'quantity' => $quantity,
                'img' => $product['img']
            ];
        }

        Session::set('cart', $cart);

        if ($this->request->isAjax()) {
            $this->json([
                'success' => true,
                'message' => "Added {$product['name']} to cart!",
                'cartCount' => ViewHelper::cartCount(),
                'subtotal' => ViewHelper::cartSubtotal()
            ]);
            return;
        }

        Flash::success("Added \"{$product['name']}\" to your cart.");
        $this->redirect('shop-cart');
    }

    public function update(): void
    {
        $quantities = $this->request->post('quantities', []);
        $cart = Session::get('cart', []);

        foreach ($quantities as $productId => $qty) {
            $qty = (int)$qty;
            if ($qty <= 0) {
                unset($cart[$productId]);
            } elseif (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $qty;
            }
        }

        Session::set('cart', $cart);

        if ($this->request->isAjax()) {
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

            $this->json([
                'success' => true,
                'cart' => $cart,
                'cartCount' => ViewHelper::cartCount(),
                'subtotal' => number_format($subtotal, 2),
                'discount' => number_format($discount, 2),
                'shipping' => number_format($shipping, 2),
                'total' => number_format($total, 2),
                'message' => 'Cart updated successfully.'
            ]);
            return;
        }

        Flash::success('Cart quantities updated.');
        $this->redirect('shop-cart');
    }

    public function applyCoupon(): void
    {
        $code = strtoupper(trim((string)$this->request->post('code', '')));

        if (empty($code)) {
            if ($this->request->isAjax()) {
                $this->json(['success' => false, 'message' => 'Please enter a promo code.'], 400);
                return;
            }
            Flash::error('Please enter a promo code.');
            $this->redirect('shop-cart');
            return;
        }

        $coupons = [
            'PETGUARD10' => ['code' => 'PETGUARD10', 'type' => 'percent', 'value' => 10, 'description' => '10% Off Entire Order'],
            'WELCOME5' => ['code' => 'WELCOME5', 'type' => 'fixed', 'value' => 5.0, 'description' => '$5.00 Off Welcome Bonus'],
            'FREESHIP' => ['code' => 'FREESHIP', 'type' => 'percent', 'value' => 0, 'description' => 'Free Express Shipping']
        ];

        if (isset($coupons[$code])) {
            Session::set('coupon', $coupons[$code]);
            if ($this->request->isAjax()) {
                $this->json(['success' => true, 'message' => "Coupon '{$code}' applied! {$coupons[$code]['description']}."]);
                return;
            }
            Flash::success("Coupon '{$code}' applied!");
        } else {
            if ($this->request->isAjax()) {
                $this->json(['success' => false, 'message' => 'Invalid or expired promo code.'], 400);
                return;
            }
            Flash::error('Invalid or expired promo code.');
        }

        $this->redirect('shop-cart');
    }

    public function remove(int|string $id): void
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::set('cart', $cart);
        }

        if ($this->request->isAjax()) {
            $this->json(['success' => true, 'message' => 'Item removed from cart.', 'cartCount' => ViewHelper::cartCount()]);
            return;
        }

        Flash::info('Item removed from cart.');
        $this->redirect('shop-cart');
    }

    public function clear(): void
    {
        Session::remove('cart');
        Session::remove('coupon');

        if ($this->request->isAjax()) {
            $this->json(['success' => true, 'message' => 'Cart cleared.']);
            return;
        }

        Flash::info('Cart emptied.');
        $this->redirect('shop-cart');
    }
}
