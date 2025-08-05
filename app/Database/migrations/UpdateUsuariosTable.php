<?php

namespace App\Database\migrations;

class UpdateUsuariosTable
{
    public function up($pdo)
    {
        $query = "
            ALTER TABLE usuarios ADD COLUMN discord_id VARCHAR(20) UNIQUE;
        ";

        $pdo->exec($query);
        echo "Coluna 'discord_id' criada com sucesso!\n";
    }
}
