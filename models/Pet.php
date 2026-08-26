<?php

namespace Models;

use Core\Model;

class Pet extends Model
{
    protected static string $table = 'pets';

    public static function getPetsByUser(int $userId): array
    {
        return self::where('user_id = :uid', ['uid' => $userId], 'id DESC');
    }

    public static function getAdoptionListings(): array
    {
        return self::where('is_for_adoption = 1 AND adoption_status = "available"', [], 'id DESC');
    }

    public static function getVaccines(int $petId): array
    {
        return Vaccine::where('pet_id = :pid', ['pid' => $petId], 'administered_date DESC');
    }
}
