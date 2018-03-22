@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('edited_servidor'))
                    <div class="alert alert-info">
                        <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                        <strong>Info!</strong> {{ session('edited_servidor') }}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{route('servidor.index')}}">Servidores</a> - Alterar</div>
                    <br>

                    {!! Form::open(['method' => 'post', 'url' => route('servidor.update', $servidor->idservidor), 'class' => 'form-horizontal']) !!}

                    {{ Form::hidden('_method', 'PUT') }}

                    <!-- servidor --> 
                <div class="form-group {{ $errors->has('servidor') ? ' has-error' : '' }}">
                {{ Form::label('servidor', 'Servidor:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                    {{ Form::text('servidor', $servidor->servidor, ['class' => 'form-control text-uppercase']) }}
                    @if ($errors->has('servidor'))
                        <span class="help-block">
                            <strong>{{$errors->first('servidor')}}</strong>
                        </span>
                    @endif
                </div> 
            </div>
              
              <!-- matricula -->
              <div class="form-group {{ $errors->has('matricula') ? ' has-error' : '' }}">   
                {{ Form::label('matricula', 'Matricula:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                    {{ Form::text('matricula', $servidor->matricula, ['class' => 'form-control']) }}
                    @if ($errors->has('matricula'))
                        <span class="help-block">
                            <strong>{{$errors->first('matricula')}}</strong>
                        </span>
                    @endif
                </div>       
            </div>

            <!--  telefone -->
            <div class="form-group {{ $errors->has('tel') ? ' has-error' : '' }}">
                {{ Form::label('tel', 'Telefone:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                    {{ Form::text('tel', $servidor->tel, ['class' => 'form-control']) }}
                    @if ($errors->has('tel'))
                        <span class="help-block">
                            <strong>{{$errors->first('tel')}}</strong>
                        </span>
                    @endif
                </div>    
            </div>

                        
            <!-- Selecionar cargo -->
            <div class="form-group  {{ $errors->has('idcargo') ? ' has-error' : '' }}">
            {{ Form::label('idcargo', 'Cargos:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                {!! Form::select('idcargo', $cargos, $servidor->idcargo, ['class' => 'form-control']) !!}
                @if ($errors->has('idcargo'))
                    <span class="help-block">
                        <strong>{{$errors->first('idcargo')}}</strong>
                    </span>
                @endif
                </div>    
            </div>

            <!-- Selecionar setor -->
            <div class="form-group  {{ $errors->has('idsetor') ? ' has-error' : '' }}">
            {{ Form::label('idsetor', 'Setores:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                {!! Form::select('idsetor', $setors, $servidor->idsetor, ['class' => 'form-control']) !!}
                @if ($errors->has('idsetor'))
                    <span class="help-block">
                        <strong>{{$errors->first('idsetor')}}</strong>
                    </span>
                @endif
                </div>    
            </div>

            <!-- Jornada semanal -->
            <div class="form-group {{ $errors->has('jornada') ? ' has-error' : '' }}">
                {{ Form::label('jornada', 'Jornada semanal:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                    {{ Form::text('jornada', $servidor->jornada, ['class' => 'form-control text-uppercase']) }}
                    @if ($errors->has('jornada'))
                        <span class="help-block">
                            <strong>{{$errors->first('jornada')}}</strong>
                        </span>
                    @endif
                </div> 
            </div>

            <!-- situacao -->
            <div class="form-group {{ $errors->has('situacao') ? ' has-error' : '' }}">
                {{ Form::label('situacao', 'Situacao:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                    {{ Form::text('situacao', $servidor->situacao, ['class' => 'form-control text-uppercase']) }}
                    @if ($errors->has('situacao'))
                        <span class="help-block">
                            <strong>{{$errors->first('situacao')}}</strong>
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
                <a href="{{route('servidor.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
            </div>
        </div>
    </div>
@endsection