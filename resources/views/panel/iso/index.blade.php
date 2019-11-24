@extends('layouts.app')
@section('title', 'Certificaciones')
@section('content')
<div class="container" id="iso">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><span class="badge badge-secondary" id="counter"></span> <i class="fas fa-table"></i>Certificaciones ISOS</li>
					  </ol>
					</nav>					
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-8">
							<!-- Buscador -->
						</div>
						<div class="col-12 col-md-4">
							<button data-toggle="modal" data-target="#modal_create" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Nombre</th>									
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

	const modal_create = $("#modal_create");
	const modal_edit = $("#modal_edit");
	let counter = $("#counter");

	function getIsos(page=0) {

		let tbisos = $("#isos"),
			ruta = '/panel/isos-data'; // Declaracion de variables
		if(page != 0) ruta = `/panel/isos-data/?page=${page}`;

		spinner.show();
		

		$.ajax({url: ruta,type: 'GET',dataType: 'JSON',
			success:res=>{
				tbisos.empty();
				spinner.hide();
				counter.text(res.total);				
				res.data.forEach(iso=>{

					tbisos.append(`
						<tr>
							<td> ${iso.id} </td>
							<td title="${iso.description}"> ${iso.name} </td>							
							<td>
							<button class="btn btn-orange btn-sm" onclick='editIso(${JSON.stringify(iso)})'> Editar </button>
							<button class="btn btn-danger btn-sm" onclick="destroyIso(${iso.id})"> Eliminar </button>

							</td>
						`);
				});
				renderPagination(res, 'getIsos');
			},
			error: error =>{
				console.log(error);
			}
		});
	}


	function saveIso(form) { // Save category method
		event.preventDefault();
		if(validateForm(form)){
			let ruta = '/panel/isos',
				data = new FormData($(form)[0]);
			spinner.show();
			$.ajax({url: ruta, type: 'POST',data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: res =>{
					spinner.hide();
					// if(res.status == 200){
						modal_create.modal('hide');
						getIsos();
						toastr.success(res.message,'Éxito');
						$(form).trigger('reset');
					// }

					if (res.status == 422){
						for (var error in res.errors){
						    toastr.error(res.errors[error][0],'Advertencia');
						}
					}
					console.log(res);
				},
				error: err =>{
					if(err.status === 422){
						console.log(err.data);
					}
				}
			});
		}	
	}
	
	function editIso(iso) {
		let formedit = $("#form_edit")[0];
		modal_edit.modal();
		formedit.iso_id.value = iso.id;
		formedit.name.value = iso.name;
		formedit.description.value = iso.description;
		$(formedit.status).empty();
	}

	function updateIso(form) {
		event.preventDefault();
		if(validateForm(form)){
			let ruta = `/panel/isos/${form.iso_id.value}`,
				data = new FormData($(form)[0]);
			spinner.show();
			$.ajax({
				url: ruta,
				type:'POST',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: res =>{
					spinner.hide();
					// if(res.status == 200){
						modal_edit.modal('hide');
						getIsos();
						toastr.success(res.message,'Éxito');
					// }

					if (res.status == 422){
						for (var error in res.errors){
						    toastr.error(res.errors[error][0],'Advertencia');
						}
					}
					console.log(res);
				},
				error: error =>{
					console.log(error);
				}
			});
		}
		
	}

	function destroyIso(isoId) {
		if(confirm('¿Seguro de eliminar el registro?')){
			let ruta = `/panel/isos/${isoId}/destroy`;
			spinner.show();
			$.ajax({
				url: ruta,
				type:'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					toastr.success(res.message,'Éxito');
					getIsos();
				},
				error: error =>{
					console.log(error);
				}
			});
		}
		
	}
</script>
@endsection