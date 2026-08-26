<?php

use Core\Migration;

class m0011_create_vaccines_and_appointments_table extends Migration
{
    public function up(PDO $db): void
    {
        // Appointments table
        $sqlAppt = "CREATE TABLE IF NOT EXISTS `appointments` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `owner_id` INT NOT NULL,
            `vet_id` INT NULL,
            `pet_id` INT NOT NULL,
            `appointment_date` DATE NOT NULL,
            `appointment_time` VARCHAR(20) NOT NULL,
            `consultation_type` VARCHAR(100) DEFAULT 'General Checkup',
            `symptoms` TEXT NULL,
            `clinical_notes` TEXT NULL,
            `prescription` TEXT NULL,
            `status` ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`owner_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
            INDEX (`owner_id`),
            INDEX (`vet_id`),
            INDEX (`status`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        // Vaccines log table
        $sqlVaccines = "CREATE TABLE IF NOT EXISTS `vaccines` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pet_id` INT NOT NULL,
            `vaccine_name` VARCHAR(150) NOT NULL,
            `batch_number` VARCHAR(100) NULL,
            `dose_number` VARCHAR(50) DEFAULT '1st Dose',
            `administered_date` DATE NOT NULL,
            `next_due_date` DATE NULL,
            `administering_vet` VARCHAR(150) NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sqlAppt);
        $db->exec($sqlVaccines);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `vaccines`;");
        $db->exec("DROP TABLE IF EXISTS `appointments`;");
    }
}
