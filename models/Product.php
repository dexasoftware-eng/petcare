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
        return self::where('category = :cat AND in_stock = 1', ['cat' => $category['title']], 'id DESC', $limit);
    }
}
