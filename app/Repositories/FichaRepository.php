<?php

namespace App\Repositories;

use PDO;

class FichaRepository
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function createSheet($user_id, $family, $primario, $secundario)
    {
        $stmt = $this->conn->prepare("
            insert into ficha(usuario_id, familia_id, status_primario_id, status_secundario_id)
            values(:user_id, :family, :primario, :secundario)
                      ");
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':family', $family, PDO::PARAM_INT);
        $stmt->bindValue(':primario', $primario, PDO::PARAM_INT);
        $stmt->bindValue(':secundario', $secundario, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $this->conn->lastInsertId();

    }

    public function findByDiscordId($id)
    {
        $stmt = $this->conn->prepare("
            SELECT * from ficha f
                     JOIN usuarios u on u.id = f.usuario_id 
            WHERE u.discord_id = :id
                      ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
