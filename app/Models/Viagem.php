<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viagem extends Model
{
    public $dateFormat = 'd-m-Y H:i:s';

    public $connection = 'conEmpresa';

    public $table = 'viagem';

    public $fillable =
    [
        'idVeiculo'
           ,'idMotorista'
           ,'idModulo'
           ,'posicaoInicio'
           ,'posicaoFim'
           ,'horaInicio'
           ,'horaFim'
           ,'km'
           ,'duracao'
           ,'descricao'
           ,'OdometroInicio'
           ,'OdometroFim'
    ];
}
