<?php

namespace Models;

use Core\Model;

class AdoptionApplication extends Model
{
    protected static string $table = 'adoption_applications';

    public static function getWithDetails(string $condition = '1=1', array $params = [], string $orderBy = 'a.created_at DESC'): array
    {
        $sql = "SELECT a.*, 
                       p.name AS pet_name, p.species AS pet_species, p.breed AS pet_breed, p.avatar AS pet_avatar,
                       u.name AS applicant_name, u.email AS applicant_email, u.phone AS applicant_phone,
                       s.name AS shelter_name
                FROM `adoption_applications` a
                LEFT JOIN `pets` p ON a.pet_id = p.id
                LEFT JOIN `users` u ON a.applicant_id = u.id
                LEFT JOIN `users` s ON a.shelter_id = s.id
                WHERE {$condition}
                ORDER BY {$orderBy}";
        return self::query($sql, $params);
    }
}
