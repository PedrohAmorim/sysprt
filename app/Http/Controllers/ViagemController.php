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
public function viewKm(){
        return view('viagem.km');

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
      format(dateadd(hour,{$fuso->valor},vi.horaInicio),'dd/MM/yyyy HH:mm:ss') horaInicio ,
      format(dateadd(hour,{$fuso->valor},vi.horaFim),'dd/MM/yyyy HH:mm:ss') horaFim,
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
     . " order by vi.horaInicio desc";

      return DB::connection('conEmpresa')->select(DB::raw($query));


    }

    public function kmDiario(){

        if(Auth::user() ->admin == true) {
            $query = "select format(convert(date,dateadd(hour,-3,horaInicio)),'dd/MM/yyyy') Dia,ve.descricao,SUM(km)/1000 Km
from viagem vi
join Veiculo ve on ve.id = vi.idVeiculo
group by convert(date,dateadd(hour,-3,horaInicio)),ve.descricao
order by  convert(date,dateadd(hour,-3,horaInicio)) desc";
        }else{
            $query = "select format(convert(date,dateadd(hour,-3,horaInicio)),'dd/MM/yyyy') Dia,ve.descricao,SUM(km)/1000 Km
from viagem vi
join Veiculo ve on ve.id = vi.idVeiculo
where ve.idUsuario = ". Auth::user()->id . "
group by convert(date,dateadd(hour,-3,horaInicio)),ve.descricao
order by  convert(date,dateadd(hour,-3,horaInicio)) desc";
        }


       return DB::connection('conEmpresa')->select($query);

    }

}
