<?php

namespace App\Controllers;

use App\Services\UsuarioService;
use App\Core\View;

class UsuarioController
{
    private UsuarioService $service;
    public function __construct()
    {
        $this->service = new UsuarioService();
    }

    public function listar()
    {
        $usuarios = $this->service->listarUsuarios();
        View::render(
            'usuario/listar',
            [
                'title' => 'Lista de Usuários',
                'usuarios' => $usuarios
            ],
            'app'
        );
    }

    public function visualizar(string $codigo){
        $usuario = $this->service->buscarUsuarioPorCodigo($codigo);
        View::render(
            'usuario/visualizar',
            [
                'title' => 'Visualizar Usuário',
                'usuario' => $usuario
            ],
            'app'
        );
    }

}