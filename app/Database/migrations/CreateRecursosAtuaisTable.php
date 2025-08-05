<?php

namespace App\Database\migrations;

class CreateRecursosAtuaisTable
{
    public function up($pdo)
    {
        $query = "
            CREATE TABLE IF NOT EXISTS recursos_atuais (
                id SERIAL PRIMARY KEY,
                usuario_id INT NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
                vida_atual INT DEFAULT 0,
                chakra_atual INT DEFAULT 0,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";

        $pdo->exec($query);
        echo "Tabela 'recursos_atuais' criada com sucesso!\n";
    }

    public function down($pdo)
    {
        $query = "DROP TABLE IF EXISTS recursos_atuais";
        $pdo->exec($query);
        echo "Tabela 'recursos_atuais' excluída com sucesso!\n";
    }
}
