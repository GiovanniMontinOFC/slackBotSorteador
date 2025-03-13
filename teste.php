<?php

namespace Giovannimontinofc\BotSorteador;
require __DIR__ . '/vendor/autoload.php';


echo "Se cechegou aqui funciona";

$teste = SetToken::getToken('SLACK_BOT_TOKEN');
echo $teste;