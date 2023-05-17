<?php

namespace App;

class Env
{
    private static array $data;

    public static function init(string $path): void
    {
        self::$data = parse_ini_file($path.'/.env');
    }

    public static function get(string $key, string $default = null): ?string
    {
        return self::$data[$key] ?? $default;
    }
}
