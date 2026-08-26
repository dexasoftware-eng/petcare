<?php

use Core\Migration;

class m0013_seed_default_admin_and_content extends Migration
{
    public function up(PDO $db): void
    {
        $passwordHash = password_hash('Admin@12345', PASSWORD_BCRYPT);
        $userPasswordHash = password_hash('User@12345', PASSWORD_BCRYPT);

        // 1. Seed Users
        $db->exec("INSERT INTO `users` (`name`, `email`, `phone`, `address`, `password_hash`, `role`, `status`, `email_verified`) VALUES
        ('System Administrator', 'admin@furshield.com', '+1-800-FUR-SHLD', '100 FurShield Way, Suite 400', '{$passwordHash}', 'admin', 'active', 1),
        ('Dr. Sarah Jenkins', 'vet@furshield.com', '+1-555-019-2834', '742 Evergreen Terrace, Clinic B', '{$userPasswordHash}', 'veterinarian', 'active', 1),
        ('Hope Animal Rescue Sanctuary', 'shelter@furshield.com', '+1-555-098-7654', '12 Shelter Valley Road', '{$userPasswordHash}', 'shelter', 'active', 1),
        ('Alex Morgan', 'owner@furshield.com', '+1-555-012-3456', '88 Magnolia Court, Apt 4B', '{$userPasswordHash}', 'petowner', 'active', 1)
        ON DUPLICATE KEY UPDATE `name`=`name`;");

        // 2. Seed Vet Profile
        $vetUserId = $db->query("SELECT id FROM users WHERE email = 'vet@furshield.com'")->fetchColumn();
        if ($vetUserId) {
            $db->exec("INSERT INTO `veterinarian_profiles` (`user_id`, `specialization`, `experience`, `clinic_name`, `clinic_address`, `bio`) VALUES
            ({$vetUserId}, 'Small Animal Surgery & Canine Medicine', 8, 'FurShield Central Pet Hospital', '742 Evergreen Terrace, Clinic B', 'Dedicated small animal clinician with 8+ years specializing in complex soft tissue surgery, vaccination immunology, and canine rehabilitation.')
            ON DUPLICATE KEY UPDATE `specialization`=`specialization`;");
        }

        // 3. Seed Shelter Profile
        $shelterUserId = $db->query("SELECT id FROM users WHERE email = 'shelter@furshield.com'")->fetchColumn();
        if ($shelterUserId) {
            $db->exec("INSERT INTO `shelter_profiles` (`user_id`, `shelter_name`, `contact_person`, `capacity`, `website`) VALUES
            ({$shelterUserId}, 'Hope Animal Rescue Sanctuary', 'Maria Rodriguez', 65, 'https://hope-shelter.org')
            ON DUPLICATE KEY UPDATE `shelter_name`=`shelter_name`;");
        }

        // 4. Seed Categories
        $db->exec("INSERT INTO `categories` (`title`, `slug`, `img`, `count`, `description`) VALUES
        ('Dog Food & Diet', 'dog-food-diet', 'assets/img/food-categorie-1.png', 24, 'Premium organic and vet-certified nutritional meal packs.'),
        ('Cat Treats & Milk', 'cat-treats-milk', 'assets/img/food-categorie-2.png', 18, 'High-protein grain-free crunchies and vitamin enrichment.'),
        ('Grooming & Hygiene', 'grooming-hygiene', 'assets/img/food-categorie-3.png', 15, 'Hypoallergenic shampoos, combs, dental sprays and paw balms.'),
        ('Health & Pharmacy', 'health-pharmacy', 'assets/img/food-categorie-4.png', 32, 'Flea/tick preventives, multivitamins and joint health chews.')
        ON DUPLICATE KEY UPDATE `title`=`title`;");

        // 5. Seed Products
        $db->exec("INSERT INTO `products` (`category`, `name`, `slug`, `sku`, `price`, `old_price`, `rating`, `discount`, `img`, `description`, `in_stock`, `is_deal_of_week`, `reviews_count`) VALUES
        ('Dog Food & Diet', 'PureBalance Grain-Free Salmon & Sweet Potato', 'purebalance-grain-free-salmon', 'FS-DOG-001', 49.99, 65.00, 4.9, '-23%', 'assets/img/product-1.jpg', 'Veterinarian-formulated dry food packed with real wild salmon, prebiotics, and essential omega-3 fatty acids for optimum coat shine and digestive vigor.', 1, 1, 42),
        ('Cat Treats & Milk', 'NutriPaws Omega-3 Salmon Bites for Kittens', 'nutripaws-omega3-salmon-bites', 'FS-CAT-002', 18.50, 24.00, 4.8, '-20%', 'assets/img/product-2.jpg', 'Tender freeze-dried single-ingredient treats providing essential DHA for brain development and immune resilience.', 1, 0, 31),
        ('Grooming & Hygiene', 'FurShield Pro Herbal De-Shedding Shampoo 500ml', 'furshield-pro-herbal-shampoo', 'FS-GRM-003', 22.00, NULL, 5.0, NULL, 'assets/img/product-3.jpg', 'Infused with chamomile and organic oatmeal to alleviate itchy dander while restoring moisture to sensitive coats.', 1, 0, 19),
        ('Health & Pharmacy', 'Canine Joint Care Plus Glucosamine & Chondroitin', 'canine-joint-care-plus', 'FS-HLT-004', 36.99, 45.00, 4.9, '-18%', 'assets/img/product-4.jpg', 'Advanced mobility chewables designed to support active dogs and reduce stiffness in senior canines.', 1, 1, 64),
        ('Dog Food & Diet', 'UltraPuppy Natural Growth Formula 10kg', 'ultrapuppy-natural-growth-formula', 'FS-DOG-005', 54.00, NULL, 4.7, NULL, 'assets/img/product-5.jpg', 'Complete balanced nutrition enriched with calcium, phosphorus, and essential vitamins for growing pups.', 1, 0, 15),
        ('Health & Pharmacy', 'FleaGuard 3-in-1 Topical Shield for Cats', 'fleaguard-3in1-topical-shield', 'FS-CAT-006', 29.99, 39.99, 4.8, '-25%', 'assets/img/product-6.jpg', 'Fast-acting monthly spot-on treatment repelling fleas, lice, and heartworm vectors.', 1, 0, 53)
        ON DUPLICATE KEY UPDATE `sku`=`sku`;");

        // 6. Seed Services
        $db->exec("INSERT INTO `services` (`title`, `slug`, `icon`, `accent_color`, `short_desc`, `full_desc`, `price`, `is_highlight`, `banner_img`, `features`) VALUES
        ('Veterinary Diagnostics & Surgery', 'veterinary-diagnostics-surgery', 'fa-solid fa-stethoscope', '#fa441d', 'State-of-the-art diagnostic imaging, ultrasound, and sterile surgical suites.', 'Our accredited veterinary surgical department offers minimally invasive diagnostics, digital radiography, orthopedic repairs, soft-tissue procedures, and 24/7 post-op recovery monitoring.', '$75.00 / consult', 1, 'assets/img/we-provide-1.jpg', '[\"Digital Radiography & Ultrasound\", \"Sterile Surgical Theatres\", \"Pre-Op Blood Chemistry\", \"Dedicated Recovery Nursing\"]'),
        ('Holistic Grooming & Spa', 'holistic-grooming-spa', 'fa-solid fa-scissors', '#fbb03b', 'Hydro-massage baths, coat de-shedding, nail trim, and aromatherapy soothing.', 'Tailored spa grooming treatments designed to keep your pets looking regal and feeling fresh using 100% natural, pH-balanced botanical products.', '$45.00 / session', 0, 'assets/img/we-provide-2.jpg', '[\"Medicated Hydro-Baths\", \"Hand Scissor Styling\", \"Ear & Dental Hygiene\", \"De-Shedding Treatment\"]'),
        ('Vaccination & Preventative Care', 'vaccination-preventative-care', 'fa-solid fa-syringe', '#10b981', 'Core and lifestyle immunization schedules tracked through your digital passport.', 'Comprehensive health wellness screens, multi-pathogen vaccination protocols, parasite prevention, and digital certification.', '$35.00 / dose', 0, 'assets/img/we-provide-3.jpg', '[\"Core 5-in-1 Immunizations\", \"Rabies Titers & Passports\", \"Deworming & Parasite Defense\", \"Automated Due Reminders\"]'),
        ('Shelter & Adoption Matching', 'shelter-adoption-matching', 'fa-solid fa-heart-pulse', '#8b5cf6', 'Connecting rescue animals with loving forever homes through smart matching.', 'Our non-profit animal rescue network facilitates medical rehab, behavioral temperament scoring, and streamlined digital adoption applications.', 'Non-Profit / Free', 0, 'assets/img/we-provide-4.jpg', '[\"Verified Health Records\", \"Behavioral Temperament Scoring\", \"Direct Shelter Applications\", \"Post-Adoption Support\"]')
        ON DUPLICATE KEY UPDATE `slug`=`slug`;");

        // 7. Seed Blogs
        $db->exec("INSERT INTO `blogs` (`title`, `slug`, `category`, `author`, `author_img`, `day`, `month_year`, `img`, `excerpt`, `content`) VALUES
        ('Understanding Your Dog\'s Vaccination Timeline: A Complete Guide', 'understanding-dog-vaccination-timeline', 'Veterinary Care', 'Dr. Sarah Jenkins', 'assets/img/man.jpg', '15', 'Aug, 2026', 'assets/img/blog-1.jpg', 'Vaccinations are the foundational shield protecting our canine companions from life-threatening communicable diseases.', '<p>Vaccines are essential biological defenses that train your pet\'s immune system to identify and neutralize deadly pathogens before they cause clinical harm. Starting at 6 to 8 weeks of age, maternal antibodies begin waning, necessitating a structured series of core inoculations.</p><h4>Core Vaccines vs Non-Core</h4><p>Core immunizations include Rabies, Canine Parvovirus, Distemper, and Canine Hepatitis (DHPP). Non-core vaccines (such as Leptospirosis, Bordetella, and Lyme) are recommended based on regional lifestyle risk factors.</p>'),
        ('Top 7 Warning Signs of Feline Kidney Distress', 'warning-signs-feline-kidney-distress', 'Pet Health', 'Dr. Sarah Jenkins', 'assets/img/man.jpg', '22', 'Aug, 2026', 'assets/img/blog-2.jpg', 'Felines are notorious for masking discomfort. Learn the subtle behavioral shifts that indicate renal stress.', '<p>Chronic kidney disease is common among aging cats. Early clinical detection through routine blood urea nitrogen (BUN) and creatinine blood panels can extend feline lifespan by years.</p><h4>Key Symptoms to Watch</h4><ul><li>Excessive water consumption and frequent urination</li><li>Unexplained weight loss and dull coat texture</li><li>Lethargy and decreased grooming habits</li><li>Mild halitosis with an ammonia scent</li></ul>'),
        ('How to Prepare Your Home for a Newly Adopted Shelter Pet', 'prepare-home-for-adopted-shelter-pet', 'Shelter & Rescue', 'Maria Rodriguez', 'assets/img/man.jpg', '05', 'Jul, 2026', 'assets/img/blog-3.jpg', 'The 3-3-3 rule for shelter rescues: what to expect in the first 3 days, 3 weeks, and 3 months.', '<p>Welcoming a rescue pet requires patience and decompression space. The 3-3-3 principle describes the stages of acclimatization: 3 days to decompress from sensory overwhelm, 3 weeks to realize they are in a safe routine, and 3 months to feel fully at home.</p>')
        ON DUPLICATE KEY UPDATE `slug`=`slug`;");

        // 8. Seed Team Members
        $db->exec("INSERT INTO `team_members` (`name`, `role`, `img`, `bio`, `phone`, `email`, `skills`) VALUES
        ('Dr. Sarah Jenkins, DVM', 'Chief Veterinary Officer', 'assets/img/team-1.jpg', 'Graduate of Cornell Vet Medicine with 12 years of clinical excellence in veterinary internal medicine and surgery.', '+1-555-019-2834', 'dr.jenkins@furshield.com', '[{\"label\":\"Surgical Procedures\",\"percentage\":95},{\"label\":\"Immunology\",\"percentage\":98},{\"label\":\"Diagnostic Imaging\",\"percentage\":90}]'),
        ('Maria Rodriguez', 'Rescue & Adoption Director', 'assets/img/team-2.jpg', 'Dedicated animal advocate with 10 years experience running non-profit sanctuaries and behavioral rehabilitation programs.', '+1-555-098-7654', 'maria@furshield.com', '[{\"label\":\"Animal Behavior\",\"percentage\":94},{\"label\":\"Shelter Logistics\",\"percentage\":92},{\"label\":\"Adoption Matching\",\"percentage\":96}]'),
        ('Liam Thorne', 'Master Pet Stylist & Groomer', 'assets/img/team-3.jpg', 'Certified show groomer specializing in breed-standard styling, de-matting techniques, and holistic skin therapy.', '+1-555-078-4321', 'liam@furshield.com', '[{\"label\":\"Breed Styling\",\"percentage\":96},{\"label\":\"Coat Therapy\",\"percentage\":90},{\"label\":\"Stress-Free Handling\",\"percentage\":95}]')
        ON DUPLICATE KEY UPDATE `name`=`name`;");

        // 9. Seed Sample Pets
        $ownerUserId = $db->query("SELECT id FROM users WHERE email = 'owner@furshield.com'")->fetchColumn();
        if ($ownerUserId) {
            $db->exec("INSERT INTO `pets` (`user_id`, `name`, `species`, `breed`, `gender`, `age`, `weight`, `microchip_id`, `blood_group`, `is_for_adoption`, `care_score`, `vaccination_status`, `avatar`, `qr_token`) VALUES
            ({$ownerUserId}, 'Milo', 'Dog', 'Golden Retriever', 'Male', '3 yrs', '31 kg', '985141002938472', 'DEA 1.1 Pos', 0, 95, 'Up to Date', 'assets/img/dog-1.png', 'Milo-QR-77291'),
            ({$ownerUserId}, 'Luna', 'Cat', 'British Shorthair', 'Female', '1.5 yrs', '4.2 kg', '985141008837192', 'Type A', 0, 88, 'Due in 2 Weeks', 'assets/img/cat-1.png', 'Luna-QR-38192')
            ON DUPLICATE KEY UPDATE `name`=`name`;");
        }

        if ($shelterUserId) {
            $db->exec("INSERT INTO `pets` (`user_id`, `name`, `species`, `breed`, `gender`, `age`, `weight`, `is_for_adoption`, `adoption_status`, `care_score`, `vaccination_status`, `avatar`, `medical_notes`) VALUES
            ({$shelterUserId}, 'Bella', 'Dog', 'Labrador Retriever Mix', 'Female', '2 yrs', '24 kg', 1, 'available', 92, 'Up to Date', 'assets/img/dog-1.png', 'Very friendly with kids and other pets. Spayed and fully vaccinated.'),
            ({$shelterUserId}, 'Oliver', 'Cat', 'Domestic Short Hair', 'Male', '1 yr', '3.8 kg', 1, 'available', 90, 'Up to Date', 'assets/img/cat-1.png', 'Playful and calm temperament. Neutered, microchipped and ready for adoption.')
            ON DUPLICATE KEY UPDATE `name`=`name`;");
        }
    }

    public function down(PDO $db): void
    {
        // Truncate tables on rollback
        $db->exec("DELETE FROM `users` WHERE `email` IN ('admin@furshield.com', 'vet@furshield.com', 'shelter@furshield.com', 'owner@furshield.com');");
    }
}
