<?php

namespace App\Database\migrations;

class CreateUsuarioEquipamentosTable
{
    public function up($pdo)
    {
        $query = "
           CREATE TABLE IF NOT EXISTS usuario_equipamentos (
                id SERIAL PRIMARY KEY,
                usuario_id INT NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
                equipamento_id INT NOT NULL REFERENCES equipamentos(id) ON DELETE CASCADE,
                slot VARCHAR(50),
                equipado BOOLEAN DEFAULT TRUE
            );
        ";

        $pdo->exec($query);
        echo "Tabela 'usuario_equipamentos' criada com sucesso!\n";
    }

    public function down($pdo)
    {
        $query = "DROP TABLE IF EXISTS usuario_equipamentos";
        $pdo->exec($query);
        echo "Tabela 'usuario_equipamentos' excluída com sucesso!\n";
    }
}
