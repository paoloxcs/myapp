@extends('layouts.app')
@section('title','Gestion de partes del producto')
@section('content')
<div class="container">
	@if(session('message'))
    <div class="alert alert-success" role="alert">
        <span> {{session('message')}} </span>
    </div>
	@endif
	<div class="row mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Gestion de partes del producto</div>
				</div>
				<div class="card-body">
					<form action="{{route('products.parts.store', $product->id)}}" method="POST">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="row">
							<div class="form-group">
								@foreach($product->measurements as $index => $measure)
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="measurement" id="measurement{{$measure->id}}" value="{{$measure->id}}" {{$index == 0 ? 'checked' : ''}}>
										<label class="form-check-label" for="measurement{{$measure->id}}">{{$measure->name}}</label>
									</div>
								@endforeach
							</div>
							<table class="table table-striped table-bordered table-sm">
								<tbody>
									<tr>
										<td>
											<div class="form-group">
												<input class="form-control form-control-sm" type="text" name="part_nro" placeholder="N° parte" required>
											</div>
										</td>
										@foreach($product->dimensions as $dimen)
										<td>
											<div class="form-group">
												<input class="form-control form-control-sm" type="text" name="{{$dimen->slug}}" placeholder="{{$dimen->sigla}}" required>
											</div>
										</td>
										@endforeach
									</tr>
								</tbody>
							</table>
	
							<div class="form-group">
									<button type="submit" class="btn btn-orange btn-sm"><i class="fa fa-save"></i> Agregar</button>
							</div>
	
						</div>

					</form>
					<hr>
					<div class="row">
						<h6>Lista de partes ingresadas</h6>
						<table class="table table-striped table-bordered table-sm">
								<thead>
								<tr>
									<th scope="col">N° parte</th>
									@foreach ($product->dimensions as $dimen2)
										<th scope="col">{{$dimen2->sigla}}</th>
									@endforeach
									<th>U. Medida</th>
									<th width="10%" scope="col">Acción</th>
								</tr>
								</thead>
								<tbody>
									@foreach ($product->parts()->orderBy('id','DESC')->get() as $part)
										<tr>
											<td> {{$part->part_nro}} </td>
											
											@foreach (json_decode($part->dimensions) as $index => $part_dimen)
												<td> {{$part_dimen}}</td>
											@endforeach
											<td> {{$part->measurement->name}} </td>
											<td align="center">							  	
												<a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
											</td>

										</tr>
									@endforeach
									
								</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">

				</div>
			</div>
		</div>
	</div>
</div>
@endsection