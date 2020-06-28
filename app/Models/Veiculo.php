<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    public $dateFormat = 'd-m-Y H:i:s';

    public $connection = 'conEmpresa';

    public $table = 'veiculo';

    public $fillable =
    [
        'id',
        'idModelo',
        'idModulo',
        'numero',
        'descricao',
        'tipo'
    ];
}
