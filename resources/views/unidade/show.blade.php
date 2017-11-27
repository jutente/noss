@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('unidade.index')}}">Unidades de Saúde</a> - Excluir</div>
                <br>
                <ul class="list-group">
                    <li class="list-group-item">Descrição: {{$unidade->descricao}}</li>
                    <li class="list-group-item">Porte: {{$unidade->porte}}</li>
                    <li class="list-group-item">Logradouro: {{$unidade->logradouro}}</li>
                    <li class="list-group-item">Tel(1): {{$unidade->tel1}}</li>
                    <li class="list-group-item">Tel(2): {{$unidade->tel2}}</li>
                    <li class="list-group-item">Distrito: {{$unidade->distrito->nome}}</li>
                </ul>                
                <br><br>
                {!! Form::open(['method' => 'POST', 'url' => route('unidade.destroy', $unidade->id), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('_method', 'DELETE') }}

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        {{ Form::submit('Excluir?', ['class' => 'btn btn-danger btn-sm']) }}
                    </div>    
                </div>

                {!! Form::close() !!} 
            </div>

            <a href="{{route('unidade.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a> 
        </div>
    </div>
</div>
@endsection