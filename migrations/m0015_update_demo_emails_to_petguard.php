<?php

use Core\Migration;

class m0015_update_demo_emails_to_petguard extends Migration
{
    public function up(PDO $db): void
    {
        $db->exec("UPDATE `users` SET `email` = 'admin@petguard.com' WHERE `email` = 'admin@furshield.com';");
        $db->exec("UPDATE `users` SET `email` = 'vet@petguard.com' WHERE `email` = 'vet@furshield.com';");
        $db->exec("UPDATE `users` SET `email` = 'shelter@petguard.com' WHERE `email` = 'shelter@furshield.com';");
        $db->exec("UPDATE `users` SET `email` = 'owner@petguard.com' WHERE `email` = 'owner@furshield.com';");
        $db->exec("UPDATE `team_members` SET `email` = 'dr.jenkins@petguard.com' WHERE `email` LIKE '%furshield.com%';");
        $db->exec("UPDATE `products` SET `name` = REPLACE(`name`, 'FurShield', 'PetGuard'), `slug` = REPLACE(`slug`, 'furshield', 'petguard') WHERE `name` LIKE '%FurShield%';");
    }

    public function down(PDO $db): void
    {
        $db->exec("UPDATE `users` SET `email` = 'admin@furshield.com' WHERE `email` = 'admin@petguard.com';");
        $db->exec("UPDATE `users` SET `email` = 'vet@furshield.com' WHERE `email` = 'vet@petguard.com';");
        $db->exec("UPDATE `users` SET `email` = 'shelter@furshield.com' WHERE `email` = 'shelter@petguard.com';");
        $db->exec("UPDATE `users` SET `email` = 'owner@furshield.com' WHERE `email` = 'owner@petguard.com';");
    }
}
