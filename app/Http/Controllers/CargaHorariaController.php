<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CargaHoraria;
use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CargaHorariaController extends Controller
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
        $cargaHorarias = new CargaHoraria;

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        $cargaHorarias = $cargaHorarias->paginate(session('perPage'));

        $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');
        
        return view('cargahoraria.index', compact('cargaHorarias', 'perPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargahoraria.create');
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
            'nome' => 'required|unique:carga_horarias|max:255',
        ]);

        CargaHoraria::create($request->all());

        Session::flash('create_cargahoraria', 'Carga Horária cadastrado com sucesso!');

        return redirect(route('cargahoraria.index'));  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargaHoraria = CargaHoraria::findOrFail($id);
        
        return view('cargaHoraria.show', compact('cargaHoraria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargahoraria = CargaHoraria::findOrFail($id);

        return view('cargahoraria.edit', compact('cargahoraria'));
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
            'nome' => 'required|unique:carga_horarias|max:255',
        ]);

        $cargahoraria = CargaHoraria::findOrFail($id);
            
        $cargahoraria->update($request->all());
        
        Session::flash('edited_cargahoraria', 'Carga horária alterada com sucesso!');

        return redirect(route('cargahoraria.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CargaHoraria::findOrFail($id)->delete();

        Session::flash('deleted_cargahoraria', 'Carga Horária excluída com sucesso!');

        return redirect(route('cargahoraria.index'));
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
            ,   'Content-Disposition' => 'attachment; filename=CargaHorarias' .  date("Y-m-d h:i:sa") . '.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];        

        $cargahorarias = DB::table('carga_horarias');

        $cargahorarias = $cargahorarias->select('nome');
        
        $list = $cargahorarias->get()->toArray(); 

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
