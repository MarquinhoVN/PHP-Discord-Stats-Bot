<?php

namespace App\Models;

use PDO;

class Usuario
{
    private $db;

    public $id;
    public $nome;
    public $familia_id;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->db->prepare("UPDATE usuarios SET nome = ?, familia_id = ? WHERE id = ?");
            return $stmt->execute([$this->nome, $this->familia_id, $this->id]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO usuarios (nome, familia_id) VALUES (?, ?)");
            return $stmt->execute([$this->nome, $this->familia_id]);
        }
    }

    public function delete()
    {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
}
