<?php

namespace Models;

use Core\Model;

class CareTask extends Model
{
    protected static string $table = 'care_tasks';

    public static function getTasksForUser(int $userId): array
    {
        return self::query("SELECT t.*, p.name AS pet_name, p.species AS pet_species, p.avatar AS pet_avatar
            FROM care_tasks t
            JOIN pets p ON t.pet_id = p.id
            WHERE t.user_id = :uid
            ORDER BY t.is_completed ASC, t.time_due ASC", ['uid' => $userId]);
    }

    public static function getTasksForPet(int $petId): array
    {
        return self::where('pet_id = :pid', ['pid' => $petId], 'time_due ASC');
    }

    public static function getTodayCompletedCount(int $userId): int
    {
        return self::count("user_id = {$userId} AND is_completed = 1");
    }

    public static function getTodayPendingCount(int $userId): int
    {
        return self::count("user_id = {$userId} AND is_completed = 0");
    }
}
