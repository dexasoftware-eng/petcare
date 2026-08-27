<?php

namespace Models;

use Core\Model;

class UserFavorite extends Model
{
    protected static string $table = 'user_favorites';

    public static function isFavorited(int $userId, string $type, int $entityId): bool
    {
        return self::count("user_id = {$userId} AND entity_type = '{$type}' AND entity_id = {$entityId}") > 0;
    }

    public static function toggle(int $userId, string $type, int $entityId): bool
    {
        $existing = self::where("user_id = :uid AND entity_type = :type AND entity_id = :eid", [
            'uid' => $userId,
            'type' => $type,
            'eid' => $entityId
        ]);

        if (!empty($existing)) {
            self::delete($existing[0]['id']);
            return false; // Removed
        } else {
            self::create([
                'user_id' => $userId,
                'entity_type' => $type,
                'entity_id' => $entityId
            ]);
            return true; // Added
        }
    }

    public static function getFavoriteEntityIds(int $userId, string $type): array
    {
        $rows = self::query("SELECT entity_id FROM user_favorites WHERE user_id = :uid AND entity_type = :type", [
            'uid' => $userId,
            'type' => $type
        ]);
        return array_column($rows, 'entity_id');
    }
}
