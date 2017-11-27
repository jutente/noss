@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('cargahoraria.index')}}">Carga Horárias</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('cargahoraria.store'), 'class' => 'form-horizontal']) !!}
                <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
                    {{ Form::label('nome', 'Nome:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('nome', '', ['class' => 'form-control']) }}
                        @if ($errors->has('nome'))
                            <span class="help-block">
                                <strong>{{$errors->first('nome')}}</strong>
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
            <a href="{{route('cargahoraria.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>  
        </div>
    </div>
</div>
@endsection