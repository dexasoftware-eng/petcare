<?php

use Core\Migration;

class m0004_create_products_table extends Migration
{
    public function up(PDO $db): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `products` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `category_id` INT NULL,
            `category` VARCHAR(100) NOT NULL,
            `name` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NOT NULL UNIQUE,
            `sku` VARCHAR(100) NOT NULL UNIQUE,
            `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            `old_price` DECIMAL(10,2) NULL,
            `rating` DECIMAL(3,1) DEFAULT 5.0,
            `discount` VARCHAR(50) NULL,
            `img` VARCHAR(255) NOT NULL,
            `description` TEXT NOT NULL,
            `in_stock` TINYINT(1) DEFAULT 1,
            `is_deal_of_week` TINYINT(1) DEFAULT 0,
            `reviews_count` INT DEFAULT 28,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`category`),
            INDEX (`price`),
            INDEX (`in_stock`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sql);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `products`;");
    }
}
