@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('servidor.index')}}">Servidores</a> - Excluir</div>
                <br>
                <ul class="list-group">
                    <li class="list-group-item">Servidor: {{$servidor->servidor}}</li>
                    <li class="list-group-item">Matricula: {{$servidor->matricula}}</li>
                    <li class="list-group-item">Telefone: {{$servidor->tel}}</li>                   
                    <li class="list-group-item">Cargo: {{$servidor->cargo->cargo}}</li>
                    <li class="list-group-item">Setor: {{$servidor->setor->setor}}</li>
                </ul>                
                <br><br>
                {!! Form::open(['method' => 'POST', 'url' => route('servidor.destroy', $servidor->idservidor), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('_method', 'DELETE') }}

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        {{ Form::submit('Excluir?', ['class' => 'btn btn-danger btn-sm']) }}
                    </div>    
                </div>

                {!! Form::close() !!} 
            </div>

            <a href="{{route('servidor.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a> 
        </div>
    </div>
</div>
@endsection