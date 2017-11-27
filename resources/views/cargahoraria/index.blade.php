@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
       
	        {{-- avisa se um usuario foi excluido --}}
	        @if(Session::has('deleted_cargahoraria')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('deleted_cargahoraria') }}
	        </div>
	        @endif
	        {{-- avisa quando um usuário foi modificado --}}
	        @if(Session::has('create_cargahoraria')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('create_cargahoraria') }}
	        </div>
	        @endif
	        <div class="panel panel-default">
	            <div class="panel-heading">
					<div class="row">
					  <div class="col-sm-4">
					  	Carga Horárias
					  </div>
					  <div class="col-sm-8 text-right">
					  	<div class="btn-group btn-group-xs">					  		
					  		<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter"><span class="glyphicon glyphicon-filter"></span> Filtro</a>
					  		<div class="btn-group">
								<button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opçoes
							 	<span class="caret"></span></button>
							 	<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="{{route('cargahoraria.create')}}">Novo Registro</a></li>
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
	                        <th>Nome</th>
	                        <th></th>
	                    </tr>
	                    </thead>

	                    <tbody>
	                    @foreach($cargaHorarias as $cargahoraria)
	                    <tr>
	                        <td>{{$cargahoraria->nome}}</td>

	                        <td style="text-align: right">
	                            <a href="{{route('cargahoraria.edit', $cargahoraria->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-pencil"></span>Alterar</a>
	                        
	                            <a href="{{route('cargahoraria.show', $cargahoraria->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span>Excluir</a>
	                        </td>
	                    </tr>    
	                    @endforeach                                                 
	                    </tbody>
	                </table>                          
	            </div>

	            <div class="container-fluid">
	            	{{ $cargaHorarias->links() }}
	            </div>

	            <div class="panel-footer">
	            	Página {{ $cargaHorarias->currentPage() }} de {{ $cargaHorarias->lastPage() }}. Total de registros: {{ $cargaHorarias->total() }}.
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
        window.open("{{ route('cargahoraria.index') }}" + "?perpage=" + perPage,"_self");
    });

    $('#btnExportar').on('click', function(){
        window.open("{{ route('cargahoraria.export') }}","_self");
    });
}); 
</script>

@endsection
