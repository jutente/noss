@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{route('cargo.index')}}">Cargos</a> - Novo Registro</div>
                <br>
                {!! Form::open(['method' => 'post', 'url' => route('cargo.store'), 'class' => 'form-horizontal']) !!}
                <div class="form-group {{ $errors->has('cargo') ? ' has-error' : '' }}">
                    {{ Form::label('cargo', 'Cargo:', ['class' => 'col-md-4 control-label']) }}
                    
                        <div class="col-md-6">
                        
                            {{ Form::text('cargo', '', ['class' => 'form-control text-uppercase']) }}
                        
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
                        {{ Form::text('cbo', '', ['class' => 'form-control']) }}
                        @if ($errors->has('cbo'))
                            <span class="help-block">
                                <strong>{{$errors->first('cbo')}}</strong>
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
            <a href="{{route('cargo.index')}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Voltar</a>  
        </div>
    </div>
</div>
@endsection