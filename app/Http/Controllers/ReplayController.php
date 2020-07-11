<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Posicao;
use App\Models\FusoHorario;
use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('replay.replay');
    }

    public function pegarVeiculos(){

        if(Auth::user()->admin){
            return Veiculo::all();
        }else{
            return Veiculo::where('idUsuario',Auth::user()->id);
        }
    }

    public function periodo(Request $request){

        $fuso = FusoHorario::all()->first();

        $request->horainicio =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->data . ' ' . $request->horainicio.':00' );
        $request->horainicio = $request->horainicio->timezone('UTC')->addHour($fuso->valor * -1)->format('d-m-Y H:i:s');

        $request->horafim =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->data . ' ' . $request->horafim.':00');
        $request->horafim = $request->horafim->timezone('UTC')->addHour($fuso->valor * -1)->format('d-m-Y H:i:s');

        $posicoes =  Posicao::on('conEmpresa')
        ->select('posicao.id', 'dataehora', 'latitude', 'longitude', 'posicao.idModulo', 'v.descricao', 'posicao.ignicao', DB::raw('convert(int,posicao.velocidade) as velocidade'),'v.tipo')
        ->join('Veiculo as v', 'v.id', '=', 'Posicao.idVeiculo')
        ->where('idVeiculo','=',$request->veiculo)
        ->whereBetween('dataehora', array($request->horainicio, $request->horafim))
        ->orderby('dataehora')
        ->get();

        foreach($posicoes as $item){
            $item->dataehora =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $item->dataehora);
            $item->dataehora = $item->dataehora->timezone('UTC')->addHour($fuso->valor)->format('d-m-Y H:i:s');
            //$item->dataehora = date("d-m-Y H:i:s", strtotime($item->dataehora));
        }


        return $posicoes;

    }
}
