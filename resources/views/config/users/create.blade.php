@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('users.index')}}">Usuários do Sistema</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('users.store'), 'class' => 'form-horizontal']) !!}
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    {{ Form::label('name', 'Nome:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('name', '', ['class' => 'form-control']) }}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{$errors->first('name')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    {{ Form::label('email', 'E-mail:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::email('email', '', ['class' => 'form-control']) }}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{$errors->first('email')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>
                <div class="form-group ">
                {{ Form::label('acesso', 'Acesso:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                    {{ Form::checkbox('acesso', 'S', null) }}
                    </div>    
                </div>
                <div class="form-group  {{ $errors->has('perfil_id') ? ' has-error' : '' }}">
                {{ Form::label('perfil_id', 'Perfil:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                    {!! Form::select('perfil_id', $perfils, null, ['placeholder' => 'Escolha um perfil...', 'class' => 'form-control']) !!}
                    @if ($errors->has('perfil_id'))
                        <span class="help-block">
                            <strong>{{$errors->first('perfil_id')}}</strong>
                        </span>
                    @endif
                    </div>    
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    {{ Form::label('password', 'Senha:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::password('password', ['class' => 'form-control']) }}
                         @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{$errors->first('password')}}</strong>
                        </span>
                        @endif
                    </div>   
                </div>
                <div class="form-group ">
                    {{ Form::label('password_confirmation', 'Confirme a senha:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                    </div>    
                </div>  
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {{ Form::submit('Incluir', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}  

            </div>
            <a href="{{route('users.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>  
        </div>
    </div>
</div>
@endsection