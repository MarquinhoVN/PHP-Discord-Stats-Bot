<?php

namespace App\Database\migrations;

class CreateEquipamentosTable
{
    public function up($pdo)
    {
        $query = "
            CREATE TABLE IF NOT EXISTS equipamentos (
                id SERIAL PRIMARY KEY,
                nome VARCHAR(100) UNIQUE NOT NULL,
                bonus_hp_percent INT DEFAULT 0,
                bonus_chakra_percent INT DEFAULT 0,
                bonus_ninjutsu_percent INT DEFAULT 0,
                bonus_taijutsu_percent INT DEFAULT 0,
                bonus_kenjutsu_percent INT DEFAULT 0,
                bonus_velocidade_percent INT DEFAULT 0
            );
        ";

        $pdo->exec($query);
        echo "Tabela 'equipamentos' criada com sucesso!\n";
    }

    public function down($pdo)
    {
        $query = "DROP TABLE IF EXISTS equipamentos";
        $pdo->exec($query);
        echo "Tabela 'equipamentos' excluída com sucesso!\n";
    }
}
