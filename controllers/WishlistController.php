<?php

namespace Controllers;

use Core\Controller;
use Core\Session;
use Helpers\Auth;
use Helpers\Flash;
use Helpers\ViewHelper;
use Models\Product;
use Models\UserFavorite;

class WishlistController extends Controller
{
    /**
     * Get array of product IDs currently in wishlist (for logged in or guest)
     */
    public static function getWishlistProductIds(): array
    {
        $userId = Auth::id();
        if ($userId) {
            return UserFavorite::getFavoriteEntityIds($userId, 'product');
        }
        return Session::get('wishlist', []);
    }

    public function index(): void
    {
        $productIds = self::getWishlistProductIds();
        $products = [];

        if (!empty($productIds)) {
            $inClause = implode(',', array_map('intval', $productIds));
            $products = Product::query("SELECT * FROM products WHERE id IN ({$inClause}) AND is_archived = 0 ORDER BY id DESC");
        }

        $this->render('shop.wishlist', [
            'pageTitle' => 'My Saved Products & Wishlist — PetGuard',
            'products' => $products
        ]);
    }

    public function toggle(): void
    {
        $productId = (int)$this->request->post('product_id');
        $product = Product::find($productId);

        if (!$product) {
            $this->json(['success' => false, 'message' => 'Product not found.'], 404);
            return;
        }

        $userId = Auth::id();
        $inWishlist = false;

        if ($userId) {
            $inWishlist = UserFavorite::toggle($userId, 'product', $productId);
            $totalCount = count(UserFavorite::getFavoriteEntityIds($userId, 'product'));
        } else {
            $wishlist = Session::get('wishlist', []);
            if (in_array($productId, $wishlist)) {
                $wishlist = array_values(array_diff($wishlist, [$productId]));
                $inWishlist = false;
            } else {
                $wishlist[] = $productId;
                $inWishlist = true;
            }
            Session::set('wishlist', $wishlist);
            $totalCount = count($wishlist);
        }

        $msg = $inWishlist ? "Added \"{$product['name']}\" to your wishlist." : "Removed \"{$product['name']}\" from your wishlist.";

        if ($this->request->isAjax()) {
            $this->json([
                'success' => true,
                'in_wishlist' => $inWishlist,
                'count' => $totalCount,
                'message' => $msg
            ]);
            return;
        }

        if ($inWishlist) {
            Flash::success($msg);
        } else {
            Flash::info($msg);
        }
        $this->back();
    }

    public function remove(int|string $id): void
    {
        $productId = (int)$id;
        $userId = Auth::id();

        if ($userId) {
            UserFavorite::query("DELETE FROM user_favorites WHERE user_id = :uid AND entity_type = 'product' AND entity_id = :pid", [
                'uid' => $userId,
                'pid' => $productId
            ]);
        } else {
            $wishlist = Session::get('wishlist', []);
            $wishlist = array_values(array_diff($wishlist, [$productId]));
            Session::set('wishlist', $wishlist);
        }

        if ($this->request->isAjax()) {
            $this->json(['success' => true, 'message' => 'Item removed from wishlist.']);
            return;
        }

        Flash::info('Item removed from wishlist.');
        $this->redirect('wishlist');
    }

    public function moveToCart(int|string $id): void
    {
        $productId = (int)$id;
        $product = Product::find($productId);

        if (!$product) {
            Flash::error('Product not found.');
            $this->redirect('wishlist');
            return;
        }

        // Add to cart
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'price' => (float)$product['price'],
                'quantity' => 1,
                'img' => $product['img']
            ];
        }
        Session::set('cart', $cart);

        // Remove from wishlist
        $this->remove($productId);

        Flash::success("Moved \"{$product['name']}\" to your cart.");
        $this->redirect('shop-cart');
    }
}
