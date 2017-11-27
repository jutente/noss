@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('edited_cargo')) 
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                <strong>Info!</strong> {{ session('edited_cargo') }}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('cargo.index')}}">Cargo</a> - Alterar</div>
                <br>

                {!! Form::open(['method' => 'post', 'url' => route('cargo.update', $cargo->idcargo), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('_method', 'PUT') }}

                <div class="form-group {{ $errors->has('cargo') ? ' has-error' : '' }}">
                    {{ Form::label('cargo', 'cargo:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('cargo', $cargo->cargo, ['class' => 'form-control text-uppercase']) }}
                        @if ($errors->has('cargo'))
                            <span class="help-block">
                                <strong>{{$errors->first('cargo')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>

                <!--    Cbo -->
                <div class="form-group {{ $errors->has('cbo') ? ' has-error' : '' }}">   
                    {{ Form::label('cbo', 'CBO:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('cbo', $cargo->cbo, ['class' => 'form-control']) }}
                        @if ($errors->has('cbo'))
                            <span class="help-block">
                                <strong>{{$errors->first('cbo')}}</strong>
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
                <a href="{{route('cargo.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
        </div>
    </div>        
</div>
@endsection