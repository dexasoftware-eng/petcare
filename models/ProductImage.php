<?php

namespace Models;

use Core\Model;

class ProductImage extends Model
{
    protected static string $table = 'product_images';

    public static function getForProduct(int $productId): array
    {
        return self::where('product_id = :pid', ['pid' => $productId], 'is_primary DESC, sort_order ASC, id ASC');
    }
}
