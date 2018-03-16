<?php

namespace App\Http\Controllers;

use App\Setor;
use Illuminate\Http\Request;

use App\PerPage;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class SetorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $setors = new Setor;

        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        $setors = $setors->paginate(session('perPage'));

        $perPages = PerPage::orderBy('valor')->pluck('nome', 'valor');
        
        return view('setor.index', compact('setors', 'perPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setor.create');
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
            'setor' => 'required|unique:setors|max:255',
        ]);

        Setor::create($request->all());

        Session::flash('create_setor', 'Setor cadastrado com sucesso!');

        return redirect(route('setor.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function show($idsetor)
    {
        $setor = Setor::findOrFail($idsetor);
        
           return view('setor.show', compact('setor','centrocusto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function edit($idsetor)
    {
        $setor = Setor::findOrFail($idsetor);
        
           return view('setor.edit', compact('setor','centrocusto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idsetor)
    {
        $this->validate($request, [
            'setor' => ['required',Rule::unique('setors')->ignore($idsetor,'idsetor'),],
        ]);

        $setor = Setor::findOrFail($idsetor);
            
        $setor->update($request->all());
        
        Session::flash('edited_setor', 'Setor alterado com sucesso!');

        return redirect(route('setor.edit', $idsetor));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function destroy($idsetor)
    {
        Setor::findOrFail($idsetor)->delete();
        
        Session::flash('deleted_setor', 'Setor excluído com sucesso!');
        
        return redirect(route('setor.index'));
    }
}
