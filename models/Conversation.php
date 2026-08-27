<?php

namespace Models;

use Core\Model;

class Conversation extends Model
{
    protected static string $table = 'conversations';

    public static function findOrCreate(int $user1Id, int $user2Id, string $entityType = 'support', ?int $entityId = null, ?string $subject = null): array
    {
        $sql = "SELECT * FROM `conversations` 
                WHERE ((user1_id = :u1 AND user2_id = :u2) OR (user1_id = :u2 AND user2_id = :u1))
                  AND related_entity_type = :etype
                  AND (related_entity_id = :eid OR (related_entity_id IS NULL AND :eid IS NULL))
                LIMIT 1";
        $results = self::query($sql, [
            'u1' => $user1Id,
            'u2' => $user2Id,
            'etype' => $entityType,
            'eid' => $entityId
        ]);

        if (!empty($results)) {
            return $results[0];
        }

        $id = self::create([
            'user1_id' => $user1Id,
            'user2_id' => $user2Id,
            'related_entity_type' => $entityType,
            'related_entity_id' => $entityId,
            'subject' => $subject ?: 'Direct Conversation',
            'last_message_at' => date('Y-m-d H:i:s')
        ]);

        return self::find($id);
    }

    public static function getConversationsForUser(int $userId): array
    {
        $sql = "SELECT c.*,
                       u1.name as user1_name, u1.role as user1_role,
                       u2.name as user2_name, u2.role as user2_role,
                       (SELECT message_text FROM `messages` WHERE conversation_id = c.id ORDER BY id DESC LIMIT 1) as last_message,
                       (SELECT is_read FROM `messages` WHERE conversation_id = c.id AND sender_id != :uid1 ORDER BY id DESC LIMIT 1) as is_last_read,
                       (SELECT COUNT(*) FROM `messages` WHERE conversation_id = c.id AND sender_id != :uid2 AND is_read = 0) as unread_count
                FROM `conversations` c
                JOIN `users` u1 ON c.user1_id = u1.id
                JOIN `users` u2 ON c.user2_id = u2.id
                WHERE c.user1_id = :uid3 OR c.user2_id = :uid4
                ORDER BY c.last_message_at DESC";
        return self::query($sql, [
            'uid1' => $userId,
            'uid2' => $userId,
            'uid3' => $userId,
            'uid4' => $userId
        ]);
    }
}
