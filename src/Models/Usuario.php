<?php
namespace App\Models;
class Usuario
{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $nomeMae;
    public $id_unidade;
    public $dataNasc;
    public $sexo;
    public Endereco $endereco;
    public $ocupacao;

    public $prontuario;
    public $observacao;
    /** @var Documento[] */
    private array $documentos = [];

    public function __construct($id, $nome, $email, ) 
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
    }

    public function adicionarDocumento(Documento $documento): void
    {
        $this->documentos[] = $documento;
    }

    public function getDocumentos(): array
    {
        return $this->documentos;
    }


}