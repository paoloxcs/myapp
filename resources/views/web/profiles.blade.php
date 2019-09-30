@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')

<div class="container">
	<div class="row mt-5">
		<section class="col-xs-12 col-sm-12 col-md-3">
			
			<div class="accordion" id="accordionExample">
			  <div class="card browser">
			    <div class="card-header" id="headingOne">
			      <h5 class="mb-0">	Filtro </h5>
			    </div>
			  </div>
			  <div class="card filterbrowser">
			    <div class="card-header" id="head2">
			    	<a class="white" data-toggle="collapse" data-target="#colapso2" aria-expanded="false" aria-controls="colapso2">SELLOS HIDRÁULICOS <i class="fas fa-caret-down"></i></a>		      
			    </div>
			    <div id="colapso2" class="collapse show" aria-labelledby="head2" data-parent="#accordionExample">
			      <div class="card-body d-flex flexwrapper">			      
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">Piston Seal</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">Rod Seal</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">Rod Buffer</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">VeePacks</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">Wear Ring</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">Wipers</a></section>
			      </div>
			    </div>
			  </div>

			  <div class="card filterbrowser">
			    <div class="card-header" id="head3">
			    	<a class="white" data-toggle="collapse" data-target="#colapso3" aria-expanded="false" aria-controls="colapso3">RETENES ROTATIVOS Y EJE <i class="fas fa-caret-down"></i></a>		      
			    </div>
			    <div id="colapso3" class="collapse" aria-labelledby="head3" data-parent="#accordionExample">
			      <div class="card-body d-flex flexwrapper">			      
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">Radiales</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">Axiales</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">V-ring</a></section>
			      </div>
			    </div>
			  </div>

			  <div class="card filterbrowser">
			    <div class="card-header" id="head4">
			    	<a class="white" data-toggle="collapse" data-target="#colapso4" aria-expanded="false" aria-controls="colapso4">BANDAS GUIA ANTIFRICCION <i class="fas fa-caret-down"></i></a>		      
			    </div>
			    <div id="colapso4" class="collapse" aria-labelledby="head4" data-parent="#accordionExample">
			      <div class="card-body d-flex flexwrapper">			      
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">1</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">2</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">3</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">4</a></section>
			      </div>
			    </div>
			  </div>

			  <div class="card filterbrowser">
			    <div class="card-header" id="head5">
			    	<a class="white" data-toggle="collapse" data-target="#colapso5" aria-expanded="false" aria-controls="colapso5">O-RINGS Y BACK-UPS <i class="fas fa-caret-down"></i></a>		      
			    </div>
			    <div id="colapso5" class="collapse" aria-labelledby="head5" data-parent="#accordionExample">
			      <div class="card-body d-flex flexwrapper">			      
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">O-ring’s</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">Backup’s</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">Kits</a></section>        
			      </div>
			    </div>
			  </div>

			  <div class="card filterbrowser">
			    <div class="card-header" id="head6">
			    	<a class="white" data-toggle="collapse" data-target="#colapso6" aria-expanded="false" aria-controls="colapso6">KITS COMPLETOS <i class="fas fa-caret-down"></i></a>		      
			    </div>
			    <div id="colapso6" class="collapse" aria-labelledby="head6" data-parent="#accordionExample">
			      <div class="card-body d-flex flexwrapper">			      
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">1</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">2</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">3</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">4</a></section>
			      </div>
			    </div>
			  </div>

			  <div class="card filterbrowser">
			    <div class="card-header" id="head7">
			    	<a class="white" data-toggle="collapse" data-target="#colapso7" aria-expanded="false" aria-controls="colapso7">SELLOS A MEDIDA <i class="fas fa-caret-down"></i></a>		      
			    </div>
			    <div id="colapso7" class="collapse" aria-labelledby="head7" data-parent="#accordionExample">
			      <div class="card-body d-flex flexwrapper">			      
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">1</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">2</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">3</a></section>
			        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="#">4</a></section>
			      </div>
			    </div>
			  </div>
			</div>		

		<div class="row mt-5 mx-auto">
			<button type="button" class="btn btn-orange btn-lg" data-toggle="modal" data-target="#converter">
				<i class="fas fa-calculator"></i> Convertidor
			</button>
			<!-- Modal Calculadora -->
			<div class="modal fade" id="converter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Calculadora de Conversiones</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      	<div class="container-fluid">
			      		{{-- Longitud --}}
			      		<div class="input-group input-group-sm mb-3">
			      		  <div class="input-group-prepend">
			      		    <span class="input-group-text" id="inputGroup-sizing-sm">Longitud</span>
			      		  </div>
			      		  <input type="text" onkeyup="lconverter()" id="longitud" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

			      		  <span class="input-group-append">
			      		  	<span class="input-group-text"> > </span>
			      		  </span>

			      		  <select name="length" class="form-control form-control-sm" id="length" onchange="lconverter()">
			      		  	<option value="1" selected>pulgadas</option>
			      		  	<option value="2">milimetros</option>
			      		  	<option value="3">metros</option>
			      		  	<option value="4">pies</option>
			      		  	<option value="5">micras</option>
			      		  </select>
			      		  <span class="input-group-append">
			      		  	<span class="input-group-text" id="lresult">0</span>
			      		  </span>
			      		</div>
			      		{{-- Longitud --}}

			      		{{-- Presión --}}

			      		<div class="input-group input-group-sm mb-3">
			      		  <div class="input-group-prepend">
			      		    <span class="input-group-text" id="inputGroup-sizing-sm">Presión</span>
			      		  </div>
			      		  <input type="text" onkeyup="pconverter()" id="presion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
			      		  <select name="pressure" class="form-control form-control-sm" id="pressure" onchange="pconverter()">
			      		  	<option value="1" selected>bar</option>
			      		  	<option value="2">p.s.i</option>
			      		  	<option value="3">MPa</option>
			      		  	<option value="4">KPa</option>
			      		  </select>
			      		  <span class="input-group-append">
			      		  	<span class="input-group-text"> &nbsp; </span>
			      		  </span>
			      		  <span class="input-group-append">
			      		  	<span class="input-group-text" id="presult">0</span>
			      		  </span>
			      		  <select name="pressure2" class="form-control form-control-sm" id="pressure2" onchange="pconverter()">
			      		  	<option value="1" selected>bar</option>
			      		  	<option value="2">p.s.i</option>
			      		  	<option value="3">MPa</option>
			      		  	<option value="4">KPa</option>
			      		  </select>
			      		</div>
			      		{{-- Presión --}}

			      		{{-- Speed --}}
			      		<div class="input-group input-group-sm mb-3">
			      		  <div class="input-group-prepend">
			      		    <span class="input-group-text" id="inputGroup-sizing-sm">Velocidad</span>
			      		  </div>
			      		  <input type="text" onkeyup="sconverter()" id="velocidad" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

			      		  <span class="input-group-append">
			      		  	<span class="input-group-text"> > </span>
			      		  </span>

			      		  <select name="length" class="form-control form-control-sm" id="speed" onchange="sconverter()">
			      		  	<option value="1" selected>ft/segundos</option>
			      		    <option value="2">m/segundos</option>
			      		  </select>
			      		  <span class="input-group-append">
			      		  	<span class="input-group-text" id="sresult">0</span>
			      		  </span>
			      		</div>
			      		{{-- Speed --}}

			      		{{-- Temp --}}

			      		<div class="input-group input-group-sm mb-3">
			      		  <div class="input-group-prepend">
			      		    <span class="input-group-text" id="inputGroup-sizing-sm">Temperatura</span>
			      		  </div>
			      		  <input type="text" onkeyup="tconverter()" id="temperatura" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

			      		  <span class="input-group-append">
			      		  	<span class="input-group-text"> > </span>
			      		  </span>

			      		  <select name="length" class="form-control form-control-sm" id="temp" onchange="tconverter()">
			      		  	<option value="1" selected>°C</option>
			      		    <option value="2">°F</option>
			      		  </select>
			      		  <span class="input-group-append">
			      		  	<span class="input-group-text" id="tresult">0</span>
			      		  </span>
			      		</div>


			      		{{-- <div class="row">
			      		    <div class="col-md-4">
			      		    	<div class="form-group row">
			      		    		<label for="longitud" class="col-sm-6 col-form-label-sm">Temperatura</label>
			      		    		<div class="col-sm-6">
			      		    			<input type="number" onkeyup="tconverter()" class="form-control form-control-sm" id="temperatura" value="0">
			      		    		</div>
			      		    	</div>
			      		    </div>
			      		    <div class="col-md-1">
			      		    	<label for="arrow" class="col-form-label-sm"> > </label>
			      		    </div>
			      		    <div class="col-md-7">
			      		    	<div class="form-group row">			      		    		
			      		    		<div class="col-sm-4">			      		    			
			      		    			<select name="length" class="form-control form-control-sm" id="temp" onchange="tconverter()">
			      		    				<option value="1" selected>°C</option>
			      		    				<option value="2">°F</option>
			      		    			</select>
			      		    		</div>
			      		    		<label for="temp" id="tresult" class="col-sm-8 col-form-label-sm">0</label>
			      		    	</div>
			      		    </div>
			      		</div> --}}
			      		{{-- Temp --}}
			      	</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>			        
			      </div>
			    </div>
			  </div>
			</div>
			<!-- Modal Calculadora -->
		</div>

		<div class="row mt-5 mx-auto">
			<h5>Sellos a Medida</h5>
			<p>Además de nuestra amplia gama de productos almacenados, ofrecemos soluciones de sellado diseñadas a medida y sellos maquinados.</p>
			<p>
				<button type="button" class="btn btn-outline-primary btn-lg">Arme su Sello</button>
			</p>
		</div>



		</section>

		<section class="col-xs-12 col-sm-12 col-md-9">
			<div class="row">
				<h3>Perfiles</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius rerum dignissimos provident mollitia, deleniti nam excepturi doloremque unde enim, dolores et quae aperiam dicta ullam sunt dolorem. Dolorem esse, aspernatur.</p>
			</div>

			<div class="row mt-3">
				<article class="col-xs-12 col-sm-12 col-md-4 mt-4 product">
					<a href="#">					
						<img src="http://www.casdel.com.pe/wp-img-prod/sellos-hid.jpg" alt="">
						<h4>Sellos Hidráulicos</h4>
						<p class="mt-2">Sellos de limpiadores, sellos de vástago, sellos de pistón, sellos de pistón de acción simple y doble y empaquetamiento en V.</p>
					</a>
				</article>
				<article class="col-xs-12 col-sm-12 col-md-4 mt-4 product">
					<a href="#">						
						<img src="http://www.casdel.com.pe/wp-img-prod/radiales/casdel-reten-radial.jpg" alt="">
						<h4>Retenes Rotativos y Eje</h4>
						<p class="mt-2">Soluciones de estanqueidad para eje rotativo radial y axial: anillos V-ring,sellos mecánicos; en nitrilo, silicona, poliacrilato y viton</p>
					</a>
				</article>
				<article class="col-xs-12 col-sm-12 col-md-4 mt-4 product">
					<a href="#">						
						<img src="http://www.casdel.com.pe/wp-img-prod/sellos-hid.jpg" alt="">
						<h4>Bandas Guia Antifricción</h4>
						<p class="mt-2">Bandas guía para cilindros hidráulicos y neumáticos; en PTFE, POM, RESINA PHENOLICA, POLIESTER…</p>
					</a>
				</article>

				<article class="col-xs-12 col-sm-12 col-md-4 mt-4 product">
					<a href="#">						
						<img src="http://www.casdel.com.pe/wp-img-prod/oring_backup/oring-bup.png" alt="">
						<h4>O-Rings y Back-Ups</h4>
						<p class="mt-2">O’ring, d-ring, back-up y kits o’ring en viton, nitrilo, silicona, EPDM y otros; en pulgadas y milimétrico</p>
					</a>
				</article>
				<article class="col-xs-12 col-sm-12 col-md-4 mt-4 product">
					<a href="#">						
						<img src="http://www.casdel.com.pe/wp-img-prod/kits/kit.png" alt="">
						<h4>Kits Completos</h4>
						<p class="mt-2">Kits hidráulicos para reparación de maquinaria Komatsu, Caterpillar, John Deere, Volvo y otros mas</p>
					</a>
				</article>
				<article class="col-xs-12 col-sm-12 col-md-4 mt-4 product">
					<a href="#">						
						<img src="http://tecnominproductos.com/imgproductos//hpqOasistema%20de%20sellado%20trygonal.jpg" alt="">
						<h4>Sellos a Medida</h4>
						<p class="mt-2">Fabricaciones de sellos</p>
					</a>
				</article>
			</div>
		</section>
			
	</div>
