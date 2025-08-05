<?php

namespace App\Database\migrations;

class CreateBatalhasTable
{
    public function up($pdo)
    {
        $query = "
            CREATE TABLE IF NOT EXISTS batalhas (
                id SERIAL PRIMARY KEY,
                jogador1_id INT NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
                jogador2_id INT NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
                vencedor_id INT REFERENCES usuarios(id),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT chk_jogadores_diferentes CHECK (jogador1_id <> jogador2_id)
            );
        ";

        $pdo->exec($query);
        echo "Tabela 'batalhas' criada com sucesso!\n";
    }

    public function down($pdo)
    {
        $query = "DROP TABLE IF EXISTS batalhas";
        $pdo->exec($query);
        echo "Tabela 'batalhas' excluída com sucesso!\n";
    }
}
