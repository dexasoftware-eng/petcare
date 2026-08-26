<?php

use Core\Migration;

class m0009_create_inquiries_table extends Migration
{
    public function up(PDO $db): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `inquiries` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(100) NOT NULL,
            `email` VARCHAR(150) NOT NULL,
            `phone` VARCHAR(50) NULL,
            `service` VARCHAR(100) DEFAULT 'Grooming',
            `message` TEXT NOT NULL,
            `status` ENUM('new', 'in-progress', 'resolved') DEFAULT 'new',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`status`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sql);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `inquiries`;");
    }
}
