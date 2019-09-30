@extends('layouts.app')
@section('title','Mercados')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i> Mercados</li>
					  </ol>
					</nav>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<!-- Buscador -->
						</div>
						<div class="col-xs-12 col-md-4">
							<!-- Button New -->
							<a href="{{route('markets.create')}}" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</a>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Mercado</th>
									<th>Portada</th>
									<th>Acción</th>
								</thead>
								<tbody>
									@foreach($markets as $market)
									<tr>
										<td>{{$market->id}}</td>
										<td>{{$market->name}}</td>
										<td> <a href="#" onclick="showImageModal('{{asset(''.$market->url_image)}}','{{$market->name}}');" class="btn btn-link">Ver imagen</a>
										</td>
										<td>
											<a class="btn btn-blue btn-sm" href="{{route('markets.edit',$market->id)}}"><i class="fa fa-pen"></i> Editar</a>
											<a class="btn btn-danger btn-sm" href="{{route('markets.destroy',$market->id)}}" onclick="return confirm('¡Advertencia!\n¿Seguro de eliminar el registro?');"><i class="fa fa-trash"></i> Eliminar</a>

										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection