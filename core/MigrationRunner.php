<?php

namespace Core;

use PDO;
use Exception;

class MigrationRunner
{
    private PDO $db;
    private string $migrationsPath;

    public function __construct(PDO $db, string $migrationsPath = '')
    {
        $this->db = $db;
        $this->migrationsPath = $migrationsPath ?: dirname(__DIR__) . '/migrations';
        $this->createMigrationsTable();
    }

    /**
     * Create the tracking migrations table if it doesn't exist.
     */
    private function createMigrationsTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `migrations` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `migration` VARCHAR(255) NOT NULL UNIQUE,
            `applied_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        
        $this->db->exec($sql);
    }

    /**
     * Get all applied migrations.
     */
    public function getAppliedMigrations(): array
    {
        $stmt = $this->db->query("SELECT `migration` FROM `migrations` ORDER BY `id` ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
    }

    /**
     * Run all pending migrations.
     *
     * @return array Array of results messages.
     */
    public function applyMigrations(): array
    {
        $results = [];
        $applied = $this->getAppliedMigrations();

        if (!is_dir($this->migrationsPath)) {
            $results[] = "Migrations folder not found at: {$this->migrationsPath}";
            return $results;
        }

        $files = scandir($this->migrationsPath);
        $migrationFiles = array_diff($files, ['.', '..']);
        sort($migrationFiles);

        $toApply = array_diff($migrationFiles, $applied);

        if (empty($toApply)) {
            $results[] = "✨ Database is already up to date. No pending migrations.";
            return $results;
        }

        foreach ($toApply as $migrationFile) {
            $filePath = $this->migrationsPath . '/' . $migrationFile;
            if (!is_file($filePath) || pathinfo($filePath, PATHINFO_EXTENSION) !== 'php') {
                continue;
            }

            require_once $filePath;

            // Class name derivation from filename e.g. m0001_create_users_table.php -> m0001_create_users_table
            $className = pathinfo($migrationFile, PATHINFO_FILENAME);

            if (!class_exists($className)) {
                $results[] = "⚠️ Error: Migration class `{$className}` not found in `{$migrationFile}`.";
                continue;
            }

            $instance = new $className();
            if (!($instance instanceof Migration)) {
                $results[] = "⚠️ Error: Class `{$className}` must extend `Core\\Migration`.";
                continue;
            }

            try {
                $instance->up($this->db);
                
                $stmt = $this->db->prepare("INSERT INTO `migrations` (`migration`) VALUES (:migration)");
                $stmt->execute(['migration' => $migrationFile]);

                $results[] = "✅ Applied migration: {$migrationFile}";
            } catch (Exception $e) {
                $results[] = "❌ Failed migration {$migrationFile}: " . $e->getMessage();
                break; // Stop running further migrations on error
            }
        }

        return $results;
    }
}
