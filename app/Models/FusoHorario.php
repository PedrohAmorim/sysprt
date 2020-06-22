<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FusoHorario extends Model
{
    public $dateFormat = 'd-m-Y H:i:s';

    public $connection = 'conSistema';

    public $table = 'fusohorario';

    public $fillable =
    [
        'id',
        'sql_fuso_name',
        'carbon_fuso_name',
        'slug',
        'valor'
    ];
}
