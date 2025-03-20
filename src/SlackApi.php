<?php

namespace Giovannimontinofc\BotSorteador;
require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

class SlackApi
{

    private Client $client;
    private string $tokenValue;
    private string $channelId;

    public function __construct()
    {
        $this->client = new Client();
        $this->tokenValue = SetEnv::getEnv('SLACK_BOT_TOKEN') ?? throw new \Exception("O Token de autenticação do seu Slack App (Bot) não foi encontrado. Confira o arquivo .env");
        $this->channelId = SetEnv::getEnv('SLACK_CHANNEL_ID') ?? throw new \Exception("O ID do canal do Slack não foi encontrado. Confira o arquivo .env");

    }

    private function getHeaders(): array
    {
        return [ "Authorization" => "Bearer {$this->tokenValue}" ];
    }

    public function getChannelMembers(): array
    {

        $response = $this->client->get('https://slack.com/api/conversations.members', [
            'query' => [ 'channel' => $this->channelId ],
            'headers' => $this->getHeaders(),
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['members'] ?? [];
    }

    public function sendMessage(string $message): void
    {
        $this->client->post('https://slack.com/api/chat.postMessage', [
            'headers' => $this->getHeaders(),
            'json' => [
                'channel' => $this->channelId,
                'blocks' => [
                    [
                        "type" => "section",
                        "text" => [
                            "type" => "mrkdwn",
                            "text" => $message
                        ],
                        "accessory" => [
                            "type" => "image",
                            "image_url" => "https://img.freepik.com/fotos-gratis/conceito-de-programacao-de-agenda-do-planejador-de-calendario_53876-133697.jpg?t=st=1742401832~exp=1742405432~hmac=737f3b0fb7f46552c8c89e43885beffb7eab085ce2bb15ae9879d9c06f130856&w=1380",
                            "alt_text" => "cute cat"
                        ]
                    ]
                ],
            ],
        ]);
    }

}