<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        if (file_exists(__DIR__ . '/../../.env')) {
            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();
        }

        $host = $_ENV['DB_HOST'] ?? 'postgres';
        $db   = $_ENV['POSTGRES_DB'] ?? 'discorddb';
        $user = $_ENV['POSTGRES_USER'] ?? 'discorddb';
        $pass = $_ENV['POSTGRES_PASSWORD'] ?? 'discorddb';
        $port = $_ENV['DB_PORT'] ?? '5432';

        try {
            $this->conn = new PDO(
                "pgsql:host={$host};port={$port};dbname={$db}",
                $user,
                $pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
