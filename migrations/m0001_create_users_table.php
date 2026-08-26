<?php

use Core\Migration;

class m0001_create_users_table extends Migration
{
    public function up(PDO $db): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(100) NOT NULL,
            `email` VARCHAR(150) NOT NULL UNIQUE,
            `phone` VARCHAR(30) NOT NULL,
            `address` TEXT NOT NULL,
            `password_hash` VARCHAR(255) NOT NULL,
            `role` ENUM('petowner', 'veterinarian', 'shelter', 'admin') DEFAULT 'petowner',
            `status` ENUM('active', 'pending', 'suspended', 'disabled') DEFAULT 'active',
            `email_verified` TINYINT(1) DEFAULT 0,
            `email_verification_token` VARCHAR(255) NULL,
            `password_reset_token` VARCHAR(255) NULL,
            `password_reset_expires_at` DATETIME NULL,
            `failed_login_attempts` INT DEFAULT 0,
            `locked_until` DATETIME NULL,
            `last_login_at` DATETIME NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`role`),
            INDEX (`status`),
            INDEX (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sql);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `users`;");
    }
}
