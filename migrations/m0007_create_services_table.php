<?php

use Core\Migration;

class m0007_create_services_table extends Migration
{
    public function up(PDO $db): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `services` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(150) NOT NULL,
            `slug` VARCHAR(150) NOT NULL UNIQUE,
            `icon` VARCHAR(100) NOT NULL,
            `accent_color` VARCHAR(20) DEFAULT '#940c69',
            `short_desc` TEXT NOT NULL,
            `full_desc` LONGTEXT NOT NULL,
            `features` TEXT NULL, -- JSON array string
            `price` VARCHAR(100) DEFAULT '$45.00 / session',
            `is_highlight` TINYINT(1) DEFAULT 0,
            `banner_img` VARCHAR(255) DEFAULT 'assets/img/we-provide-1.jpg',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sql);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `services`;");
    }
}
