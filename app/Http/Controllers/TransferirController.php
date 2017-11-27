<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Servidor;
use App\Cargo;
use App\Setor;
use App\Destino;

use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class TransferirController extends Controller
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
        $this->middleware(['middleware' => 'auth']);
        $this->middleware(['middleware' => 'temacesso']);

        $this->middleware('verificaperfil:administrador,operador,leitura',  ['only' => ['show', 'index', 'export']]);
        $this->middleware('verificaperfil:administrador',  ['except' => ['show', 'index', 'export']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $servidor = Servidor::findOrFail($id);
        
           return view('transferir.show', compact('servidor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(request $setor, $id)
    {   

       // dd($setor->setor);
        $destinosetor = $setor->setor;

        $servidor = Servidor::findOrFail($id);
        
        $cargos = Cargo::orderBy('cargo')->pluck('cargo', 'idcargo');
        $setors = Setor::orderBy('setor')->pluck('setor', 'idsetor');

           return view('transferir.edit', compact('servidor','cargos','setors','destinosetor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idservidor)
    {
        $this->validate($request, [
            'servidor' => ['required',Rule::unique('servidors')->ignore($idservidor,'idservidor'),],
        ]);

        $servidor = Servidor::findOrFail($idservidor);
            
        $servidor->update($request->all());
        
       // Session::flash('edited_servidor', 'Setor alterado com sucesso!');
       
        return redirect()->route('transferir.show', $idservidor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Destino::findOrFail($idservidor)->delete();
        //dd($id);

        DB::table('destinos')->where('idservidor','=',$id)->delete();
        
        Session::flash('deleted_destino', 'As outras opçoes do servidor foram excluidas!');
        
        return redirect(route('destino.index'));
    }
}
