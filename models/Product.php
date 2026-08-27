<?php

namespace Models;

use Core\Model;

class Product extends Model
{
    protected static string $table = 'products';

    public static function findBySlug(string $slug): ?array
    {
        return self::findBy('slug', $slug);
    }

    public static function getFeatured(int $limit = 6): array
    {
        return self::where('in_stock = 1', [], 'is_deal_of_week DESC, id DESC', $limit);
    }

    public static function getByCategory(string $categorySlug, int $limit = 12): array
    {
        $category = Category::findBySlug($categorySlug);
        if (!$category) {
            return [];
        }
        return self::where('category = :cat AND in_stock = 1 AND is_archived = 0', ['cat' => $category['title']], 'id DESC', $limit);
    }

    public static function getForVendor(int $vendorId, string $search = '', string $category = '', string $stockStatus = ''): array
    {
        $sql = "SELECT * FROM `products` WHERE (vendor_id = :vid OR vendor_id IS NULL) AND is_archived = 0";
        $params = ['vid' => $vendorId];

        if (!empty($search)) {
            $sql .= " AND (name LIKE :search OR sku LIKE :search)";
            $params['search'] = "%{$search}%";
        }

        if (!empty($category)) {
            $sql .= " AND category = :cat";
            $params['cat'] = $category;
        }

        if ($stockStatus === 'in_stock') {
            $sql .= " AND stock > 5";
        } elseif ($stockStatus === 'low_stock') {
            $sql .= " AND stock > 0 AND stock <= 5";
        } elseif ($stockStatus === 'out_of_stock') {
            $sql .= " AND stock = 0";
        }

        $sql .= " ORDER BY id DESC";
        return self::query($sql, $params);
    }

    public static function updateStockLevel(int $productId, int $newStock): bool
    {
        $inStock = $newStock > 0 ? 1 : 0;
        return (bool) self::update($productId, [
            'stock' => max(0, $newStock),
            'in_stock' => $inStock
        ]);
    }
}
