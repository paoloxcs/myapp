@extends('layouts.app')
@section('title', 'Certificaciones')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i>Certificaciones ISOS</li>
					  </ol>
					</nav>					
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-8">
							<!-- Buscador -->
						</div>
						<div class="col-12 col-md-4">
							<button onclick="createIso()" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Acción</th>
								</thead>
								<tbody id="isos">
									
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
	@include('panel.iso.create')
	@include('panel.iso.edit')
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getIsos();
	});
	let props={
		tbIsos : $('#isos'),
		modal_create: $('#modal_create'),
		modal_edit: $('#modal_edit')
	}

	function getIsos(page=1) {
		spinner.show();

		$.ajax({
			url:`/panel/isos-data?page=${page}`,
			type:'GET',
			dataType:'JSON',
			success:res=>{
				spinner.hide();
				props.tbIsos.empty();
				res.data.forEach(iso=>{
					props.tbIsos.append(`
						<tr>
							<td> ${iso.id} </td>
							<td> ${iso.name} </td>
							<td> ${iso.description} </td>
							<td>
							<button class="btn btn-orange btn-sm" onclick='editIso(${JSON.stringify(iso)})'> Editar </button>
							<button class="btn btn-danger btn-sm" onclick="destroyIso(${iso.id})"> Eliminar </button>

							</td>
						`)
				})
			}

		});
	}

	function createIso() {
		props.modal_create.modal();
	}

	function saveIso(form) {
		event.preventDefault();
		let ruta = '/panel/isos',
			data = new FormData($(form)[0]);

		spinner.show();
		$.ajax({
			url:ruta,
			type:'POST',
			headers: {'X-CSRF-TOKEN': form._token.value},
			data: data,
			contentType: false,
			cache: false,
			processData: false,
			success: res=>{
				spinner.hide();
				props.modal_create.modal('hide');
				getIsos();
				toastr.success(res.message);
				$(form).trigger('reset');
			},
			error:error=>{
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

	function editIso(iso) {
		console.log(iso);		
		let form_edit = $('#form_edit')[0];
		form_edit.iso_id.value = iso.id;
		form_edit.name.value = iso.name;
		form_edit.description.value = iso.description;
		props.modal_edit.modal();
	}
	function updateIso(form) {
		event.preventDefault();
		let ruta = `/panel/isos/${form.iso_id.value}`,
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
			success:res=>{
				spinner.hide();
				props.modal_edit.modal('hide');
				getIsos();
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

	function destroyIso(isoId) { // send postId on server for deleting register
		if(confirm('¿Seguro de eliminar la certificación?')){
			let ruta = `/panel/isos/${isoId}/destroy`;
			spinner.show();
			$.ajax({
				url: ruta,
				type:'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					getIsos();
					toastr.success(res.message);
				},
				error: error =>{
					console.log(error);
				}
			});
		}
	}
</script>
@endsection