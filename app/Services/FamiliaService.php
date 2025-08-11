<?php

namespace App\Services;

use App\Repositories\FamiliaRepository;

class FamiliaService
{
    private $familiaRepository;

    public function __construct(FamiliaRepository $familiaRepository)
    {
        $this->familiaRepository = $familiaRepository;
    }

    public function findFamily($name)
    {
        return $this->familiaRepository->findByName($name);
    }
    public function findById($id)
    {
        return $this->familiaRepository->findById($id);
    }
}
