<?php

namespace Controllers;

use Core\Controller;
use Models\Product;
use Models\Category;

class ShopController extends Controller
{
    public function index(): void
    {
        $selectedCategory = $this->request->get('category');
        $search = $this->request->get('search');
        $page = (int)$this->request->get('page', 1);

        $conditions = ['in_stock = 1'];
        $params = [];

        if (!empty($selectedCategory)) {
            $conditions[] = "category = :cat";
            $params['cat'] = $selectedCategory;
        }

        if (!empty($search)) {
            $conditions[] = "(name LIKE :search OR description LIKE :search)";
            $params['search'] = "%{$search}%";
        }

        $where = implode(' AND ', $conditions);

        $productsData = Product::paginate($page, 9, $where, $params, 'id DESC');
        $categories = Category::all('id ASC');

        $this->render('shop.index', [
            'pageTitle' => 'Pet Marketplace & Products — PetGuard',
            'products' => $productsData['items'],
            'pagination' => $productsData['pagination'],
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'search' => $search
        ]);
    }

    public function details(string $slug): void
    {
        $product = Product::findBySlug($slug);

        if (!$product) {
            $this->redirect('our-products');
        }

        $relatedProducts = Product::where('category = :cat AND id != :id AND in_stock = 1', [
            'cat' => $product['category'],
            'id' => $product['id']
        ], 'id DESC', 3);

        $this->render('shop.details', [
            'pageTitle' => "{$product['name']} — PetGuard",
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }
}
