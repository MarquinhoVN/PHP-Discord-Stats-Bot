<?php

// Carrega o autoload do Composer
use App\Database\migrations\CreateFamiliasTable;
use App\Database\migrations\CreateFichaTable;
use App\Database\migrations\CreateStatusPrimariosTable;
use App\Database\migrations\CreateStatusSecundariosTable;
use App\Database\migrations\CreateUsuariosTable;

require_once __DIR__ . '/../../../vendor/autoload.php';

// Crie a conexão PDO
$pdo = new PDO("pgsql:host=postgres;dbname=discorddb", "discorddb", "discorddb");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class Migrate
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function runMigration($migration)
    {
        $migration->up($this->pdo);
    }

    public function migrateUp()
    {
        $this->runMigration(new CreateFamiliasTable());
        $this->runMigration(new CreateFichaTable());
        $this->runMigration(new CreateUsuariosTable());
        $this->runMigration(new CreateStatusPrimariosTable());
        $this->runMigration(new CreateStatusSecundariosTable());
    }

    public function run()
    {
        $this->migrateUp();
    }
}

$migrator = new Migrate($pdo);

$migrator->run();
