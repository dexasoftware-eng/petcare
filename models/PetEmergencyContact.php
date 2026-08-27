<?php

namespace Models;

use Core\Model;

class PetEmergencyContact extends Model
{
    protected static string $table = 'pet_emergency_contacts';

    public static function getContactsForUser(int $userId): array
    {
        return self::query("SELECT c.*, p.name AS pet_name
            FROM pet_emergency_contacts c
            JOIN pets p ON c.pet_id = p.id
            WHERE c.user_id = :uid
            ORDER BY c.is_primary DESC, c.created_at ASC", ['uid' => $userId]);
    }

    public static function getContactsForPet(int $petId): array
    {
        return self::where('pet_id = :pid', ['pid' => $petId], 'is_primary DESC, created_at ASC');
    }
}
