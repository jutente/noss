@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('edited_destino'))
                    <div class="alert alert-info">
                        <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                        <strong>Info!</strong> {{ session('edited_destino') }}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{route('destino.index')}}">Destinos</a> - Alterar</div>
                    <br>

                    {!! Form::open(['method' => 'post', 'url' => route('destino.update', $destino->iddestino), 'class' => 'form-horizontal']) !!}

                    {{ Form::hidden('_method', 'PUT') }}
            
            
            <!-- Selecionar cargo -->
            <div class="form-group  {{ $errors->has('idservidor') ? ' has-error' : '' }}">
            {{ Form::label('idservidor', 'Servidor:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                {!! Form::select('idservidor', $servidors, $destino->idservidor, ['class' => 'form-control']) !!}
                @if ($errors->has('idservidor'))
                    <span class="help-block">
                        <strong>{{$errors->first('idservidor')}}</strong>
                    </span>
                @endif
                </div>    
            </div>

            <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
                    {{ Form::label('setor', 'Setor:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('setor', $destino->setor, ['class' => 'form-control text-uppercase']) }}
                        @if ($errors->has('setor'))
                            <span class="help-block">
                                <strong>{{$errors->first('setor')}}</strong>
                            </span>
                        @endif
                    </div>    
            </div>

            <!--  Protocolo -->
            <div class="form-group {{ $errors->has('protocolo') ? ' has-error' : '' }}">
                {{ Form::label('protocolo', 'Protocolo:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                    {{ Form::text('protocolo', $destino->protocolo, ['class' => 'form-control text-uppercase']) }}
                    @if ($errors->has('protocolo'))
                        <span class="help-block">
                            <strong>{{$errors->first('protocolo')}}</strong>
                        </span>
                    @endif
                </div>    
            </div>

            <!-- Data do Protocolo -->
            <div class="form-group {{ $errors->has('dtcadastro') ? ' has-error' : '' }}">
                {{ Form::label('dtcadastro', 'Data do Protocolo:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                    {{ Form::date('dtcadastro',$destino->dtcadastro, ['class' => 'form-control']) }}
                    @if ($errors->has('dtcadastro'))
                        <span class="help-block">
                            <strong>{{$errors->first('dtcadastro')}}</strong>
                        </span>
                    @endif
                </div>    
            </div>

            <!-- Selecionar setor -->
            <!-- <div class="form-group  {{ $errors->has('idsetor') ? ' has-error' : '' }}">
            {{ Form::label('idsetor', 'Setores:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                {!! Form::select('idsetor', $setors, $destino->idsetor, ['class' => 'form-control']) !!}
                @if ($errors->has('idsetor'))
                    <span class="help-block">
                        <strong>{{$errors->first('idsetor')}}</strong>
                    </span>
                @endif
                </div>    
            </div> -->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <a href="{{route('destino.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
            </div>
        </div>
    </div>
@endsection