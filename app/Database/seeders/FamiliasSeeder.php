<?php

namespace App\Database\seeders;

class FamiliasSeeder
{
    public function run($pdo)
    {
        $sql = "
            INSERT INTO familias (id, nome, bonus_hp, bonus_chakra, bonus_ninjutsu, bonus_taijutsu, bonus_kenjutsu, bonus_velocidade)
            VALUES (default, 'Aburame', 20, 80, 50, 20, 0, 50),
                   (default, 'Chinoike', 30, 60, 60, 40, 0, 30),
                   (default, 'Hatake', 20, 70, 50, 40, 0, 40),
                   (default, 'Hebi', 20, 70, 50, 30, 0, 50),
                   (default, 'Hoshigaki', 40, 60, 60, 30, 0, 30),
                   (default, 'Hyuuga', 30, 50, 40, 60, 0, 40),
                   (default, 'Kazekage', 30, 60, 60, 40, 0, 30),
                   (default, 'Lee', 20, 10, 0, 90, 0, 60),
                   (default, 'Nara', 20, 80, 60, 30, 0, 30),
                   (default, 'Kami', 25, 70, 70, 50, 0, 10),
                   (default, 'Raikage', 35, 50, 30, 30, 0, 80),
                   (default, 'Kyou', 40, 80, 70, 10, 0, 50),
                   (default, 'Sarutobi', 30, 60, 55, 40, 0, 40),
                   (default, 'Uchiha', 20, 70, 50, 30, 0, 50),
                   (default, 'Uzumaki', 35, 75, 50, 45, 0, 20),
                   (default, 'Yuki', 25, 65, 60, 0, 35, 40),
                   (default, 'Senju', 35, 75, 50, 35, 0, 30)
        ";

        $pdo->exec($sql);
    }
}
