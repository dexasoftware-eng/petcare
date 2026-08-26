<?php

use Core\Migration;

class m0005_create_orders_and_items_table extends Migration
{
    public function up(PDO $db): void
    {
        $sqlOrders = "CREATE TABLE IF NOT EXISTS `orders` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `order_number` VARCHAR(50) NOT NULL UNIQUE,
            `user_id` INT NULL,
            `first_name` VARCHAR(100) NOT NULL,
            `last_name` VARCHAR(100) NOT NULL,
            `email` VARCHAR(150) NOT NULL,
            `phone` VARCHAR(30) NOT NULL,
            `address` TEXT NOT NULL,
            `city` VARCHAR(100) NOT NULL,
            `postcode` VARCHAR(20) NOT NULL,
            `notes` TEXT DEFAULT NULL,
            `subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            `discount` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            `total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            `payment_method` ENUM('card', 'cod', 'bank') DEFAULT 'card',
            `payment_status` ENUM('pending', 'paid', 'failed') DEFAULT 'paid',
            `status` ENUM('received', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'received',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`user_id`),
            INDEX (`status`),
            INDEX (`order_number`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $sqlItems = "CREATE TABLE IF NOT EXISTS `order_items` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `order_id` INT NOT NULL,
            `product_id` INT NULL,
            `name` VARCHAR(255) NOT NULL,
            `price` DECIMAL(10,2) NOT NULL,
            `quantity` INT NOT NULL DEFAULT 1,
            `img` VARCHAR(255) NULL,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sqlOrders);
        $db->exec($sqlItems);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `order_items`;");
        $db->exec("DROP TABLE IF EXISTS `orders`;");
    }
}
