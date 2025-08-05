<?php

namespace App\Database\seeders;

class UsuarioEquipamentosSeeder
{
    public function run($pdo)
    {
        $sql = "
            INSERT INTO usuario_equipamentos (id, usuario_id, equipamento_id, slot)
            VALUES (default, 1, 1, 'Armadura')
        ";

        $pdo->exec($sql);
    }
}
