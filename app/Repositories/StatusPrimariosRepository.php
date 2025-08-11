<?php

namespace App\Repositories;

use PDO;

class StatusPrimariosRepository
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }
    public function create($forca,$chakra,$destreza){
        $stmt = $this->conn->prepare("
            insert into status_primarios(forca,chakra,destreza) 
            values(:forca,:chakra,:destreza)
                      ");
        $stmt->bindValue(':forca', $forca, PDO::PARAM_INT);
        $stmt->bindValue(':chakra', $chakra, PDO::PARAM_INT);
        $stmt->bindValue(':destreza', $destreza, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $this->conn->lastInsertId();

    }
    public function findById($id)
    {
        $stmt = $this->conn->prepare("
            SELECT * from status_primarios sp WHERE sp.id = :id LIMIT 1
                      ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function setStatus($id,$forca,$chakra,$destreza)
    {
        $stmt = $this->conn->prepare("
            UPDATE status_primarios
             SET forca = :forca , destreza = :destreza, chakra = :chakra
             WHERE id = :id;
            ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':forca', $forca, PDO::PARAM_INT);
        $stmt->bindValue(':chakra', $chakra, PDO::PARAM_INT);
        $stmt->bindValue(':destreza', $destreza, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
