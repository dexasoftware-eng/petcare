<?php

namespace Models;

use Core\Model;

class ShelterProfile extends Model
{
    protected static string $table = 'shelter_profiles';

    public static function findByUserId(int $userId): ?array
    {
        return self::findBy('user_id', $userId);
    }
}
