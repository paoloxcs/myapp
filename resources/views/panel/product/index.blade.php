@extends('layouts.app')
@section('title','Productos')
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
					<div class="card-title">Productos</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<!-- Buscador -->
						</div>
						<div class="col-xs-12 col-md-4">
							<!-- Button New -->
						
							<button onclick="createProduct()" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo producto</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<th width="80">Perfil</th>
									<th>Nombre</th>
									<th>Categoría</th>
									<th>Estado</th>
									<th>Fecha</th>
									<th>Acción</th>
								</thead>
								<tbody id="products">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('panel.product.create')
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getProducts();
	});
	let props = {
		ruta : '',
		tbProducts: $("#products"),
		modal_create : $("#modal_create"),
		modal_fluid : $("#modal_fluid"),
		modal_part : $("#modal_parts"),
		
	}
	function getProducts(page = 1) {
		spinner.show();
		props.ruta = `/panel/products-data?page=${page}`;
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				props.tbProducts.empty();
				resp.data.forEach(product =>{
					props.tbProducts.append(`
						<tr>
							<td>
								<img src="${product.url_image}"/>
							</td>
							<td>${product.name}</td>
							<td>${product.category.name}</td>
							<td>
							${product.status === 1 ? 'Activo': 'Inactivo'}
							</td>
							<td>${getFecha(product.created_at)}</td>
							<td>
								<a href="/panel/products/${product.id}/edit" class="btn btn-info btn-sm" title="Editar"><i class="fas fa-pen"></i></a>
								<a href="/panel/products/${product.id}/compatibility" class="btn btn-orange btn-sm" title="Compatibilidad de fluidos"><i class="fas fa-water"></i> </a>
								<a href="/panel/products/${product.id}/parts" class="btn btn-secondary btn-sm" title="Gestionar partes"><i class="fas fa-cogs"></i></a>
								<a href="/panel/products/${product.id}/docs" class="btn btn-blue btn-sm" title="Gestionar Documentos"><i class="far fa-file-pdf"></i></a>
								<a href="/panel/products/${product.id}/materials" class="btn btn-success btn-sm" title="Gestionar Materiales"><i class="fas fa-tools"></i></a>
								<a href="/panel/products/${product.id}/isos" class="btn btn-info btn-sm" title="Gestionar Isos"><i class="fas fa-cubes"></i></a>
								<a href="/panel/products/${product.id}/destroy" onclick="return confirm('¿Seguro de eliminar el registro?')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></a>
							</td>
						</tr>
						`);
				});
				spinner.hide();
			},
			error: err =>{
				console.log(err);
			}
		});
	}

	//function para obtner fecha
	function getFecha(date_string) {
		let date = new Date(date_string);
		return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
	}


	function getCategories() {
		// funciona
		props.ruta = '/panel/categories-all-data';
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				$('.categories').empty();
				$('.categories').append(`
					<option selected disabled>Elige una categoría</option>
					`);
				resp.forEach(categ =>{
					$('.categories').append(`
						<option value="${categ.id}">${categ.name}</option>
						`);
				});
			},
			error: err =>{
				console.log(err);
			}
		});
	}
	function getDimensions() {
		// funciona
		props.ruta = '/panel/dimensions-data';
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				$('.dimensions').empty();
				resp.forEach((dimen, index) =>{
					$('.dimensions').append(`
						<div class="form-check form-check-inline p-2" title="${dimen.name}">
							<input type="checkbox" name="dimensions[]" id="inline-checkbox${index}" class="form-check-input" value="${dimen.id}">
							<label for="inline-checkbox${index}"  class="form-check-label">${dimen.sigla}</label>
						</div>
						`);
				});
			},
			error: err =>{
				console.log(err);
			}
		});
	}

	function getMeasurements() {
		props.ruta = '/panel/measurements-data';
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				$('.unit_measurements').empty();
				resp.forEach((measurement, index) =>{
					$('.unit_measurements').append(`
						<div class="form-check form-check-inline p-2">
							<input type="checkbox" name="measurements[]" id="inline-checkbox${index}" ${index === 0 ? 'checked': ''} class="form-check-input" value="${measurement.id}">
							<label for="inline-checkbox${index}" class="form-check-label">${measurement.name}</label>
						</div>
					`);
				});
			},
			error: err =>{
				console.log(err);
			}
		});

	}
	
	function createProduct() {
		// funciona
		getDimensions();
		getCategories();
		getMeasurements();
		props.modal_create.modal();
	}
	
	function saveProduct(form) {
		// Funciona
		event.preventDefault();
		props.ruta = '/panel/products';
		let formData = new FormData($(form)[0]);
		formData.set('body', CKEDITOR.instances[form.body.name].getData());
		$.ajax({
			url: props.ruta,
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			success: resp =>{
				getProducts();
				toastr.success(resp.message);
				props.modal_create.modal('hide');
				$(form).trigger('reset');
				$('#showImage').attr('src','');
				CKEDITOR.instances[form.body.name].setData('');

			},
			error: err =>{
				if(err.status === 422){
					for(let key in err.responseJSON){
						toastr.error(err.responseJSON[key][0]);
					}
				}
			}

		});

	}
</script>
@endsection