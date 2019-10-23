@extends('layouts.app')
@section('title','Gestionar partes del Producto')
@section('content')
<div class="container">
	@if(session('message'))
	<div class="alert alert-success" role="alert">
	    <span> {{session('message')}} </span>
	</div>
	@endif

	<div class="row-mt-3">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Partes</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-8">	{{-- Buscador --}} </div>
						<div class="col-4">	<a href="#" class="btn btn-orange"><i class="fa fa-plus"></i>Agregar Parte</a> </div>
					</div>

					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<th>Nombre</th>
									@foreach($heads as $h)
										<th>{{$h->sigla}}</th>
									@endforeach
									<th>Acciones</th>
								</thead>
							</table>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection