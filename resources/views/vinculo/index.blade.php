@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
       
	        {{-- avisa se um usuario foi excluido --}}
	        @if(Session::has('deleted_vinculo')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('deleted_vinculo') }}
	        </div>
	        @endif
	        {{-- avisa quando um usuário foi modificado --}}
	        @if(Session::has('create_vinculo')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('create_vinculo') }}
	        </div>
	        @endif
	        <div class="panel panel-default">
	            <div class="panel-heading">
					<div class="row">
					  <div class="col-sm-4">
					  	Vínculos
					  </div>
					  <div class="col-sm-8 text-right">
					  	<div class="btn-group btn-group-xs">					  		
					  		<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter"><span class="glyphicon glyphicon-filter"></span> Filtro</a>
					  		<div class="btn-group">
								<button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opçoes
							 	<span class="caret"></span></button>
							 	<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="{{route('vinculo.create')}}">Novo Registro</a></li>
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
	                    @foreach($vinculos as $vinculo)
	                    <tr>
	                        <td>{{$vinculo->nome}}</td>

	                        <td style="text-align: right">
	                            <a href="{{route('vinculo.edit', $vinculo->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-pencil"></span>Alterar</a>
	                        
	                            <a href="{{route('vinculo.show', $vinculo->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span>Excluir</a>
	                        </td>
	                    </tr>    
	                    @endforeach                                                 
	                    </tbody>
	                </table>                          
	            </div>

	            <div class="container-fluid">
	            	{{ $vinculos->links() }}
	            </div>

	            <div class="panel-footer">
	            	Página {{ $vinculos->currentPage() }} de {{ $vinculos->lastPage() }}. Total de registros: {{ $vinculos->total() }}.
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
        window.open("{{ route('vinculo.index') }}" + "?perpage=" + perPage,"_self");
    });

    $('#btnExportar').on('click', function(){
        window.open("{{ route('vinculo.export') }}","_self");
    });
}); 
</script>

@endsection
