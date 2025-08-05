<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;

class UserController
{
    private $usuarioService;

    public function __construct()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $usuarioRepository = new UserRepository($conn);
        $this->usuarioService = new UserService($usuarioRepository);
    }

    public function index()
    {
        $usuarios = $this->usuarioService->listarUsuarios();
        header('Content-Type: application/json');
        echo json_encode(['abab']);
    }

    public function show($id)
    {
        $usuario = $this->usuarioService->buscarUsuario($id);
        header('Content-Type: application/json');
        echo json_encode($usuario);
    }
}
