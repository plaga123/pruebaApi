<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permissao_sistema extends Model
{

    protected $table='permissao_sistema';
    protected $primaryKey='co_usuario';
    public $timestamps=false;
    public $incrementing = false;
    protected $fillable =[        
        'co_tipo_usuario',
        'co_sistema',
        'in_ativo',
        'co_usuario_atualizacao',
        'dt_atualizacao'        
    ];
    protected $guarded =[

    ];
}
