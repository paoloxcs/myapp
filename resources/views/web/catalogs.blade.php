@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')
<div class="container">
	<div class="row mt-5">
		<h3>Catálogos Disponibles</h3>
	</div>

	<div class="row mt-3">
		<section class="col-12 col-md-3">
			<ul class="list-group">
			  <li class="list-group-item active">2019</li>
			  <li class="list-group-item">2018</li>
			  <li class="list-group-item">2017</li>
			  <li class="list-group-item">2016</li>
			  <li class="list-group-item">2015</li>
			</ul>
		</section>

		<section class="col-12 col-md-9">
			<div class="row" id="catalogs">
				<!-- <section class="col-12 col-sm-6 col-md-4">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Materiales de Sellado</h5>
						</div>			  
						<div class="card-body">
							<img src="http://www.casdel.com.pe/images/servicios/thumbnail_1455811182.jpg" class="img-fluid" alt="">
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>					
						</div>
						<div class="card-footer text-center">
							<a href="#" class="btn btn-primary">Descargar <i class="fas fa-download"></i></a>
						</div>
					</div>
				</section>
				<section class="col-12 col-sm-6 col-md-4">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Materiales de Sellado</h5>
						</div>			  
						<div class="card-body">
							<img src="http://www.casdel.com.pe/images/servicios/thumbnail_1455811182.jpg" class="img-fluid" alt="">
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>					
						</div>
						<div class="card-footer text-center">
							<a href="#" class="btn btn-primary">Descargar <i class="fas fa-download"></i></a>
						</div>
					</div>
				</section>
				<section class="col-12 col-sm-6 col-md-4">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Materiales de Sellado</h5>
						</div>			  
						<div class="card-body">
							<img src="http://www.casdel.com.pe/images/servicios/thumbnail_1455811182.jpg" class="img-fluid" alt="">
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>					
						</div>
						<div class="card-footer text-center">
							<a href="#" class="btn btn-primary">Descargar <i class="fas fa-download"></i></a>
						</div>
					</div>
				</section> -->
			</div>
		</section>




	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		getCatalogs();
	});

	let props = {
		ruta : '',
		catalogList : $("#catalogs"),
	}

	function getCatalogs(page = 0) {
		props.ruta = '/catalogos-data';
		if(page != 0) props.ruta = `/catalogos-data/?page=${page}`;

		spinner.show();
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res =>{
				console.log(res);
				spinner.hide();
				props.catalogList.empty();
				res.data.forEach(catalog =>{
					props.catalogList.append(`
						<section class="col-12 col-sm-6 col-md-4">
							<div class="card">
								<div class="card-header">
									<h6 class="card-title">${catalog.name}</h6>
								</div>			  
								<div class="card-body text-center">
									<img src="/allimages/${catalog.url_image}" class="img-fluid" alt="${catalog.name}">
									<p class="card-text">${catalog.brand.name}<br><small>${catalog.edicion}</small></p>					
								</div>
								<div class="card-footer text-center">
									<a href="/docs/${catalog.ruta}" target="_blank" class="btn btn-orange btn-sm">Descargar <i class="fas fa-download"></i></a>
								</div>
							</div>
						</section>
						`);
				});
				
				renderPagination(res,'getCatalogs');
			},
			error: error =>{
				console.log(error);
			}
		});
	}

</script>
@endsection