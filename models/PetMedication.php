<?php

namespace Models;

use Core\Model;

class PetMedication extends Model
{
    protected static string $table = 'pet_medications';

    public static function getMedicationsForUser(int $userId): array
    {
        return self::query("SELECT m.*, p.name AS pet_name, p.species AS pet_species, p.avatar AS pet_avatar
            FROM pet_medications m
            JOIN pets p ON m.pet_id = p.id
            WHERE m.user_id = :uid
            ORDER BY m.is_active DESC, m.created_at DESC", ['uid' => $userId]);
    }

    public static function getMedicationsForPet(int $petId): array
    {
        return self::where('pet_id = :pid', ['pid' => $petId], 'is_active DESC, start_date DESC');
    }

    public static function getDoseLimit(string $frequency): int
    {
        $freq = strtolower(trim($frequency));
        if (str_contains($freq, 'twice') || str_contains($freq, '2 times') || str_contains($freq, 'every 12 hours')) {
            return 2;
        }
        if (str_contains($freq, 'three') || str_contains($freq, '3 times') || str_contains($freq, 'every 8 hours')) {
            return 3;
        }
        if (str_contains($freq, 'four') || str_contains($freq, '4 times') || str_contains($freq, 'every 6 hours')) {
            return 4;
        }
        if (str_contains($freq, 'as needed') || str_contains($freq, 'prn')) {
            return 999;
        }
        return 1;
    }

    public static function getDosesGivenToday(array $med): int
    {
        $today = date('Y-m-d');
        if (!empty($med['last_dose_date']) && $med['last_dose_date'] === $today) {
            return max(1, (int)($med['doses_today'] ?? 1));
        }
        if (!empty($med['last_administered_at']) && str_starts_with($med['last_administered_at'], $today)) {
            return max(1, (int)($med['doses_today'] ?? 1));
        }
        return 0;
    }

    public static function isDoseLimitReached(array $med): bool
    {
        $limit = self::getDoseLimit($med['frequency'] ?? 'Once daily');
        if ($limit >= 999) return false;
        $given = self::getDosesGivenToday($med);
        return $given >= $limit;
    }
}
