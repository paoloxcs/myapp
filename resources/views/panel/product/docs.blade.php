@extends('layouts.app')
@section('title','Gestión de documentos por Perfil')
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
					Documentos para <strong>{{$product->name}}</strong>
					<a href="{{route('products.index')}}" class="btn btn-orange btn-sm float-right"><i class="fa fa-arrow-left"></i> Regresar</a>
				</div>
				<div class="card-body">
					<form action="{{route('products.docs.store', $product->id)}}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="row">
						<section class="col-12 col-md-5">
							<div class="form-group">
								<input type="text" name="name" class="form-control" placeholder="Nombre del Documento">
							</div>
						</section>
						<section class="col-12 col-md-5">
							<div class="form-group">
								<input data-validate="true" type="file" name="ruta" accept="pdf/*">
							</div>
						</section>
						<section class="col-12 col-md-2">

							<button type="submit" class="btn btn-orange btn-block"><i class="fa fa-save"></i> Agregar </button>
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
										<th>Documento</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									
										@foreach($product->docs as $index => $doc)
										<tr>
										<td>{{$doc->id}}</td>
										<td>{{$doc->name}}</td>
										<td>{{$doc->url_doc}}</td>
										<td><a href="{{route('docs.destroy', $doc->id)}}" onclick="return confirm('¿Seguro de eliminar el registro?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>
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