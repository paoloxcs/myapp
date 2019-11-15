
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

			    	  	<form action="">
			    	  		<div class="row mt-1">
			    	  			<section class="col-12">
				    	  			<label for="category"><small>Categoría</small></label>
				    	  			<select name="category" class="form-control form-control-sm" id="">
				    	  				<option value="1">Rod Seals</option>
				    	  				<option value="2">Single Action Piston</option>
				    	  			</select>
			    	  			</section>
			    	  		</div>

			    	  		<div class="row mt-1">
			    	  			<section class="col-12">
			    	  				<small>Diámetros</small>
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" class="form-control form-control-sm" placeholder="0d1">
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" class="form-control form-control-sm" placeholder="0D1">
			    	  			</section>
			    	  		</div>

			    	  		<div class="row mt-1">
			    	  			<section class="col-12">
			    	  				<small>Longitud y Largo</small>
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" class="form-control form-control-sm" placeholder="L1">
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" class="form-control form-control-sm" placeholder="SL">
			    	  			</section>
			    	  		</div>

			    	  		<div class="row mt-2">
			    	  			<section class="col-12">
			    	  				<small>Presión de Operación</small>
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" class="form-control form-control-sm" placeholder="Max">
			    	  			</section>
			    	  			<section class="col-12">
			    	  				<small>Temperaturas de Operatividad</small>
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" class="form-control form-control-sm" placeholder="Max">
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" class="form-control form-control-sm" placeholder="Min">
			    	  			</section>
			    	  			<section class="col-12">
			    	  				<small>Velocidad de Operación</small>
			    	  			</section>
			    	  			<section class="col-6">
			    	  				<input type="text" class="form-control form-control-sm" placeholder="Max">
			    	  			</section>
			    	  		</div>

			    	  		<div class="row mt-2">
			    	  			<section class="col-12">
			    	  				<h6>Fluido de Operatividad</h6>
			    	  			</section>
			    	  			<section class="col-12">
			    	  				<label for="application">
			    	  					<small>Aplicación</small>
			    	  				</label>
			    	  				<select name="application" class="form-control form-control-sm" id="">
			    	  					<option value="1">Estática</option>
			    	  					<option value="1">Dinámica</option>
			    	  				</select>
			    	  			</section>
			    	  			<section class="col-12">
			    	  				<label for="fluid">
			    	  					<small>Tipo de Fluido</small>
			    	  				</label>
			    	  				<select name="fluid" class="form-control form-control-sm" id="">
			    	  					<option value="1">basados en aceite mineral</option>
			    	  					<option value="2">basados en agua</option>
			    	  				</select>
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
			    	  	<form action="">
			    	  		<div class="row mt-1">
				    	  		<section class="col-12">
				    	  			<input type="text" class="form-control form-control-sm" placeholder="Nro de Parte">
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
				
			</div>
		</section>
			
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/calculator.js')}}">
</script>

@endsection
