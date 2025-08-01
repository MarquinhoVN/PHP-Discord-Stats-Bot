<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
echo 'aaa';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Caminho correto para a raiz
$dotenv->load();

$discord = new Discord\Discord([
    'token' => $_ENV['DISCORD_TOKEN'],
]);
