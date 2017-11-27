@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
	        @if(Session::has('deleted_unidade')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('deleted_unidade') }}
	        </div>
	        @endif
	        @if(Session::has('create_unidade')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('create_unidade') }}
	        </div>
	        @endif
	        <div class="panel panel-default">
	            <div class="panel-heading">
					<div class="row">
					  <div class="col-sm-4">
					  	Unidades de Saúde
					  </div>
					  <div class="col-sm-8 text-right">
					  	<div class="btn-group btn-group-xs">					  		
					  		<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter"><span class="glyphicon glyphicon-filter"></span> Filtro</a>
					  		<div class="btn-group">
								<button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opçoes
							 	<span class="caret"></span></button>
							 	<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="{{route('unidade.create')}}">Novo Registro</a></li>
									<li><a href="#" id="btnExportar">Exportar</a></li>
							  </ul>
							</div>
					  	</div>					  	
					  </div>
					</div>
				</div>	
				<br>
	            <div class="table-responsive">
	                <table class="table table-striped">
	                    <thead>
	                    <tr>
	                        <th>Descrição</th>
	                        <th>Porte</th>
	                        <th>Tel(1)</th>
	                        <th>Tel(2)</th>
	                        <th>Distrito</th>
	                        <th></th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($unidades as $unidade)
	                    <tr>
	                        <td>{{$unidade->descricao}}</td>
	                        <td>{{$unidade->porte}}</td>
	                        <td>{{$unidade->tel1}}</td>
	                        <td>{{$unidade->tel2}}</td>
	                        <td>{{$unidade->distrito->nome}}</td>
	                        <td style="text-align: right">
	                            <a href="{{route('unidade.edit', $unidade->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-pencil"></span>Alterar</a>
	                        
	                            <a href="{{route('unidade.show', $unidade->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span>Excluir</a>
	                        </td>
	                    </tr>    
	                    @endforeach                                                 
	                    </tbody>
	                </table>                          
	            </div>
	            <div class="container-fluid">
	            	{{ $unidades->links() }}
	            </div>
	            <div class="panel-footer">
	            	Página {{ $unidades->currentPage() }} de {{ $unidades->lastPage() }}. Total de registros: {{ $unidades->total() }}.
	            </div>
	        </div>    
    	</div>
    </div>
</div>

<div id="modalFilter" class="modal fade" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Filtro</h4>
	      	</div>
	      	<div class="modal-body style="padding:40px 50px;"">
	      		<div class="container-fluid">
                    <div class="row">                                         
                        {!! Form::open(['method'=>'GET','url'=>route('unidade.index')])  !!}
                        <br>                         
                        <div class="form-group">
                            {{ Form::label('descricao', 'Nome:') }}
                            {{ Form::text('descricao', '', ['class' => 'form-control', 'placeholder' => 'Nome da unidade...']) }}   
                        </div>
                        <div class="form-group">
                            {{ Form::label('distrito_id', 'Distritos:') }}
                            {!! Form::select('distrito_id', $distritos, null, ['placeholder' => 'Escolha um distrito...', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Buscar', ['class' => 'btn btn-default btn-sm']) }}
                            <a href="{{ route('unidade.index') }}" class="btn btn-default btn-sm" role="button">Limpar</a>
                        </div>
                        {!! Form::close() !!} 
                    </div>            
                </div>
	        	<div class="form-group">
	        		{!! Form::select('perPage', $perPages, session('perPage'), ['id' => 'perPage', 'class'  => 'form-control']) !!}
	    		</div>
	      	</div>
	    	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	    	</div>
		</div>
	</div>
</div>

@endsection

@section('script-footer')
<script>
$(document).ready(function(){
    $('#perPage').on('change', function() {
        perPage = $(this).find(":selected").val();         
        window.open("{{ route('unidade.index') }}" + "?perpage=" + perPage,"_self");
    });

    $('#btnExportar').on('click', function(){
    	var filtro_descricao = $('input[name="descricao"]').val();
        var filtro_pedistrito_id = $('select[name="distrito_id"]').val(); 

        if (filtro_pedistrito_id == null) { 
            filtro_pedistrito_id = ''; 
        }
        window.open("{{ route('unidade.export') }}" + "?descricao=" + filtro_descricao + "&distrito_id=" + filtro_pedistrito_id,"_self");
    });
}); 
</script>

@endsection
