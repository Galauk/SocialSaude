<?php
namespace App\Models;

class Documento 
{
    public function __construct(
        private TipoDocumento $tipo,
        private string $numero,
        private ?string $orgaoEmissor = null,
        private ?\DateTimeImmutable $dataEmissao = null,
        private ?string $observacao = null
    ) {
    }

    public function getTipo(): TipoDocumento
    {
        return $this->tipo;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getOrgaoEmissor(): ?string
    {
        return $this->orgaoEmissor;
    }

    public function getDataEmissao(): ?\DateTimeImmutable
    {
        return $this->dataEmissao;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }
}