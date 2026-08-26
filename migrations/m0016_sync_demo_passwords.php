<?php

use Core\Migration;

class m0016_sync_demo_passwords extends Migration
{
    public function up(PDO $db): void
    {
        $hash = password_hash('Password@123', PASSWORD_BCRYPT);

        $db->prepare("UPDATE `users` SET `password_hash` = :hash WHERE `email` IN (
            'admin@petguard.com',
            'vet@petguard.com',
            'shelter@petguard.com',
            'owner@petguard.com',
            'admin@furshield.com',
            'vet@furshield.com',
            'shelter@furshield.com',
            'owner@furshield.com'
        )")->execute(['hash' => $hash]);
    }

    public function down(PDO $db): void
    {
        // No-op
    }
}
