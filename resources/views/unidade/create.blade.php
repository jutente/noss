@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('unidade.index')}}">Unidades de Saúde</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('unidade.store'), 'class' => 'form-horizontal']) !!}
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
                <div class="form-group {{ $errors->has('porte') ? ' has-error' : '' }}">
                    {{ Form::label('porte', 'Porte:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('porte', '', ['class' => 'form-control']) }}
                        @if ($errors->has('porte'))
                            <span class="help-block">
                                <strong>{{$errors->first('porte')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>
                <div class="form-group {{ $errors->has('logradouro') ? ' has-error' : '' }}">
                    {{ Form::label('logradouro', 'Logradouro:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('logradouro', '', ['class' => 'form-control']) }}
                        @if ($errors->has('logradouro'))
                            <span class="help-block">
                                <strong>{{$errors->first('logradouro')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>
                <div class="form-group {{ $errors->has('tel1') ? ' has-error' : '' }}">
                    {{ Form::label('tel1', 'Telefone(1):', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('tel1', '', ['class' => 'form-control']) }}
                        @if ($errors->has('tel1'))
                            <span class="help-block">
                                <strong>{{$errors->first('tel1')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>
                <div class="form-group {{ $errors->has('tel2') ? ' has-error' : '' }}">
                    {{ Form::label('tel2', 'Telefone(2):', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('tel2', '', ['class' => 'form-control']) }}
                        @if ($errors->has('tel2'))
                            <span class="help-block">
                                <strong>{{$errors->first('tel2')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>
                <div class="form-group  {{ $errors->has('distrito_id') ? ' has-error' : '' }}">
                {{ Form::label('distrito_id', 'Distrito:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                    {!! Form::select('distrito_id', $distritos, null, ['placeholder' => 'Escolha um distrito...', 'class' => 'form-control']) !!}
                    @if ($errors->has('distrito_id'))
                        <span class="help-block">
                            <strong>{{$errors->first('distrito_id')}}</strong>
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
            <a href="{{route('unidade.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>  
        </div>
    </div>
</div>
@endsection