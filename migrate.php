<?php
/**
 * PetGuard — Database Migration Runner CLI & Web
 *
 * Usage via CLI:
 *   php migrate.php
 *   php migrate.php --status
 *   C:\xampp\php\php.exe migrate.php
 *
 * Usage via Browser:
 *   http://localhost/petcaretw/migrate.php
 */

declare(strict_types=1);

require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Migration.php';
require_once __DIR__ . '/core/MigrationRunner.php';

use Core\Database;
use Core\MigrationRunner;

$isCli = (php_sapi_name() === 'cli');

if (!$isCli) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title>Database Migrations — PetGuard</title>
        <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
        <style>
            body { background-color: #fff8e5; padding: 50px 15px; font-family: sans-serif; }
            .card-box { max-width: 750px; margin: 0 auto; background: #fff; border-radius: 16px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        </style>
    </head>
    <body>
    <div class='card-box'>
        <h3 class='fw-bold mb-3' style='color: #222;'>🐾 PetGuard Database Migration Runner</h3>
        <p class='text-muted small'>Scanning <code>migrations/</code> directory for unapplied database migrations...</p>
        <hr>";
}

try {
    $dbConfig = require __DIR__ . '/config/database.php';
    Database::init($dbConfig);
    $db = Database::getInstance();

    $runner = new MigrationRunner($db, __DIR__ . '/migrations');
    $results = $runner->applyMigrations();
    $appliedMigrations = $runner->getAppliedMigrations();

    if ($isCli) {
        echo "\n======================================================\n";
        echo "🐾 PetGuard Database Migrations Engine\n";
        echo "======================================================\n";
        foreach ($results as $res) {
            echo "  " . $res . "\n";
        }
        echo "\n📜 Total Applied Migrations in Database: " . count($appliedMigrations) . "\n";
        foreach ($appliedMigrations as $m) {
            echo "   • {$m}\n";
        }
        echo "======================================================\n\n";
    } else {
        echo "<h5 class='fw-bold mb-3'>Migration Results:</h5>";
        echo "<ul class='list-group mb-4'>";
        foreach ($results as $res) {
            $class = str_contains($res, '✅') ? 'list-group-item-success' : (str_contains($res, '❌') ? 'list-group-item-danger' : 'list-group-item-light');
            echo "<li class='list-group-item {$class} py-2'>" . htmlspecialchars($res) . "</li>";
        }
        echo "</ul>";

        echo "<h6 class='fw-bold mb-2'>All Applied Migrations (" . count($appliedMigrations) . "):</h6>";
        echo "<ul class='list-group mb-4'>";
        foreach ($appliedMigrations as $m) {
            echo "<li class='list-group-item py-1 small text-muted'><i class='text-success me-2'>✓</i> " . htmlspecialchars($m) . "</li>";
        }
        echo "</ul>";

        echo "<div class='d-flex gap-2'>
            <a href='index.php' class='btn btn-dark rounded-pill px-4 py-2 fw-semibold'>Go to Application Home</a>
        </div>
        </div>
        </body>
        </html>";
    }
} catch (\Throwable $e) {
    if ($isCli) {
        echo "\n❌ Migration Failed with Exception: " . $e->getMessage() . "\n\n";
    } else {
        echo "<div class='alert alert-danger p-3 rounded-3'>
            <h5>Migration Failed</h5>
            <p class='m-0'>" . htmlspecialchars($e->getMessage()) . "</p>
        </div>
        </div></body></html>";
    }
}
