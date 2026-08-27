<?php

namespace Models;

use Core\Model;

class PetFamilyAccess extends Model
{
    protected static string $table = 'pet_family_access';

    public static function getFamilyForUser(int $userId): array
    {
        return self::query("SELECT f.*, p.name AS pet_name, p.avatar AS pet_avatar
            FROM pet_family_access f
            JOIN pets p ON f.pet_id = p.id
            WHERE f.user_id = :uid
            ORDER BY f.created_at DESC", ['uid' => $userId]);
    }

    public static function getFamilyForPet(int $petId): array
    {
        return self::where('pet_id = :pid', ['pid' => $petId], 'created_at DESC');
    }
}
