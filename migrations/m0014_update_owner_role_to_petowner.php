<?php

use Core\Migration;

class m0014_update_owner_role_to_petowner extends Migration
{
    public function up(PDO $db): void
    {
        // 1. Modify the role ENUM column in users table to include 'petowner'
        $sql = "ALTER TABLE `users` MODIFY COLUMN `role` ENUM('petowner', 'owner', 'veterinarian', 'shelter', 'admin') DEFAULT 'petowner';";
        $db->exec($sql);

        // 2. Update existing 'owner' records to 'petowner'
        $db->exec("UPDATE `users` SET `role` = 'petowner' WHERE `role` = 'owner';");

        // 3. Finalize ENUM definition to standard roles
        $sqlFinal = "ALTER TABLE `users` MODIFY COLUMN `role` ENUM('petowner', 'veterinarian', 'shelter', 'admin') DEFAULT 'petowner';";
        $db->exec($sqlFinal);
    }

    public function down(PDO $db): void
    {
        $sql = "ALTER TABLE `users` MODIFY COLUMN `role` ENUM('owner', 'petowner', 'veterinarian', 'shelter', 'admin') DEFAULT 'owner';";
        $db->exec($sql);

        $db->exec("UPDATE `users` SET `role` = 'owner' WHERE `role` = 'petowner';");

        $sqlFinal = "ALTER TABLE `users` MODIFY COLUMN `role` ENUM('owner', 'veterinarian', 'shelter', 'admin') DEFAULT 'owner';";
        $db->exec($sqlFinal);
    }
}
