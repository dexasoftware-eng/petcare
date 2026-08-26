<?php

use Core\Migration;

class m0008_create_teams_table extends Migration
{
    public function up(PDO $db): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `team_members` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(100) NOT NULL,
            `role` VARCHAR(100) NOT NULL,
            `img` VARCHAR(255) NOT NULL,
            `bio` TEXT NOT NULL,
            `phone` VARCHAR(50) DEFAULT '+021 01283492',
            `email` VARCHAR(100) DEFAULT 'team@patte.com',
            `facebook` VARCHAR(255) DEFAULT '#',
            `twitter` VARCHAR(255) DEFAULT '#',
            `instagram` VARCHAR(255) DEFAULT '#',
            `skills` TEXT NULL, -- JSON formatted array
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sql);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `team_members`;");
    }
}
