<?php

namespace Models;

use Core\Model;

class PetWeight extends Model
{
    protected static string $table = 'pet_weights';

    public static function getWeightsForPet(int $petId): array
    {
        return self::where('pet_id = :pid', ['pid' => $petId], 'recorded_date ASC');
    }
}
