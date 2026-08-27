<?php

namespace Models;

use Core\Model;

class PetDocument extends Model
{
    protected static string $table = 'pet_documents';

    public static function getDocsForUser(int $userId): array
    {
        return self::query("SELECT d.*, p.name AS pet_name
            FROM pet_documents d
            JOIN pets p ON d.pet_id = p.id
            WHERE d.user_id = :uid
            ORDER BY d.created_at DESC", ['uid' => $userId]);
    }

    public static function getDocsForPet(int $petId): array
    {
        return self::where('pet_id = :pid', ['pid' => $petId], 'created_at DESC');
    }
}
