<?php

namespace App\Http\Controllers;

use App\Servidor;
use App\Cargo;
use App\Setor;

use Illuminate\Http\Request;

use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class ServidorController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * Somente administradores podem alterar, excluir e incluir registros
     * Operador e Leitura só podem ler os dados
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servidors = new Servidor;
           
                if(request()->has('perpage')) {
                    session(['perPage' => request('perpage')]);
                }
      
                // filtros
                if (request()->has('servidor')){
                    $servidors = $servidors->where('servidor', 'like', '%' . request('servidor') . '%');
                }

                  if (request()->has('idcargo')){
                    if (request('idcargo') != ""){
                        $servidors = $servidors->where('idcargo', '=', request('idcargo'));
                    }
                }

             if (request()->has('idsetor')){
                    if (request('idsetor') != ""){
                        $servidors = $servidors->where('idsetor', '=', request('idsetor'));
                    }
                }      
              // ordenando
                $servidors = $servidors->orderBy('servidor', 'asc');
       
                $servidors = $servidors->paginate(session('perPage'))->appends([
                    'servidor' => request('servidor'),
                    'idcargo' => request('idcargo'),
                    'idsetor' => request('idsetor'),
                ]);
       
                $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');

                $cargos = Cargo::orderBy('cargo')->pluck('cargo', 'idcargo');
                $setors = Setor::orderBy('setor')->pluck('setor', 'idsetor');
     
                return view('servidor.index', compact('servidors', 'perPages', 'cargos', 'setors')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::orderBy('cargo')->pluck('cargo', 'idcargo');
        $setors = Setor::orderBy('setor')->pluck('setor', 'idsetor');

        return view('servidor.create', compact('cargos','setors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'servidor' => 'required|unique:servidors|max:255',
           // 'dtprotocolo' => 'date|date_format:Y-m-d',
        ]);
        
      
     // $request->servidor = mb_strtoupper($request->servidor,'UTF-8');
       /* $request->servidor =$request->servidor;
       dd($request->all() );
        */
        Servidor::create($request->all());
        

        Session::flash('create_servidor', 'Servidor cadastrado com sucesso!');

        return redirect(route('servidor.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servidor  $servidor
     * @return \Illuminate\Http\Response
     */
    public function show($idservidor)
    {
        $servidor = Servidor::findOrFail($idservidor);
        
           return view('servidor.show', compact('servidor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servidor  $servidor
     * @return \Illuminate\Http\Response
     */
    public function edit($idservidor)
    {
        $servidor = Servidor::findOrFail($idservidor);
        
        $cargos = Cargo::orderBy('cargo')->pluck('cargo', 'idcargo');
        $setors = Setor::orderBy('setor')->pluck('setor', 'idsetor');

           return view('servidor.edit', compact('servidor','cargos','setors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servidor  $servidor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idservidor)
    {
        $this->validate($request, [
            'servidor' => ['required',Rule::unique('servidors')->ignore($idservidor,'idservidor'),],
        ]);

        $servidor = Servidor::findOrFail($idservidor);
            
        $servidor->update($request->all());
        
        Session::flash('edited_servidor', 'Servidor alterado com sucesso!');

        return redirect(route('servidor.edit', $idservidor));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servidor  $servidor
     * @return \Illuminate\Http\Response
     */
    public function destroy($idservidor)
    {
        Servidor::findOrFail($idservidor)->delete();
        
        Session::flash('deleted_servidor', 'servidor excluído com sucesso!');
        
        return redirect(route('servidor.index'));
    }
}
