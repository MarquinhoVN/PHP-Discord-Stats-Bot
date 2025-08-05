<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\Database;
use App\Services\CalcDamageService;
use App\Services\CharacterService;
use App\Services\JutsuMenuService;
use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\WebSockets\Intents;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$db = Database::connect();

// Aqui você inicia o bot, por exemplo:
$bot = new Discord([
    'token' => $_ENV['DISCORD_TOKEN'],
    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
]);

$bot->on('ready', function ($discord) {
    echo "Bot está online\n";

    $discord->on('message', function ($message) use ($discord) {
        $calcDamageService = new CalcDamageService();

        // Katon
        if ($message->content === '!katon') {
            $characterService = new CharacterService(null, null, null, $message->author->id);
            $select = JutsuMenuService::createMenu('katon', $discord, $characterService, $calcDamageService);
            $message->channel->sendMessage(
                MessageBuilder::new()
                    ->setContent("Escolha um jutsu do estilo Katon:")
                    ->addComponent($select)
            );
        }

        // Uchiha
        if ($message->content === '!uchiha') {
            $characterService = new CharacterService(null, null, null, $message->author->id);
            $select = JutsuMenuService::createMenu('uchiha', $discord, $characterService, $calcDamageService);
            $message->channel->sendMessage(
                MessageBuilder::new()
                    ->setContent("Escolha um jutsu do clã Uchiha:")
                    ->addComponent($select)
            );
        }

        // Raiton
        if ($message->content === '!raiton') {
            $characterService = new CharacterService(null, null, null, $message->author->id);
            $select = JutsuMenuService::createMenu('raiton', $discord, $characterService, $calcDamageService);
            $message->channel->sendMessage(
                MessageBuilder::new()
                    ->setContent("Escolha um jutsu do estilo Raiton:")
                    ->addComponent($select)
            );
        }

        // Doton
        if ($message->content === '!doton') {
            $characterService = new CharacterService(null, null, null, $message->author->id);
            $select = JutsuMenuService::createMenu('doton', $discord, $characterService, $calcDamageService);
            $message->channel->sendMessage(
                MessageBuilder::new()
                    ->setContent("Escolha um jutsu do estilo Doton:")
                    ->addComponent($select)
            );
        }

        // Futon
        if ($message->content === '!futon') {
            $characterService = new CharacterService(null, null, null, $message->author->id);
            $select = JutsuMenuService::createMenu('futon', $discord, $characterService, $calcDamageService);
            $message->channel->sendMessage(
                MessageBuilder::new()
                    ->setContent("Escolha um jutsu do estilo Futon:")
                    ->addComponent($select)
            );
        }

        // Suiton
        if ($message->content === '!suiton') {
            $characterService = new CharacterService(null, null, null, $message->author->id);
            $select = JutsuMenuService::createMenu('suiton', $discord, $characterService, $calcDamageService);
            $message->channel->sendMessage(
                MessageBuilder::new()
                    ->setContent("Escolha um jutsu do estilo Suiton:")
                    ->addComponent($select)
            );
        }

        // Soco
        if ($message->content === '!soco') {
            $characterService = new CharacterService(null, null, null, $message->author->id);
            $damage = $characterService->taijutsu;
            $message->channel->sendMessage(
                MessageBuilder::new()
                    ->setContent("Soco 👊\n🩸 Dano: `$damage`")
            );
        }

        // Atributos
        if ($message->content === '!stats') {
            $characterService = new CharacterService(null, null, null, $message->author->id);
            $message->channel->sendMessage(
                MessageBuilder::new()
                    ->setContent("## 🧬 Atributos: \n\n ***🧡 HP:*** `$characterService->hp`
                                                        \n ***🌀 Chakra:*** `$characterService->chakra`
                                                        \n ***👤 Ninjutsu:*** `$characterService->ninjutsu`
                                                        \n ***⚡ Velocidade:*** `$characterService->speed`
                                                        \n ***💪 Taijutsu:*** `$characterService->taijutsu`
                                                        \n ***⚔️ Kenjutsu:*** `$characterService->kenjutsu`")
            );
        }
    });
});

$bot->run();