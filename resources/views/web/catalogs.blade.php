@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')
<div class="container">
	<div class="row mt-5">
		<h3>Catálogos Disponibles</h3>
	</div>

	<div class="row mt-3">
		<section class="col-12 col-md-3">
			<ul class="list-group" id="editions">
			  
			</ul>
		</section>

		<section class="col-12 col-md-9">
			<div class="row" id="catalogs">
				
			</div>
		</section>




	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		getCatalogs();
		getEditions();
	});

	let props = {
		ruta : '',
		catalogList : $("#catalogs"),
		editionList: $("#editions"),
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

	// Obteniendo lista de ediciones 
	function getEditions() {
		props.ruta = '/editions-data';
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res =>{
				
				props.editionList.empty();
				res.editions.forEach((edition, index) =>{
					props.editionList.append(`
						<a href="#" class="list-group-item list-group-item-action ${index === 0 ? 'active' : ''}">${edition}</a>
						`);
				});
			
			},
			error: error =>{
				console.log(error);
			}
		});
	}

</script>
@endsection