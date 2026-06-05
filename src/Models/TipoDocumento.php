<?php
namespace App\Models;

enum TipoDocumento: string
{
    case CPF = 'CPF';
    case RG = 'RG';
    case CTPS = 'CTPS';
    case TITULO_ELEITOR = 'TITULO_ELEITOR';
    case PIS_PASEP = 'PIS_PASEP';
    case CARTAO_SUS = 'CARTAO_SUS';
    case CERTIDAO_NASCIMENTO = 'CERTIDAO_NASCIMENTO';
}