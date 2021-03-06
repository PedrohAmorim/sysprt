<?php

namespace App\Http\Controllers;

session_start();
use Illuminate\Http\Request;
use App\Models\Versao;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        session_destroy();
        $_SESSION['versao'] = Versao::all()->first()->valor;
        return view('home');
    }

    public function resetSenha(){
        return Versao::all()->first()->resetSenha;
    }



}
