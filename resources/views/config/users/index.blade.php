@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            {{-- avisa se um usuario foi excluido --}}
            @if(Session::has('deleted_user')) 
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                <strong>Info!</strong> {{ session('deleted_user') }}
            </div>
            @endif
            {{-- avisa quando um usuário foi modificado --}}
            @if(Session::has('create_user')) 
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                <strong>Info!</strong> {{ session('create_user') }}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                      <div class="col-sm-4">
                        Usuários do Sistema
                      </div>
                      <div class="col-sm-8 text-right">
                        <div class="btn-group btn-group-xs">                            
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter"><span class="glyphicon glyphicon-filter"></span> Filtro</a>
                            <div class="btn-group">
                                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opçoes
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('users.create')}}">Novo Registro</a></li>
                                    <li><a href="#" id="btnExportar">Exportar</a></li>
                              </ul>
                            </div>
                        </div>                      
                      </div>
                    </div>
                </div>  
                <br>
                                   
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td> 
                            <td>{{$user->perfil->descricao}}</td>
                            <td>
                                @if($user->acesso == 'N')
                                <span class="glyphicon glyphicon-lock text-danger"></span>    
                                @endif
                            </td>
                            <td style="text-align: right">
                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-pencil"></span>Alterar</a>
                            
                                <a href="{{route('users.show', $user->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span>Excluir</a>
                            </td>
                        </tr>    
                        @endforeach                                                 
                        </tbody>
                    </table>     
                    <br>
                </div>
                <div class="container-fluid">
                    {{ $users->links() }}
                </div>
                <div class="panel-footer">
                    Página {{ $users->currentPage() }} de {{ $users->lastPage() }}. Total de registros: {{ $users->total() }}.
                </div>          
            </div>
        </div>       
    </div>
</div>

<div id="modalFilter" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Filtro</h4>
            </div>
            <div class="modal-body style="padding:40px 50px;"">
                <div class="container-fluid">
                    <div class="row">                                         
                        {!! Form::open(['method'=>'GET','url'=>route('users.index')])  !!}
                        <br>                         
                        <div class="form-group">
                            {{ Form::label('name', 'Nome:') }}
                            {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nome...']) }}   
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', 'E-mail:') }}
                            {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'E-mail...']) }}   
                        </div>
                        <div class="form-group">
                            {{ Form::label('perfil_id', 'Perfil:') }}
                            {!! Form::select('perfil_id', $perfils, null, ['placeholder' => 'Escolha um perfil...', 'class' => 'form-control']) !!}
                        </div>
                        <div class="checkbox">
                            {!! Form::radio('acesso', 'T'); !!}Mostrar todos
                            {!! Form::radio('acesso', 'S'); !!}Mostrar somente com acesso
                            {!! Form::radio('acesso', 'N'); !!}Mostrar somente sem acesso                               
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Buscar', ['class' => 'btn btn-default btn-sm']) }}
                            <a href="{{ route('users.index') }}" class="btn btn-default btn-sm" role="button">Limpar</a>
                        </div>
                        {!! Form::close() !!} 
                    </div>            
                </div>
                <div class="form-group">
                    {!! Form::select('perPage', $perPages, session('perPage'), ['id' => 'perPage', 'class'  => 'form-control']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('script-footer')
<script>
$(document).ready(function(){
    $('#perPage').on('change', function() {
        perPage = $(this).find(":selected").val(); 
        
        window.open("{{ route('users.index') }}" + "?perpage=" + perPage,"_self");
    });

    $('#btnExportar').on('click', function(){
        var filtro_name = $('input[name="name"]').val();
        var filtro_email = $('input[name="email"]').val();        
        var filtro_acesso = $('input[name="acesso"]:checked').val(); 
        var filtro_perfil_id = $('select[name="perfil_id"]').val(); 

        if (filtro_acesso == undefined) { 
            filtro_acesso = 'T'; 
        }
        if (filtro_perfil_id == null) { 
            filtro_perfil_id = ''; 
        }

        window.open("{{ route('config.users.export') }}" + "?name=" + filtro_name + "&email=" + filtro_email + "&acesso=" + filtro_acesso + "&perfil_id=" + filtro_perfil_id,"_self");
    });
}); 
</script>
@endsection

