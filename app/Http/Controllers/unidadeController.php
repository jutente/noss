<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Unidade;
use App\Distrito;
use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class unidadeController extends Controller
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

        $this->middleware('verificaperfil:administrador,operador,leitura',   ['only' => ['show', 'index', 'export']]);
        $this->middleware('verificaperfil:administrador',   ['except' => ['show', 'index', 'export']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = new Unidade;

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // filtros
        if (request()->has('descricao')){
            $unidades = $unidades->where('descricao', 'like', '%' . request('descricao') . '%');
        }

        if (request()->has('distrito_id')){
            if (request('distrito_id') != ""){
                $unidades = $unidades->where('distrito_id', '=', request('distrito_id'));
            }
        }

        // ordenando
        $unidades = $unidades->orderBy('descricao', 'asc'); 

        $unidades = $unidades->paginate(session('perPage'))->appends([          
            'descricao' => request('descricao'),                     
            'distrito_id' => request('distrito_id'),                     
            ]);

        $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');

        $distritos = Distrito::orderBy('nome')->pluck('nome', 'id');
        
        return view('unidade.index', compact('unidades', 'perPages', 'distritos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distritos = Distrito::orderBy('nome')->pluck('nome', 'id');
        return view('unidade.create', compact('distritos'));
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
            'distrito_id' => 'required',
        ]);

        Unidade::create($request->all());

        Session::flash('create_unidade', 'Unidade de saúde cadastrada com sucesso!');

        return redirect(route('unidade.index'));  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidade = Unidade::findOrFail($id);

        return view('unidade.show', compact('unidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidade = Unidade::findOrFail($id);

        $distritos = Distrito::orderBy('nome')->pluck('nome', 'id');

        return view('unidade.edit', compact('unidade', 'distritos'));
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
            'distrito_id' => 'required',
        ]);

        $unidade = Unidade::findOrFail($id);
            
        $unidade->update($request->all());

        Session::flash('edited_unidade', 'Unidade de saúde alterada com sucesso!');

        return redirect(route('unidade.edit', $id)); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unidade::findOrFail($id)->delete();

        Session::flash('deleted_unidade', 'Unidade de saúde excluída com sucesso!');

        return redirect(route('unidade.index'));
    }

    public function export()
    {

        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=Unidades' .  date("Y-m-d h:i:sa") . '.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];        

        $unidades = DB::table('unidades');

        $unidades = $unidades->select('descricao');

        // filtros
        if (request()->has('descricao')){
            $unidades = $unidades->where('descricao', 'like', '%' . request('descricao') . '%');
        }

        if (request()->has('distrito_id')){
            if (request('distrito_id') != ""){
                $unidades = $unidades->where('distrito_id', '=', request('distrito_id'));
            }
        }

        // ordenando
        $unidades = $unidades->orderBy('descricao', 'asc'); 
        
        $list = $unidades->get()->toArray(); 

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
