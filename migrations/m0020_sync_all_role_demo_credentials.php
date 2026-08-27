<?php

declare(strict_types=1);

use Core\Migration;

class m0020_sync_all_role_demo_credentials extends Migration {
    public function up(PDO $db): void
    {
        $hash = password_hash('password123', PASSWORD_BCRYPT);

        // Ensure all 5 primary demo accounts have the password 'password123'
        $stmt = $db->prepare("UPDATE `users` SET `password_hash` = :hash WHERE `email` IN (
            'admin@petguard.com',
            'vet@petguard.com',
            'shelter@petguard.com',
            'owner@petguard.com',
            'vendor@petguard.com'
        )");
        $stmt->execute(['hash' => $hash]);
    }

    public function down(PDO $db): void
    {
        // No down migration needed
    }
}
