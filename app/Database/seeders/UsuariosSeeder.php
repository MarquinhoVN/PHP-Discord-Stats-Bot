<?php

namespace App\Database\seeders;

class UsuariosSeeder
{
    public function run($pdo)
    {
        $sql = "
            INSERT INTO usuarios (id, nome, familia_id)
            VALUES (default, 'Helzen', 14),
                   (default, 'MVN', 10),
                   (default, 'Cayo', 13)
        ";

        $pdo->exec($sql);
    }
}
