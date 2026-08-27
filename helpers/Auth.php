<?php

namespace Helpers;

use Core\Session;
use Models\User;

class Auth
{
    private const SESSION_KEY = '_auth_user';

    public static function login(array $user): void
    {
        // Don't store password hash in session
        unset($user['password_hash'], $user['passwordResetTokenHash'], $user['emailVerificationTokenHash']);
        Session::set(self::SESSION_KEY, $user);
        Session::set('_auth_user_id', $user['id']);
        Session::set('_auth_role', $user['role']);
    }

    public static function user(): ?array
    {
        return Session::get(self::SESSION_KEY);
    }

    public static function id(): ?int
    {
        return Session::get('_auth_user_id');
    }

    public static function check(): bool
    {
        return Session::has(self::SESSION_KEY) && Session::get(self::SESSION_KEY) !== null;
    }

    public static function role(): ?string
    {
        $user = self::user();
        return $user['role'] ?? null;
    }

    public static function name(): ?string
    {
        $user = self::user();
        return $user['name'] ?? null;
    }

    public static function email(): ?string
    {
        $user = self::user();
        return $user['email'] ?? null;
    }

    public static function isRole(string $role): bool
    {
        return self::role() === $role;
    }

    public static function hasRole(array $roles): bool
    {
        $currentRole = self::role();
        return $currentRole !== null && in_array($currentRole, $roles, true);
    }

    public static function logout(): void
    {
        Session::remove(self::SESSION_KEY);
        Session::remove('_auth_user_id');
        Session::remove('_auth_role');
        Session::destroy();
    }
}
