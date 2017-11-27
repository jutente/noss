<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Perfil;
use App\PerPage;

use Response;
use Auth;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserPasswordRequest;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;


class ConfigUsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Somente administradores possuem acesso a essa configuração
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['middleware' => 'auth']);
        $this->middleware(['middleware' => 'temacesso']);

        /*
        -- controle de acesso a ser usado como padrão -- 
        $this->middleware('verificaperfil:administrador,operador,leitura',   ['only' => ['show', 'index', 'export']]);
        $this->middleware('verificaperfil:administrador,operador',   ['except' => ['show', 'index', 'export']]);
        */
        $this->middleware(['middleware' => 'verificaperfil:administrador']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = new User;

        // altera a quantidade de resultados mostrados por página, tabela per_pages
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // filtros
        if (request()->has('name')){
            $users = $users->where('name', 'like', '%' . request('name') . '%');
        }

        if (request()->has('email')){
            $users = $users->where('name', 'like', '%' . request('email') . '%');
        }

        if (request()->has('perfil_id')){
            if (request('perfil_id') != ""){
                $users = $users->where('perfil_id', '=', request('perfil_id'));
            }
        }  

        if (request()->has('acesso')){
            if (request('acesso') != "T"){
                $users = $users->where('acesso', '=', request('acesso'));
            }
        }

        $users = $users->orderBy('name', 'asc');       

        // une ao endereço dos links de navegação, para manter a pesquisa salva
        $users = $users->paginate(session('perPage'))->appends([          
            'name' => request('name'),           
            'email' => request('email'),           
            'perfil_id' => request('perfil_id'),           
            'acesso' => request('acesso'),           
            ]);

        $perfils = Perfil::orderBy('descricao')->pluck('descricao', 'id');

        $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');
        
        return view('config.users.index', compact('users', 'perfils', 'perPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfils = Perfil::orderBy('descricao')->pluck('descricao', 'id');

        return view('config.users.create', compact('perfils'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $input = $request->all();

        //dd($input);       

        $input['acesso'] = isset($input['acesso']) ? 'S' : 'N';

        $input['password'] = bcrypt($input['password']);

        User::create($input);

        Session::flash('create_user', 'Usuário cadastrado com sucesso!');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('config.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // usuário que será alterado
        $user = User::findOrFail($id);

        // lista de perfis para o campo select
        $perfils = Perfil::orderBy('descricao')->pluck('descricao', 'id');

        return view('config.users.edit', compact('user', 'perfils'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->has('password')) {
            $input = $request->all();

            $input['password'] = bcrypt($input['password']);
        } else {
            $input = $request->except('password');
        }   

        if (isset($input['acesso'])) {
            $input['acesso'] = 'S';
        } else {
            $input['acesso'] = 'N';
        }
            
        $user->update($input);
        
        Session::flash('edited_user', 'Usuário alterado com sucesso!');

        return redirect(route('users.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        Session::flash('deleted_user', 'Usuário excluído com sucesso!');

        return redirect(route('users.index'));
    }

     /**
     * Retorna o fomulário de alteração do usuário logado no sistema
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function password(){
        return view('config.users.password');
    }

     /**
     * Atualiza a nova senha do usuário logado ao sistema.
     *
     * @param  App\Http\Requests\UserPasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(UserPasswordRequest $request){
        $input = $request->all();
        $user = Auth::user();

        /* verifica se a senha passada confere com a senha do usuário logado */
        if (Auth::attempt(['email' => $user->email, 'password' => $input['password'] ])) {
            /*  criptografa e atualiza a senha */           
            $user->password = bcrypt($input['newpassword']);
            $user->update();
            Session::flash('password_altered', 'Senha Alterada!');           
        } else {
            Session::flash('password_wrong', 'Senha Atual Incorreta!');
        }      

        return view('config.users.password');
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
            ,   'Content-Disposition' => 'attachment; filename=UsuariosDoSistema' .  date("Y-m-d h:i:sa") . '.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];        

        $users = DB::table('users');

        $users = $users->select('name', 'email', 'acesso', 'perfils.descricao as perfil');

        # retornando a descricao do perfil usando (inner) join
        $users = $users->join('perfils', 'users.perfil_id', '=', 'perfils.id');

        # filtros
        if (request()->has('name')){
            $users = $users->where('name', 'like', '%' . request('name') . '%');
        }

        if (request()->has('email')){
            $users = $users->where('name', 'like', '%' . request('email') . '%');
        }

        if (request()->has('perfil_id')){
            if (request('perfil_id') != ""){
                $users = $users->where('perfil_id', '=', request('perfil_id'));
            }
        }  

        if (request()->has('acesso')){
            if (request('acesso') != "T"){
                $users = $users->where('acesso', '=', request('acesso'));
            }
        } 
        
        $list = $users->get()->toArray(); 

        // nota: mostra consulta gerada pelo elloquent
        // dd($users->toSql());
        //dd($list);

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
