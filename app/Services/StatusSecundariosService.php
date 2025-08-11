<?php

namespace App\Services;

use App\Repositories\StatusSecundarioRepository;
use App\Repositories\UserRepository;

class StatusSecundariosService
{
    private $statusSecundariosRepository;

    public function __construct(StatusSecundarioRepository $statusSecundariosRepository)
    {
        $this->statusSecundariosRepository = $statusSecundariosRepository;
    }

    public function create($hp, $chakra_max, $ninjutsu, $taijutsu, $kenjutsu, $velocidade){
        return $this->statusSecundariosRepository->create($hp, $chakra_max, $ninjutsu, $taijutsu, $kenjutsu, $velocidade);
    }
    public function setStatus($id, $hp, $chakra_max, $ninjutsu, $taijutsu, $kenjutsu, $velocidade){
        return $this->statusSecundariosRepository->setStatus($id, $hp, $chakra_max, $ninjutsu, $taijutsu, $kenjutsu, $velocidade);
    }
}
