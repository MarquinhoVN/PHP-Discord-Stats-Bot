<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listarUsuarios()
    {
        return $this->userRepository->getAll();
    }

    public function buscarUsuario($id)
    {
        return $this->userRepository->findById($id);
    }
}
