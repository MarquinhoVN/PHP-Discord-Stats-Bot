<?php

namespace App\Database\migrations;

class CreateUsuariosTable
{
    public function up($pdo)
    {
        $query = "
            CREATE TABLE IF NOT EXISTS usuarios (
                id SERIAL PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";

        $pdo->exec($query);
        echo "Tabela 'usuarios' criada com sucesso!\n";
    }

    public function down($pdo)
    {
        $query = "DROP TABLE IF EXISTS usuarios";
        $pdo->exec($query);
        echo "Tabela 'usuarios' excluída com sucesso!\n";
    }
}
