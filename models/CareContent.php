<?php

namespace Models;

use Core\Model;

class CareContent extends Model
{
    protected static string $table = 'care_content';

    public static function getByType(string $type, string $status = 'published'): array
    {
        return self::where("type = :type AND status = :status", [
            'type' => $type,
            'status' => $status
        ], 'created_at DESC');
    }
}
