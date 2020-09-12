<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/resetSenha', 'HomeController@resetSenha');
Route::get('/politicadeprivacidade', 'PoliticaController@politica');
Route::get('/ultimaposicao', 'VeiculosAoVivoController@ultimaposicao');
Route::post('/posicaoperiodo', 'ReplayController@periodo');
Route::get('/pegarveiculos','ReplayController@pegarVeiculos');
Route::get('/apresentacao','ApresentacaoController@index');
Route::get('/veiculo','VeiculoController@index');
Route::post('/veiculo/salvar','VeiculoController@salvar');
Route::get('/veiculo/bloqueio/{idModulo}','VeiculoController@bloqueio');
Route::get('/veiculo/desbloqueio/{idModulo}','VeiculoController@desbloqueio');
Route::get('/viagens', 'ViagemController@index');
Route::get('/viagens/{dia}', 'ViagemController@pegarViagens');
Route::get('/km', 'VeiculoController@pegarKm');
Route::get('/kmDiario', 'ViagemController@kmDiario');
Route::get('/quilometragem','ViagemController@viewKm');
