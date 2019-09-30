@extends('layouts.app')
@section('title','Productos')
@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Perfiles</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<!-- Buscador -->
						</div>
						<div class="col-xs-12 col-md-4">
							<!-- Button New -->
						
							<button onclick="createProfile()" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo perfil</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<th width="80">Perfil</th>
									<th>Tipo</th>
									<th>Categoría</th>
									<th>Autor</th>
									<th>Estado</th>
									<th>Fecha</th>
									<th>Acción</th>
								</thead>
								<tbody id="profiles">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('panel.profile.create')
	@include('panel.profile.fluid')
	@include('panel.profile.parts')
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getProfiles();
	});
	let props = {
		ruta : '',
		tbProfiles: $("#profiles"),
		modal_create : $("#modal_create"),
		modal_fluid : $("#modal_fluid"),
		modal_part : $("#modal_parts")
	}
	function getProfiles() {
		spinner.show();
		props.ruta = '/panel/profiles-data';
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				props.tbProfiles.empty();
				resp.profiles.forEach(prof =>{
					props.tbProfiles.append(`
						<tr>
							<td>
								<img src="${prof.url_image}"/>
							</td>
							<td>${prof.type}</td>
							<td>${prof.category.name}</td>
							<td>${prof.creator.name}</td>
							<td>
							${prof.status === 1 ? 'Activo': 'Inactivo'}
							</td>
							<td>${prof.created_at}</td>
							<td>
								<button class="btn btn-info btn-sm" title="Editar"><i class="fas fa-pen"></i></button>
								<button class="btn btn-orange btn-sm" onclick="getFluid(${prof.id})" title="Compatibilidad de fluidos"><i class="fas fa-water"></i></button>
								<button class="btn btn-secondary btn-sm" onclick="getParts(${prof.id})" title="Gestionar partes"><i class="fas fa-cogs"></i></button>
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
	function getCategpories() {
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
		props.ruta = '/panel/dimensions-data';
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				$('.dimensions').empty();
				resp.forEach((dimen, index) =>{
					$('.dimensions').append(`
						<div class="form-check form-check-inline p-2">
							<input type="checkbox" name="dimensions[]" id="inline-checkbox${index}" class="form-check-input" value="${dimen.id}">
							<label for="inline-checkbox${index}" class="form-check-label">${dimen.sigla}</label>
						</div>
						`);
				});
			},
			error: err =>{
				console.log(err);
			}
		});
	}
	
	function createProfile() {
		getDimensions();
		getCategpories();
		props.modal_create.modal();
	}
	function saveProfile(form) {

		event.preventDefault();
		props.ruta = '/panel/profiles';
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
				getProfiles();
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
	function getFluid(profile_id){

		props.modal_fluid.modal();
	}
	function getParts(profile_id){
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