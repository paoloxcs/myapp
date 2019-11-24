
@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')

<div class="container">
	<div class="row mt-5">
		<section class="col-xs-12 col-sm-12 col-md-3">
			
			<div class="accordion" id="accordionExample">
			  <div class="card browser">
			    <div class="card-header" id="headingOne">
			      <h5 class="mb-0">	Criterios </h5>
			    </div>
			    <div class="card-body">

			    	<ul class="nav nav-tabs" id="myTab" role="tablist">
			    	  <li class="nav-item">
			    	    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#seal" role="tab" aria-controls="home" aria-selected="true">Sello</a>
			    	  </li>
			    	  <li class="nav-item">
			    	    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#part" role="tab" aria-controls="profile" aria-selected="false">N° Parte</a>
			    	  </li>
			    	</ul>
			    	<div class="tab-content" id="myTabContent">
			    	  <div class="tab-pane fade show active" id="seal" role="tabpanel" aria-labelledby="home-tab">

			    	  	<form action="{{route('products.search')}}" method="GET">
			    	  		<div class="row mt-1">
			    	  			<section class="col-12">
				    	  			<label for="category"><small>Categoría</small></label>
				    	  			<select name="category" class="form-control form-control-sm" id="">
				    	  				@foreach($categories as $categ)
				    	  					<option value="{{$categ->id}}">{{$categ->name}}</option>
				    	  				@endforeach
				    	  			</select>
			    	  			</section>
			    	  		</div>

			    	  		<div class="row mt-1">
			    	  			<section class="col-12">
			    	  				<small>Diámetros y Longitud</small>
			    	  			</section>
			    	  			@foreach ($dimensions as $index => $dimension)
			    	  			<section class="col-4">
			    	  				<div class="form-group">
			    	  					<input type="text" class="form-control form-control-sm" title="{{$dimension->name}}" name="dimension{{$index}}" placeholder="{{$dimension->sigla}}">
			    	  				</div>
			    	  			</section>
			    	  			@endforeach
			    	  		</div>

			    	  		<div class="row mt-2">
			    	  			<section class="col-12">
			    	  				<small>Presión de Operación</small>
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" name="max_pressure" class="form-control form-control-sm" placeholder="Max">
			    	  			</section>
			    	  			<section class="col-12">
			    	  				<small>Temperaturas de Operatividad</small>
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" name="max_temp" class="form-control form-control-sm" placeholder="Max">
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" name="min_temp" class="form-control form-control-sm" placeholder="Min">
			    	  			</section>
			    	  			<section class="col-12">
			    	  				<small>Velocidad de Operación</small>
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" name="max_speed" class="form-control form-control-sm" placeholder="Max">
			    	  			</section>
			    	  		</div>

			    	  		<div class="row mt-2">
			    	  			<section class="col-12 text-center">
			    	  				<button type="submit" class="btn btn-orange btn-sm">Buscar</button>
			    	  			</section>
			    	  		</div>

			    	  		
			    	  	</form>
			    	  	

			    	  </div>
			    	  <div class="tab-pane fade" id="part" role="tabpanel" aria-labelledby="profile-tab">
			    	  	<form action="{{route('products.search')}}" method="GET">
			    	  		<div class="row mt-1">
				    	  		<section class="col-12">
				    	  			<input type="text" name="part_number" class="form-control form-control-sm" placeholder="Nro de Parte">
				    	  		</section>
			    	  		</div>

			    	  		<div class="row mt-2">
			    	  			<section class="col-12 text-center">
			    	  				<button type="submit" class="btn btn-orange btn-sm">Buscar</button>
			    	  			</section>
			    	  		</div>
			    	  	</form>
			    	  </div>
			    	</div>

			    </div>
			  </div>
			</div>		

		<div class="row mt-5 mx-auto">
			@include('layouts.calculator')
		</div>


		</section>

		<section class="col-xs-12 col-sm-12 col-md-9">
			<div class="row">
				<h3>Buscador de Productos</h3>
			</div>

			<div class="row mt-3">
				@if(isset($category))
				<h5 class="orange-text">Resultados x Categoría</h5>

				<table class="table table-striped table-bordered table-sm">
					<tbody>
						<tr>
							<td width="8%"><img src="{{$category->url_image}}" alt="{{$category->name}}"></td>
							<td>{{$category->id}}</td>
							<td>{{$category->name}}</td>
							<td><a href="productos/{{$category->slug}}" class="btn btn-orange btn-sm">Visitar</a></td>
						</tr>
					</tbody>
				</table>

				<!-- <pre>
					{{$category}}
				</pre -->
				@endif

		    	@if(isset($parts))
		    	<h5 class="orange-text">Partes Encontradas</h5>
		    	<table class="table table-striped table-bordered table-sm">
		    	<thead>
		    		<th scope="col">Código</th>
		    		<th scope="col">Perfil</th>
		    		<th scope="col">Nro de Parte</th>
		    		@foreach($parts as $p)
		    			
		    				@foreach($p->product->dimensions as $dim)
		    					<th scope="col">{{$dim->sigla}}</th>
		    				@endforeach
		    			
		    		@endforeach
		    		<th scope="col">Medida</th>
		    		<th scope="col">Documento</th>	

		    	</thead>
		    	<tbody>
		    		@foreach($parts as $part)
		    		<tr>
		    			<td>{{$part->id}}</td>
		    			<td>{{$part->product->name}}</td>
		    			<td>{{$part->part_nro}}</td>
		    			@foreach(json_decode($part->dimensions) as $index => $part_dimen)
		    				<td>{{$part_dimen}}</td>
		    			@endforeach
		    			<td>{{$part->measurement->sigla}}</td>
		    			<td><a href="/docs/{{$part->ruta}}" target="_blank" class="orange-text"><i class="far fa-file-pdf"></i> Descargar </a></td>
		    			<!-- {{$part}} -->
		    		</tr>
		    		@endforeach
		    	</tbody>
		    	</table>

		    	

		    	@endif

		    	@if(isset($part))
		    	<h5 class="orange-text">Resultados para Partes</h5>

		    	<table class="table table-striped table-bordered table-sm">
		    	<thead>
		    		<th scope="col">Código</th>
		    		<th scope="col">Perfil</th>
		    		<th scope="col">Nro de Parte</th>
		    		@foreach($part->product->dimensions as $dim)
		    			<th scope="col">{{$dim->sigla}}</th>
		    		@endforeach
		    		<th scope="col">Medida</th>
		    		<th scope="col">Documento</th>				    		
		    	</thead>
		    	<tbody>

		    		<tr>
		    			<td>{{$part->id}}</td>
		    			<td>{{$part->product->name}}</td>
		    			<td>{{$part->part_nro}}</td>				    			
		    			@foreach(json_decode($part->dimensions) as $index => $part_dimen)
		    				<td>{{$part_dimen}}</td>
		    			@endforeach
		    			<td>{{$part->measurement->sigla}}</td>
		    			<td><a href="/docs/{{$part->ruta}}" target="_blank" class="orange-text"><i class="far fa-file-pdf"></i> Descargar </a></td>
		    		</tr>
		    		
		    	</tbody>
		    	</table>
		    	@endif				    	

				    	

			</div>
		</section>
			
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/calculator.js')}}">
</script>

@endsection
