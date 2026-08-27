<?php

namespace Models;

use Core\Model;

class CallSession extends Model
{
    protected static string $table = 'call_sessions';

    public static function findByToken(string $token): ?array
    {
        return self::findBy('session_token', $token);
    }

    public static function getActiveIncomingCallForUser(int $userId): ?array
    {
        $sql = "SELECT cs.*, u.name as caller_name, u.role as caller_role, u.email as caller_email
                FROM `call_sessions` cs
                JOIN `users` u ON cs.caller_id = u.id
                WHERE cs.receiver_id = :uid 
                  AND cs.status IN ('initiating', 'ringing')
                  AND (cs.created_at >= DATE_SUB(NOW(), INTERVAL 90 SECOND) OR cs.created_at >= DATE_SUB(UTC_TIMESTAMP(), INTERVAL 90 SECOND))
                ORDER BY cs.id DESC
                LIMIT 1";
        $results = self::query($sql, ['uid' => $userId]);
        return $results[0] ?? null;
    }

    public static function getCallHistoryForUser(int $userId, int $limit = 30): array
    {
        $sql = "SELECT cs.*, 
                       c.name as caller_name, c.role as caller_role,
                       r.name as receiver_name, r.role as receiver_role
                FROM `call_sessions` cs
                JOIN `users` c ON cs.caller_id = c.id
                JOIN `users` r ON cs.receiver_id = r.id
                WHERE cs.caller_id = :uid1 OR cs.receiver_id = :uid2
                ORDER BY cs.created_at DESC
                LIMIT {$limit}";
        return self::query($sql, ['uid1' => $userId, 'uid2' => $userId]);
    }
}
