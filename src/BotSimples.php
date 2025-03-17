<?php

namespace Giovannimontinofc\BotSorteador;
require __DIR__ . '/vendor/autoload.php';


class BotSimples
{

    private SlackApi $slackApi;

    public function  __construct()
    {
        $slackApi = new SlackApi();
    }

    public function sortear(): void
    {

        $listaMembros = $this->slackApi->getChannelMembers();

        if (empty($listaMembros)){
            $mensagem = "Nenhum membro encontrado no canal.";
            $this->slackApi->enviarMensagem($mensagem);
        }

        $sorteado = $listaMembros[array_rand($listaMembros)];
        $mensagem = "Quem vai puxar a Daily? \n E o sortudo de hoje é: <@$sorteado>";
        $this->slackApi->enviarMensagem($mensagem);

    }




}