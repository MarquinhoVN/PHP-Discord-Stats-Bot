<?php

require __DIR__ . '/../vendor/autoload.php';

use Discord\Discord;
use Discord\WebSockets\Intents;
use Dotenv\Dotenv;

// Carrega o .env da raiz do projeto
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


// Instancia o bot com intents
$bot = new Discord([
    'token' => $_ENV['DISCORD_TOKEN'],
    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
]);

// Registra os eventos do bot
require_once __DIR__ . '/../app/Bot/start.php';
registerBotEvents($bot);

// Executa o bot
$bot->run();
