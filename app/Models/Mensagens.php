<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagens extends Model
{
    public $dateFormat = 'd-m-Y H:i:s';

    public $connection = 'conSistema';

    public $table = 'mensagens';

    public $fillable =
    [
        'id',
        'idModulo',
        'mensagem',
        'idUser',
        'enviado'
    ];
}
