<?php

use Core\Migration;

class m0017_activate_all_demo_users extends Migration
{
    public function up(PDO $db): void
    {
        $db->exec("UPDATE `users` SET `status` = 'active', `email_verified` = 1 WHERE `status` != 'active' OR `email_verified` != 1;");
    }

    public function down(PDO $db): void
    {
        // No-op
    }
}
