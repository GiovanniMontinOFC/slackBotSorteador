<?php

namespace Giovannimontinofc\BotSorteador;

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;
date_default_timezone_set("America/Sao_Paulo");


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
        $data = date('d-m-Y');
        $hora = date('H:i:s');

        $this->client->post( $this->webHookToken , [
            'json' => [
                'text' => "Quem vai puxar a Daily?\n E o sortudo de hoje é: <@>\n Dia: $data - Hora: $hora",
            ],
            'headers' => ['Content-Type' => 'application/json'],
        ]);
    }

}

$teste = new TesteHorario();
while (true) {
    $teste-> enviarMensagem();
    sleep(50);
}