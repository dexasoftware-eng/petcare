<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;
    private static array $config = [];

    public static function init(array $config): void
    {
        self::$config = $config;
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            if (empty(self::$config)) {
                self::$config = require __DIR__ . '/../config/database.php';
            }

            $driver = self::$config['driver'] ?? 'mysql';
            $host = self::$config['host'] ?? '127.0.0.1';
            $port = self::$config['port'] ?? '3306';
            $dbname = self::$config['database'] ?? 'petcare_db';
            $username = self::$config['username'] ?? 'root';
            $password = self::$config['password'] ?? '';
            $charset = self::$config['charset'] ?? 'utf8mb4';
            $options = self::$config['options'] ?? [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                // Connect directly to the database
                $dsn = "{$driver}:host={$host};port={$port};dbname={$dbname};charset={$charset}";
                self::$instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                // If database doesn't exist (error 1049), attempt to create it automatically
                if ($e->getCode() == 1049 || str_contains($e->getMessage(), 'Unknown database')) {
                    try {
                        $serverDsn = "{$driver}:host={$host};port={$port};charset={$charset}";
                        $serverPdo = new PDO($serverDsn, $username, $password, $options);
                        $serverPdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                        
                        $dsn = "{$driver}:host={$host};port={$port};dbname={$dbname};charset={$charset}";
                        self::$instance = new PDO($dsn, $username, $password, $options);
                    } catch (PDOException $createEx) {
                        die("Database Connection Error: " . $createEx->getMessage());
                    }
                } else {
                    die("Database Connection Error: " . $e->getMessage());
                }
            }
        }

        return self::$instance;
    }
}
