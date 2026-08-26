<?php

use Core\Migration;

class m0012_create_audit_logs_table extends Migration
{
    public function up(PDO $db): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `audit_logs` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NULL,
            `action` VARCHAR(100) NOT NULL,
            `entity_type` VARCHAR(100) NULL,
            `entity_id` INT NULL,
            `ip_address` VARCHAR(50) NULL,
            `user_agent` VARCHAR(255) NULL,
            `details` TEXT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            INDEX (`user_id`),
            INDEX (`action`),
            INDEX (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sql);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `audit_logs`;");
    }
}
