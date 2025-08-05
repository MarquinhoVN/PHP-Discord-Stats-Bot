<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database\Database;

$db = new Database();
$conn = $db->getConnection();

try {
    // Usuários
    $conn->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id SERIAL PRIMARY KEY,
            discord_id VARCHAR(50) UNIQUE NOT NULL,
            nome VARCHAR(100) NOT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // Status primários
    $conn->exec("
        CREATE TABLE IF NOT EXISTS status_primarios (
            id SERIAL PRIMARY KEY,
            destreza INT DEFAULT 0,
            forca INT DEFAULT 0,
            chakra INT DEFAULT 0
        );
    ");

    // Status secundários
    $conn->exec("
        CREATE TABLE IF NOT EXISTS status_secundarios (
            id SERIAL PRIMARY KEY,
            hp INT DEFAULT 0,
            chakra_max INT DEFAULT 0,
            ninjutsu INT DEFAULT 0,
            taijutsu INT DEFAULT 0,
            kenjutsu INT DEFAULT 0,
            velocidade INT DEFAULT 0
        );
    ");

    // Ficha do jogador
    $conn->exec("
        CREATE TABLE IF NOT EXISTS ficha (
            id SERIAL PRIMARY KEY,
            usuario_id INT NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
            status_primarios_id INT NOT NULL REFERENCES status_primarios(id) ON DELETE CASCADE,
            status_secundarios_id INT NOT NULL REFERENCES status_secundarios(id) ON DELETE CASCADE,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // Recursos atuais do jogador (para batalha)
    $conn->exec("
        CREATE TABLE IF NOT EXISTS recursos_atuais (
            id SERIAL PRIMARY KEY,
            ficha_id INT NOT NULL REFERENCES ficha(id) ON DELETE CASCADE,
            vida_atual INT DEFAULT 0,
            chakra_atual INT DEFAULT 0,
            atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // Histórico de batalhas
    $conn->exec("
        CREATE TABLE IF NOT EXISTS batalhas (
            id SERIAL PRIMARY KEY,
            jogador1_id INT NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
            jogador2_id INT NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
            vencedor_id INT REFERENCES usuarios(id),
            data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ");

    echo "✅ Todas as tabelas foram criadas com sucesso!\n";

} catch (PDOException $e) {
    echo "❌ Erro ao criar tabelas: " . $e->getMessage() . "\n";
}
