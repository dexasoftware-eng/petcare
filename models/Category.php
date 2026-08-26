<?php

namespace Models;

use Core\Model;

class Category extends Model
{
    protected static string $table = 'categories';

    public static function findBySlug(string $slug): ?array
    {
        return self::findBy('slug', $slug);
    }
}
