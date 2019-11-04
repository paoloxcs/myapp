@extends('layouts.app')
@section('title','Más detalles del Perfil')
@section('content')
<div class="container">
	@if(session('message'))
	<div class="alert alert-success" role="alert">
	    <span> {{session('message')}} </span>
	</div>
	@endif

	<div class="row mt-3">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Materiales disponibles para <strong>{{$product->name}}</strong>
					<a href="{{route('products.index')}}" class="btn btn-orange btn-sm float-right"><i class="fa fa-arrow-left"></i> Regresar</a>
				</div>
				<div class="card-body">
					<form action="{{route('products.materials.store', $product->id)}}" method="POST">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="row">
							<section class="col-12 col-md-4">
								<div class="form-group">
									<input type="text" name="name" class="form-control" placeholder="Nombre del Material">
								</div>
							</section>
							<section class="col-12 col-md-4">
								<div class="form-group">
									<input type="text" name="type" class="form-control" placeholder="Tipo del Material">
								</div>
							</section>
							<section class="col-12 col-md-4">
								<div class="form-group">
									<input type="text" name="colour" class="form-control" placeholder="Color del Material">
								</div>
							</section>
							<section class="col-12 col-md-10">
								<div class="form-group">
									<textarea name="options" id="options" class="form-control" rows="2">Ingrese detalles del material</textarea>
								</div>
							</section>
							<section class="col-12 col-md-2 text-center">
								<button type="submit" class="btn btn-blue"><i class="fa fa-save"></i> Agregar </button>
							</section>
						</div>
					</form>
					<div class="row mt-2">
						<div class="col-12">
							<table class="table table-striped table-bordered table-sm">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Tipo</th>
										<th>Color</th>
										<th>Detalles</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									@foreach($product->materials as $index => $material)
										<tr>
											<td>{{$material->id}}</td>
											<td>{{$material->name}}</td>
											<td>{{$material->type}}</td>
											<td>{{$material->colour}}</td>
											<td>{{$material->options}}</td>
											<td>
												<a href="{{route('materials.destroy', $material->id)}}" onclick="return confirm('¿Seguro de eliminar el registro?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
