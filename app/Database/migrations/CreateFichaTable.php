<?php

namespace App\Database\migrations;

class CreateFichaTable
{
    public function up($pdo)
    {
        $query = "
            CREATE TABLE IF NOT EXISTS ficha (
                id SERIAL PRIMARY KEY,
                usuario_id INT,
                familia_id INT,  -- Adiciona a referência à tabela 'familias'
                status_primario_id INT,
                status_secundario_id INT,
                FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
                FOREIGN KEY (familia_id) REFERENCES familias(id),  -- Chave estrangeira para 'familias'
                FOREIGN KEY (status_primario_id) REFERENCES status_primarios(id),
                FOREIGN KEY (status_secundario_id) REFERENCES status_secundarios(id),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";

        $pdo->exec($query);
        echo "Tabela 'ficha' criada com sucesso!\n";
    }

    public function down($pdo)
    {
        $query = "DROP TABLE IF EXISTS ficha";
        $pdo->exec($query);
        echo "Tabela 'ficha' excluída com sucesso!\n";
    }
}
