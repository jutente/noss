<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PessoalController extends Controller
{
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
        $destinos = new Destino;

            $destinos = $destinos->where($destinos->idservidor == auth()->user()->id );
        
             if(request()->has('perpage')) {
                 session(['perPage' => request('perpage')]);
             }
   
             // filtros

             if (request()->has('servidor')){
                if (request('servidor') != ""){
                    
                    $destinos = $destinos->join('servidors', 'destinos.idservidor', '=', 'servidors.idservidor')
                    ->select('destinos.*')
                    ->where('servidors.servidor', 'like', '%' . request('servidor') . '%');
                   
                }
            }

           /*  if (request()->has('setor')){
                $destinos = $destinos->where('setor', 'like', '%' . request('setor') . '%');
            } */


            if (request()->has('iddestino')){
                 if (request('iddestino') != ""){
                    
                    $destinos = $destinos->where('iddestino', '=', request('iddestino'));
                 }
             }

            if (request()->has('idsetor')){
                 if (request('idsetor') != ""){
                    
                    $destinos = $destinos->where('idsetor', '=', request('idsetor'));
                  
                 }
            }

           // ordenando
            // $destinos = $destinos->orderBy('destino', 'asc');
    
             $destinos = $destinos->paginate(session('perPage'))->appends([
                 'servidors' => request('servidor'),
                 'iddestino' => request('iddestino'),
                 'idsetor' => request('idsetor'),
             ]);
    
             $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');

             $servidors = Servidor::orderBy('servidor')->pluck('servidor', 'idservidor');
             $setors = Setor::orderBy('setor')->pluck('setor', 'idsetor');
  
         
             return view('destino.index', compact('destinos','servidors', 'perPages','setors')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servidors = Servidor::orderBy('servidor')->pluck('servidor', 'idservidor');
        $setors = Setor::orderBy('setor')->pluck('setor', 'idsetor');

        return view('destino.create', compact('servidors','setors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $this->validate($request, [
            'destino' => 'required|unique:destinos|max:255',
           // 'dtprotocolo' => 'date|date_format:Y-m-d',
        ]);
 */
        Destino::create($request->all());

        Session::flash('create_destino', 'Destino cadastrado com sucesso!');

        return redirect(route('destino.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Destino  $destino
     * @return \Illuminate\Http\Response
     */
    public function show($iddestino)
    {
        $destino = destino::findOrFail($iddestino);
        
           return view('destino.show', compact('destino'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Destino  $destino
     * @return \Illuminate\Http\Response
     */
    public function edit($iddestino)
    {
        $destino = Destino::findOrFail($iddestino);
        
        //$destinos = destino::orderBy('setor')->pluck('setor', 'iddestino');
        $setors = Setor::orderBy('setor')->pluck('setor', 'idsetor');
        $servidors = Servidor::orderBy('servidor')->pluck('servidor', 'idservidor');
           return view('destino.edit', compact('destino','servidors','setors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Destino  $destino
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $iddestino)
    {
        $destino = Destino::findOrFail($iddestino);
        
        $destino->update($request->all());
        
        Session::flash('edited_destino', 'Destino alterado com sucesso!');

        return redirect(route('destino.edit', $iddestino));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Destino  $destino
     * @return \Illuminate\Http\Response
     */
    public function destroy($iddestino)
    {
        Destino::findOrFail($iddestino)->delete();
        
        Session::flash('deleted_destino', 'Destino excluído com sucesso!');
        
        return redirect(route('destino.index'));
    }
}
