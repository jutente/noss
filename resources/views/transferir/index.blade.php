@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
	        @if(Session::has('deleted_servidor')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('deleted_servidor') }}
	        </div>
	        @endif
	        @if(Session::has('create_servidor')) 
	        <div class="alert alert-info">
				<a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('create_servidor') }}
	        </div>
	        @endif
	        <div class="panel panel-default">
	            <div class="panel-heading">
					<div class="row">
					  <div class="col-sm-4">
					  	servidors de Saúde
					  </div>
					  <div class="col-sm-8 text-right">
					  	<div class="btn-group btn-group-xs">					  		
					  		<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter"><span class="glyphicon glyphicon-filter"></span> Filtro</a>
					  		<div class="btn-group">
								<button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opçoes
							 	<span class="caret"></span></button>
							 	<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="{{route('servidor.create')}}">Novo Registro</a></li>
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
	                        <th>Servidor</th>
	                        <th>Matricula</th>
	                        <th>Telefone</th>
							<th>Cargo</th>
							<th>Setor</th>							
	                        <th></th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($servidors as $servidor)
	                    <tr>
	                        <td>{{$servidor->servidor}}</td>
	                        <td>{{$servidor->matricula}}</td>
	                        <td>{{$servidor->tel}}</td>
	                        
							<td>{{$servidor->cargo->cargo}}</td>
								                        
							<td>{{$servidor->setor->setor}}</td>
							
	                        <td style="text-align: right">
	                            <a href="{{route('servidor.edit', $servidor->idservidor)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-pencil"></span>Alterar</a>
	                        
	                            <a href="{{route('servidor.show', $servidor->idservidor)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span>Excluir</a>
	                        </td>
	                    </tr>    
	                    @endforeach                                                 
	                    </tbody>
	                </table>                          
	            </div>
	            <div class="container-fluid">
	            	{{ $servidors->links() }}
	            </div>
	            <div class="panel-footer">
	            	Página {{ $servidors->currentPage() }} de {{ $servidors->lastPage() }}. Total de registros: {{ $servidors->total() }}.
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
                        {!! Form::open(['method'=>'GET','url'=>route('servidor.index')])  !!}
                        <br>                         
                        <div class="form-group">
                            {{ Form::label('servidor', 'Servidor:') }}
                            {{ Form::text('servidor', '', ['class' => 'form-control', 'placeholder' => 'Nome do servidor...']) }}   
                        </div>
                        <div class="form-group">
                            {{ Form::label('idcargo', 'Cargo:') }}
                            {!! Form::select('idcargo', $cargos, null, ['placeholder' => 'Escolha um cargo...', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Buscar', ['class' => 'btn btn-default btn-sm']) }}
                            <a href="{{ route('servidor.index') }}" class="btn btn-default btn-sm" role="button">Limpar</a>
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
        window.open("{{ route('servidor.index') }}" + "?perpage=" + perPage,"_self");
    });

    $('#btnExportar').on('click', function(){
    	var filtro_descricao = $('input[name="descricao"]').val();
        var filtro_unidade_id = $('select[name="unidade_id"]').val(); 

        if (filtro_unidade_id == null) { 
            filtro_unidade_id = ''; 
        }
        window.open("{{ route('servidor.export') }}" + "?descricao=" + filtro_descricao + "&unidade_id=" + filtro_unidade_id,"_self");
    });
}); 
</script>

@endsection
