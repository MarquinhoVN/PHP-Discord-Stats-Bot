<?php

use Discord\Discord;
use Discord\WebSockets\Event;
use Discord\Parts\Channel\Message;
use App\Controllers\UserController;
use App\Controllers\FichaController;

function registerBotEvents(Discord $discord): void
{
    $discord->on('ready', function (Discord $discord) {
        echo "Bot está online e conectado ao Discord!" . PHP_EOL;
        flush();

        $discord->on('message', function (Message $message, Discord $discord) {
            if ($message->author->bot) {
                return;
            }
            $discord_id = $message->author->id;

            if (strtolower($message->content) === '!status') {
                $userController = new UserController();
                $resposta = $userController->show($discord_id);
                $message->channel->sendMessage($resposta);
            }
            if (str_starts_with(strtolower($message->content), '!criarficha')) {
                $args = explode(' ', $message->content);
                if (count($args) < 2) {
                    $message->channel->sendMessage("❌ Uso correto: `!criarficha <nome> <familia> <força> <chakra> <destreza>`");
                    return;
                }

                $nome = (string)$args[1];
                $familia = (string)$args[2];
                $forca = (int)$args[3];
                $chakra = (int)$args[4];
                $destreza = (int)$args[5];
                $create = (boolean)$args[6];
                $fichaController = new FichaController();
                $resposta = $fichaController->create($discord_id,$nome,$familia,$forca,$chakra,$destreza,$create);
                if($resposta === true){
                    $message->channel->sendMessage("Sucesso");
                } else if($resposta === false){
                    $message->channel->sendMessage("Erro");
                } else{
                    $message->channel->sendMessage($resposta);
                }

            }
            if (str_starts_with(strtolower($message->content), '!addstatus')) {
                $args = explode(' ', $message->content);
                if (count($args) !== 4) {
                    $message->channel->sendMessage("❌ Uso correto: `!addstatus <força> <chakra> <destreza>`");
                    return;
                }

                $forca = (int)$args[1];
                $chakra = (int)$args[2];
                $destreza = (int)$args[3];
                $fichaController = new FichaController();
                $resposta = $fichaController->addStats($discord_id,$forca,$chakra,$destreza);
                $message->channel->sendMessage($resposta);
            }
        });
    });
}
