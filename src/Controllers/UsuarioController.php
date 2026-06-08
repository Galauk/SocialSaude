<?php

namespace App\Controllers;

use App\Services\UsuarioService;

class UsuarioController
{
    private UsuarioService $service;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->service = $usuarioService;
    }

    public function listar()
    {
        $usuarios = $this->service->listarUsuarios();
        require __DIR__ . '/../Views/usuario_listar.php';
    }

    public function visualizar(string $codigo){
        $usuario = $this->service->buscarUsuarioPorCodigo($codigo);
        require __DIR__ . '/../Views/usuario_visualizar.php';
    }

}