</div>
@endsection
@section('scripts')
<script>
	function lconverter() {
		var nro1 = document.getElementById('longitud').value;
		var select = document.getElementById('length').value;
		var result = 0;
		if(select==1){
			result = `${(nro1 * 25.4).toFixed(1)} mm`;
		}
		else if(select==2){
			result = `${(nro1 / 25.4).toFixed(1)} mm`;
		}
		else if(select==3){
			result = `${(nro1 * 1000).toFixed(1)} m`;
		}
		else if(select==4){
			result = `${(nro1 / 304.8).toFixed(8)} ft`;
		}
		else if(select==5){
			result = `${(nro1 * 1000).toFixed(2)} μm`; 
		}
		// if (select==1){
		// 	result = `${(nro1 * 25.4).toFixed(1)} mm`;			
		// }else{
		// 	result = `${(nro1 / 25.4).toFixed(3)} "`;
		// }
		document.getElementById('lresult').innerText='= ' + result;
		//console.log(result);
	}

	function sconverter() {
		var nro1 = document.getElementById('velocidad').value;
		var select = document.getElementById('speed').value;
		var result = 0;
		if (select==1){			
			result = `${(nro1 / 3.28084).toFixed(2)} m/seg`;
		}else{
			result = `${(nro1 * 3.28084).toFixed(2)} ft/seg`;
		}
		document.getElementById('sresult').innerText='= ' + result;
		//console.log(result);
	}

	function tconverter() {
		var nro1 = document.getElementById('temperatura').value;
		var select = document.getElementById('temp').value;
		var result = 0;
		if (select==1){			
			result = `${((nro1 / 1.8)/32).toFixed(1)} °F`;
		}else{
			result = `${((nro1 * 1.8)+32).toFixed(1)} °C`;
		}
		document.getElementById('tresult').innerText='= ' + result;
		//console.log(result);
	}

