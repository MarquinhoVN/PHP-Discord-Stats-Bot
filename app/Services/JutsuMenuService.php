<?php

namespace App\Services;

use App\Repositories\JutsuRepository;
use Discord\Discord;
use Discord\Builders\Components\SelectMenu;
use Discord\Builders\Components\Option;
use Discord\Parts\Interactions\Interaction;
use Discord\Builders\MessageBuilder;
use Discord\Helpers\Collection;

class JutsuMenuService
{

    public static function createMenu(string $type, Discord $discord, CharacterService $characterService, CalcDamageService $calcDamageService): SelectMenu
    {
        $select = SelectMenu::new("menu_{$type}")
            ->setPlaceholder("Escolha um jutsu de $type");

        $jutsus = JutsuRepository::getAll();
        foreach ($jutsus as $key => $data) {
            if (str_starts_with($key, strtolower($type))) {
                $label = $data['name'] ?? ucfirst($type) . " " . substr($key, strlen($type));
                $select->addOption(new Option($label, $key));
            }
        }

        $select->setListener(function (Interaction $interaction, Collection $options) use ($calcDamageService, $discord, $jutsus) {
            $selected = $options[0]->getValue();

            $characterService = new CharacterService(null, null, null, $interaction->user->id);

            if (!isset($jutsus[$selected])) {
                $interaction->respondWithMessage(
                    MessageBuilder::new()->setContent('Jutsu inválido.')
                );
                return;
            }

            $jutsu = $jutsus[$selected];

            if (isset($jutsu['versions'])) {
                // Criar novo SelectMenu para escolher a versão
                $versionMenu = SelectMenu::new("menu_{$selected}_version")
                    ->setPlaceholder("Escolha a versão de {$selected}");

                foreach ($jutsu['versions'] as $versionKey => $versionData) {
                    $versionMenu->addOption(new Option($versionData['label'], "{$selected}_{$versionKey}"));
                }

                $versionMenu->setListener(function (Interaction $interaction, Collection $options) use ($calcDamageService, $jutsu) {
                    $chosen = $options[0]->getValue(); // ex: "katon1_base"
                    [$jutsuKey, $versionKey] = explode('_', $chosen, 2);

                    $characterService = new CharacterService(null, null, null, $interaction->user->id);

                    $version = $jutsu['versions'][$versionKey] ?? null;
                    if (!$version) {
                        $interaction->respondWithMessage(MessageBuilder::new()->setContent('Versão inválida.'));
                        return;
                    }

                    [$damage, $chakra] = $version['calc']($characterService, $calcDamageService);

                    $interaction->respondWithMessage(
                        MessageBuilder::new()
                            ->setContent("{$jutsu['name']} ({$version['label']})\n🩸 Dano: `$damage`\n🌀 Chakra: `$chakra`")
                    );
                }, $discord);

                $interaction->respondWithMessage(
                    MessageBuilder::new()
                        ->setContent("Escolha a versão de **{$selected}**:")
                        ->addComponent($versionMenu)
                );
                return;
            }

            // Jutsus sem versão (como uchiha1)
            if (isset($jutsu['calc'])) {
                $characterService = new CharacterService(null, null, null, $interaction->user->id);
                [$damage, $chakra] = $jutsu['calc']($characterService, $calcDamageService);

                $interaction->respondWithMessage(
                    MessageBuilder::new()
                        ->setContent("{$jutsu['name']}\n🩸 Dano: `$damage`\n🌀 Chakra: `$chakra`")
                );
            }
        }, $discord);

        return $select;
    }
}