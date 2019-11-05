@extends('layouts.app')
@section('title','Administración de Certificados por Perfil')
@section('content')
<div class="container">
	@if(session('message'))
	<div class="alert alert-success" role="alert">
	    <span> {{session('message')}} </span>
	</div>
	@endif
</div>

<div class="row mt-3">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				Certificaciones permitidas para <strong>{{$product->name}}</strong>
				<a href="{{route('products.index')}}" class="btn btn-orange btn-sm float-right"><i class="fa fa-arrow-left"></i> Regresar</a>
			</div>
			<div class="card-body">
				<form action="{{route('products.isos.store', $product->id)}}" method="POST">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="row">
						<div class="col-12 col-md-8">
							<div class="input-group">
								<select name="iso" id="iso" class="form-control">
									@foreach($isos as $index => $iso)
										<option value="{{$iso->id}}"> {{$iso->name}} </option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<button type="submit" class="btn btn-blue"><i class="fa fa-save"></i> Agregar </button>
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
									<th>Certificado</th>
									<th>Acción</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection