@extends('layouts.app')
@section('title','Productos')
@section('content')
<div class="container">
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
	@include('panel.product.fluid')
	@include('panel.product.parts')
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
							<td>${product.created_at}</td>
							<td>
								<button class="btn btn-info btn-sm" title="Editar"><i class="fas fa-pen"></i></button>
								<button class="btn btn-orange btn-sm" onclick="getFluid(${product.id})" title="Compatibilidad de fluidos"><i class="fas fa-water"></i></button>
								<button class="btn btn-secondary btn-sm" onclick="getParts(${product.id})" title="Gestionar partes"><i class="fas fa-cogs"></i></button>
								<button class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
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
	function getFluid(product_id){
		//Funciona - incompleta
		console.log(product_id);
		props.ruta = '/panel/compatibilities-data';
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				$('#compatibilities').empty();
				resp.forEach((compat, index) =>{
					
					if(compat.level === 1){
						$('#compatibilities').append(`
							<table class="table table-striped table-bordered table-sm">
								<thead>
									<tr>
									<th scope="col">${compat.name}</th>
									<th scope="col">Dinámico</th>
									<th scope="col">Estático</th>
									</tr>
								</thead>
								<tbody>
									${renderChilds(resp,compat.id)}
								</tbody>
							</table>
						`);

					}
				});
			},
			error: err =>{
				console.log(err);
			}
		});
		props.modal_fluid.modal();
	}

	function renderChilds(compatibilities, compat_id) {
		let childs = compatibilities.filter(compat =>{
			return compat.parent_id === compat_id;
		});

		let template = '';
		childs.forEach(child =>{
			template += `
			<tr>
				<td scope="row"> ${child.name}</td>
				<td>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="oil" id="oil1" value="option1" checked>
					<label class="form-check-label" for="oil1">
					<i class="fas fa-check text-success"></i>
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="oil" id="oil2" value="option2">
					<label class="form-check-label" for="oil2">
					<i class="fas fa-dot-circle text-primary"></i>
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="oil" id="oil3" value="option3">
					<label class="form-check-label" for="exampleRadios3">
						<i class="fas fa-times text-danger"></i>
					</label>
				</div>
				</td>
				<td>

				<div class="form-check">
					<input class="form-check-input" type="radio" name="other" id="other1" value="option1" checked>
					<label class="form-check-label" for="other1">
					<i class="fas fa-check text-success"></i>
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="other" id="other2" value="option2">
					<label class="form-check-label" for="other2">
					<i class="fas fa-dot-circle text-primary"></i>
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="other" id="other3" value="option3">
					<label class="form-check-label" for="other3">
						<i class="fas fa-times text-danger"></i>
					</label>
				</div>					      	
				</td>
			</tr>
			`;
		});
		
	return template;

	}
	function getParts(profile_id){
		// Aun no funciona
		$('#prof-id').val(profile_id);
		props.ruta = `/panel/profiles/${profile_id}/parts`;
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				// Limpiar y agregar unidades de medida del perfil.
				$('#unit_measurements').empty();
				resp.unit_measurements.forEach((unit,index) =>{
					$('#unit_measurements').append(`
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="unit_measurememt" id="inlineRadio${index}" value="${unit.name}" ${unit.enabled == 1 ? 'checked': 'disabled'} >
						<label class="form-check-label" for="inlineRadio${index}">${unit.name}</label>
					</div>
					`);
				});

				// Limpiar y agregar dimensiones del perfil.
				$('#dimensions').empty();
				resp.dimensions.forEach((dimen, index) =>{
					$('#dimensions').append(`
					<td>
						<div class="form-group">
							<input class="form-control form-control-sm" type="text" placeholder="${dimen.dimension.sigla}">
						</div>
					</td>
					`);
				});

			},
			error: err =>{
				console.log(err);
			}
		});
		props.modal_part.modal();
	}
</script>
@endsection