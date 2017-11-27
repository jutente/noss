@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        @if(Session::has('password_altered')) 
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
            <strong>Info!</strong> {{ session('password_altered') }}
        </div>
        @endif
        @if(Session::has('password_wrong')) 
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
            <strong>Atenção!</strong> {{ session('password_wrong') }}
        </div>
        @endif
            <div class="panel panel-default">
                <div class="panel-heading">Alteração de Senha
                </div>
                <br>

                {!! Form::open(['method' => 'put', 'url' => route('config.users.password.update'), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('_method', 'PUT') }}

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                	{{ Form::label('password', 'Senha Atual', ['class' => 'col-md-4 control-label']) }}
                	<div class="col-md-6">
                		{{ Form::password('password', ['class' => 'form-control']) }}
                		@if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{$errors->first('password')}}</strong>
                            </span>
                    	@endif
                	</div>               	
                </div>

				<div class="form-group {{ $errors->has('newpassword') ? ' has-error' : '' }}">
                	{{ Form::label('newpassword', 'Nova Senha', ['class' => 'col-md-4 control-label']) }}
                	<div class="col-md-6">
                		{{ Form::password('newpassword', ['class' => 'form-control']) }}
                		@if ($errors->has('newpassword'))
                            <span class="help-block">
                                <strong>{{$errors->first('newpassword')}}</strong>
                            </span>
                        @endif
                	</div>
                </div>  

                <div class="form-group">
                	{{ Form::label('newpassword_confirmation', 'Confirmar a Senha', ['class' => 'col-md-4 control-label']) }}
                	<div class="col-md-6">
                		{{ Form::password('newpassword_confirmation', ['class' => 'form-control']) }}
                	</div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {{ Form::submit('Alterar senha?', ['class' => 'btn btn-warning']) }}
                    </div>
                </div>              

                {!! Form::close() !!}
            </div>
            <a href="{{route('home')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>  
        </div>
    </div>
</div>
@endsection