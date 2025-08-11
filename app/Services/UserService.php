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
    public function criarUsuario($discord_id, $nome){
        return $this->userRepository->createUser($discord_id, $nome);
    }
    public function findAttributes($id)
    {
        return $this->userRepository->detailByDiscordId($id);
    }
    public function findUser($id)
    {
        return $this->userRepository->findByDiscordId($id);
    }

    public function updateName($id, $nome){
        $this->userRepository->updateName($id, $nome);
    }
}
