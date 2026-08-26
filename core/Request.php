<?php

namespace Core;

class Request
{
    private array $queryParams;
    private array $bodyParams;
    private array $serverParams;
    private array $files;
    private ?array $jsonBody = null;

    public function __construct()
    {
        $this->queryParams = $_GET;
        $this->bodyParams = $_POST;
        $this->serverParams = $_SERVER;
        $this->files = $_FILES;

        // Parse JSON body if Content-Type is application/json
        $contentType = $this->serverParams['CONTENT_TYPE'] ?? '';
        if (str_contains(strtolower($contentType), 'application/json')) {
            $rawInput = file_get_contents('php://input');
            $this->jsonBody = json_decode($rawInput, true) ?: [];
        }
    }

    public function getMethod(): string
    {
        // Support method spoofing for forms: <input type="hidden" name="_method" value="DELETE">
        if (isset($this->bodyParams['_method'])) {
            return strtoupper($this->bodyParams['_method']);
        }
        return strtoupper($this->serverParams['REQUEST_METHOD'] ?? 'GET');
    }

    public function getUri(): string
    {
        $uri = $this->serverParams['REQUEST_URI'] ?? '/';
        
        // Remove query string from path
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        // Normalize base script path (e.g. /PetGaurd)
        $scriptDir = str_replace('\\', '/', dirname($this->serverParams['SCRIPT_NAME'] ?? ''));
        if ($scriptDir !== '/' && $scriptDir !== '.' && !empty($scriptDir)) {
            if (str_starts_with($uri, $scriptDir)) {
                $uri = substr($uri, strlen($scriptDir));
            }
        }

        // Also strip /index.php if present in URI
        if (str_starts_with($uri, '/index.php')) {
            $uri = substr($uri, strlen('/index.php'));
        }

        $uri = '/' . trim($uri, '/');
        return $uri ?: '/';
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'POST';
    }

    public function isGet(): bool
    {
        return $this->getMethod() === 'GET';
    }

    public function isAjax(): bool
    {
        return (!empty($this->serverParams['HTTP_X_REQUESTED_WITH']) && 
                strtolower($this->serverParams['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
               str_contains($this->serverParams['HTTP_ACCEPT'] ?? '', 'application/json');
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->queryParams[$key] ?? $default;
    }

    public function post(string $key, mixed $default = null): mixed
    {
        if ($this->jsonBody !== null) {
            return $this->jsonBody[$key] ?? $default;
        }
        return $this->bodyParams[$key] ?? $default;
    }

    public function input(string $key, mixed $default = null): mixed
    {
        if ($this->jsonBody !== null && isset($this->jsonBody[$key])) {
            return $this->jsonBody[$key];
        }
        if (isset($this->bodyParams[$key])) {
            return $this->bodyParams[$key];
        }
        return $this->queryParams[$key] ?? $default;
    }

    public function all(): array
    {
        if ($this->jsonBody !== null) {
            return array_merge($this->queryParams, $this->jsonBody);
        }
        return array_merge($this->queryParams, $this->bodyParams);
    }

    public function file(string $key): ?array
    {
        return $this->files[$key] ?? null;
    }

    public function getBearerToken(): ?string
    {
        $headers = $this->serverParams['HTTP_AUTHORIZATION'] ?? '';
        if (!empty($headers) && preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
