<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Equipe;
use App\Unidade;
use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipes = new Equipe;

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // filtros
        if (request()->has('descricao')){
            $equipes = $equipes->where('descricao', 'like', '%' . request('descricao') . '%');
        }

        if (request()->has('unidade_id')){
            if (request('unidade_id') != ""){
                $equipes = $equipes->where('unidade_id', '=', request('unidade_id'));
            }
        }

        // ordenando
        $equipes = $equipes->orderBy('descricao', 'asc'); 

        $equipes = $equipes->paginate(session('perPage'))->appends([          
            'descricao' => request('descricao'),                     
            'unidade_id' => request('unidade_id'),                     
            ]);

        $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');

        $unidades = Unidade::orderBy('descricao')->pluck('descricao', 'id');
        
        return view('equipe.index', compact('equipes', 'perPages', 'unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::orderBy('descricao')->pluck('descricao', 'id');
        return view('equipe.create', compact('unidades'));
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
            'descricao' => 'required|unique:unidades|max:255',
            'numero' => 'required|integer',
            'cnes' => 'required|max:255',
            'ine' => 'required|max:255',
            'unidade_id' => 'required',
        ]);

        Equipe::create($request->all());

        Session::flash('create_equipe', 'Equipe de saúde cadastrada com sucesso!');

        return redirect(route('equipe.index'));  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipe = Equipe::findOrFail($id);

        return view('equipe.show', compact('equipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipe = Equipe::findOrFail($id);

        $unidades = Unidade::orderBy('descricao')->pluck('descricao', 'id');

        return view('equipe.edit', compact('equipe', 'unidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'descricao' => 'required|unique:unidades|max:255',
            'numero' => 'required|integer',
            'cnes' => 'required|max:255',
            'ine' => 'required|max:255',
            'unidade_id' => 'required',
        ]);

        $equipe = Equipe::findOrFail($id);
            
        $equipe->update($request->all());

        Session::flash('edited_equipe', 'Equipe de saúde alterada com sucesso!');

        return redirect(route('equipe.edit', $id)); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Equipe::findOrFail($id)->delete();

        Session::flash('deleted_equipe', 'Equipe de saúde excluída com sucesso!');

        return redirect(route('equipe.index'));
    }

    /**
     * export to csv.
     *
     * @param  
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function export()
    {

        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=Equipes' .  date("Y-m-d h:i:sa") . '.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];        

        $equipes = DB::table('equipe');

        $equipes = $equipes->select('descricao');
        
        $list = $equipes->get()->toArray(); 

        // nota: mostra consulta gerada pelo elloquent
        // dd($distritos->toSql());

        # converte os objetos para uma array
        $list = json_decode(json_encode($list), true);

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

       $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);
    }
}
