<?php

namespace App\Database\seeders;

class RecursosAtuaisSeeder
{
    public function run($pdo)
    {
        $sql = "
            INSERT INTO recursos_atuais (id, usuario_id, vida_atual, chakra_atual)
            VALUES (default, 1, 1408, 1221),
                   (default, 2, 1250, 1488),
                   (default, 3, 1485, 984)
        ";

        $pdo->exec($sql);
    }
}
