<?php

namespace Helpers;

use Core\Session;

class Flash
{
    public static function success(string $message): void
    {
        Session::setFlash('success', $message);
    }

    public static function error(string $message): void
    {
        Session::setFlash('error', $message);
    }

    public static function warning(string $message): void
    {
        Session::setFlash('warning', $message);
    }

    public static function info(string $message): void
    {
        Session::setFlash('info', $message);
    }

    public static function get(string $type): ?string
    {
        $messages = Session::getFlash($type);
        return !empty($messages) ? implode(' ', $messages) : null;
    }

    public static function all(): array
    {
        return Session::getAllFlash();
    }
}
