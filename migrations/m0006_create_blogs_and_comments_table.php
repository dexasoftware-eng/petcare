<?php

use Core\Migration;

class m0006_create_blogs_and_comments_table extends Migration
{
    public function up(PDO $db): void
    {
        $sqlBlogs = "CREATE TABLE IF NOT EXISTS `blogs` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NOT NULL UNIQUE,
            `category` VARCHAR(100) NOT NULL,
            `author` VARCHAR(100) DEFAULT 'Willimes Domson',
            `author_img` VARCHAR(255) DEFAULT 'assets/img/man.jpg',
            `day` VARCHAR(10) DEFAULT '23',
            `month_year` VARCHAR(30) DEFAULT 'May,2023',
            `img` VARCHAR(255) NOT NULL,
            `excerpt` TEXT NOT NULL,
            `content` LONGTEXT NOT NULL,
            `views` INT DEFAULT 0,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`slug`),
            INDEX (`category`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $sqlComments = "CREATE TABLE IF NOT EXISTS `blog_comments` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `blog_id` INT NOT NULL,
            `name` VARCHAR(100) NOT NULL,
            `email` VARCHAR(150) NULL,
            `text` TEXT NOT NULL,
            `avatar` VARCHAR(255) DEFAULT 'assets/img/comment-1.jpg',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`blog_id`) REFERENCES `blogs`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        $db->exec($sqlBlogs);
        $db->exec($sqlComments);
    }

    public function down(PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS `blog_comments`;");
        $db->exec("DROP TABLE IF EXISTS `blogs`;");
    }
}
