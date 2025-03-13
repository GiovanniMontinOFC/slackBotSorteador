<?php

namespace Giovannimontinofc\BotSorteador;
require_once __DIR__ . '/../vendor/autoload.php';


use Dotenv\Dotenv;

class SetToken
{

    private static array $configToken;

    public static function loadTokens(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        self::$configToken = $_ENV;
    }

    public static function getToken(string $key): ?string
    {
        return self::$configToken[$key] ?? null;
    }

}
SetToken::loadTokens();
