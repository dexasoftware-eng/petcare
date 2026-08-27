<?php

use Core\Migration;

class m0019_create_vendor_and_communication_ecosystem extends Migration
{
    public function up(PDO $db): void
    {
        // 1. Update users table role enum to include 'vendor'
        try {
            $db->exec("ALTER TABLE `users` MODIFY COLUMN `role` ENUM('petowner', 'veterinarian', 'shelter', 'vendor', 'admin') DEFAULT 'petowner';");
        } catch (Throwable $e) {
            // Already altered or compatible
        }

        // 2. Vendor Profiles Table
        $db->exec("CREATE TABLE IF NOT EXISTS `vendor_profiles` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL UNIQUE,
            `store_name` VARCHAR(150) NOT NULL,
            `business_registration` VARCHAR(100) NULL,
            `store_logo` VARCHAR(255) NULL,
            `store_banner` VARCHAR(255) NULL,
            `description` TEXT NULL,
            `shipping_policy` TEXT NULL,
            `refund_policy` TEXT NULL,
            `verification_status` ENUM('pending', 'approved', 'rejected', 'suspended') DEFAULT 'approved',
            `rejection_reason` TEXT NULL,
            `rating` DECIMAL(3,2) DEFAULT 5.00,
            `total_sales_count` INT DEFAULT 0,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`verification_status`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 3. Update products table with vendor_id and enhanced fields individually
        $productCols = [
            "ALTER TABLE `products` ADD COLUMN `vendor_id` INT NULL AFTER `id`",
            "ALTER TABLE `products` ADD COLUMN `sale_price` DECIMAL(10,2) NULL AFTER `price`",
            "ALTER TABLE `products` ADD COLUMN `weight` VARCHAR(50) NULL AFTER `stock`",
            "ALTER TABLE `products` ADD COLUMN `target_species` VARCHAR(50) DEFAULT 'All Pets' AFTER `weight`",
            "ALTER TABLE `products` ADD COLUMN `is_archived` TINYINT(1) DEFAULT 0 AFTER `in_stock`",
            "ALTER TABLE `products` ADD INDEX (`vendor_id`)",
            "ALTER TABLE `products` ADD INDEX (`is_archived`)"
        ];

        foreach ($productCols as $sql) {
            try {
                $db->exec($sql);
            } catch (Throwable $e) {
                // Column or index may already exist
            }
        }

        // 4. WebRTC Call Sessions Table
        $db->exec("CREATE TABLE IF NOT EXISTS `call_sessions` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `session_token` VARCHAR(64) NOT NULL UNIQUE,
            `caller_id` INT NOT NULL,
            `receiver_id` INT NOT NULL,
            `call_type` ENUM('audio', 'video') DEFAULT 'video',
            `status` ENUM('initiating', 'ringing', 'connected', 'ended', 'rejected', 'missed', 'busy') DEFAULT 'initiating',
            `related_entity_type` ENUM('appointment', 'adoption', 'order', 'emergency', 'consultation', 'direct') DEFAULT 'direct',
            `related_entity_id` INT NULL,
            `offer_sdp` MEDIUMTEXT NULL,
            `answer_sdp` MEDIUMTEXT NULL,
            `caller_ice_candidates` MEDIUMTEXT NULL,
            `receiver_ice_candidates` MEDIUMTEXT NULL,
            `started_at` DATETIME NULL,
            `ended_at` DATETIME NULL,
            `duration_seconds` INT DEFAULT 0,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`caller_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`receiver_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`session_token`),
            INDEX (`caller_id`),
            INDEX (`receiver_id`),
            INDEX (`status`),
            INDEX (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 5. Conversations Table (Relationship-based messaging)
        $db->exec("CREATE TABLE IF NOT EXISTS `conversations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user1_id` INT NOT NULL,
            `user2_id` INT NOT NULL,
            `related_entity_type` ENUM('appointment', 'adoption', 'order', 'pet', 'support') DEFAULT 'support',
            `related_entity_id` INT NULL,
            `subject` VARCHAR(200) NULL,
            `last_message_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`user1_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`user2_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`user1_id`),
            INDEX (`user2_id`),
            INDEX (`last_message_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 6. Messages Table
        $db->exec("CREATE TABLE IF NOT EXISTS `messages` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `conversation_id` INT NOT NULL,
            `sender_id` INT NOT NULL,
            `message_text` TEXT NOT NULL,
            `attachment_url` VARCHAR(255) NULL,
            `attachment_type` VARCHAR(50) NULL,
            `is_read` TINYINT(1) DEFAULT 0,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`conversation_id`) REFERENCES `conversations`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`sender_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`conversation_id`),
            INDEX (`sender_id`),
            INDEX (`is_read`),
            INDEX (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 7. Veterinarian Clinical Services Table
        $db->exec("CREATE TABLE IF NOT EXISTS `vet_services` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `vet_id` INT NOT NULL,
            `name` VARCHAR(150) NOT NULL,
            `category` VARCHAR(100) DEFAULT 'General Consultation',
            `price` DECIMAL(10,2) NOT NULL DEFAULT 45.00,
            `duration_minutes` INT NOT NULL DEFAULT 30,
            `description` TEXT NULL,
            `is_active` TINYINT(1) DEFAULT 1,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`vet_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`vet_id`),
            INDEX (`is_active`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 8. Veterinarian Weekly Availability Table
        $db->exec("CREATE TABLE IF NOT EXISTS `vet_availabilities` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `vet_id` INT NOT NULL,
            `day_of_week` ENUM('monday','tuesday','wednesday','thursday','friday','saturday','sunday') NOT NULL,
            `start_time` TIME NOT NULL DEFAULT '09:00:00',
            `end_time` TIME NOT NULL DEFAULT '17:00:00',
            `slot_duration_minutes` INT NOT NULL DEFAULT 30,
            `is_available` TINYINT(1) DEFAULT 1,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`vet_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            UNIQUE KEY `uniq_vet_day` (`vet_id`, `day_of_week`),
            INDEX (`vet_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 9. Veterinary Clinical Consultation Records Table
        $db->exec("CREATE TABLE IF NOT EXISTS `consultation_records` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `appointment_id` INT NULL,
            `vet_id` INT NOT NULL,
            `pet_id` INT NOT NULL,
            `owner_id` INT NOT NULL,
            `symptoms` TEXT NULL,
            `diagnosis` TEXT NOT NULL,
            `treatment_plan` TEXT NOT NULL,
            `prescription` TEXT NULL,
            `clinical_notes` TEXT NULL,
            `follow_up_date` DATE NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`vet_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`owner_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
            INDEX (`vet_id`),
            INDEX (`pet_id`),
            INDEX (`owner_id`),
            INDEX (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // 10. Seed Demo Vendor and Demo Data
        $this->seedVendorAndEcosystemData($db);
    }

    private function seedVendorAndEcosystemData(PDO $db): void
    {
        // 1. Create or ensure Demo Vendor User
        $vendor = $db->query("SELECT id FROM `users` WHERE `email` = 'vendor@petguard.com' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $passwordHash = password_hash('password123', PASSWORD_BCRYPT);

        if (!$vendor) {
            $stmt = $db->prepare("INSERT INTO `users` (`name`, `email`, `phone`, `address`, `password_hash`, `role`, `status`, `email_verified`) VALUES
                ('PetGuard Nutrition & Supplies', 'vendor@petguard.com', '+1-555-018-7744', '500 Commerce Blvd, Suite 100, Austin TX', :pass, 'vendor', 'active', 1)");
            $stmt->execute(['pass' => $passwordHash]);
            $vendorId = (int)$db->lastInsertId();
        } else {
            $vendorId = (int)$vendor['id'];
            $db->exec("UPDATE `users` SET `role` = 'vendor', `status` = 'active', `password_hash` = '{$passwordHash}' WHERE `id` = {$vendorId}");
        }

        // 2. Create Vendor Profile
        $vProfile = $db->query("SELECT id FROM `vendor_profiles` WHERE `user_id` = {$vendorId} LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        if (!$vProfile) {
            $stmt = $db->prepare("INSERT INTO `vendor_profiles` (`user_id`, `store_name`, `business_registration`, `store_logo`, `store_banner`, `description`, `shipping_policy`, `refund_policy`, `verification_status`, `rating`, `total_sales_count`) VALUES
                (:uid, 'PetGuard Official Pet Emporium', 'TX-BUS-98231', 'assets/img/heading-img.png', 'assets/img/hero-bg.jpg', 'Direct manufacturer and certified organic pet nutrition, orthopedic beds, interactive toys, and veterinary-grade supplements.', 'Free express shipping on all orders over $49. 2-day delivery across continental US.', '30-day hassle-free returns on unopened items.', 'approved', 4.95, 142)");
            $stmt->execute(['uid' => $vendorId]);
        }

        // 3. Link existing products to this vendor
        try {
            $db->exec("UPDATE `products` SET `vendor_id` = {$vendorId}, `target_species` = 'Dog & Cat' WHERE `vendor_id` IS NULL OR `vendor_id` = 0");
        } catch (Throwable $e) {
            // Column may not be ready
        }

        // 4. Seed Vet Services for Dr. Sarah Jenkins (vet@petguard.com)
        $vet = $db->query("SELECT id FROM `users` WHERE `email` = 'vet@petguard.com' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        if ($vet) {
            $vetId = (int)$vet['id'];
            $sCount = (int)$db->query("SELECT COUNT(*) FROM `vet_services` WHERE `vet_id` = {$vetId}")->fetchColumn();
            if ($sCount === 0) {
                $stmt = $db->prepare("INSERT INTO `vet_services` (`vet_id`, `name`, `category`, `price`, `duration_minutes`, `description`) VALUES
                    ({$vetId}, 'General Canine/Feline Wellness Exam', 'Preventive Care', 55.00, 30, 'Comprehensive nose-to-tail physical exam, heart & lung auscultation, dental and coat evaluation.'),
                    ({$vetId}, 'Telemedicine Video Consultation', 'Telehealth', 40.00, 20, 'Direct HD video consultation for non-emergency triage, behavioral advice, and prescription renewals.'),
                    ({$vetId}, 'Core Vaccination & Antibody Titer', 'Vaccinations', 65.00, 15, 'Core vaccine administration including Rabies, DHPP / FVRCP with digital passport certification.'),
                    ({$vetId}, 'Nutritional & Allergy Assessment', 'Specialty', 75.00, 45, 'In-depth dietary review, food elimination trial planning, and dermatology analysis.'),
                    ({$vetId}, 'Post-Operative Recovery Follow-up', 'Surgery', 35.00, 20, 'Surgical incision evaluation, suture removal check, and pain management adjustment.')");
                $stmt->execute();
            }

            // Seed Vet Availability
            $aCount = (int)$db->query("SELECT COUNT(*) FROM `vet_availabilities` WHERE `vet_id` = {$vetId}")->fetchColumn();
            if ($aCount === 0) {
                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                foreach ($days as $day) {
                    $start = $day === 'saturday' ? '10:00:00' : '09:00:00';
                    $end = $day === 'saturday' ? '14:00:00' : '17:30:00';
                    $db->exec("INSERT INTO `vet_availabilities` (`vet_id`, `day_of_week`, `start_time`, `end_time`, `slot_duration_minutes`, `is_available`) VALUES
                        ({$vetId}, '{$day}', '{$start}', '{$end}', 30, 1)");
                }
            }

            // Seed a sample consultation record for Bella
            $cCount = (int)$db->query("SELECT COUNT(*) FROM `consultation_records` WHERE `vet_id` = {$vetId}")->fetchColumn();
            if ($cCount === 0) {
                $owner = $db->query("SELECT id FROM `users` WHERE `email` = 'owner@petguard.com' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                $pet = $db->query("SELECT id FROM `pets` LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                if ($owner && $pet) {
                    $ownerId = (int)$owner['id'];
                    $petId = (int)$pet['id'];
                    $stmt = $db->prepare("INSERT INTO `consultation_records` (`appointment_id`, `vet_id`, `pet_id`, `owner_id`, `symptoms`, `diagnosis`, `treatment_plan`, `prescription`, `clinical_notes`, `follow_up_date`) VALUES
                        (1, {$vetId}, {$petId}, {$ownerId}, 'Mild seasonal itchiness on paws and ears after park walks.', 'Canine Seasonal Atopic Dermatitis (Mild)', 'Wipe paws after walks with chlorhexidine wipes. Maintain daily Omega-3 fish oil supplement.', 'Apoquel 5.4mg - 1 tablet daily for 7 days if acute flair occurs.', 'Patient is in excellent overall physical condition, clear lungs, ideal body condition score 5/9.', DATE_ADD(CURRENT_DATE(), INTERVAL 6 MONTH))");
                    $stmt->execute();
                }
            }
        }

        // 5. Seed sample conversation & message between Owner and Vet
        $owner = $db->query("SELECT id FROM `users` WHERE `email` = 'owner@petguard.com' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        if ($owner && $vet) {
            $ownerId = (int)$owner['id'];
            $vetId = (int)$vet['id'];
            $conv = $db->query("SELECT id FROM `conversations` WHERE (`user1_id` = {$ownerId} AND `user2_id` = {$vetId}) OR (`user1_id` = {$vetId} AND `user2_id` = {$ownerId}) LIMIT 1")->fetch(PDO::FETCH_ASSOC);
            if (!$conv) {
                $stmt = $db->prepare("INSERT INTO `conversations` (`user1_id`, `user2_id`, `related_entity_type`, `related_entity_id`, `subject`) VALUES
                    ({$ownerId}, {$vetId}, 'appointment', 1, 'Bella - Annual Wellness Follow-up')");
                $stmt->execute();
                $convId = (int)$db->lastInsertId();

                $db->exec("INSERT INTO `messages` (`conversation_id`, `sender_id`, `message_text`, `is_read`, `created_at`) VALUES
                    ({$convId}, {$ownerId}, 'Hello Dr. Jenkins, Bella had her joint supplement this morning and is doing very well.', 1, DATE_SUB(NOW(), INTERVAL 2 HOUR)),
                    ({$convId}, {$vetId}, 'That is wonderful news! Keep up the daily routine and let me know if any limping occurs during park agility training.', 0, DATE_SUB(NOW(), INTERVAL 1 HOUR))");
            }
        }
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `consultation_records`;");
        $db->exec("DROP TABLE IF EXISTS `vet_availabilities`;");
        $db->exec("DROP TABLE IF EXISTS `vet_services`;");
        $db->exec("DROP TABLE IF EXISTS `messages`;");
        $db->exec("DROP TABLE IF EXISTS `conversations`;");
        $db->exec("DROP TABLE IF EXISTS `call_sessions`;");
        $db->exec("DROP TABLE IF EXISTS `vendor_profiles`;");
    }
}
