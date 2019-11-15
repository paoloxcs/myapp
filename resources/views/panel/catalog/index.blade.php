@extends('layouts.app')
@section('title', 'Catálogos')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i>Catálogos</li>
					  </ol>
					</nav>					
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-8">
							<!-- Buscador -->
						</div>
						<div class="col-12 col-md-4">
							<button onclick="createCatalog()" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Nombre</th>
									<th>Portada</th>
									<th>Documento</th>
									<th>Marca</th>
									<th>Edición</th>
									<th>Acción</th>
								</thead>
								<tbody id="catalogs">
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="input-group custom-pagination">
								<!-- Render pagination here -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('panel.catalog.create')
	@include('panel.catalog.edit')
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		getCatalogs();
	});
	let props = {
		tbCatalogs : $('#catalogs'),
		modal_create : $('#modal_create'),
		modal_edit : $('#modal_edit')
	}
	//Recuperando los videos con Jquery
	function getCatalogs(page=1) {
		//activando Spinner para realizar carga
		spinner.show();

		//Realizando la consulta via Ajax
		$.ajax({
			url:`/panel/catalogs-data?page=${page}`,
			type:'GET',
			dataType:'JSON',
			success:res => {
				//ocultamos spinner
				spinner.hide();
				//Vaciamos el elemento
				props.tbCatalogs.empty();
				//Llenando el elemento con la data recuperada
				res.data.forEach(catalog=>{
					props.tbCatalogs.append(`
						<tr>
							<td> ${catalog.id} </td>
							<td> ${catalog.name}</td>
							<td width="100"> <img src="/allimages/${catalog.url_image}" class="img-responsive" alt="" /> </td>
							<td> <a href="/docs/${catalog.ruta}" target="_blank"> Ver Documento </a> </td>
							<td> ${catalog.brand.name} </td>
							<td> ${catalog.edicion}</td>
							<td>
								<button class="btn btn-orange btn-sm" onclick='editCatalog(${JSON.stringify(catalog)})'> Editar </button>
								<button class="btn btn-danger btn-sm" onclick="destroyCatalog(${catalog.id})"> Eliminar </button>
							</td>
						</tr>
						`)
				})
			}
		});
	}

	function createCatalog() {
		getBrands();
		props.modal_create.modal();
	}

	function saveCatalog(form) { // send data on server

		event.preventDefault();
		let ruta = '/panel/catalogs',
			data = new FormData($(form)[0]);	

		spinner.show();
		$.ajax({
			url: ruta,
			type: 'POST',
			headers: {'X-CSRF-TOKEN': form._token.value},
			data: data,
			contentType: false,
			cache: false,
			processData: false,
			success: res=>{
				spinner.hide();
				props.modal_create.modal('hide');
				getCatalogs();
				toastr.success(res.message);
				$(form).trigger('reset');
				$('#showImage').attr('src','');
			},
			error: error=>{
				if (error.status == 422){
					spinner.hide();
					let errors = Object.values(error.responseJSON.errors);
					for (var error in errors){
					    toastr.error(errors[error][0],'Advertencia');
					}

				}else{
					console.log(error);
				}
			}

		});
	}

	function getBrands(brand_id = 0) {
		props.ruta = '/panel/brands-all-data';
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				$('.brands').empty();
				if(brand_id!=0){
					resp.forEach(brand =>{
						$('.brands').append(`
							<option ${brand_id===brand.id ? 'selected' : '' } value="${brand.id}">${brand.name}</option>
							`);
					});

				}else{
					$('.brands').append(`
						<option selected disabled>Elige una Marca</option>
						`);
					resp.forEach(brand =>{
						$('.brands').append(`
							<option value="${brand.id}">${brand.name}</option>
							`);
					});

				}
				
			},
			error: err =>{
				console.log(err);
			}
		});
	}

	function destroyCatalog(catalogId) { // send postId on server for deleting register
		if(confirm('¿Seguro de eliminar el registro?')){
			let ruta = `/panel/catalogs/${catalogId}/destroy`;
			spinner.show();
			$.ajax({
				url: ruta,
				type:'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					getCatalogs();
					toastr.success(res.message);
				},
				error: error =>{
					console.log(error);
				}
			});
		}
		
	}

	function editCatalog(catalog) {
		console.log(catalog);		
		let form_edit = $('#form_edit')[0];
		form_edit.catalog_id.value = catalog.id;
		form_edit.name.value = catalog.name;
		form_edit.edicion.value = catalog.edicion;
		getBrands(catalog.brand_id);
		props.modal_edit.modal();
	}

	function updateCatalog(form) { // send data on server for update
		event.preventDefault();
		let ruta = `/panel/catalogs/${form.catalog_id.value}`,
			data = new FormData($(form)[0]);
		
		spinner.show();
		$.ajax({
			url: ruta,
			type: 'POST',
			headers:{'X-CSRF-TOKEN': form._token.value},
			data: data,
			contentType: false,
			processData: false,
			cache: false,
			success: res =>{
				spinner.hide();
				props.modal_edit.modal('hide');
				getCatalogs();
				toastr.success(res.message);				
			},
			error: error =>{
				if (error.status == 422){
					spinner.hide();
					let errors = Object.values(error.responseJSON.errors);
					for (var error in errors){
					    toastr.error(errors[error][0],'Advertencia');
					}

				}else{
					console.log(error);
				}
			}
		});
	}



</script>
@endsection