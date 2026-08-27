<?php
/**
 * Application Configuration
 */

// Load .env if getenv or parse_ini_file exists
if (file_exists(dirname(__DIR__) . '/.env')) {
    $env = @parse_ini_file(dirname(__DIR__) . '/.env');
} else {
    $env = [];
}

// Detect base URL dynamically or allow override
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$scriptDir = ($scriptDir === '/' || $scriptDir === '\\' || $scriptDir === '.') ? '' : '/' . trim($scriptDir, '/');

$dynamicUrl = rtrim($protocol . $host . $scriptDir, '/');
$envUrl = $env['APP_URL'] ?? getenv('APP_URL') ?: '';

$baseUrl = !empty($envUrl) ? rtrim($envUrl, '/') : $dynamicUrl;
if (empty($baseUrl) || $baseUrl === 'http://' || $baseUrl === 'https://') {
    $baseUrl = 'http://localhost/PetGaurd';
}

return [
    'app_name' => $env['APP_NAME'] ?? 'PetGuard — Pet Care & Clinic Ecosystem',
    'app_url' => $baseUrl,
    'app_env' => $env['APP_ENV'] ?? 'development',
    'debug' => (bool) ($env['APP_DEBUG'] ?? true),
    'timezone' => 'UTC',
    'session' => [
        'name' => 'petguard_session',
        'lifetime' => 86400 * 7, // 7 days
    ],
    'ai' => [
        'provider' => 'openrouter',
        'api_key' => $env['OPENROUTER_API_KEY'] ?? getenv('OPENROUTER_API_KEY') ?: '',
        'model' => $env['OPENROUTER_MODEL'] ?? getenv('OPENROUTER_MODEL') ?: 'meta-llama/llama-3.2-3b-instruct:free',
        'base_url' => $env['OPENROUTER_BASE_URL'] ?? getenv('OPENROUTER_BASE_URL') ?: 'https://openrouter.ai/api/v1',
    ],
];
