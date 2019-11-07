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
						<div class="col-12">
							<pre>
								{{$product->isos}}
							</pre>
							<div class="form-group">
								@php $pos = 0 @endphp
								@foreach($isos as $iso)
								<div class="isos">
								@if($product->isos->contains('id',$iso->id))
								<pre>{{$pos}}</pre>
								<div class="form-check form-check-inline p-2" title="{{$iso->name}}">
								    <input type="checkbox" name="isos[]" id="inline-checkbox{{$iso->id}}" {{$product->isos[$pos]->pivot->iso_id == $iso->id ? 'checked' : ''}} class="form-check-input" value="{{$iso->id}}">
								    <label for="inline-checkbox{{$iso->id}}"  class="form-check-label">{{$iso->name}}</label>
								</div>
								@php $pos ++ @endphp
								@else
								<pre>{{$iso->id}}</pre>
									<div class="form-check form-check-inline p-2" title="{{$iso->name}}">
									    <input type="checkbox" name="isos[]" id="inline-checkbox{{$iso->id}}" class="form-check-input" value="{{$iso->id}}">
									    <label for="inline-checkbox{{$iso->id}}"  class="form-check-label">{{$iso->name}}</label>
									</div>

								@endif
								</div>
								@endforeach
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-blue"><i class="fa fa-save"></i>Guardar</button>
							</div>
						</div>						
					</div>
				</form>			
			</div>
		</div>
	</div>
</div>
@endsection