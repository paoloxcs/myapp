@extends('layouts.front')
@section('title','Contáctenos | Llene el siguiente formulario')
@section('content')
<div class="container">
	<div class="row mt-5">
		<section class="col-xs-12 col-sm-12 col-md-3">
			<div class="card">
			<div class="card-header darkgray">
				<h5 class="card-title">CASDEL - Oficina Principal</h5>
			</div>	 
			  <div class="card-body gray">			    
			    <p class="card-text"><strong>Dirección:</strong></p>
			    <p>Calle Rodolfo del Campo 428 – La Victoria</p>
			    <br>
			    <p class="card-text"><strong>Central Teléfonica:</strong></p>
			    <p><i class="fas fa-phone"></i>: +511-2020777</p>
			    <p>Informes: Anexo 100</p>
			    <p>ventas Corporativas: Anexos 102-105</p>
			    <br>
			    <p class="card-text"><strong>Correo Electrónico:</strong></p>
			    <p>Ventas: <a class="orange-text" href="mailto:ventas@casdel.com.pe">ventas@casdel.com.pe</a></p>
			    <p>Información: <a class="orange-text" href="mailto:informes@casdel.com.pe">informes@casdel.com.pe</a></p>
			  </div>
			</div>
		</section>

		<section class="col-xs-12 col-sm-12 col-md-9">
			<h3>Contáctenos</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora itaque cum quaerat facere est commodi delectus dicta impedit ipsum vero quod quo eligendi, blanditiis quia alias tenetur neque nesciunt, totam?</p>

			<form>
			<div class="form-group">			    
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese sus Apellidos y nombres">
			</div>

			<div class="form-group">			    
				<input type="nro" class="form-control" id="telf" name="telf" placeholder="Ingrese su nro de Teléfono / Móvil">
			</div>

			<div class="form-group">				
				<textarea name="mensaje" class="form-control" id="mensaje" cols="30" rows="5" placeholder="Ingrese su mensaje,"></textarea>
			</div>

			<button type="submit" class="btn btn-orange">Enviar</button>
			</form>
		</section>
	</div>
	<div class="row mt-5">
		<section class="col-md-12">
			<h3>Nuestras Sedes</h3>
		</section>

		<section class="col-md-12 mt-4">
			<div class="row" id="sedes">
				<!-- <section class="col-xs-12 col-md-4">
					<h4>Sede Lima</h4>
					<small>Psj. Enrique Barreda 166B Urb. Apolo – La Victoria<br>Lima- Perú</small>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.537736536833!2d-77.01192828592814!3d-12.075294191448277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c628253cc6ab%3A0x4dc848e1e5b24465!2sJir%C3%B3n+Enrique+Barreda+166%2C+Cercado+de+Lima+15018!5e0!3m2!1ses!2spe!4v1550787720357" frameborder="0" style="border:0" allowfullscreen></iframe>
				</section>
				
				<section class="col-xs-12 col-md-4">
					<h4>Sede Arequipa</h4>
					<small>Av. Aviación 720-2 – Cerro Colorado<br>Arequipa – Perú</small>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3828.1479113534956!2d-71.56597328586463!3d-16.366425988697955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91424a038d9c0527%3A0x77d5182afacde227!2sAv.+Aviacion%2C+Cerro+Colorado!5e0!3m2!1ses!2spe!4v1550787203979" frameborder="0" style="border:0" allowfullscreen></iframe>
				</section> -->
			</div>
		</section>
	</div>
</div>

@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		getSedes();
	});
	let props = {
		ruta : '',
		sedeList : $("#sedes"),
	}
	function getSedes(page = 0) {
		props.ruta = '/sedes-data';
		if(page != 0) props.ruta = `/sedes-data/?page=${page}`;

		spinner.show();
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res =>{
				console.log(res);
				spinner.hide();
				props.sedeList.empty();
				res.data.forEach(sede =>{
					props.sedeList.append(`
						<section class="col-xs-12 col-md-4">
							<h4>${sede.name} </h4>
							<small>${sede.address} – ${sede.district}<br><span class="orange-text">Telf: ${sede.telf} - Anexo: ${sede.anexo}</span><br>${sede.city}</small><br>
							${sede.maps_code}
						</section>						
						`);
				});
				
				renderPagination(res,'getSedes');
			},
			error: error =>{
				console.log(error);
			}
		});
	}
</script>
@endsection