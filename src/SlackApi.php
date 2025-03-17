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
        $this->tokenValue = SetToken::getToken('SLACK_BOT_TOKEN');
        $this->channelId = SetToken::getToken('SLACK_CHANNEL_ID');
    }

    public function getChannelMembers(): array
    {

        $response = $this->client->get('https://slack.com/api/conversations.members', [
            'query' => [ 'channel' => $this->channelId ],
            'headers' => [ "Authorization" => "Bearer {$this->tokenValue} "], 
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['members'] ?? [];
    }

    public function enviarMensagem(string $mensagem): void
    {
        $this->client->post('https://slack.com/api/chat.postMessage', [
            'json' => [
                'channel' => $this->channelId,
                'text' => $mensagem,
            ],
            'headers' => [ "Authorization" => "Bearer {$this->tokenValue} "], 
        ]);
    }

}