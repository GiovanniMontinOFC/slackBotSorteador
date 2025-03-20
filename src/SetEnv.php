<?php

namespace Giovannimontinofc\BotSorteador;
require_once __DIR__ . '/../vendor/autoload.php';


use Dotenv\Dotenv;

class SetEnv
{

    private static array $configEnv;

    public static function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        self::$configEnv = $_ENV;
    }

    public static function getEnv(string $key): ?string
    {
        return self::$configEnv[$key] ?? null;
    }

}
SetEnv::loadEnv();
