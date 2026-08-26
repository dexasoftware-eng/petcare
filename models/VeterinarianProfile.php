<?php

namespace Models;

use Core\Model;

class VeterinarianProfile extends Model
{
    protected static string $table = 'veterinarian_profiles';

    public static function findByUserId(int $userId): ?array
    {
        return self::findBy('user_id', $userId);
    }
}
