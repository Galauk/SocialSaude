<?php

namespace App\Repositories;
use PDO;
use App\Models\Usuario;

class UsuarioRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function buscarPorCodigo(string $codigo): ?Usuario
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :codigo");
        $stmt->execute(['codigo' => $codigo]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Usuario($data['id'], $data['nome'], $data['email']);
        }

        return null;
    }

    public function salvar(Usuario $usuario): void
    {
        $stmt = $this->db->prepare("INSERT INTO usuarios (id, nome, email) VALUES (:id, :nome, :email)");
        $stmt->execute([
            'id' => $usuario->id,
            'nome' => $usuario->nome,
            'email' => $usuario->email
        ]);
    }

    public function listar(): array
    {
        $stmt = $this->db->query("SELECT * FROM usuarios");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $usuarios = [];
        while ($data = $stmt->fetch()) {
            $usuarios[] = new Usuario($data['id'], $data['nome'], $data['email']);
        }
        return $usuarios;
    }
}