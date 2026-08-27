<?php

namespace Models;

use Core\Model;

class Message extends Model
{
    protected static string $table = 'messages';

    public static function getForConversation(int $conversationId): array
    {
        $sql = "SELECT m.*, u.name as sender_name, u.role as sender_role
                FROM `messages` m
                JOIN `users` u ON m.sender_id = u.id
                WHERE m.conversation_id = :cid
                ORDER BY m.created_at ASC";
        return self::query($sql, ['cid' => $conversationId]);
    }

    public static function markAsRead(int $conversationId, int $readerUserId): void
    {
        self::execute("UPDATE `messages` SET `is_read` = 1 WHERE `conversation_id` = :cid AND `sender_id` != :uid AND `is_read` = 0", [
            'cid' => $conversationId,
            'uid' => $readerUserId
        ]);
    }

    public static function getTotalUnreadCount(int $userId): int
    {
        $sql = "SELECT COUNT(*) as count 
                FROM `messages` m
                JOIN `conversations` c ON m.conversation_id = c.id
                WHERE (c.user1_id = :u1 OR c.user2_id = :u2)
                  AND m.sender_id != :u3
                  AND m.is_read = 0";
        $results = self::query($sql, ['u1' => $userId, 'u2' => $userId, 'u3' => $userId]);
        return (int)($results[0]['count'] ?? 0);
    }
}
