@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('edited_setor')) 
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                <strong>Info!</strong> {{ session('edited_setor') }}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('setor.index')}}">setor</a> - Alterar</div>
                <br>

                {!! Form::open(['method' => 'post', 'url' => route('setor.update', $setor->idsetor), 'class' => 'form-horizontal']) !!}

                {{ Form::hidden('_method', 'PUT') }}

                <div class="form-group {{ $errors->has('setor') ? ' has-error' : '' }}">
                    {{ Form::label('setor', 'Setor:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('setor', $setor->setor, ['class' => 'form-control']) }}
                        @if ($errors->has('setor'))
                            <span class="help-block">
                                <strong>{{$errors->first('setor')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div>

                <div class="form-group {{ $errors->has('centrocusto') ? ' has-error' : '' }}">
                    {{ Form::label('centrocusto', 'Centro de Custo:', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('centrocusto', $setor->centrocusto, ['class' => 'form-control']) }}
                        @if ($errors->has('centrocusto'))
                            <span class="help-block">
                            <strong>{{$errors->first('centrocusto')}}</strong>
                            </span>
                        @endif
                    </div>    
                </div

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!} 
            </div>  
                <a href="{{route('setor.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
        </div>
    </div>        
</div>
@endsection