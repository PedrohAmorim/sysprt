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

Route::get('/ultimaposicao', 'VeiculosAoVivoController@ultimaposicao');
Route::post('/posicaoperiodo', 'ReplayController@periodo');
Route::get('/pegarveiculos','ReplayController@pegarVeiculos');
Route::get('/apresentacao','ApresentacaoController@index');
Route::get('/veiculo','VeiculoController@index');
Route::post('/veiculo/salvar','VeiculoController@salvar');
Route::get('/veiculo/bloqueio/{id}','VeiculoController@bloqueio');
Route::get('/veiculo/desbloqueio/{id}','VeiculoController@desbloqueio');
