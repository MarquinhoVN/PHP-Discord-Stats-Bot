<?php


namespace App\Database\migrations;

class CreateStatusSecundariosTable
{
    public function up($pdo)
    {
        $query = "
            CREATE TABLE IF NOT EXISTS status_secundarios (
                id SERIAL PRIMARY KEY,
                hp INT DEFAULT 0,
                chakra INT DEFAULT 0,
                ninjutsu INT DEFAULT 0,
                taijutsu INT DEFAULT 0,
                kenjutsu INT DEFAULT 0,
                velocidade INT DEFAULT 0
            );
        ";

        $pdo->exec($query);
        echo "Tabela 'status_secundarios' criada com sucesso!\n";
    }

    public function down($pdo)
    {
        $query = "DROP TABLE IF EXISTS status_secundarios";
        $pdo->exec($query);
        echo "Tabela 'status_secundarios' excluída com sucesso!\n";
    }
}
