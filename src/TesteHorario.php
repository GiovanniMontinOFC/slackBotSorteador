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
        $this->webHookToken = SetEnv::getEnv('SLACK_WEBHOOK') ?? throw new \Exception("O seu link WebHook do Slack App (Bot) não foi encontrado. Confira o arquivo .env");
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