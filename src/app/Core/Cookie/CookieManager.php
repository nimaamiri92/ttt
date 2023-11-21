<?php

namespace App\Core\Cookie;


class CookieManager
{
    public function set(
        $name,
        $value,
        $expiration = null,
        $path = '/',
        $domain = null,
        $secure = false,
        $httpOnly = true
    ): void {
        setcookie(
            $name,
            $value,
            $expiration ?? time() + 3600,
            $path,
            $domain ?? 'localhost',
            $secure,
            $httpOnly
        );
    }

    public function removeCookie($name): void
    {
        $this->set($name, time() - 3600);
    }

    public function get($name): ?string
    {
        return $_COOKIE[$name] ?? null;
    }

    public function getAllCookies(): array
    {
        return $_COOKIE;
    }
}

