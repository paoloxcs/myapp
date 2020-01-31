@extends('layouts.app')
@section('title','Usuarios del sistema')
@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i> Usuarios</li>
					  </ol>
					</nav>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<!-- Buscador -->
						</div>
						<div class="col-xs-12 col-md-4">
							<!-- Button New -->
							<button onclick="createUser()" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Nombres</th>
									<th>Correo electrónico</th>
									<th>Rol asignado</th>
									<th>Acción</th>
								</thead>
								<tbody id="users">
									
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
	@include('panel.user.create')
	@include('panel.user.edit')
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
	getUsers();
});

let props = {
	tbUsers : $('#users')
}


function getUsers(page = 1) {
	
	$.ajax({
		url: `/panel/users?page=${page}`,
		type:  'GET',
		dataType: 'JSON',
		cache: false,
		beforeSend: function(){
			spinner.show();
		},
		success: resp =>{
			props.tbUsers.empty();
			resp.data.forEach(user =>{
				props.tbUsers.append(`
					<tr>
						<td>${user.id}</td>
						<td>${user.name} ${user.last_name}</td>
						<td>${user.email}</td>
						<td>${user.role.name}</td>
						<td>
							<button onclick='editUser(${JSON.stringify(user)})' class="btn btn-blue btn-sm" ><i class="fa fa-pen"></i> Editar</button>
							<button onclick="destroyUser(${user.id})" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i> Eliminar</button>
						</td>
					</tr>
				`);
			});

			renderPagination(resp,'getUsers');

			spinner.hide();
		},
		error: err =>{
			console.log(err);
			spinner.hide();
		}
	});
}


async function createUser(){

	$('#modal_create').modal();
	let roles = await getRoles();
	$('.roles').empty();
	roles.forEach(role =>{
		$('.roles').append(`
			<option value="${role.id}">${role.name}</option>
		`);
	});
}

function saveUser(form){
	event.preventDefault();

	let data = $(form).serialize();

	$.ajax({
		url: '/panel/users',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		beforeSend: function(){
			spinner.show();
		},
		success: resp =>{

			$('#modal_create').modal('hide');
			getUsers();
			toastr.success(resp.message);
			spinner.hide();

			$(form).trigger('reset');

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

async function editUser(user){
	$('#modal_edit').modal();

	let roles = await getRoles();
	$('.roles').empty();
	roles.forEach(role =>{
		$('.roles').append(`
			<option ${user.role_id == role.id ? 'selected' : ''} value="${role.id}">${role.name}</option>
		`);
	});

	let form_edit = $('#form-edit')[0];
	form_edit.user_id.value = user.id;
	form_edit.email.value = user.email;
	form_edit.name.value = user.name;
	form_edit.last_name.value = user.last_name;


}


function updateUser(form){
	event.preventDefault();

	let data = $(form).serialize();

	$.ajax({
		url: `/panel/users/${form.user_id.value}`,
		type: 'POST',
		dataType: 'JSON',
		data: data,
		beforeSend: function(){
			spinner.show();
		},
		success: resp =>{

			$('#modal_edit').modal('hide');
			getUsers();
			toastr.success(resp.message);
			spinner.hide();

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

function destroyUser(user_id){
	if(confirm('¿Seguro de eliminar el usuario?')){
		$.ajax({
			url: `/panel/users/${user_id}/destroy`,
			type: 'GET',
			dataType: 'JSON',
			beforeSend: function(){
				spinner.show();
			},
			success: resp =>{
				toastr.success(resp.message);

				getUsers();
			},
			error: err =>{
				console.log(err);
			}
		});
	}
}

function getRoles(){
	return new Promise((resolve, reject) =>{
		$.ajax({
			url: '/panel/users/create',
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				
				resolve(resp);
			},
			error: err =>{
				reject(err);
			}
		});
	});
}

</script>
@endsection