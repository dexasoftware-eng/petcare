<?php

namespace Models;

use Core\Model;

class ConsultationRecord extends Model
{
    protected static string $table = 'consultation_records';

    public static function getForPet(int $petId): array
    {
        $sql = "SELECT cr.*, v.name as vet_name, vp.clinic_name, vp.specialization
                FROM `consultation_records` cr
                JOIN `users` v ON cr.vet_id = v.id
                LEFT JOIN `veterinarian_profiles` vp ON v.id = vp.user_id
                WHERE cr.pet_id = :pid
                ORDER BY cr.created_at DESC";
        return self::query($sql, ['pid' => $petId]);
    }

    public static function getForVet(int $vetId, int $limit = 50): array
    {
        $sql = "SELECT cr.*, p.name as pet_name, p.breed as pet_breed, p.species, o.name as owner_name, o.phone as owner_phone
                FROM `consultation_records` cr
                JOIN `pets` p ON cr.pet_id = p.id
                JOIN `users` o ON cr.owner_id = o.id
                WHERE cr.vet_id = :vid
                ORDER BY cr.created_at DESC
                LIMIT {$limit}";
        return self::query($sql, ['vid' => $vetId]);
    }
}
