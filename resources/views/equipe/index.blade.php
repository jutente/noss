@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
	        @if(Session::has('deleted_equipe')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('deleted_equipe') }}
	        </div>
	        @endif
	        @if(Session::has('create_equipe')) 
	        <div class="alert alert-info">
				<a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('create_equipe') }}
	        </div>
	        @endif
	        <div class="panel panel-default">
	            <div class="panel-heading">
					<div class="row">
					  <div class="col-sm-4">
					  	Equipes de Saúde
					  </div>
					  <div class="col-sm-8 text-right">
					  	<div class="btn-group btn-group-xs">					  		
					  		<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter"><span class="glyphicon glyphicon-filter"></span> Filtro</a>
					  		<div class="btn-group">
								<button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opçoes
							 	<span class="caret"></span></button>
							 	<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="{{route('equipe.create')}}">Novo Registro</a></li>
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
	                        <th>Número</th>
	                        <th>CNES</th>
	                        <th>INE</th>
	                        <th>Unidade</th>
	                        <th></th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($equipes as $equipe)
	                    <tr>
	                        <td>{{$equipe->descricao}}</td>
	                        <td>{{$equipe->numero}}</td>
	                        <td>{{$equipe->cnes}}</td>
	                        <td>{{$equipe->ine}}</td>
	                        <td>{{$equipe->unidade->descricao}}</td>
	                        <td style="text-align: right">
	                            <a href="{{route('equipe.edit', $equipe->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-pencil"></span>Alterar</a>
	                        
	                            <a href="{{route('equipe.show', $equipe->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span>Excluir</a>
	                        </td>
	                    </tr>    
	                    @endforeach                                                 
	                    </tbody>
	                </table>                          
	            </div>
	            <div class="container-fluid">
	            	{{ $equipes->links() }}
	            </div>
	            <div class="panel-footer">
	            	Página {{ $equipes->currentPage() }} de {{ $equipes->lastPage() }}. Total de registros: {{ $equipes->total() }}.
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
                        {!! Form::open(['method'=>'GET','url'=>route('equipe.index')])  !!}
                        <br>                         
                        <div class="form-group">
                            {{ Form::label('descricao', 'Nome:') }}
                            {{ Form::text('descricao', '', ['class' => 'form-control', 'placeholder' => 'Nome da unidade...']) }}   
                        </div>
                        <div class="form-group">
                            {{ Form::label('unidade_id', 'Unidades:') }}
                            {!! Form::select('unidade_id', $unidades, null, ['placeholder' => 'Escolha uma equipe de saúde...', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Buscar', ['class' => 'btn btn-default btn-sm']) }}
                            <a href="{{ route('equipe.index') }}" class="btn btn-default btn-sm" role="button">Limpar</a>
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
        window.open("{{ route('equipe.index') }}" + "?perpage=" + perPage,"_self");
    });

    $('#btnExportar').on('click', function(){
    	var filtro_descricao = $('input[name="descricao"]').val();
        var filtro_unidade_id = $('select[name="unidade_id"]').val(); 

        if (filtro_unidade_id == null) { 
            filtro_unidade_id = ''; 
        }
        window.open("{{ route('equipe.export') }}" + "?descricao=" + filtro_descricao + "&unidade_id=" + filtro_unidade_id,"_self");
    });
}); 
</script>

@endsection
