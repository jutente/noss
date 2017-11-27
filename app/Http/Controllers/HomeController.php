<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * basta estar logado para ver essa página
     * usuários bloqueados podem acessar essa página
     * todos níveis de acesso podem acessar essa página
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // estou iniciando a sessão que defini a quantidade de linhas
        // exibidas por páginas aqui, ainda em teste
        session(['perPage' => 5]);
        return view('home');
    }
}
