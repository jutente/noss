@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('setor.index')}}">Setores</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('setor.store'), 'class' => 'form-horizontal']) !!}
                <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
                    {{ Form::label('setor', 'Setor:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('setor', '', ['class' => 'form-control']) }}
                        @if ($errors->has('setor'))
                            <span class="help-block">
                                <strong>{{$errors->first('setor')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>

                <div class="form-group {{ $errors->has('centrocusto') ? ' has-error' : '' }}">
                    {{ Form::label('centrocusto', 'Centro de Custo:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('centrocusto', '', ['class' => 'form-control']) }}
                        @if ($errors->has('centrocusto'))
                            <span class="help-block">
                                <strong>{{$errors->first('centrocusto')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>
 
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {{ Form::submit('Incluir', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}  

            </div>
            <a href="{{route('setor.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>  
        </div>
    </div>
</div>
@endsection