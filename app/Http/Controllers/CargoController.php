<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cargo;
use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class CargoController extends Controller
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
        $cargos = new Cargo;

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        $cargos = $cargos->paginate(session('perPage'));

        $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');
        
        return view('cargo.index', compact('cargos', 'perPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargo.create');
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
            'cargo' => 'required|unique:cargos|max:255',

        ]);

        Cargo::create($request->all());

        Session::flash('create_cargo', 'Cargo cadastrado com sucesso!');

        return redirect(route('cargo.index'));  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idcargo
     * @return \Illuminate\Http\Response
     */
    public function show($idcargo)
    {
        $cargo = Cargo::findOrFail($idcargo);
     
        return view('cargo.show', compact('cargo','cbo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idcargo
     * @return \Illuminate\Http\Response
     */
    public function edit($idcargo)
    {
        $cargo = Cargo::findOrFail($idcargo);

        return view('cargo.edit', compact('cargo','cbo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idcargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idcargo)
    {
        $this->validate($request, [
            'cargo' => ['required',Rule::unique('cargos')->ignore($idcargo,'idcargo'),],
        ]);

       
        $cargo = Cargo::findOrFail($idcargo);
            
        $cargo->update($request->all());
        
        Session::flash('edited_cargo', 'Cargo alterado com sucesso!');

        return redirect(route('cargo.edit', $idcargo));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idcargo
     * @return \Illuminate\Http\Response
     */
    public function destroy($idcargo)
    {
        Cargo::findOrFail($idcargo)->delete();

        Session::flash('deleted_cargo', 'Cargo excluído com sucesso!');

        return redirect(route('cargo.index'));
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
            ,   'Content-Disposition' => 'attachment; filename=Cargos' .  date("Y-m-d h:i:sa") . '.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];        

        $cargos = DB::table('cargos');

        $cargos = $cargos->select('cargo');
        
        $list = $cargos->get()->toArray(); 

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
