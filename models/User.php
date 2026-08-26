<?php

namespace Models;

use Core\Model;

class User extends Model
{
    protected static string $table = 'users';

    public static function findByEmail(string $email): ?array
    {
        return self::findBy('email', strtolower(trim($email)));
    }

    public static function authenticate(string $email, string $password): ?array
    {
        $user = self::findByEmail($email);
        if (!$user) {
            return null;
        }

        if (password_verify($password, $user['password_hash'])) {
            // Update last login
            self::update($user['id'], [
                'last_login_at' => date('Y-m-d H:i:s'),
                'failed_login_attempts' => 0
            ]);
            return self::toSafeArray($user);
        }

        // Increment failed login count
        self::execute("UPDATE `users` SET failed_login_attempts = failed_login_attempts + 1 WHERE id = :id", ['id' => $user['id']]);
        return null;
    }

    public static function register(array $data): int|string
    {
        $data['email'] = strtolower(trim($data['email']));
        if (isset($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT);
            unset($data['password'], $data['confirm_password']);
        }
        return self::create($data);
    }

    public static function toSafeArray(array $user): array
    {
        unset($user['password_hash'], $user['email_verification_token'], $user['password_reset_token']);
        return $user;
    }
}
