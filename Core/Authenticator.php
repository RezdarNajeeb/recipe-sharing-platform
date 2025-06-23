<?php

namespace Core;

use App\Models\User;

class Authenticator
{
    public static function attempt(string $email, string $password): bool
    {
        $user = User::where('email', $email)->get();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                self::login($user['name'], $email);

                return true;
            }
        }
        return false;
    }

    public static function login($name, string $email): void
    {
        session_regenerate_id(true);

        Session::put('user', [
            'name' => $name,
            'email' => $email,
            'role' => 'user'
        ]);
    }

    public static function logout(): void
    {
        Session::destroy();
    }
}