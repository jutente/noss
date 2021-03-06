@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">


            <div class="col-md-12">
                <div class="alert alert-danger text-center">
                    <strong>Atençao!</strong> Transferir do setor {{$servidor->setor->setor}} para o setor {{$destinosetor->setor}}
                </div>

                @if(Session::has('edited_servidor'))
                    <div class="alert alert-info">
                        <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                        <strong>Info!</strong> {{ session('edited_servidor') }}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{route('servidor.index')}}">Servidores</a> - Alterar</div>
                    <br>

                    {!! Form::open(['method' => 'post', 'url' => route('transferir.update', $servidor->idservidor), 'class' => 'form-horizontal']) !!}

                    {{ Form::hidden('_method', 'PUT') }}

                    <!-- servidor --> 
                <div class="form-group {{ $errors->has('servidor') ? ' has-error' : '' }}">
                {{ Form::label('servidor', 'Servidor:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                    {{ Form::text('servidor', $servidor->servidor, ['class' => 'form-control text-uppercase','readonly']) }}
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
                    {{ Form::text('matricula', $servidor->matricula, ['class' => 'form-control','readonly']) }}
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
                    {{ Form::text('tel', $servidor->tel, ['class' => 'form-control','readonly']) }}
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
                {!! Form::text('idcargo', $servidor->cargo->cargo, ['class' => 'form-control','readonly']) !!}
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
                {!! Form::select('idsetor', $setors, $destinosetor->idsetor, ['class' => 'form-control']) !!}
                @if ($errors->has('idsetor'))
                    <span class="help-block">
                        <strong>{{$errors->first('idsetor')}}</strong>
                    </span>
                @endif
                </div>    
            </div>

            <!-- Data da mudança -->
            <div class="form-group {{ $errors->has('dtmudanca') ? ' has-error' : '' }}">
                {{ Form::label('dtmudanca', 'Data da mudança:', ['class' => 'col-md-4 control-label']) }}
                <div class="col-md-6">
                    {{ Form::date('dtmudanca', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
                    @if ($errors->has('dtmudanca'))
                        <span class="help-block">
                            <strong>{{$errors->first('dtmudanca')}}</strong>
                        </span>
                    @endif
                </div>    
            </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {{ Form::submit('Transferir', ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <a href="{{route('servidor.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
            </div>
        </div>
    </div>
@endsection