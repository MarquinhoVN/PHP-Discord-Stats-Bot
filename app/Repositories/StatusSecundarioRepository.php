<?php

namespace App\Repositories;

use PDO;

class StatusSecundarioRepository
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }
    public function create($hp, $chakra_max, $ninjutsu, $taijutsu, $kenjutsu, $velocidade){
        $stmt = $this->conn->prepare("
            insert into status_secundarios(hp, chakra_max, ninjutsu, taijutsu, kenjutsu, velocidade) 
            values(:hp, :chakra_max, :ninjutsu, :taijutsu, :kenjutsu, :velocidade)
                      ");
        $stmt->bindValue(':hp', $hp, PDO::PARAM_INT);
        $stmt->bindValue(':chakra_max', $chakra_max, PDO::PARAM_INT);
        $stmt->bindValue(':ninjutsu', $ninjutsu, PDO::PARAM_INT);
        $stmt->bindValue(':taijutsu', $taijutsu, PDO::PARAM_INT);
        $stmt->bindValue(':kenjutsu', $kenjutsu, PDO::PARAM_INT);
        $stmt->bindValue(':velocidade', $velocidade, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $this->conn->lastInsertId();

    }

    public function setStatus($id, $hp, $chakra_max, $ninjutsu, $taijutsu, $kenjutsu, $velocidade)
    {
        $stmt = $this->conn->prepare("
            UPDATE status_secundarios
            SET 
                hp = :hp,
                chakra_max = :chakra_max,
                ninjutsu = :ninjutsu,
                taijutsu = :taijutsu,
                kenjutsu = :kenjutsu,
                velocidade = :velocidade
            WHERE id = :id;
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':hp', $hp, PDO::PARAM_INT);
        $stmt->bindValue(':chakra_max', $chakra_max, PDO::PARAM_INT);
        $stmt->bindValue(':ninjutsu', $ninjutsu, PDO::PARAM_INT);
        $stmt->bindValue(':taijutsu', $taijutsu, PDO::PARAM_INT);
        $stmt->bindValue(':kenjutsu', $kenjutsu, PDO::PARAM_INT);
        $stmt->bindValue(':velocidade', $velocidade, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

}
