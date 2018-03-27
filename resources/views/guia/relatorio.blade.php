@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
	        @if(Session::has('deleted_guia')) 
	        <div class="alert alert-info">
	            <a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('deleted_guia') }}
	        </div>
	        @endif
	        @if(Session::has('create_guia')) 
	        <div class="alert alert-info">
				<a href="#" class="close" data-dismiss="alert" aria-label="Fechar">&times;</a>
	            <strong>Info!</strong> {{ session('create_guia') }}
	        </div>
	        @endif
	        <div class="panel panel-default">
	            <div class="panel-heading">
					<div class="row">
					  <div class="col-sm-4">
					  	guias de Saúde
					  </div>
					  <div class="col-sm-8 text-right">
					  	<div class="btn-group btn-group-xs">					  		
					  		<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFilter"><span class="glyphicon glyphicon-filter"></span> Filtro</a>
					  		<div class="btn-group">
								<button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Opçoes
							 	<span class="caret"></span></button>
							 	<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#}">Novo Registro</a></li>
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
	                        <th>Matricula</th>
	                        <th>Servidor</th>
							<th>Setor origem</th>
                            <th>Setor destino</th>			
                            <th>Data</th>		
	                        <th></th>
	                    </tr>
	                    </thead>
	                    <tbody>
                        
	                    @foreach($guias as $guia)
	                    <tr>
                            <td>{{$guia->servidor->matricula}}</td>
	                        <td>{{$guia->servidor->servidor}}</td>  								                        
                            <td>{{$guia->setor->setor}}</td>
                            <td>{{$guia->setordestino->setor}}</td>
                            <td>{{\Carbon\Carbon::parse($guia->dtmudanca)->format('d/m/Y')}}</td>
							
	                        <td style="text-align: right">
	                            <a href="{{route('relsetor', $guia->id)}}" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-pencil"></span>Gerar guia</a>	                        
	                        </td>
	                    </tr>    
	                    @endforeach                                                 
	                    </tbody>
	                </table>                          
	            </div>
	            <div class="container-fluid">
                        {{$guias->links()}}
	            </div>
	            <div class="panel-footer">
	            
	            </div>
	        </div>    
    	</div>
    </div>
</div>


@endsection
