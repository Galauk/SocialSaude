<?php
namespace App\Models;

class Unidade
{
    public $id;
    public $nome;
    public $endereco;
    public $cidade;
    public $estado;

    public function __construct($id, $nome, $endereco, $cidade, $estado)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }
}