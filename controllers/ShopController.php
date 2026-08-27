<?php

namespace Controllers;

use Core\Controller;
use Models\Product;
use Models\Category;
use Models\ProductImage;

class ShopController extends Controller
{
    public function index(): void
    {
        $selectedCategory = $this->request->get('category');
        $search = trim((string)$this->request->get('search', ''));
        $species = $this->request->get('species');
        $minPrice = $this->request->get('min_price') !== null && $this->request->get('min_price') !== '' ? (float)$this->request->get('min_price') : null;
        $maxPrice = $this->request->get('max_price') !== null && $this->request->get('max_price') !== '' ? (float)$this->request->get('max_price') : null;
        $sort = $this->request->get('sort', 'featured');
        $page = max(1, (int)$this->request->get('page', 1));

        $conditions = ['is_archived = 0'];
        $params = [];

        if (!empty($selectedCategory)) {
            // Support both category slug and category title
            $catModel = Category::findBySlug($selectedCategory);
            if ($catModel) {
                $conditions[] = "category = :cat";
                $params['cat'] = $catModel['title'];
            } else {
                $conditions[] = "category = :cat";
                $params['cat'] = $selectedCategory;
            }
        }

        if (!empty($species) && $species !== 'all') {
            $conditions[] = "(target_species = :spec OR target_species = 'All Pets')";
            $params['spec'] = $species;
        }

        if ($minPrice !== null) {
            $conditions[] = "price >= :min_p";
            $params['min_p'] = $minPrice;
        }

        if ($maxPrice !== null) {
            $conditions[] = "price <= :max_p";
            $params['max_p'] = $maxPrice;
        }

        if (!empty($search)) {
            $conditions[] = "(name LIKE :search OR description LIKE :search OR category LIKE :search OR target_species LIKE :search)";
            $params['search'] = "%{$search}%";
        }

        // Sorting mapping
        $orderBy = match ($sort) {
            'price_low' => 'price ASC, id DESC',
            'price_high' => 'price DESC, id DESC',
            'rating' => 'rating DESC, reviews_count DESC, id DESC',
            'newest' => 'id DESC',
            default => 'is_deal_of_week DESC, rating DESC, id DESC'
        };

        $where = implode(' AND ', $conditions);
        $productsData = Product::paginate($page, 12, $where, $params, $orderBy);
        $categories = Category::all('id ASC');

        // Total products count for filter badges
        $totalCatalogCount = Product::count('is_archived = 0');

        $this->render('shop.index', [
            'pageTitle' => 'Pet Marketplace, Clinical Nutrition & Supplies — PetGuard',
            'products' => $productsData['items'],
            'pagination' => $productsData['pagination'],
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'selectedSpecies' => $species,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'sort' => $sort,
            'search' => $search,
            'totalCatalogCount' => $totalCatalogCount
        ]);
    }

    public function details(string $slug): void
    {
        $product = Product::findBySlug($slug);

        if (!$product) {
            $this->redirect('our-products');
            return;
        }

        $images = ProductImage::getForProduct((int)$product['id']);
        
        $relatedProducts = Product::where('category = :cat AND id != :id AND is_archived = 0', [
            'cat' => $product['category'],
            'id' => $product['id']
        ], 'rating DESC, id DESC', 4);

        $this->render('shop.details', [
            'pageTitle' => "{$product['name']} — PetGuard Marketplace",
            'product' => $product,
            'images' => $images,
            'relatedProducts' => $relatedProducts
        ]);
    }
}
