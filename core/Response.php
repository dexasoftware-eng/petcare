<?php

namespace Core;

class Response
{
    public function setStatusCode(int $code): self
    {
        http_response_code($code);
        return $this;
    }

    public function json(mixed $data, int $statusCode = 200): void
    {
        $this->setStatusCode($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function redirect(string $url, int $statusCode = 302): void
    {
        // If relative path without protocol
        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
            $config = require dirname(__DIR__) . '/config/config.php';
            $baseUrl = rtrim($config['app_url'], '/');
            $url = $baseUrl . '/' . ltrim($url, '/');
        }

        $this->setStatusCode($statusCode);
        header("Location: {$url}");
        exit;
    }

    public function back(): void
    {
        $referrer = $_SERVER['HTTP_REFERER'] ?? '/';
        $this->redirect($referrer);
    }
}
