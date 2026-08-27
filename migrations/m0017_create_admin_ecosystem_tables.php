<?php

use Core\Migration;

class m0017_create_admin_ecosystem_tables extends Migration
{
    public function up(PDO $db): void
    {
        // 1. Adoption Applications Table
        $db->exec("CREATE TABLE IF NOT EXISTS `adoption_applications` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pet_id` INT NOT NULL,
            `applicant_id` INT NOT NULL,
            `shelter_id` INT NULL,
            `living_arrangement` VARCHAR(100) DEFAULT 'House with Yard',
            `experience_level` VARCHAR(100) DEFAULT 'Experienced Pet Owner',
            `has_other_pets` TINYINT(1) DEFAULT 0,
            `message` TEXT NULL,
            `status` ENUM('submitted', 'under_review', 'interview', 'approved', 'rejected', 'adopted') DEFAULT 'submitted',
            `reviewer_notes` TEXT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`pet_id`),
            INDEX (`applicant_id`),
            INDEX (`shelter_id`),
            INDEX (`status`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 2. Moderation Reports Table
        $db->exec("CREATE TABLE IF NOT EXISTS `moderation_reports` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `reporter_id` INT NULL,
            `entity_type` ENUM('review', 'listing', 'comment', 'user', 'product') DEFAULT 'listing',
            `entity_id` INT NOT NULL,
            `reason` VARCHAR(255) NOT NULL,
            `details` TEXT NULL,
            `status` ENUM('pending', 'reviewed', 'resolved', 'dismissed') DEFAULT 'pending',
            `resolution_notes` TEXT NULL,
            `resolved_by` INT NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`entity_type`, `entity_id`),
            INDEX (`status`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Platform Notifications & Broadcasts Table
        $db->exec("CREATE TABLE IF NOT EXISTS `notifications` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `sender_id` INT NULL,
            `target_user_id` INT NULL,
            `audience` ENUM('everyone', 'petowner', 'veterinarian', 'shelter', 'admin', 'individual') DEFAULT 'everyone',
            `title` VARCHAR(255) NOT NULL,
            `message` TEXT NOT NULL,
            `priority` ENUM('normal', 'high', 'urgent') DEFAULT 'normal',
            `is_broadcast` TINYINT(1) DEFAULT 1,
            `is_read` TINYINT(1) DEFAULT 0,
            `action_url` VARCHAR(255) NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            INDEX (`audience`),
            INDEX (`target_user_id`),
            INDEX (`is_read`),
            INDEX (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 4. AI Usage Logs Table
        $db->exec("CREATE TABLE IF NOT EXISTS `ai_usage_logs` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NULL,
            `query_type` VARCHAR(100) DEFAULT 'general_assistant',
            `model` VARCHAR(100) NOT NULL,
            `prompt_preview` VARCHAR(255) NULL,
            `tokens_used` INT DEFAULT 0,
            `latency_ms` INT DEFAULT 0,
            `safety_status` ENUM('safe', 'emergency', 'flagged') DEFAULT 'safe',
            `status` ENUM('success', 'failed', 'rate_limited', 'simulated') DEFAULT 'success',
            `error_message` VARCHAR(255) NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            INDEX (`user_id`),
            INDEX (`safety_status`),
            INDEX (`status`),
            INDEX (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Care Content (Articles, FAQs, Health Tips) Table
        $db->exec("CREATE TABLE IF NOT EXISTS `care_content` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `type` ENUM('article', 'faq', 'health_tip') DEFAULT 'article',
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NULL,
            `category` VARCHAR(100) DEFAULT 'General Wellness',
            `species` VARCHAR(50) DEFAULT 'All',
            `content` TEXT NOT NULL,
            `image` VARCHAR(255) NULL,
            `author_id` INT NULL,
            `status` ENUM('draft', 'published', 'archived') DEFAULT 'published',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`type`),
            INDEX (`status`),
            INDEX (`species`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Emergency Center Events Table
        $db->exec("CREATE TABLE IF NOT EXISTS `emergency_events` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `pet_id` INT NULL,
            `user_id` INT NOT NULL,
            `emergency_type` VARCHAR(100) NOT NULL,
            `severity` ENUM('moderate', 'severe', 'critical') DEFAULT 'severe',
            `status` ENUM('active', 'in_triage', 'assigned', 'resolved') DEFAULT 'active',
            `assigned_vet_id` INT NULL,
            `symptoms` TEXT NULL,
            `triage_notes` TEXT NULL,
            `location` VARCHAR(255) NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`pet_id`),
            INDEX (`user_id`),
            INDEX (`severity`),
            INDEX (`status`),
            INDEX (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // Check & Add verification columns to veterinarian_profiles
        try {
            $db->exec("ALTER TABLE `veterinarian_profiles` 
                ADD COLUMN `verification_status` ENUM('pending', 'approved', 'rejected', 'suspended') DEFAULT 'approved' AFTER `bio`,
                ADD COLUMN `license_number` VARCHAR(100) DEFAULT 'VET-DVM-98421' AFTER `verification_status`,
                ADD COLUMN `rejection_reason` TEXT NULL AFTER `license_number`;");
        } catch (Throwable $e) {
            // Already exists or column added
        }

        // Check & Add verification columns to shelter_profiles
        try {
            $db->exec("ALTER TABLE `shelter_profiles` 
                ADD COLUMN `verification_status` ENUM('pending', 'approved', 'rejected', 'suspended') DEFAULT 'approved' AFTER `capacity`,
                ADD COLUMN `rejection_reason` TEXT NULL AFTER `verification_status`;");
        } catch (Throwable $e) {
            // Already exists or column added
        }

        // Check & Add passport_status to pets
        try {
            $db->exec("ALTER TABLE `pets` 
                ADD COLUMN `passport_status` ENUM('active', 'revoked', 'pending') DEFAULT 'active' AFTER `qr_token`,
                ADD COLUMN `passport_revoked_at` DATETIME NULL AFTER `passport_status`;");
        } catch (Throwable $e) {
            // Already exists or column added
        }

        // Check & Add stock to products
        try {
            $db->exec("ALTER TABLE `products` 
                ADD COLUMN `stock` INT DEFAULT 25 AFTER `in_stock`;");
        } catch (Throwable $e) {
            // Already exists or column added
        }

        // Seed initial demo data for new admin features if empty
        $this->seedInitialAdminData($db);
    }

    private function seedInitialAdminData(PDO $db): void
    {
        // Check if care_content has entries
        $count = (int)$db->query("SELECT COUNT(*) FROM `care_content`")->fetchColumn();
        if ($count === 0) {
            $stmt = $db->prepare("INSERT INTO `care_content` (`type`, `title`, `slug`, `category`, `species`, `content`, `status`) VALUES
                ('article', 'Essential Canine Nutrition Guide: Protein & Carbohydrate Balance', 'essential-canine-nutrition-guide', 'Nutrition', 'Dog', 'Balanced nutrition is the single most important factor in canine longevity. Ensure clean protein sources, essential fatty acids, and proper portion control based on weight and activity level.', 'published'),
                ('article', 'Feline Hydration & Kidney Disease Prevention', 'feline-hydration-kidney-prevention', 'Preventive Care', 'Cat', 'Cats have a low thirst drive. Incorporating wet food and circulating water fountains significantly reduces the risk of chronic kidney disease and urinary crystals.', 'published'),
                ('faq', 'How often should my adult dog receive a comprehensive wellness exam?', 'faq-wellness-frequency', 'Clinical Schedule', 'Dog', 'Adult dogs under 7 years should be examined at least once annually. Senior pets (7+ years) benefit significantly from bi-annual checkups.', 'published'),
                ('faq', 'What are the required core vaccinations for indoor rescue cats?', 'faq-indoor-cat-vaccines', 'Vaccinations', 'Cat', 'Core vaccines include FVRCP (Feline Viral Rhinotracheitis, Calicivirus, Panleukopenia) and Rabies, regardless of whether the cat is strictly indoor.', 'published'),
                ('health_tip', 'Summer Heat Safety: Recognizing Heatstroke in Brachycephalic Breeds', 'heatstroke-prevention', 'Seasonal Care', 'All', 'Never leave pets in parked cars even with windows cracked. Provide shade, constant fresh water, and avoid walking during peak afternoon pavement temperatures.', 'published')");
            $stmt->execute();
        }

        // Check if notifications has entries
        $countNotif = (int)$db->query("SELECT COUNT(*) FROM `notifications`")->fetchColumn();
        if ($countNotif === 0) {
            $stmt = $db->prepare("INSERT INTO `notifications` (`sender_id`, `audience`, `title`, `message`, `priority`, `is_broadcast`) VALUES
                (1, 'everyone', '🐾 Welcome to the New FurShield Platform Release', 'We have successfully upgraded our digital health records, veterinary telemedicine, and animal shelter adoption ecosystem.', 'normal', 1),
                (1, 'veterinarian', '🩺 Clinical Portal Upgrade: Electronic Prescription Pad Active', 'Veterinarians can now generate digital prescriptions directly linked to pet medical records.', 'high', 1),
                (1, 'shelter', '🏠 Adoption Drive: Matchmaking Engine Active', 'Shelters can now use AI-driven lifestyle matching for potential adopters.', 'normal', 1)");
            $stmt->execute();
        }

        // Check if adoption_applications has entries
        $countAdoptions = (int)$db->query("SELECT COUNT(*) FROM `adoption_applications`")->fetchColumn();
        if ($countAdoptions === 0) {
            // Find an adoption pet and user
            $pet = $db->query("SELECT id FROM `pets` WHERE `is_for_adoption` = 1 LIMIT 1")->fetch();
            $petId = $pet ? $pet['id'] : 1;
            $user = $db->query("SELECT id FROM `users` WHERE `role` = 'petowner' LIMIT 1")->fetch();
            $userId = $user ? $user['id'] : 2;

            $stmt = $db->prepare("INSERT INTO `adoption_applications` (`pet_id`, `applicant_id`, `shelter_id`, `living_arrangement`, `experience_level`, `has_other_pets`, `message`, `status`) VALUES
                (:pet_id, :applicant_id, 4, 'Single Family Home with Fenced Yard', 'Lifelong Dog Owner', 1, 'We would love to provide a loving and active home with daily park walks.', 'under_review')");
            $stmt->execute(['pet_id' => $petId, 'applicant_id' => $userId]);
        }

        // Check if moderation_reports has entries
        $countMod = (int)$db->query("SELECT COUNT(*) FROM `moderation_reports`")->fetchColumn();
        if ($countMod === 0) {
            $stmt = $db->prepare("INSERT INTO `moderation_reports` (`reporter_id`, `entity_type`, `entity_id`, `reason`, `details`, `status`) VALUES
                (2, 'review', 1, 'Inappropriate Language', 'Review contains promotional spam link.', 'pending')");
            $stmt->execute();
        }

        // Check if emergency_events has entries
        $countEmerg = (int)$db->query("SELECT COUNT(*) FROM `emergency_events`")->fetchColumn();
        if ($countEmerg === 0) {
            $stmt = $db->prepare("INSERT INTO `emergency_events` (`pet_id`, `user_id`, `emergency_type`, `severity`, `status`, `symptoms`, `triage_notes`, `location`) VALUES
                (1, 2, 'Accidental Ingestion (Chocolate)', 'severe', 'resolved', 'Consumed 50g dark chocolate 30 mins ago.', 'Owner advised to induce emesis with vet supervision. Patient recovered.', 'Manhattan, New York')");
            $stmt->execute();
        }
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `emergency_events`;");
        $db->exec("DROP TABLE IF EXISTS `care_content`;");
        $db->exec("DROP TABLE IF EXISTS `ai_usage_logs`;");
        $db->exec("DROP TABLE IF EXISTS `notifications`;");
        $db->exec("DROP TABLE IF EXISTS `moderation_reports`;");
        $db->exec("DROP TABLE IF EXISTS `adoption_applications`;");
    }
}
