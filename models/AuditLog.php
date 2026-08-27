<?php

namespace Models;

use Core\Model;
use Helpers\Auth;

class AuditLog extends Model
{
    protected static string $table = 'audit_logs';

    public static function log(string $action, ?string $entityType = null, int|string|null $entityId = null, ?array $details = null): void
    {
        $userId = Auth::id();
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $ua = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);

        self::create([
            'user_id' => $userId,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId !== null ? (int)$entityId : null,
            'ip_address' => $ip,
            'user_agent' => $ua,
            'details' => $details ? json_encode($details) : null,
        ]);
    }
}
