<?php

namespace Models;

use Core\Model;

class VetService extends Model
{
    protected static string $table = 'vet_services';

    public static function getForVet(int $vetId, bool $activeOnly = false): array
    {
        $where = "vet_id = :vid" . ($activeOnly ? " AND is_active = 1" : "");
        return self::where($where, ['vid' => $vetId], 'id ASC');
    }
}
