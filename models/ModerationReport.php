<?php

namespace Models;

use Core\Model;

class ModerationReport extends Model
{
    protected static string $table = 'moderation_reports';

    public static function getWithReporter(string $condition = '1=1', array $params = []): array
    {
        $sql = "SELECT r.*, u.name AS reporter_name, u.email AS reporter_email, res.name AS resolver_name
                FROM `moderation_reports` r
                LEFT JOIN `users` u ON r.reporter_id = u.id
                LEFT JOIN `users` res ON r.resolved_by = res.id
                WHERE {$condition}
                ORDER BY r.created_at DESC";
        return self::query($sql, $params);
    }
}
