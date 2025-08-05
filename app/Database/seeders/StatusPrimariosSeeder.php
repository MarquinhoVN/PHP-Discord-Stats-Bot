<?php

namespace App\Database\seeders;

class StatusPrimariosSeeder
{
    public function run($pdo)
    {
        $sql = "
            INSERT INTO status_primarios (id, usuario_id, destreza, forca, chakra)
            VALUES (default, 1, 1000, 100, 1330),
                   (default, 2, 300, 200, 1750),
                   (default, 3, 1000, 200, 1230)
        ";

        $pdo->exec($sql);
    }
}
