<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use PhpParser\Node\Stmt\Return_;

class VeiculoController extends Controller
{

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

    }
}