function pconverter() {
	var nro1 = document.getElementById('presion').value;
	var select = document.getElementById('pressure').value;
	var select2 = document.getElementById('pressure2').value;
	var result = 0;
	if (select==1 && select2==1){
		result = `${(nro1 * 1).toFixed(0)}`;
	}else if(select==1 && select2==2){
		result = `${(nro1 / 0.06895).toFixed(2)}`;
	}else if(select==1 && select2==3){
		result = `${(nro1 / 10).toFixed(2)}`;
	}else if(select==1 && select2==4){
		result = `${(nro1 * 100).toFixed(2)}`;
	}else if(select==2 && select2==1){
		result = `${(nro1 * 0.06895).toFixed(2)}`;
	}else if(select==2 && select2==2){
		result = `${(nro1 * 1).toFixed(0)}`;
	}else if(select==2 && select2==3){
		result = `${(nro1 * 0.00689476).toFixed(2)}`;
	}else if(select==2 && select2==4){
		result = `${(nro1 * 6.8948).toFixed(2)}`;
	}else if(select==3 && select2==1){
		result = `${(nro1 * 10).toFixed(1)}`;
	}else if(select==3 && select2==2){
		result = `${(nro1 / 0.00689476).toFixed(1)}`;
	}else if(select==3 && select2==3){
		result = `${(nro1 * 1).toFixed(0)}`;
	}else if(select==3 && select2==4){
		result = `${(nro1 * 1000).toFixed(0)}`;
	}else if(select==4 && select2==1){
		result = `${(nro1 / 100).toFixed(4)}`;
	}else if(select==4 && select2==2){
		result = `${(nro1 / 6.8948).toFixed(4)}`;
	}else if(select==4 && select2==3){
		result = `${(nro1 / 1000).toFixed(4)}`;
	}else if(select==4 && select2==4){
		result = `${(nro1 * 1).toFixed(0)}`;
	}
	document.getElementById('presult').innerText='= ' + result;
	console.log(result);
}
</script>
@endsection
