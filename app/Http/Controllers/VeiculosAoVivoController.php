<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UltimaPosicao;
use App\Models\FusoHorario;
use Illuminate\Support\Facades\DB;

class VeiculosAoVivoController extends Controller
{


    public function index()
    {
    }

    public function ultimaposicao()
    {
        $fuso = FusoHorario::all()->first();

        //dd($fuso);

        if(Auth::user()->admin){
            $ultimaposicao=  UltimaPosicao::on('conEmpresa')
            ->select('ultimaposicao.id', 'dataehora', 'latitude', 'longitude', 'ultimaposicao.idModulo', 'v.descricao', 'ultimaposicao.ignicao', DB::raw('convert(int,ultimaposicao.velocidade) as velocidade'),'v.tipo')
            ->join('Veiculo as v', 'v.id', '=', 'ultimaposicao.idVeiculo')
            ->get();
        }else{

        $ultimaposicao=  UltimaPosicao::on('conEmpresa')
            ->select('ultimaposicao.id', 'dataehora', 'latitude', 'longitude', 'ultimaposicao.idModulo', 'v.descricao', 'ultimaposicao.ignicao', DB::raw('convert(int,ultimaposicao.velocidade) as velocidade'),'v.tipo')
            ->join('Veiculo as v', 'v.id', '=', 'ultimaposicao.idVeiculo')
            ->where('v.idUsuario',Auth::user()->id)
            ->get();
        }

            foreach($ultimaposicao as $item){
                $item->dataehora =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $item->dataehora);
                $item->dataehora = $item->dataehora->timezone('UTC')->addHour($fuso->valor)->format('d-m-Y H:i:s');
                //$item->dataehora = date("d-m-Y H:i:s", strtotime($item->dataehora));
            }

            return $ultimaposicao;
    }

    public function posicaoporhorario(Request $request)
    {

    }
}
