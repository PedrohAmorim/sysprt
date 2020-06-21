<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UltimaPosicao extends Model
{

    public $dateFormat = 'd-m-Y H:i:s';

    public $connection = 'conEmpresa';

    public $table = 'ultimaposicao';

    public $fillable =
    [
        'id',
        'idVeiculo',
        'idMotorista',
        'dataehora',
        'latitude',
        'longitude',
        'velocidade',
        'aceleracao',
        'idModulo'
    ];
}
