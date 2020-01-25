@extends('layouts.app')
@section('title','Reclamos registrados')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i> Reclamos</li>
					  </ol>
					</nav>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<!-- Buscador -->
						</div>
						
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Nombres</th>
									<th>Apellidos</th>
									<th>Razón Social</th>
									<th>Nro Documento</th>
									<th>Correo</th>
									<th>Acción</th>
								</thead>
								<tbody id="claims">
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
					   <div class="col-xs-12 col-md-4">
					       <div class="input-group custom-pagination">
					        <!-- Render pagination here -->
					       </div>
					     </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('panel.claimbook.edit')
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getClaims();
	});

	let props = {
		tbClaims : $("#claims"),
		modal_edit : $("#modal_edit"),
	}

	function getClaims(page=1) {
		//activando Spinner para realizar carga
		spinner.show();

		//Realizando la consulta via Ajax
		$.ajax({
			url:`/panel/claims-data?page=${page}`,
			type:'GET',
			dataType:'JSON',
			success:res => {
				//ocultamos spinner
				spinner.hide();
				//Vaciamos el elemento
				props.tbClaims.empty();
				//Llenando el elemento con la data recuperada
				res.data.forEach(queja=>{
					props.tbClaims.append(`
						<tr>
							<td> ${queja.id} </td>
							<td> ${queja.name}</td>
							<td> ${queja.last_name}</td>
							<td> ${queja.nrs}</td>
							<td> ${queja.doc_number}</td>
							<td> ${queja.email}</td>						
							<td>
								<button class="btn btn-orange btn-sm" onclick='responseClaim(${JSON.stringify(queja)})'> Responder </button>
							</td>
						</tr>
						`)
				})
			}
		});
	}


	function responseClaim(queja) {
		console.log(queja);		
		let form_edit = $('#form_edit')[0];
		form_edit.queja_id.value = queja.id;
		form_edit.booknumber.value = queja.book_number;
		form_edit.name.value = queja.name;
		form_edit.last_name.value = queja.last_name;
		form_edit.nrs.value = queja.nrs;
		form_edit.reason.value = queja.reason;
		form_edit.detail.value = queja.detail;
		form_edit.response.value = queja.request_client;
		form_edit.fecharegistro.value = queja.created_at;
		props.modal_edit.modal();
	}

	function updateClaim(form) { // send data on server for update
		event.preventDefault();
		let ruta = `/panel/claims/${form.queja_id.value}`,
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
				getClaims();
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