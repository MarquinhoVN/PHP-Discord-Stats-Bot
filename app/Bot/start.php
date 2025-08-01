<?php

// Carregar o autoload do Composer
require_once __DIR__ . '/vendor/autoload.php';

// Use as classes do Discord PHP
use Discord\Discord;
use Discord\WebSockets\Event;
use Discord\Parts\Channel\Message;

// Carregar variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Obter o token do bot do arquivo .env
$token = $_ENV['DISCORD_BOT_TOKEN'];

// Criar uma nova instância do Discord
$discord = new Discord([
    'token' => $token,
]);

// Event listener para quando o bot estiver pronto
$discord->on('ready', function (Discord $discord) {
    echo "Bot está online e conectado ao Discord!" . PHP_EOL;

    // Reagir ao evento de mensagens no Discord
    $discord->on('message', function (Message $message, Discord $discord) {
        // Ignorar as mensagens do próprio bot
        if ($message->author->bot) {
            return;
        }

        // Resposta simples para uma mensagem
        if (strtolower($message->content) === 'olá') {
            $message->channel->sendMessage('Olá, como posso ajudar?');
        }
    });
});

// Iniciar o bot
$discord->run();
