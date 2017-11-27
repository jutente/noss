@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('edited_vinculo')) 
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                <strong>Info!</strong> {{ session('edited_vinculo') }}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('vinculo.index')}}">Vínculos</a> - Alterar</div>
                <br>

                {!! Form::open(['method' => 'post', 'url' => route('vinculo.update', $vinculo->id), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('_method', 'PUT') }}

                <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
                    {{ Form::label('nome', 'Nome:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('nome', $vinculo->nome, ['class' => 'form-control']) }}
                        @if ($errors->has('nome'))
                            <span class="help-block">
                                <strong>{{$errors->first('nome')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!} 
            </div>  
                <a href="{{route('vinculo.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
        </div>
    </div>        
</div>
@endsection