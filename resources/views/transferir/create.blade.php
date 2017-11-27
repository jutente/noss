@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('servidor.index')}}">Servidores</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('servidor.store'), 'class' => 'form-horizontal']) !!}
                
                <!-- servidor --> 
                <div class="form-group {{ $errors->has('servidor') ? ' has-error' : '' }}">
                    {{ Form::label('servidor', 'Servidor:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('servidor', '', ['class' => 'form-control text-uppercase']) }}
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
                        {{ Form::number('matricula', '', ['class' => 'form-control', 'max'=>'999999']) }}
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
                        {{ Form::tel('tel', '', ['class' => 'form-control','maxlength'=>'11']) }}
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
                    {!! Form::select('idcargo', $cargos, null, ['placeholder' => 'Escolha um cargo...', 'class' => 'form-control']) !!}
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
                    {!! Form::select('idsetor', $setors, null, ['placeholder' => 'Escolha um setor...', 'class' => 'form-control']) !!}
                    @if ($errors->has('idsetor'))
                        <span class="help-block">
                            <strong>{{$errors->first('idsetor')}}</strong>
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
            <a href="{{route('servidor.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>  
        </div>
    </div>
</div>
@endsection