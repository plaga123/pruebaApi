<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cao_usuario extends Model
{
    //

    protected $table='cao_usuario';
    protected $primaryKey='co_usuario';
    public $timestamps=false;
    public $incrementing = false;
    protected $fillable =[        
        'no_usuario',
        'ds_senha',
        'co_usuario_autorizacao',
        'nu_matricula',
        'dt_nascimento',       
        'dt_admissao_empresa',
        'dt_desligamento',
        'dt_inclusao',
        'dt_expiracao',        
        'nu_cpf',
        'nu_rg',
        'no_orgao_emissor',
        'uf_orgao_emissor',
        'ds_endereco',
        'no_email',
        'no_email_pessoal',
        'nu_telefone',
        'dt_alteracao',
        'url_foto',
        'instant_messenger',
        'icq',
        'msn',
        'yms',
        'ds_comp_end',
        'ds_bairro',
        'nu_cep',
        'no_cidade',
        'uf_cidade',
        'dt_expedicao'
    ];
    protected $guarded =[

    ];
}
