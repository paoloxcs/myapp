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
							<div class="col-12">
								<div class="input-group">
										<input type="text" name="name" class="form-control" placeholder="Nombre del Documento">
										<div class="input-group-append">
											<span class="input-group-text">&nbsp;</span>
										</div>
										<input data-validate="true" type="file" class="form-control" name="ruta" accept="application/pdf">
										<div class="input-group-append">
											<button type="submit" class="btn btn-blue"><i class="fa fa-save"></i> Agregar </button>
										</div>

								</div>
							</div>
						</div>
					</form>
					<hr>
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