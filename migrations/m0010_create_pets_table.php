<?php

use Core\Migration;

class m0010_create_pets_table extends Migration
{
    public function up(PDO $db): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `pets` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL, -- Owner ID or Shelter User ID
            `name` VARCHAR(100) NOT NULL,
            `species` VARCHAR(50) DEFAULT 'Dog',
            `breed` VARCHAR(100) NOT NULL,
            `gender` ENUM('Male', 'Female') DEFAULT 'Male',
            `age` VARCHAR(50) NOT NULL,
            `weight` VARCHAR(30) NOT NULL,
            `microchip_id` VARCHAR(100) NULL,
            `blood_group` VARCHAR(20) NULL,
            `is_for_adoption` TINYINT(1) DEFAULT 0,
            `adoption_status` ENUM('available', 'pending', 'adopted') DEFAULT 'available',
            `care_score` INT DEFAULT 85,
            `vaccination_status` VARCHAR(100) DEFAULT 'Up to Date',
            `avatar` VARCHAR(255) DEFAULT 'assets/img/dog-1.png',
            `medical_notes` TEXT NULL,
            `qr_token` VARCHAR(100) NULL UNIQUE,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`user_id`),
            INDEX (`is_for_adoption`),
            INDEX (`adoption_status`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sql);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `pets`;");
    }
}
