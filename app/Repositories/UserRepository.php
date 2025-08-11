<?php

namespace App\Repositories;

use PDO;

class UserRepository
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detailByDiscordId($id)
    {
        $stmt = $this->conn->prepare("
            SELECT u.nome,
                   sp.forca,
                   sp.chakra,
                   sp.destreza,
                   ss.hp as vida,
                   ss.chakra_max as reserva_de_chakra,
                   ss.ninjutsu,
                   ss.taijutsu,
                   ss.kenjutsu,
                   ss.velocidade
            FROM usuarios u
                     JOIN ficha f on f.usuario_id = u.id
                     JOIN status_primarios sp on sp.id = f.status_primario_id
                     JOIN status_secundarios ss on ss.id = f.status_secundario_id
            WHERE discord_id = :id ORDER BY f.id desc LIMIT 1
                      ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateName($id,$name){
        $stmt = $this->conn->prepare("
            update usuarios 
            set nome = :nome
            WHERE id = :id
                      ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nome', $name, PDO::PARAM_STR);
        $stmt->execute();
    }
    public function findByDiscordId($id)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM usuarios u
            WHERE discord_id = :id LIMIT 1
                      ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($discord_id,$nome){
        $stmt = $this->conn->prepare("
            insert into usuarios(discord_id,nome) 
            values(:discord_id,:name)
                      ");
        $stmt->bindValue(':discord_id', $discord_id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $nome, PDO::PARAM_STR);
        $stmt->execute();

        return (int) $this->conn->lastInsertId();

    }
}
