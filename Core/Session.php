<?php

namespace Core;

class Session
{
    public static function has($key): bool
    {
        return isset($_SESSION['_flash'][$key]) || isset($_SESSION[$key]);
    }

    public static function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash(string $key, mixed $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unFlash(string $key): void
    {
        unset($_SESSION['flash'][$key]);
    }

    public static function unFlashAll(): void
    {
        unset($_SESSION['_flash']);
    }

    public static function flush(): void
    {
        // Unset all session variables (but still the session data alive on server)
        session_unset();
    }

    public static function destroy(): void
    {
        static::flush();

        // Destroy the session; deletes session data on the server
        session_destroy();

        // Remove the session cookie (if cookies are used)
        if (ini_get('session.use_cookies')) {
            // Get current cookie settings
            $params = session_get_cookie_params();

            // Set the cookie with an expired time to delete it from browser
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
    }
}