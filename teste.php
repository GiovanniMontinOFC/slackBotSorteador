<?php

namespace Giovannimontinofc\BotSorteador;
require __DIR__ . '/vendor/autoload.php';

// Teste namespace
echo "Se cechegou aqui funciona";

// Teste código para pegar o Token
$tokenTeste = SetToken::getToken('SLACK_BOT_TOKEN');
echo $tokenTeste;

// Teste de receber o membros do canal 
$teste = new SlackApi();
$membros = $teste->getChannelMembers();
var_dump( $membros);

// Teste de enviar mensagem no canal
$mensagem = "Olá, este é um teste enviado pelo bot! @{$membros[0]}";
$teste->enviarMensagem($mensagem);

