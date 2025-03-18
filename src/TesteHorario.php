<?php

namespace Giovannimontinofc\BotSorteador;

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

class TesteHorario
{
    private Client $client;
    private string $webHookToken;

    public function __construct()
    {
        $this->client = new Client();
        $this->webHookToken = 'https://hooks.slack.com/services/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';
    }

    public function enviarMensagem(): void
    {
        $this->client->post( $this->webHookToken , [
            'json' => [
                'text' => 'Hello Worlds'
            ],
            'headers' => ['Content-Type' => 'application/json'],
        ]);
    }

}

$teste = new TesteHorario();
$teste->enviarMensagem();