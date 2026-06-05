<?php
namespace App\Models;

class Endereco
{
    public $rua;
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;
    public $cidade;
    public $estado;

    public function __construct($rua, $numero, $complemento, $bairro, $cep, $cidade, $estado)
    {
        $this->rua = $rua;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }
}