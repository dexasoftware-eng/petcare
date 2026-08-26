<?php

namespace Models;

use Core\Model;

class Blog extends Model
{
    protected static string $table = 'blogs';

    public static function findBySlug(string $slug): ?array
    {
        $blog = self::findBy('slug', $slug);
        if ($blog) {
            $blog['comments'] = BlogComment::where('blog_id = :bid', ['bid' => $blog['id']], 'id DESC');
        }
        return $blog;
    }

    public static function getRecent(int $limit = 3): array
    {
        return self::where('1=1', [], 'id DESC', $limit);
    }
}
