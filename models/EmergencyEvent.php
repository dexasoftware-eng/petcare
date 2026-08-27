<?php

namespace Models;

use Core\Model;

class EmergencyEvent extends Model
{
    protected static string $table = 'emergency_events';

    public static function getWithDetails(string $condition = '1=1', array $params = []): array
    {
        $sql = "SELECT e.*, 
                       p.name AS pet_name, p.species AS pet_species, p.breed AS pet_breed,
                       u.name AS owner_name, u.phone AS owner_phone, u.email AS owner_email,
                       v.name AS assigned_vet_name
                FROM `emergency_events` e
                LEFT JOIN `pets` p ON e.pet_id = p.id
                LEFT JOIN `users` u ON e.user_id = u.id
                LEFT JOIN `users` v ON e.assigned_vet_id = v.id
                WHERE {$condition}
                ORDER BY FIELD(e.status, 'active', 'in_triage', 'assigned', 'resolved'), e.created_at DESC";
        return self::query($sql, $params);
    }
}
