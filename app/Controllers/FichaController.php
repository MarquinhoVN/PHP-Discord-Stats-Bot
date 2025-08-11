<?php

namespace App\Controllers;

use App\Database\Database;
use App\Repositories\FichaRepository;
use App\Services\FichaService;

class FichaController
{
    private $fichaService;

    public function __construct()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $this->fichaService = new FichaService($conn);
    }

    public function create($discord_id, $nome, $familia, $forca, $chakra, $destreza, $create)
    {
        return $this->fichaService->montarFicha($discord_id, $nome, $familia, $forca, $chakra, $destreza, $create);
    }

    public function addStats($discord_id, $forca, $chakra, $destreza)
    {
        if ($forca == 0 && $chakra == 0 && $destreza == 0) {
            return "Status não alterados";
        } else if ($forca >= 0 && $chakra >= 0 && $destreza >= 0) {
            $msg = "Adição realizada com sucesso.";
            $usuario = $this->fichaService->adicionarStatus($discord_id, $forca, $chakra, $destreza);
            if (!$usuario) {
                return "Usuário não encontrado.";
            }
            if ($forca > 0)
                $msg = $msg . "\nForça adicionada {$forca}";
            if ($chakra > 0)
                $msg = $msg . "\nChakra adicionado {$chakra}";
            if ($destreza > 0)
                $msg = $msg . "\nDestreza adicionado {$destreza}";

            return $msg;
        }
        return "Não pode adicionar status negativos";

    }
}
