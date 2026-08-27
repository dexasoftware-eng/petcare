<?php

namespace Models;

use Core\Model;

class VendorProfile extends Model
{
    protected static string $table = 'vendor_profiles';

    public static function findByUserId(int $userId): ?array
    {
        return self::findBy('user_id', $userId);
    }

    public static function getWithUserDetails(string $where = '1=1', array $params = []): array
    {
        $sql = "SELECT vp.*, u.name as user_name, u.email, u.phone, u.status as user_status, u.created_at as registered_at
                FROM `vendor_profiles` vp
                JOIN `users` u ON vp.user_id = u.id
                WHERE {$where}
                ORDER BY vp.created_at DESC";
        return self::query($sql, $params);
    }
}
