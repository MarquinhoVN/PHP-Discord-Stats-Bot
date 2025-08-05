<?php

namespace App\Database\seeders;

class UsuariosSeeder
{
    public function run($pdo)
    {
        $sql = "
            INSERT INTO usuarios (id, nome, familia_id, discord_id)
            VALUES (default, 'Helzen', 14, '268068444237201410'),
                   (default, 'MVN', 10, '265279165010411521'),
                   (default, 'Cayo', 13, '386225545819586562')
        ";

        $pdo->exec($sql);
    }
}
