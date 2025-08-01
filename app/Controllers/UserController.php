<?php

namespace App\Controllers;

class UserController
{
    // Método para listar os usuários
    public function index()
    {
        echo "Listagem de usuários";
    }

    // Método para exibir um usuário específico
    public function show()
    {
        echo "Detalhes de um usuário";
    }

    // Método para armazenar um novo usuário
    public function store()
    {
        echo "Armazenando um novo usuário";
    }

    // Método para atualizar um usuário
    public function update()
    {
        echo "Atualizando um usuário";
    }

    // Método para excluir um usuário
    public function destroy()
    {
        echo "Excluindo um usuário";
    }
}
