<?php

use Core\Migration;

class m0002_create_profiles_table extends Migration
{
    public function up(PDO $db): void
    {
        // Veterinarian Profiles
        $sqlVet = "CREATE TABLE IF NOT EXISTS `veterinarian_profiles` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL UNIQUE,
            `specialization` VARCHAR(150) NOT NULL,
            `experience` INT NOT NULL DEFAULT 0,
            `clinic_name` VARCHAR(150) DEFAULT '',
            `clinic_address` TEXT DEFAULT NULL,
            `bio` TEXT DEFAULT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        // Shelter Profiles
        $sqlShelter = "CREATE TABLE IF NOT EXISTS `shelter_profiles` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL UNIQUE,
            `shelter_name` VARCHAR(150) NOT NULL,
            `contact_person` VARCHAR(100) NOT NULL,
            `capacity` INT DEFAULT 0,
            `website` VARCHAR(255) DEFAULT '',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sqlVet);
        $db->exec($sqlShelter);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `shelter_profiles`;");
        $db->exec("DROP TABLE IF EXISTS `veterinarian_profiles`;");
    }
}
