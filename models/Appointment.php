<?php

namespace Models;

use Core\Model;

class Appointment extends Model
{
    protected static string $table = 'appointments';

    public static function getWithDetailsForOwner(int $ownerId): array
    {
        $sql = "SELECT a.*, p.name as pet_name, p.breed as pet_breed, p.avatar as pet_avatar, v.name as vet_name 
                FROM `appointments` a
                JOIN `pets` p ON a.pet_id = p.id
                LEFT JOIN `users` v ON a.vet_id = v.id
                WHERE a.owner_id = :owner_id
                ORDER BY a.appointment_date DESC, a.appointment_time ASC";
        return self::query($sql, ['owner_id' => $ownerId]);
    }

    public static function getWithDetailsForVet(int $vetId): array
    {
        $sql = "SELECT a.*, p.name as pet_name, p.breed as pet_breed, p.species, p.avatar as pet_avatar, o.name as owner_name, o.phone as owner_phone, o.email as owner_email
                FROM `appointments` a
                JOIN `pets` p ON a.pet_id = p.id
                JOIN `users` o ON a.owner_id = o.id
                WHERE a.vet_id = :vet_id OR a.vet_id IS NULL
                ORDER BY a.appointment_date ASC, a.appointment_time ASC";
        return self::query($sql, ['vet_id' => $vetId]);
    }
}
