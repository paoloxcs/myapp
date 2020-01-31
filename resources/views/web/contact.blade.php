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
			<p>Llene el siguiente formulario y en breve un asesor se pondrá en contacto con usted.</p>
			@if(session('msg'))
			<div class="alert alert-success">
				{{session('msg')}}
			</div>									
			@endif

			<form action="{{route('contact')}}" method="POST">
			{{csrf_field()}}
			<div class="form-group">			    
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese sus Apellidos y nombres" required>
			</div>

			<div class="form-group">			    
				<input type="text" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo electrónico" required>
			</div>

			<div class="form-group">			    
				<input type="number" class="form-control" id="telf" name="telf" placeholder="Ingrese su nro de Teléfono / Móvil" required>
			</div>

			<div class="form-group">				
				<textarea name="mensaje" class="form-control" id="mensaje" rows="5" placeholder="Ingrese su mensaje" required></textarea>
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