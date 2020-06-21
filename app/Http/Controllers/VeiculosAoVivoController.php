<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UltimaPosicao;

class VeiculosAoVivoController extends Controller
{


    public function index()
    {
    }

    public function ultimaposicao()
    {
        $ultimaposicao=  UltimaPosicao::on('conEmpresa')
            ->select('ultimaposicao.id', 'dataehora', 'latitude', 'longitude', 'ultimaposicao.idModulo', 'v.descricao')
            ->join('Veiculo as v', 'v.id', '=', 'ultimaposicao.idVeiculo')->get();

            foreach($ultimaposicao as $item){
                $item->dataehora = date("d-m-Y H:i:s", strtotime($item->dataehora));
            }

            return $ultimaposicao;
    }

    public function posicaoporhorario(Request $request)
    {
    }
}
