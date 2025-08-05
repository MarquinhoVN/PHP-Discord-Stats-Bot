<?php

namespace App\Database\seeders;

class StatusSecundariosSeeder
{
    public function run($pdo)
    {
        $sql = "
            INSERT INTO status_secundarios (id, usuario_id, hp, chakra, ninjutsu, taijutsu, kenjutsu, velocidade)
            VALUES (default, 1, 1408, 1221, 549, 150, 156, 200),
                   (default, 2, 1250, 1488, 646, 45, 133, 60),
                   (default, 3, 1485, 984, 536, 140, 196, 200)
        ";

        $pdo->exec($sql);
    }
}
