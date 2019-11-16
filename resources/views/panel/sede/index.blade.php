@extends('layouts.app')
@section('title', 'Sedes')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i>Sedes</li>
					  </ol>
					</nav>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-8">
							
						</div>
						<div class="col-12 col-md-4">
							<button onclick="createSede()" class="btn btn-orange"><i class="fa fa-plus"></i> Nueva Sede</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Nombre</th>
									<th>Dirección</th>
									<th>Distrito</th>
									<th>Teléfono</th>
									<th>Anexo</th>
									<th>Ciudad</th>									
									<th>Acción</th>
								</thead>
								<tbody id="sedes">
									
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
	@include('panel.sede.create')
	@include('panel.sede.edit')
	<!-- Incluir Modals -->
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		getSedes();
	});
	let props = {
		tbSedes : $('#sedes'),
		modal_create : $('#modal_create'),
		modal_edit : $('#modal_edit')
	}

	function getSedes(page=1) {
		//activando Spinner para realizar carga
		spinner.show();

		//Realizando la consulta via Ajax
		$.ajax({
			url:`/panel/sedes-data?page=${page}`,
			type:'GET',
			dataType:'JSON',
			success:res => {
				//ocultamos spinner
				spinner.hide();
				//Vaciamos el elemento
				props.tbSedes.empty();
				//Llenando el elemento con la data recuperada
				res.data.forEach(sede=>{
					props.tbSedes.append(`
						<tr>
							<td> ${sede.id} </td>
							<td> ${sede.name}</td>
							<td> ${sede.address}</td>
							<td> ${sede.district}</td>
							<td> ${sede.telf}</td>
							<td> ${sede.anexo}</td>
							<td> ${sede.city}</td>							
							<td>
								<button class="btn btn-orange btn-sm" onclick='editSede(${JSON.stringify(sede)})'> Editar </button>
								<button class="btn btn-danger btn-sm" onclick="destroySede(${sede.id})"> Eliminar </button>
							</td>
						</tr>
						`)
				})
			}
		});
	}

	function createSede() {
		getSedes();
		props.modal_create.modal();
	}

	function saveSede(form) { // send data on server

		event.preventDefault();
		let ruta = '/panel/sedes',
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
				getSedes();
				toastr.success(res.message);
				$(form).trigger('reset');
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

	function editSede(sede) {
		console.log(sede);		
		let form_edit = $('#form_edit')[0];
		form_edit.sede_id.value = sede.id;
		form_edit.name.value = sede.name;
		form_edit.address.value = sede.address;
		form_edit.district.value = sede.district;
		form_edit.telf.value = sede.telf;
		form_edit.anexo.value = sede.anexo;
		form_edit.city.value = sede.city;
		form_edit.maps_code.value = sede.maps_code;
		props.modal_edit.modal();
	}

	function updateSede(form) { // send data on server for update
		event.preventDefault();
		let ruta = `/panel/sedes/${form.sede_id.value}`,
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
				getSedes();
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

	function destroySede(sedeId) { // send postId on server for deleting register
		if(confirm('¿Seguro de eliminar el registro?')){
			let ruta = `/panel/sedes/${sedeId}/destroy`;
			spinner.show();
			$.ajax({
				url: ruta,
				type:'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					getSedes();
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