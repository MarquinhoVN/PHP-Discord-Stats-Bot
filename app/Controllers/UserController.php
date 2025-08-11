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
    public function show($discord_id)
    {
       $usuario = $this->usuarioService->findAttributes($discord_id);
        if (!$usuario) {
            return "Usuário não encontrado.";
        }

        $mensagemFormatada = "🧬 **Atributos de {$usuario['nome']}**:\n" .
            "💪 **Força**: {$usuario['forca']}\n" .
            "🌀 **Chakra Base**: {$usuario['chakra']}\n" .
            "⚡ **Detreza**: {$usuario['destreza']}\n\n" .
            "🧡 **HP**: {$usuario['vida']}\n" .
            "🌀 **Chakra**: {$usuario['reserva_de_chakra']}\n" .
            "👤 **Ninjutsu**: {$usuario['ninjutsu']}\n" .
            "💪 **Taijutsu**: {$usuario['taijutsu']}\n" .
            "⚔️ **Kenjutsu**: {$usuario['kenjutsu']}\n" .
            "⚡ **Velocidade**: {$usuario['velocidade']}";

        return $mensagemFormatada;
    }
}
