<?php

namespace Helpers;

use Core\Session;

class ViewHelper
{
    public static function url(string $path = ''): string
    {
        $config = require dirname(__DIR__) . '/config/config.php';
        $baseUrl = rtrim($config['app_url'] ?? '', '/');
        $path = ltrim($path, '/');
        return $path ? "{$baseUrl}/{$path}" : $baseUrl;
    }

    public static function asset(string $path): string
    {
        $path = ltrim($path, '/');
        return self::url("assets/{$path}");
    }

    public static function e(mixed $value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }

    public static function old(string $key, mixed $default = ''): mixed
    {
        $old = Session::get('_old_input', []);
        return $old[$key] ?? $default;
    }

    public static function error(string $key): ?string
    {
        $errors = Session::get('_validation_errors', []);
        return $errors[$key][0] ?? null;
    }

    public static function hasError(string $key): bool
    {
        $errors = Session::get('_validation_errors', []);
        return isset($errors[$key]);
    }

    public static function csrfField(): string
    {
        $token = Session::csrfToken();
        return '<input type="hidden" name="_csrf" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    public static function csrf(): string
    {
        return self::csrfField();
    }

    public static function csrfToken(): string
    {
        return Session::csrfToken();
    }

    public static function user(): ?array
    {
        return Auth::user();
    }

    public static function isAuth(): bool
    {
        return Auth::check();
    }

    public static function cartCount(): int
    {
        $cart = Session::get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += ($item['quantity'] ?? 1);
        }
        return $count;
    }

    public static function cartSubtotal(): float
    {
        $cart = Session::get('cart', []);
        $subtotal = 0.0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        }
        return $subtotal;
    }
}
