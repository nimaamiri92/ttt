<?php

namespace App\Core\Config;


class Config
{
    public static function get(string $configName, ?string $key = null): string|array|null
    {
        $configPath = static::getConfigPath($configName);
        if (!file_exists($configPath)) {
            throw new \Exception('Config not found!');
        }
        $configs = require $configPath;

        if (is_null($key)) {
            return $configs ?? null;
        }

        return $configs[$key] ?? null;

    }

    protected static function getConfigPath($configName): string
    {
        return APP_DIRECTORY . '/config/' . $configName . '.php';
    }
}
