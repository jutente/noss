<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vinculo;
use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class VinculoController extends Controller
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
        $vinculos = new Vinculo;

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        $vinculos = $vinculos->paginate(session('perPage'));

        $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');
        
        return view('Vinculo.index', compact('vinculos', 'perPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vinculo.create');
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
            'nome' => 'required|unique:vinculos|max:255',
        ]);

        Vinculo::create($request->all());

        Session::flash('create_vinculo', 'Vínculo cadastrado com sucesso!');

        return redirect(route('vinculo.index'));  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vinculo = Vinculo::findOrFail($id);

        return view('vinculo.show', compact('vinculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vinculo = Vinculo::findOrFail($id);

        return view('vinculo.edit', compact('vinculo'));
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
            'nome' => 'required|unique:vinculos|max:255',
        ]);

        $vinculo = Vinculo::findOrFail($id);
            
        $vinculo->update($request->all());
        
        Session::flash('edited_vinculo', 'Vínculo alterado com sucesso!');

        return redirect(route('vinculo.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vinculo::findOrFail($id)->delete();

        Session::flash('deleted_vinculo', 'Vínculo excluído com sucesso!');

        return redirect(route('vinculo.index'));
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
            ,   'Content-Disposition' => 'attachment; filename=Vinculos' .  date("Y-m-d h:i:sa") . '.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];        

        $vinculos = DB::table('vinculos');

        $vinculos = $vinculos->select('nome');
        
        $list = $vinculos->get()->toArray(); 

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
