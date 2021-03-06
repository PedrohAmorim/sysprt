<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;
use App\Models\Mensagens;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Support\Facades\DB;

class VeiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('veiculos.index');
    }

    public function salvar(Request $request)
    {
        $veiculo = Veiculo::where('id', $request->id)->get()->first();

        $veiculo->numero = $request->numero;
        $veiculo->tipo = $request->tipo;
        $veiculo->descricao = $request->descricao;
        $veiculo->placa = $request->placa;

        $veiculo->save();

        return redirect()->away('/home?bloqueio=true');
    }

    public function bloqueio($idModulo){
      
        $mensagem = new Mensagens();

        $mensagem->idModulo = $idModulo;
        $mensagem->mensagem = 'ST300CMD;' . $idModulo . ';02;Enable1';
        $mensagem->idUser  = Auth::user()->id;
        $mensagem->enviado = 0;

        $mensagem->save();

      return redirect()->away('/home?bloqueio=false');

    }

    public function desbloqueio($idModulo){
      
        $mensagem = new Mensagens();

        $mensagem->idModulo = $idModulo;
        $mensagem->mensagem = 'ST300CMD;' . $idModulo . ';02;Disable1';
        $mensagem->idUser  = Auth::user()->id;
        $mensagem->enviado = 0;

        $mensagem->save();

    }

    public function pegarKm(){

        $idUser = Auth::user()->id;
        $data = date('d-m-Y');

        $query =  "select sum(km)/1000 Km from viagem vi
        join veiculo ve on ve.id = vi.idVeiculo
        where ve.idUsuario = {$idUser} and vi.HoraInicio > '$data'";
         
       return DB::connection('conEmpresa')->select(DB::raw($query));
    }
}
