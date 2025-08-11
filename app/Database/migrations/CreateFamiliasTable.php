<?php

namespace App\Database\migrations;

class CreateFamiliasTable
{
    public function up($pdo)
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS familias (
                id SERIAL PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                bonus_hp INT DEFAULT 0,
                bonus_chakra INT DEFAULT 0,
                bonus_ninjutsu INT DEFAULT 0,
                bonus_taijutsu INT DEFAULT 0,
                bonus_kenjutsu INT DEFAULT 0,
                bonus_velocidade INT DEFAULT 0
            );
        ";

        $pdo->exec($sql);
    }
}
