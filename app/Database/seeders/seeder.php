<?php

// Carrega o autoload do Composer
use App\Database\seeders\FamiliasSeeder;
use App\Database\seeders\UsuariosSeeder;
use App\Database\seeders\StatusPrimariosSeeder;
use App\Database\seeders\StatusSecundariosSeeder;
use App\Database\seeders\RecursosAtuaisSeeder;
use App\Database\seeders\EquipamentosSeeder;
use App\Database\seeders\UsuarioEquipamentosSeeder;

require_once __DIR__ . '/../../../vendor/autoload.php';

// Crie a conexão PDO
$pdo = new PDO("pgsql:host=postgres;dbname=discorddb", "discorddb", "discorddb");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class Seeder
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function runSeeder($seeder)
    {
        echo "Rodando seeder: " . get_class($seeder) . "\n";
        $seeder->run($this->pdo);
    }

    public function seed()
    {
        $this->runSeeder(new FamiliasSeeder());
        $this->runSeeder(new UsuariosSeeder());
        $this->runSeeder(new StatusPrimariosSeeder());
        $this->runSeeder(new StatusSecundariosSeeder());
        $this->runSeeder(new RecursosAtuaisSeeder());
        $this->runSeeder(new EquipamentosSeeder());
        $this->runSeeder(new UsuarioEquipamentosSeeder());
    }

    public function run()
    {
        $this->seed();
    }
}

$seeder = new Seeder($pdo);

$seeder->run();
