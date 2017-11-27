@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('licencatipo.index')}}">Tipos de Licenças</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('licencatipo.store'), 'class' => 'form-horizontal']) !!}
                <div class="form-group {{ $errors->has('descricao') ? ' has-error' : '' }}">
                    {{ Form::label('descricao', 'Descrição:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('descricao', '', ['class' => 'form-control']) }}
                        @if ($errors->has('descricao'))
                            <span class="help-block">
                                <strong>{{$errors->first('descricao')}}</strong>
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
            <a href="{{route('licencatipo.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>  
        </div>
    </div>
</div>
@endsection