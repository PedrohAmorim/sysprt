<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FusoHorario;
use App\Models\Viagem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViagemController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('viagem.index');
    }

    public function pegarViagens($dia){
     
      $fuso = FusoHorario::all()->first();

      $horainicio =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dia . ' ' . '00:00:00' );
      $horainicio = $horainicio->timezone('UTC')->addHour($fuso->valor * -1)->format('d-m-Y H:i:s');

      $horafim =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dia . ' ' . '02:59:59');
      $horafim =  $horafim->timezone('UTC')->addDay(1)->format('d-m-Y H:i:s');

      $filtroUsuario = Auth::user()->admin == true ? ' ' : "and ve.idUsuario = " . Auth::user()->id . "";

      $query = 
      "select 
      vi.id,
      vi.posicaoInicio,
      vi.posicaoFim,
      vi.horaInicio,
      vi.horaFim,
      vi.km,
      m.nomeescala,
      ve.descricao,
      ve.tipo,
      pi.latitude latInicio,
      pi.longitude lngInicio,
      pf.latitude latFim,
      pf.longitude lngFim,
      ve.placa,
      '' ruaInicio,
      '' ruaFim
       from viagem vi "
     ." left join motorista m on m.id = vi.idMotorista "
     ." left join veiculo ve on ve.id = vi.idVeiculo "
     ." join posicao pi on pi.id = vi.posicaoInicio "
     ." join posicao pf on pf.id = vi.posicaoFim "
     ." where vi.horaInicio between '". $horainicio . "' and '" . $horafim ."'"
     . $filtroUsuario 
     . "and (vi.km/1000) > 3 order by vi.horaInicio desc";

      $viagens = DB::connection('conEmpresa')->select(DB::raw($query));

      foreach($viagens as $item){
        //Colocar o Fuso na hora Inicial
        $item->horaInicio =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $item->horaInicio);
        $item->horaInicio = $item->horaInicio->timezone('UTC')->addHour($fuso->valor)->format('d-m-Y H:i:s');
        //Colocar o Fuso na hora Final
        $item->horaFim =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $item->horaFim);
        $item->horaFim = $item->horaFim->timezone('UTC')->addHour($fuso->valor)->format('d-m-Y H:i:s');
      }

      return $viagens;
    }
}
