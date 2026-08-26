<?php

namespace Controllers;

use Core\Controller;
use Core\Session;
use Helpers\Flash;
use Models\Product;

class CartController extends Controller
{
    public function index(): void
    {
        $cart = Session::get('cart', []);
        $subtotal = 0.0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        $this->render('shop.cart', [
            'pageTitle' => 'Shopping Cart — PetGuard',
            'cart' => $cart,
            'subtotal' => $subtotal
        ]);
    }

    public function add(): void
    {
        $productId = (int)$this->request->post('product_id');
        $quantity = max(1, (int)$this->request->post('quantity', 1));

        $product = Product::find($productId);
        if (!$product) {
            Flash::error('Product not found.');
            $this->back();
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'price' => (float)$product['price'],
                'quantity' => $quantity,
                'img' => $product['img']
            ];
        }

        Session::set('cart', $cart);

        if ($this->request->isAjax()) {
            $this->json(['success' => true, 'message' => "Added {$product['name']} to cart!", 'cartCount' => \Helpers\ViewHelper::cartCount()]);
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
            } else if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $qty;
            }
        }

        Session::set('cart', $cart);
        Flash::success('Cart quantities updated.');
        $this->redirect('shop-cart');
    }

    public function remove(int|string $id): void
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::set('cart', $cart);
            Flash::info('Item removed from cart.');
        }
        $this->redirect('shop-cart');
    }

    public function clear(): void
    {
        Session::remove('cart');
        Flash::info('Cart emptied.');
        $this->redirect('shop-cart');
    }
}
