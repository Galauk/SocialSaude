<?php
namespace App\Services;

use App\Repositories\UsuarioRepository;

class UsuarioService
{
    private UsuarioRepository $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function listarUsuarios()
    {
        return $this->usuarioRepository->listar();
    }

    public function buscarUsuarioPorCodigo(string $codigo)
    {
        return $this->usuarioRepository->buscarPorCodigo($codigo);
    }

    public function criarUsuario($id, $nome, $email)
    {
        $usuario = new \App\Models\Usuario($id, $nome, $email);
        $this->usuarioRepository->salvar($usuario);
        return $usuario;
    }
}