<?php

namespace Models;

use Core\Model;

class Notification extends Model
{
    protected static string $table = 'notifications';

    public static function getRecentForUser(string $role = 'petowner', int $limit = 5): array
    {
        return self::where("audience = '{$role}' OR audience = 'everyone'", [], "created_at DESC LIMIT {$limit}");
    }

    public static function getUnreadCountForUser(string $role = 'petowner'): int
    {
        return self::count("(audience = '{$role}' OR audience = 'everyone') AND is_read = 0");
    }

    public static function broadcast(string $title, string $message, string $audience = 'everyone', string $priority = 'normal', ?int $senderId = null, ?string $actionUrl = null): int|string
    {
        return self::create([
            'sender_id' => $senderId,
            'audience' => $audience,
            'title' => $title,
            'message' => $message,
            'priority' => $priority,
            'is_broadcast' => 1,
            'action_url' => $actionUrl,
            'is_read' => 0
        ]);
    }
}
