<?php

use Core\Migration;

class m0018_create_pet_owner_ecosystem_tables extends Migration
{
    public function up(PDO $db): void
    {
        // 1. Care Tasks Table (Daily care checklist, routines, feeding, walking, grooming, medication)
        $sqlCareTasks = "CREATE TABLE IF NOT EXISTS `care_tasks` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pet_id` INT NOT NULL,
            `user_id` INT NOT NULL,
            `title` VARCHAR(200) NOT NULL,
            `task_type` ENUM('feeding', 'walking', 'medication', 'grooming', 'dental', 'training', 'veterinary', 'custom') DEFAULT 'custom',
            `time_due` VARCHAR(20) DEFAULT '08:00 AM',
            `frequency` ENUM('daily', 'weekly', 'monthly', 'once') DEFAULT 'daily',
            `is_completed` TINYINT(1) DEFAULT 0,
            `last_completed_at` DATETIME NULL,
            `reminder_enabled` TINYINT(1) DEFAULT 1,
            `notes` TEXT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`pet_id`),
            INDEX (`user_id`),
            INDEX (`is_completed`),
            INDEX (`task_type`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        // 2. Pet Medications Table
        $sqlMedications = "CREATE TABLE IF NOT EXISTS `pet_medications` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pet_id` INT NOT NULL,
            `user_id` INT NOT NULL,
            `name` VARCHAR(150) NOT NULL,
            `dosage` VARCHAR(100) NOT NULL,
            `frequency` VARCHAR(100) DEFAULT 'Once daily',
            `start_date` DATE NOT NULL,
            `end_date` DATE NULL,
            `prescribing_vet` VARCHAR(150) NULL,
            `instructions` TEXT NULL,
            `is_active` TINYINT(1) DEFAULT 1,
            `last_administered_at` DATETIME NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`pet_id`),
            INDEX (`user_id`),
            INDEX (`is_active`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        // 3. Pet Weights Table (Growth and Weight tracking)
        $sqlWeights = "CREATE TABLE IF NOT EXISTS `pet_weights` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pet_id` INT NOT NULL,
            `user_id` INT NOT NULL,
            `weight_kg` DECIMAL(5,2) NOT NULL,
            `recorded_date` DATE NOT NULL,
            `notes` VARCHAR(255) NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`pet_id`),
            INDEX (`recorded_date`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        // 4. Pet Document Vault Table
        $sqlDocs = "CREATE TABLE IF NOT EXISTS `pet_documents` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pet_id` INT NOT NULL,
            `user_id` INT NOT NULL,
            `title` VARCHAR(200) NOT NULL,
            `doc_type` ENUM('vaccine_cert', 'medical_report', 'adoption_papers', 'insurance', 'id_card', 'lab_results', 'other') DEFAULT 'other',
            `file_path` VARCHAR(255) NOT NULL,
            `file_size` VARCHAR(50) NULL,
            `notes` TEXT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`pet_id`),
            INDEX (`doc_type`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        // 5. Family & Pet Sitter Sharing Table
        $sqlFamily = "CREATE TABLE IF NOT EXISTS `pet_family_access` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pet_id` INT NOT NULL,
            `user_id` INT NOT NULL, -- Owner who shared
            `member_name` VARCHAR(150) NOT NULL,
            `member_email` VARCHAR(150) NOT NULL,
            `relationship` VARCHAR(100) DEFAULT 'Family Member',
            `access_level` ENUM('view_only', 'view_care', 'full_access') DEFAULT 'view_care',
            `is_sitter` TINYINT(1) DEFAULT 0,
            `expires_at` DATETIME NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`pet_id`),
            INDEX (`member_email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        // 6. Emergency Contacts Table
        $sqlEmergContacts = "CREATE TABLE IF NOT EXISTS `pet_emergency_contacts` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pet_id` INT NOT NULL,
            `user_id` INT NOT NULL,
            `contact_name` VARCHAR(150) NOT NULL,
            `relationship` VARCHAR(100) DEFAULT 'Emergency Contact',
            `phone` VARCHAR(50) NOT NULL,
            `alt_phone` VARCHAR(50) NULL,
            `clinic_name` VARCHAR(150) NULL,
            `is_primary` TINYINT(1) DEFAULT 0,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`pet_id`),
            INDEX (`is_primary`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        // 7. User Favorites (Vets, Pets, Products)
        $sqlFavorites = "CREATE TABLE IF NOT EXISTS `user_favorites` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `entity_type` ENUM('vet', 'pet', 'product') NOT NULL,
            `entity_id` INT NOT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            UNIQUE KEY `uniq_user_favorite` (`user_id`, `entity_type`, `entity_id`),
            INDEX (`user_id`),
            INDEX (`entity_type`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sqlCareTasks);
        $db->exec($sqlMedications);
        $db->exec($sqlWeights);
        $db->exec($sqlDocs);
        $db->exec($sqlFamily);
        $db->exec($sqlEmergContacts);
        $db->exec($sqlFavorites);

        // 8. Add extra columns to `pets` table for rich lifecycle data
        try {
            $db->exec("ALTER TABLE `pets` 
                ADD COLUMN `is_lost` TINYINT(1) DEFAULT 0 AFTER `passport_status`,
                ADD COLUMN `lost_date` DATETIME NULL AFTER `is_lost`,
                ADD COLUMN `lost_location` VARCHAR(255) NULL AFTER `lost_date`,
                ADD COLUMN `lost_notes` TEXT NULL AFTER `lost_location`,
                ADD COLUMN `birthday` DATE NULL AFTER `age`,
                ADD COLUMN `color` VARCHAR(100) NULL AFTER `breed`,
                ADD COLUMN `allergies` TEXT NULL AFTER `blood_group`,
                ADD COLUMN `diet_instructions` TEXT NULL AFTER `allergies`;");
        } catch (Throwable $e) {
            // Already altered
        }

        // Seed initial demo records for demo pet owner
        $this->seedInitialPetOwnerData($db);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `user_favorites`;");
        $db->exec("DROP TABLE IF EXISTS `pet_emergency_contacts`;");
        $db->exec("DROP TABLE IF EXISTS `pet_family_access`;");
        $db->exec("DROP TABLE IF EXISTS `pet_documents`;");
        $db->exec("DROP TABLE IF EXISTS `pet_weights`;");
        $db->exec("DROP TABLE IF EXISTS `pet_medications`;");
        $db->exec("DROP TABLE IF EXISTS `care_tasks`;");
    }

    private function seedInitialPetOwnerData(PDO $db): void
    {
        // Get first pet owned by owner@petguard.com
        $owner = $db->query("SELECT id FROM users WHERE email = 'owner@petguard.com' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        if (!$owner) return;
        $ownerId = (int)$owner['id'];

        $pet = $db->query("SELECT id FROM pets WHERE user_id = {$ownerId} LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        if (!$pet) {
            // Seed a pet if none exists
            $db->exec("INSERT INTO `pets` (`user_id`, `name`, `species`, `breed`, `gender`, `age`, `birthday`, `weight`, `color`, `blood_group`, `microchip_id`, `care_score`, `vaccination_status`, `passport_status`, `avatar`, `qr_token`, `allergies`, `diet_instructions`)
                VALUES ({$ownerId}, 'Bella', 'Dog', 'Golden Retriever', 'Female', '2 Years', '2024-04-15', '24.5 kg', 'Golden Honey', 'DEA 1.1 Negative', '985141002348912', 95, 'Up to Date', 'active', 'assets/img/dog-1.png', 'PG-PET-BEL-882', 'Mild pollen allergy, No poultry meal', 'Grain-free salmon formula, 2 cups twice daily')");
            $petId = (int)$db->lastInsertId();
        } else {
            $petId = (int)$pet['id'];
            $db->exec("UPDATE `pets` SET 
                `birthday` = '2024-04-15', 
                `color` = 'Golden Honey', 
                `allergies` = 'Mild pollen allergy, No poultry meal', 
                `diet_instructions` = 'Grain-free salmon formula, 2 cups twice daily',
                `qr_token` = IFNULL(`qr_token`, 'PG-PET-BEL-882')
                WHERE `id` = {$petId}");
        }

        // Seed Care Tasks
        $taskCount = (int)$db->query("SELECT COUNT(*) FROM care_tasks WHERE pet_id = {$petId}")->fetchColumn();
        if ($taskCount === 0) {
            $db->exec("INSERT INTO `care_tasks` (`pet_id`, `user_id`, `title`, `task_type`, `time_due`, `frequency`, `is_completed`, `notes`) VALUES
                ({$petId}, {$ownerId}, 'Morning Nutrition & Fresh Water', 'feeding', '08:00 AM', 'daily', 1, '1 cup salmon kibble + fresh filtered water'),
                ({$petId}, {$ownerId}, 'Daily Joint Supplement (Glucosamine)', 'medication', '08:30 AM', 'daily', 1, '1 chewable tablet with breakfast'),
                ({$petId}, {$ownerId}, 'Neighborhood Park Walk & Exercise', 'walking', '10:00 AM', 'daily', 0, '30 min active brisk walk + fetch'),
                ({$petId}, {$ownerId}, 'Evening Meal & Hydration Refresh', 'feeding', '06:00 PM', 'daily', 0, '1 cup salmon kibble'),
                ({$petId}, {$ownerId}, 'Weekly Coat Brushing & De-Shedding', 'grooming', '07:30 PM', 'weekly', 0, 'Use undercoat de-shedding comb'),
                ({$petId}, {$ownerId}, 'Dental Hygiene Chew', 'dental', '08:30 PM', 'daily', 0, '1 enzymatic dental stick')");
        }

        // Seed Medications
        $medCount = (int)$db->query("SELECT COUNT(*) FROM pet_medications WHERE pet_id = {$petId}")->fetchColumn();
        if ($medCount === 0) {
            $db->exec("INSERT INTO `pet_medications` (`pet_id`, `user_id`, `name`, `dosage`, `frequency`, `start_date`, `end_date`, `prescribing_vet`, `instructions`, `is_active`) VALUES
                ({$petId}, {$ownerId}, 'Cosequin DS Joint Health Chew', '1 Tablet', 'Once daily with meal', '2026-01-01', '2026-12-31', 'Dr. Sarah Jenkins, DVM', 'Administer in the morning with food to maintain joint cartilage.', 1),
                ({$petId}, {$ownerId}, 'Heartgard Plus Chewables', '1 Chew', 'Monthly on 1st', '2026-01-01', '2026-12-31', 'Dr. Sarah Jenkins, DVM', 'Heartworm prevention and intestinal parasite control.', 1)");
        }

        // Seed Weights
        $weightCount = (int)$db->query("SELECT COUNT(*) FROM pet_weights WHERE pet_id = {$petId}")->fetchColumn();
        if ($weightCount === 0) {
            $db->exec("INSERT INTO `pet_weights` (`pet_id`, `user_id`, `weight_kg`, `recorded_date`, `notes`) VALUES
                ({$petId}, {$ownerId}, 22.80, '2026-03-01', 'Spring wellness check'),
                ({$petId}, {$ownerId}, 23.40, '2026-05-15', 'Regular monthly weigh-in'),
                ({$petId}, {$ownerId}, 24.10, '2026-07-10', 'Active agility training period'),
                ({$petId}, {$ownerId}, 24.50, '2026-08-20', 'Current optimal weight')");
        }

        // Seed Emergency Contacts
        $contactCount = (int)$db->query("SELECT COUNT(*) FROM pet_emergency_contacts WHERE pet_id = {$petId}")->fetchColumn();
        if ($contactCount === 0) {
            $db->exec("INSERT INTO `pet_emergency_contacts` (`pet_id`, `user_id`, `contact_name`, `relationship`, `phone`, `alt_phone`, `clinic_name`, `is_primary`) VALUES
                ({$petId}, {$ownerId}, 'Dr. Sarah Jenkins (Primary Vet)', 'Veterinary Clinic', '+1-555-019-2834', '+1-555-019-2835', 'PetGuard Central Hospital', 1),
                ({$petId}, {$ownerId}, 'Metro 24/7 Animal Emergency Hospital', 'Emergency Clinic', '+1-800-555-PET-911', NULL, 'Metro Trauma Center', 0),
                ({$petId}, {$ownerId}, 'Sarah Morgan', 'Co-Owner / Spouse', '+1-555-012-9876', NULL, NULL, 0)");
        }

        // Seed Family Access
        $familyCount = (int)$db->query("SELECT COUNT(*) FROM pet_family_access WHERE pet_id = {$petId}")->fetchColumn();
        if ($familyCount === 0) {
            $db->exec("INSERT INTO `pet_family_access` (`pet_id`, `user_id`, `member_name`, `member_email`, `relationship`, `access_level`, `is_sitter`) VALUES
                ({$petId}, {$ownerId}, 'Sarah Morgan', 'sarah.m@petguard.com', 'Co-Owner / Spouse', 'full_access', 0),
                ({$petId}, {$ownerId}, 'Emily Watson', 'emily.sitter@gmail.com', 'Trusted Pet Sitter', 'view_care', 1)");
        }
    }
}
