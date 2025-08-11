<?php

namespace App\Services;

use App\Repositories\FichaRepository;
use App\Repositories\FamiliaRepository;
use App\Repositories\StatusPrimariosRepository;
use App\Repositories\StatusSecundarioRepository;
use App\Repositories\UserRepository;
use PDO;

class FichaService
{
    private $fichaRepository;
    private $statusPrimariosService;
    private $statusSecundariosService;
    private $familiaService;
    private $userService;

    public function __construct(PDO $conn
    )
    {
        $this->familiaService = new FamiliaService(new FamiliaRepository($conn));
        $this->statusPrimariosService = new StatusPrimariosService(new StatusPrimariosRepository($conn));
        $this->statusSecundariosService = new StatusSecundariosService(new StatusSecundarioRepository($conn));
        $this->fichaRepository = new FichaRepository($conn);
        $this->userService = new UserService(new UserRepository($conn));
    }

    public function findByDiscordId($discord_id)
    {
        return $this->fichaRepository->findByDiscordId($discord_id);
    }

    public function montarFicha($discord_id, $nome, $familia, $forca, $chakra, $destreza, $create = false)
    {
        $user = $this->userService->findUser($discord_id);
        if (empty($user)) {
            $newUser = $this->userService->criarUsuario($discord_id, $nome);
        } else if ($this->fichaRepository->findByDiscordId($discord_id) && !$create) {
            return "Esse usuário já possui ficha, se deseja criar uma nova, utilize: !criarficha <nome> <familia> <força> <chakra> <destreza> true";
        } else if ($create) {
            $this->userService->updateName($user['id'], $nome);
        }
        $family = $this->familiaService->findFamily($familia);
        if ($family) {
            $primario = $this->statusPrimariosService->create($forca, $chakra, $destreza);

            [$hp, $chakra_max, $ninjutsu, $taijutsu, $kenjutsu, $velocidade] = $this->calcStatus($family,$forca,$chakra,$destreza);

            $secundario = $this->statusSecundariosService->create($hp, $chakra_max, $ninjutsu, $taijutsu, $kenjutsu, $velocidade);

            $user_id = $user['id'] ?? $newUser;
            $this->fichaRepository->createSheet($user_id, $family['id'], $primario, $secundario);
        } else {
            return "Essa familia não existe";
        }
        return true;
    }

    public function calcStatus($bonus, $tforca, $tchakra, $tdestreza)
    {
        $bhp = $bonus['bonus_hp'] / 100;
        $bc = $bonus['bonus_chakra'] / 100;
        $bn = $bonus['bonus_ninjutsu'] / 100;
        $bt = $bonus['bonus_taijutsu'] / 100;
        $bk = $bonus['bonus_kenjutsu'] / 100;
        $bv = $bonus['bonus_velocidade'] / 100;

        $newhp = round((1 + $bhp) * ($tforca * 0.75 + $tchakra * 0.4 + $tdestreza * 0.5));
        $newc = round((1 + $bc) * ($tchakra * 0.5));
        $newn = round((1 + $bn) * ($tchakra * 0.2 + $tdestreza * 0.1));
        $newt = round((1 + $bt) * ($tforca * 0.2 + $tdestreza * 0.1));
        $newk = round((1 + $bk) * ($tdestreza * 0.2));
        $newv = round((1 + $bv) * ($tdestreza * 0.1));
        return [$newhp, $newc, $newn, $newt, $newk, $newv];
    }

    public function adicionarStatus($discord_id, $forca, $chakra, $destreza): mixed
    {
        $ficha = $this->fichaRepository->findByDiscordId($discord_id);
        if (empty($ficha)) {
            return false;
        }
        $bonus = $this->familiaService->findByID($ficha['familia_id']);

        $atributos = $this->statusPrimariosService->findById($ficha['status_primario_id']);

        $tforca = $atributos['forca'] + $forca;
        $tchakra = $atributos['chakra'] + $chakra;
        $tdestreza = $atributos['destreza'] + $destreza;

        $this->statusPrimariosService->setStatus($ficha['status_primario_id'], $tforca, $tchakra, $tdestreza);

        [$newhp, $newc, $newn, $newt, $newk, $newv] = $this->calcStatus($bonus, $tforca, $tchakra, $tdestreza);

        $this->statusSecundariosService->setStatus($ficha['status_secundario_id'], $newhp, $newc, $newn, $newt, $newk, $newv);
        return true;
    }

}
