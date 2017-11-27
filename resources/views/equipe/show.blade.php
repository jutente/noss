@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('equipe.index')}}">Equipes de Saúde</a> - Excluir</div>
                <br>
                <ul class="list-group">
                    <li class="list-group-item">Descrição: {{$equipe->descricao}}</li>
                    <li class="list-group-item">Número: {{$equipe->numero}}</li>
                    <li class="list-group-item">CNES: {{$equipe->cnes}}</li>
                    <li class="list-group-item">INE: {{$equipe->ine}}</li>
                    <li class="list-group-item">Distrito: {{$equipe->unidade->descricao}}</li>
                </ul>                
                <br><br>
                {!! Form::open(['method' => 'POST', 'url' => route('equipe.destroy', $equipe->id), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('_method', 'DELETE') }}

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        {{ Form::submit('Excluir?', ['class' => 'btn btn-danger btn-sm']) }}
                    </div>    
                </div>

                {!! Form::close() !!} 
            </div>

            <a href="{{route('equipe.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a> 
        </div>
    </div>
</div>
@endsection