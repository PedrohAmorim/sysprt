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
            return Veiculo::where('idUsuario',Auth::user()->id)->get();
        }
    }

    public function periodo(Request $request){

        $fuso = FusoHorario::all()->first();

       $horaInicio =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->data . ' ' . $request->horainicio.':00' )->addHour($fuso->valor * -1)->format('d-m-Y H:i:s');
        $horaFim =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->data . ' ' . $request->horafim.':00')->addHour($fuso->valor * -1)->format('d-m-Y H:i:s');


        $posicoes =  Posicao::on('conEmpresa')
        ->select('posicao.id', DB::raw("format(dateadd(hour,-3,dataehora),'dd/MM/yyyy HH:mm:ss') as dataehora"), 'latitude', 'longitude', 'posicao.idModulo', 'v.descricao', 'posicao.ignicao', DB::raw('convert(int,posicao.velocidade) as velocidade'),'v.tipo')
        ->join('Veiculo as v', 'v.id', '=', 'Posicao.idVeiculo')
        ->where('idVeiculo','=',$request->veiculo)
        ->whereBetween('dataehora', array($horaInicio, $horaFim))
        ->orderby('dataehora')
        ->get();

        return $posicoes;

    }
}
