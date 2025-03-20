<?php

namespace Giovannimontinofc\BotSorteador;
use DateTime;
date_default_timezone_set("America/Sao_Paulo");

class SimpleBot 
{
    private SlackApi $slackApi;
    public function __construct()
    {
        $this->slackApi = new SlackApi();
    } 

    public function runBot()
    {
        // Horario de execução
        $targetTime = '11:08';

        while (true) {
            $currentTime = (new DateTime())->format('H:i');

            if ($currentTime === $targetTime) {
                echo "Executando tarefa às $currentTime\n Hora alvo: $targetTime\n";

                $this->runRandom();

                // Aguardar até o próximo dia às 11:15
                // 86400 segundos = 24 horas
                break;
            } else {
                echo "Ainda não é $targetTime. Hora atual: $currentTime. Aguardando 10 segundos...\n";
                sleep(10); // 900 segundos = 15 minutos
            }
        }
    }

    public function runRandom(): void
    {

        $membersList = $this->slackApi->getChannelMembers();
        $date = date('d/m/Y H:i:s');

        if (empty($membersList)){
            $message = "Nenhum membro foi encontrado no canal - Lista de membros vazia.";
            $this->slackApi->sendMessage($message);
        }
        
        $resultRandom = $membersList[array_rand($membersList)];
        $message = "*Quem vai puxar a Daily?*\n E o sortudo de hoje é: <@$resultRandom>\n*Dia:* $date\n";
        $this->slackApi->sendMessage($message);
    }
}
