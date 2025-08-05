<?php

namespace App\Database\seeders;

class EquipamentosSeeder
{
    public function run($pdo)
    {
        $sql = "
            INSERT INTO equipamentos (id, nome, bonus_hp_percent, bonus_chakra_percent, bonus_ninjutsu_percent, bonus_taijutsu_percent, bonus_kenjutsu_percent, bonus_velocidade_percent)
            VALUES (default, 'Roupão Ninja', 6, 8, 0, 0, 0, 0)
        ";

        $pdo->exec($sql);
    }
}
