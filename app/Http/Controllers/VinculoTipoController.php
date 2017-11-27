<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\VinculoTipo;
use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class VinculoTipoController extends Controller
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
        $vinculotipos = new VinculoTipo;

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        $vinculotipos = $vinculotipos->paginate(session('perPage'));

        $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');
        
        return view('vinculotipo.index', compact('vinculotipos', 'perPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vinculotipo.create');
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
            'descricao' => 'required|unique:vinculo_tipos|max:255',
        ]);

        VinculoTipo::create($request->all());

        Session::flash('create_vinculotipo', 'Tipo de vínculo cadastrado com sucesso!');

        return redirect(route('vinculotipo.index'));  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vinculotipo = VinculoTipo::findOrFail($id);

        return view('vinculotipo.show', compact('vinculotipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vinculotipo = VinculoTipo::findOrFail($id);

        return view('vinculotipo.edit', compact('vinculotipo'));
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
            'descricao' => 'required|unique:vinculo_tipos|max:255',
        ]);

        $vinculotipo = VinculoTipo::findOrFail($id);
            
        $vinculotipo->update($request->all());
        
        Session::flash('edited_vinculotipo', 'Tipo de vínculo alterado com sucesso!');

        return redirect(route('vinculotipo.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VinculoTipo::findOrFail($id)->delete();

        Session::flash('deleted_vinculotipo', 'Tipo de vínculo excluído com sucesso!');

        return redirect(route('vinculotipo.index'));
    }
    public function export()
    {

        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=VinculoTipo' .  date("Y-m-d h:i:sa") . '.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];        

        $vinculotipos = DB::table('vinculo_tipos');

        $vinculotipos = $vinculotipos->select('descricao');
        
        $list = $vinculotipos->get()->toArray(); 

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
