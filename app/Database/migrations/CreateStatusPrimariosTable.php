<?php

namespace App\Database\migrations;

class CreateStatusPrimariosTable
{
    public function up($pdo)
    {
        $query = "
            CREATE TABLE IF NOT EXISTS status_primarios (
                id SERIAL PRIMARY KEY,
                destreza INT DEFAULT 0,
                forca INT DEFAULT 0,
                chakra INT DEFAULT 0
            );
        ";

        $pdo->exec($query);
        echo "Tabela 'status_primarios' criada com sucesso!\n";
    }

    public function down($pdo)
    {
        $query = "DROP TABLE IF EXISTS status_primarios";
        $pdo->exec($query);
        echo "Tabela 'status_primarios' excluída com sucesso!\n";
    }
}
