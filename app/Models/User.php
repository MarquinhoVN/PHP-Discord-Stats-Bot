<?php

namespace App\Models;

use PDO;

class User
{
    private $db;

    public $id;
    public $name;
    public $email;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            return $stmt->execute([$this->name, $this->email, $this->id]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
            return $stmt->execute([$this->name, $this->email]);
        }
    }

    public function delete()
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$this->id]);
    }
}
