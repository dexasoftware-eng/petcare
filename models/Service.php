<?php

namespace Models;

use Core\Model;

class Service extends Model
{
    protected static string $table = 'services';

    public static function findBySlug(string $slug): ?array
    {
        return self::findBy('slug', $slug);
    }
}
