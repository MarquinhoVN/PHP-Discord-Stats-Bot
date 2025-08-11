<?php

namespace App\Repositories;

use PDO;

class FamiliaRepository
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }
    public function findByName($name){
        $stmt = $this->conn->prepare("
            SELECT * FROM familias f WHERE f.nome ILIKE :name LIMIT 1
                      ");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findById($id)
    {
        $stmt = $this->conn->prepare("
            SELECT * from familias f WHERE f.id = :id LIMIT 1
                      ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
