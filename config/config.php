<?php
/**
 * Application Configuration
 */

// Detect base URL dynamically or allow override
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$baseUrl = rtrim($protocol . $host . $scriptName, '/');

// If running in CLI, fallback
if (php_sapi_name() === 'cli' || empty($baseUrl) || $baseUrl === 'http://') {
    $baseUrl = 'http://localhost/petcaretw';
}

return [
    'app_name' => 'PetGuard — Pet Care & Clinic',
    'app_url' => $baseUrl,
    'app_env' => 'development', // 'development' or 'production'
    'debug' => true,
    'timezone' => 'UTC',
    'session' => [
        'name' => 'petguard_session',
        'lifetime' => 86400 * 7, // 7 days
    ],
];
