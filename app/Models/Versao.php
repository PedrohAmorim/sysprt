<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Versao extends Model
{
    public $dateFormat = 'd-m-Y H:i:s';

    public $connection = 'conSistema';

    public $table = 'versao';

    public $fillable =
    [
        'valor',
        'resetSenha'
    ];
}
