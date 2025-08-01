<?php

namespace App\Database;

use PDO;

class Database {
    public static function connect(): PDO {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbname = $_ENV['POSTGRES_DB'];
        $user = $_ENV['POSTGRES_USER'];
        $pass = $_ENV['POSTGRES_PASSWORD'];

        return new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    }
}

