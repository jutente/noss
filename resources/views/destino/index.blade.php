@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
	        @if(Session::has('deleted_destino')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('deleted_destino') }}
	        </div>
	        @endif
	        @if(Session::has('create_destino')) 
	        <div class="alert alert-info">
				<a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('create_destino') }}
	        </div>
	        @endif
	        <div class="panel panel-default">
	            <div class="panel-heading">
					<div class="row">
					  <div class="col-sm-4">
					  	destinos de Saúde
					  </div>
					  <div class="col-sm-8 text-right">
					  	<div class="btn-group btn-group-xs">					  		
					  		<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter"><span class="glyphicon glyphicon-filter"></span> Filtro</a>
					  		<div class="btn-group">
								<button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opçoes
							 	<span class="caret"></span></button>
							 	<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="{{route('destino.create')}}">Novo Registro</a></li>
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
							<th>Setor de Origem</th>                 
							<th>Setor Desejado</th>							
							<th>Data Cadastro</th>
	                        <th></th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($destinos as $destino)
	                    <tr>
	                        <td>{{$destino->servidor->servidor}}</td>	                        
							<td>{{$destino->servidor->setor->setor}}</td>
							<td>{{$destino->setor->setor}}</td>

							@if (isset($destino->dtcadastro))
 								<td>{{\Carbon\Carbon::parse($destino->dtcadastro)->format('d/m/Y')}}</td>
							@else                      		
							<td></td>
							@endif
	                        
							<td style="text-align: right">
								<a href="{{route('transferir.edit', ['servidor' => $destino->servidor->idservidor, 'setor' => $destino->setor])}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-refresh"></span>Transferir</a>

	                            <a href="{{route('destino.edit', $destino->iddestino)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-pencil"></span>Alterar</a>
	                        
	                            <a href="{{route('destino.show', $destino->iddestino)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span>Excluir</a>
	                        </td>
	                    </tr>    
	                    @endforeach                                                 
	                    </tbody>
	                </table>                          
	            </div>
	            <div class="container-fluid">
	            	{{ $destinos->links() }}
	            </div>
	            <div class="panel-footer">
	            	Página {{ $destinos->currentPage() }} de {{ $destinos->lastPage() }}. Total de registros: {{ $destinos->total() }}.
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
                        {!! Form::open(['method'=>'GET','url'=>route('destino.index')])  !!}
                        <br>                         
                        <div class="form-group">
                            {{ Form::label('servidor', 'Servidor:') }}
                            {{ Form::text('servidor', '', ['class' => 'form-control', 'placeholder' => 'Nome do servidor...']) }}   
                        </div>
						<div class="form-group">
                            {{ Form::label('setor', 'Setor:') }}
                            {{ Form::text('setor', '', ['class' => 'form-control', 'placeholder' => 'Nome do setor ...']) }}   
                        </div>
                        <!-- <div class="form-group">
                            {{ Form::label('idsetor', 'Setor:') }}
                            {!! Form::select('idsetor', $setors, null, ['placeholder' => 'Escolha um setor...', 'class' => 'form-control']) !!}
                        </div> -->
                        <div class="form-group">
                            {{ Form::submit('Buscar', ['class' => 'btn btn-default btn-sm']) }}
                            <a href="{{ route('destino.index') }}" class="btn btn-default btn-sm" role="button">Limpar</a>
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
        window.open("{{ route('destino.index') }}" + "?perpage=" + perPage,"_self");
    });

    $('#btnExportar').on('click', function(){
    	var filtro_servidor = $('input[name="servidor"]').val();
        var filtro_setor = $('input[name="setor"]').val(); 

        if (filtro_setor == null) { 
            filtro_setor = ''; 
        }
        window.open("{{ route('destino.export') }}" + "?servidor=" + filtro_descricao + "&setor=" + filtro_setor,"_self");
    });
}); 
</script>

@endsection
