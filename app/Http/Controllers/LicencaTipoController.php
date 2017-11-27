<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LicencaTipo;
use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LicencaTipoController extends Controller
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
        $licencatipos = new LicencaTipo;

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        $licencatipos = $licencatipos->paginate(session('perPage'));

        $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');
        
        return view('licencatipo.index', compact('licencatipos', 'perPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('licencatipo.create');
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
            'descricao' => 'required|unique:licenca_tipos|max:255',
        ]);

        LicencaTipo::create($request->all());

        Session::flash('create_licencatipo', 'Tipo de vínculo cadastrado com sucesso!');

        return redirect(route('licencatipo.index'));  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $licencatipo = LicencaTipo::findOrFail($id);

        return view('licencatipo.show', compact('licencatipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $licencatipo = LicencaTipo::findOrFail($id);

        return view('licencatipo.edit', compact('licencatipo'));
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
            'descricao' => 'required|unique:licenca_tipos|max:255',
        ]);

        $licencatipo = LicencaTipo::findOrFail($id);
            
        $licencatipo->update($request->all());
        
        Session::flash('edited_licencatipo', 'Tipo de licença alterado com sucesso!');

        return redirect(route('licencatipo.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LicencaTipo::findOrFail($id)->delete();

        Session::flash('deleted_licencatipo', 'Tipo de liçenca excluído com sucesso!');

        return redirect(route('licencatipo.index'));
    }

    public function export()
    {

        $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=LicencaTipo' .  date("Y-m-d h:i:sa") . '.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];        

        $licencatipos = DB::table('licenca_tipos');

        $licencatipos = $licencatipos->select('descricao');
        
        $list = $licencatipos->get()->toArray(); 

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
