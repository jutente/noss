@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('edited_equipe'))
                    <div class="alert alert-info">
                        <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
                        <strong>Info!</strong> {{ session('edited_equipe') }}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{route('equipe.index')}}">Equpes de Saúde</a> - Alterar</div>
                    <br>

                    {!! Form::open(['method' => 'post', 'url' => route('equipe.update', $equipe->id), 'class' => 'form-horizontal']) !!}

                    {{ Form::hidden('_method', 'PUT') }}

                    <div class="form-group {{ $errors->has('descricao') ? ' has-error' : '' }}">
                        {{ Form::label('descricao', 'Descrição:', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('descricao', $equipe->descricao, ['class' => 'form-control']) }}
                            @if ($errors->has('descricao'))
                                <span class="help-block">
                                <strong>{{$errors->first('descricao')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('numero') ? ' has-error' : '' }}">
                        {{ Form::label('numero', 'Número:', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::number('numero', $equipe->numero, ['class' => 'form-control']) }}
                            @if ($errors->has('numero'))
                                <span class="help-block">
                                <strong>{{$errors->first('numero')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('cnes') ? ' has-error' : '' }}">
                        {{ Form::label('cnes', 'Logradouro:', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('cnes', $equipe->cnes, ['class' => 'form-control']) }}
                            @if ($errors->has('cnes'))
                                <span class="help-block">
                                <strong>{{$errors->first('cnes')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('ine') ? ' has-error' : '' }}">
                        {{ Form::label('ine', 'Telefone(1):', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('ine', $equipe->ine, ['class' => 'form-control']) }}
                            @if ($errors->has('ine'))
                                <span class="help-block">
                                <strong>{{$errors->first('ine')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group  {{ $errors->has('unidade_id') ? ' has-error' : '' }}">
                        {{ Form::label('unidade_id', 'Unidade:', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {!! Form::select('unidade_id', $unidades, $equipe->unidade_id, ['class' => 'form-control']) !!}
                            @if ($errors->has('unidade_id'))
                                <span class="help-block">
                            <strong>{{$errors->first('unidade_id')}}</strong>
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
                <a href="{{route('equipe.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>
            </div>
        </div>
    </div>
@endsection