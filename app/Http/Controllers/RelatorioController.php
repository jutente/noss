<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Historico;

use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class RelatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function lista()
    {     
        $guias = new Historico;       
               
        $guias = $guias->orderby('dtmudanca','desc')->paginate(10);

        return view('guia.relatorio', compact('guias')); 

    }
}
