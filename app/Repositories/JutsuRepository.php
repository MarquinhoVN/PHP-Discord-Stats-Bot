<?php

namespace App\Repositories;

class JutsuRepository
{
    public static function getAll(): array
    {
        return [
            // Katon | Estilo Fogo
            'katon1' => [
                'name' => '🔥 Estilo Fogo: Jutsu Bola de Fogo',
                'versions' => [
                    'base' => [
                        'label' => 'Base',
                        'calc' => function ($char, $dmg) {
                            $damage = $dmg->execute(0, 1.0, $char->ninjutsu);
                            $chakra = round($damage * 0.2);
                            return [$damage, $chakra];
                        }
                    ],
                    'melhorado' => [
                        'label' => 'Melhorado',
                        'calc' => function ($char, $dmg) {
                            $damage = $dmg->execute(50, 1.5, $char->ninjutsu);
                            $chakra = round($damage * 0.5);
                            return [$damage, $chakra];
                        }
                    ]
                ]
            ],
            'katon2' => self::generateMultiProjectileJutsu(
                '🔥 Estilo Fogo: Técnica Flor de Fênix',
                200,
                0.5,
                [1 => 0.2, 2 => 0.4, 3 => 0.8, 4 => 1, 5 => 1.2]
            ),
            'katon3' => [
                'name' => '🔥 Estilo Fogo: Bomba do Dragão Flamejante',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(500, 2, $char->ninjutsu);
                    $chakra = round($damage * 0.5);
                    return [$damage, $chakra];
                }
            ],
            'katon4' => [
                'name' => '🔥 Estilo Fogo: Grande Aniquilação por Fogo',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(0, 1.5, $char->ninjutsu);
                    $chakra = round(50);
                    return [$damage, $chakra];
                }
            ],
            'katon5' => [
                'name' => '🔥 Estilo Fogo: Técnica do Grande Dragão de Fogo',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(1000, 2, $char->ninjutsu);
                    $chakra = round($damage * 0.75);
                    return [$damage, $chakra];
                }
            ],
            // Uchiha
            'uchiha1' => [
                'name' => '👁️ Katon: Gōkakyū no Jutsu',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(0, 1.5, $char->ninjutsu);
                    $chakra = round($char->chakra * 0.1);
                    return [$damage, $chakra];
                }
            ],
            'uchiha2' => [
                'name' => '👁️ Katon: Ryūka no Jutsu',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(0, 2.5, $char->ninjutsu);
                    $chakra = round($char->chakra * 0.15);
                    return [$damage, $chakra];
                }
            ],
            'uchiha3' => [
                'name' => '👁️ Hōsenka Tsumabeni',
                'calc' => function ($char, $dmg) {
                    $damage = ($dmg->execute(0, 2, $char->kenjutsu) + $dmg->execute(0, 1.5, $char->ninjutsu));
                    $chakra = round($char->chakra * 0.25);
                    return [$damage, $chakra];
                }
            ],
            // Raiton | Estilo Raio
            'raiton1' => self::generateMultiProjectileJutsu(
                '⚡ Estilo Raio: Senbons de Raio',
                0,
                0.5,
                [1 => 0.1, 2 => 0.2, 3 => 0.4, 4 => 0.8, 5 => 1]
            ),
            'raiton2' => self::generateMultiProjectileJutsu(
                '⚡ Estilo Raio: Gian',
                150,
                1,
                [1 => 0.3, 2 => 0.3]
            ),
            'raiton3' => [
                'name' => '⚡ Estilo Raio: Perseguição de Garras da Besta Relâmpago',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(500, 2, $char->ninjutsu);
                    $chakra = round($damage * 0.5);
                    return [$damage, $chakra];
                }
            ],
            'raiton4' => [
                'name' => '⚡ Estilo Raio: Thunder Bolt',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(150, 1.5, $char->ninjutsu);
                    $chakra = round($damage * 0.5);
                    return [$damage, $chakra];
                }
            ],
            'raiton5' => [
                'name' => '⚡ Estilo Raio: Transmissão Relâmpago',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(0, 3, $char->ninjutsu);
                    $chakra = round($damage * 0.75);
                    return [$damage, $chakra];
                }
            ],
            // Doton | Estilo Terra
            'doton1' => [
                'name' => '🪨 Estilo Terra: Deslocamento Subterrâneo',
                'calc' => function ($char, $dmg) {
                    $damage = 0;
                    $chakra = round($char->chakra * 0.1);
                    return [$damage, $chakra];
                }
            ],
            'doton2' => [
                'name' => '🪨 Estilo Terra: Técnica da Decapitação Suicida',
                'calc' => function ($char, $dmg) {
                    $damage = 0;
                    $chakra = round($char->chakra * 0.1);
                    return [$damage, $chakra];
                }
            ],
            'doton3' => [
                'name' => '🪨 Estilo Terra: A Outra Face do Solo',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(0, 3, $char->ninjutsu);
                    $chakra = round($char->chakra * 0.3);
                    return [$damage, $chakra];
                }
            ],
            'doton4' => [
                'name' => '🪨 Estilo Terra: Clone de Lama',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(0, 1, $char->chakra);
                    $chakra = round($char->chakra * 0.1);
                    return [$damage, $chakra];
                }
            ],
            'doton5' => [
                'name' => '🪨 Estilo Terra: Pântano Infernal',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(0, 1.5, $char->ninjutsu);
                    $chakra = round($damage * 0.75);
                    return [$damage, $chakra];
                }
            ],
            // Futon | Estilo Vento
            'futon1' => self::generateMultiProjectileJutsu(
                '💨 Estilo Vento: Linhas de Vácuo',
                0,
                0.5,
                [1 => 0.1, 2 => 0.2, 3 => 0.4, 4 => 0.8, 5 => 1]
            ),
            'futon2' => [
                'name' => '💨 Estilo Vento: Lâmina de Vento',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(80, 1.5, $char->ninjutsu);
                    $chakra = round($damage * 0.25);
                    return [$damage, $chakra];
                }
            ],
            'futon3' => [
                'name' => '💨 Estilo Vento: Grande Destruição',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(200, 1.5, $char->ninjutsu);
                    $chakra = round($damage * 0.3);
                    return [$damage, $chakra];
                }
            ],
            'futon4' => [
                'name' => '💨 Estilo Vento: Atsugai',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(500, 2, $char->ninjutsu);
                    $chakra = round($damage * 0.5);
                    return [$damage, $chakra];
                }
            ],
            'futon5' => [
                'name' => '💨 Estilo Vento: Bala de Ar Perfuradora',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(1000, 3, $char->ninjutsu);
                    $chakra = round($damage * 0.75);
                    return [$damage, $chakra];
                }
            ],
            // Suiton | Estilo Água
            'suiton1' => [
                'name' => '💧 Estilo Água: Ondas Furiosas',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(50, 1, $char->ninjutsu);
                    $chakra = round($damage * 0.2);
                    return [$damage, $chakra];
                }
            ],
            'suiton2' => [
                'name' => '💧 Estilo Água: Trombeta de Água',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(250, 1.5, $char->ninjutsu);
                    $chakra = round($damage * 0.3);
                    return [$damage, $chakra];
                }
            ],
            'suiton3' => [
                'name' => '💧 Estilo Água: Formação da Parede de Água Ofensiva',
                'calc' => function ($char, $dmg) {
                    $damage = 0;
                    $chakra = round($char->chakra * 0.25);
                    return [$damage, $chakra];
                }
            ],
            'suiton4' => [
                'name' => '💧 Estilo Água: Técnica da Bomba do Dragão de Água',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(300, 2, $char->ninjutsu);
                    $chakra = round($damage * 0.45);
                    return [$damage, $chakra];
                }
            ],
            'suiton5' => [
                'name' => '💧 Estilo Água: Formação da Parede de Água Defensiva',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(100, 2, $char->ninjutsu);
                    $chakra = round($damage * 0.5);
                    return [$damage, $chakra];
                }
            ],
            'suiton6' => [
                'name' => '💧 Estilo Água: Técnica da Grande Cachoeira',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(500, 2, $char->ninjutsu);
                    $chakra = round($damage * 0.75);
                    return [$damage, $chakra];
                }
            ],
            // Soco
            'soco' => [
                'name' => '👊 Soco',
                'calc' => function ($char, $dmg) {
                    $damage = $dmg->execute(0, 1, $char->taijutsu);
                    $chakra = 0;
                    return [$damage, $chakra];
                }
            ],
        ];
    }

    private static function generateMultiProjectileJutsu(
        string $baseName,
        int    $baseDamage,
        float  $mult,
        array  $chakraMultipliers,
        string $attribute = 'ninjutsu',
    ): array
    {
        return [
            'name' => "$baseName",
            'versions' => array_reduce(array_keys($chakraMultipliers), function ($versions, $count) use (
                $baseDamage, $mult, $chakraMultipliers, $attribute
            ) {
                $label = "$count";

                $versions[(string)$count] = [
                    'label' => $label,
                    'calc' => function ($char, $dmg) use ($count, $baseDamage, $mult, $chakraMultipliers, $attribute) {
                        $attributeValue = $char->{$attribute} ?? 0;
                        $damagePer = $dmg->execute($baseDamage, $mult, $attributeValue);
                        $totalDamage = $damagePer * $count;
                        $chakra = round($totalDamage * $chakraMultipliers[$count]);
                        return [$totalDamage, $chakra];
                    }
                ];
                return $versions;
            }, [])
        ];
    }
}
