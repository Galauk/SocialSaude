<?php
namespace App\Models;
use 
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
                                      fam_codigo, 
                                      usu_observacao, 
                                      usu_sit_familiar,
                                      usu_freq_escolar, 
                                      usu_ocupacao, 
                                      usu_cbo_r, 
                                      usu_pis_pasep,
                                      usu_cpf, 
                                      usu_cartao_p_sus, 
                                      usu_cartao_sus, 
                                      usu_tipo_certidao,
                                      usu_cert_cartorio, 
                                      usu_cert_livro, 
                                      usu_cert_lv_fls,
                                      usu_cert_termo, 
                                      to_char(usu_cert_emissao, 'dd/mm/yyyy') as usu_cert_emissao,
                                      usu_prontuario,
                                      usu_tit_eleitor, 
                                      usu_tit_eleitor_zona, 
                                      usu_tit_eleitor_secao

    public function __construct($id, $nome, $email, $senha) 
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }
}