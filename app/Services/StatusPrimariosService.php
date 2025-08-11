<?php

namespace App\Services;

use App\Repositories\StatusPrimariosRepository;

class StatusPrimariosService
{
    private $statusPrimariosRepository;

    public function __construct(StatusPrimariosRepository $statusPrimariosRepository)
    {
        $this->statusPrimariosRepository = $statusPrimariosRepository;
    }
    public function create($forca,$chakra,$destreza){
        return $this->statusPrimariosRepository->create($forca,$chakra,$destreza);
    }
    public function findById($id){
        return $this->statusPrimariosRepository->findById($id);
    }
    public function setStatus($id,$forca,$chakra,$destreza){
        return $this->statusPrimariosRepository->setStatus($id,$forca,$chakra,$destreza);
    }
}
