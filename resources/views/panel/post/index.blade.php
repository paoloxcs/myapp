@extends('layouts.app')
@section('title','Posts')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i> Posts</li>
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
							<button data-toggle="modal" data-target="#modal_create" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>título</th>
									<th>Tipo</th>
									<th>Creado por</th>
									<th>Acción</th>
								</thead>
								<tbody id="posts">
									
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
	@include('panel.post.create')
	@include('panel.post.edit')
	@include('panel.post.photos')
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getPosts();
	});

	let props = {
		tbPosts : $("#posts"),
		modal_create : $("#modal_create"),
		modal_edit : $("#modal_edit"),
		modal_photos : $("#modal_photos"),
		tbPhotos : $("#photos"),

	}

	function getPosts(page = 0) { // get posts with pagination
		
		spinner.show();
		let ruta = '/panel/posts-data';
		if(page != 0) ruta = `/panel/posts-data/?page=${page}`;
		$.ajax({
			url: ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res=>{
				spinner.hide();
				props.tbPosts.empty();
				res.data.forEach(post =>{
					props.tbPosts.append(`
							<tr class="${post.status == false ? 'table-warning': ''}">
								<td>${post.id}</td>
								<td>${post.title}</td>
								<td>${post.post_type == 'N' ? 'Noticia' : 'Evento'}</td>
								<td>${post.user.name}</td>
								<td>
									<button onclick="openModalPhotos(${post.id})" class="btn btn-link btn-sm"><i class="far fa-images"></i> Fotos</button>
									<button onclick='editPost(${JSON.stringify(post)});' class="btn btn-blue btn-sm"><i class="fa fa-pen"></i> Editar</button>
									<button onclick="destroyPost(${post.id})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</button>

								</td>
							</tr>
						`);
				});

				renderPagination(res,'getPosts');
			},
			error: error=>{
				console.log(error);
			}
		});
	}

	function savePost(form) { // send data on server

		event.preventDefault();
		let ruta = '/panel/posts',
			data = new FormData($(form)[0]);
			data.append('body', CKEDITOR.instances[form.body.name].getData());

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
				getPosts();
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

	function editPost(post) { //show form edit with data
		let form_edit = $("#form-edit")[0];
		form_edit.post_id.value = post.id;
		form_edit.title.value = post.title;
		CKEDITOR.instances[form_edit.bodyedit.name].setData(post.body);
		form_edit.summary.value = post.summary;

		$(form_edit.post_type).empty();
		$(form_edit.post_type).append(`
			<option ${post.post_type == 'N' ? 'selected' : ''} value="N">Noticia</option>
			<option ${post.post_type == 'E' ? 'selected' : ''} value="E">Evento</option>
		`);

		$(form_edit.status).empty();
		$(form_edit.status).append(`
				<option ${post.status == true ? 'selected': ''} value="1">Activo</option>
				<option ${post.status == false ? 'selected': ''} value="0">Inactivo</option>
			`);

		props.modal_edit.modal();
	}

	function updatePost(form) { // send data on server for update
		event.preventDefault();
		let ruta = `/panel/posts/${form.post_id.value}`,
			data = new FormData($(form)[0]);
		data.set('body',CKEDITOR.instances[form.bodyedit.name].getData());

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
				getPosts();
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

	function openModalPhotos(postId) {
		props.modal_photos.modal();
		$("#postphoto_id").val(postId);
		getPhotos(postId);

	}

	function getPhotos(postId) {
		let ruta = `/panel/posts/${postId}/photos`;
		spinner.show();
		$.ajax({
			url: ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res =>{
				spinner.hide();
				props.tbPhotos.empty();
				res.forEach(photo =>{
					props.
					tbPhotos.append(`
							<div class="photo-post">
								<img class="picture" src="${photo.url_image}" alt="">
								<div class="actions">
								${photo.is_main == true ? `
									<button class="btn btn-warning btn-sm btn-block disabled"><i class="fa fa-check"></i> Principal</button>

									` : `

									<button onclick="changeMain(${photo.id})" class="btn btn-secondary btn-sm btn-block">Establecer principal</button>
									<button onclick="destroyPhoto(${photo.id})" class="btn btn-danger btn-sm btn-block"><i class="fa fa-times"></i> Borrar</button>
									`}
									
								</div>
							</div>
						`);
				});
			},
			error: error =>{
				console.log(error);
			}
		});
	}

	function savePhotos(form) { // save photos of post
		event.preventDefault();
		let data = new FormData($(form)[0]),
			ruta = '/panel/posts/photos';
		spinner.show();
		$.ajax({
			url: ruta,
			type: 'POST',
			headers: {'X-CSRF-TOKEN': form._token.value},
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: res =>{
				spinner.hide();
				getPhotos(form.post_id.value);
				toastr.success(res.message);
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

	function changeMain(photoId) {
		let ruta = `/panel/posts/photos/${photoId}/changemain`;
		spinner.show();
		$.ajax({
			url: ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res =>{
				spinner.hide();
				getPhotos($("#postphoto_id").val());
				toastr.success(res.message);
			},
			error: error =>{
				console.log(error);
			}
		});
	}

	function destroyPhoto(photoId) {
		if (confirm('¿Seguro de borrar el registro?')) {
			let ruta = `/panel/posts/photos/${photoId}/destroy`;
			spinner.show();
			$.ajax({
				url: ruta,
				type: 'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					getPhotos($("#postphoto_id").val());
					toastr.success(res.message);
				},
				error: error =>{
					console.log(error);
				}
			});
		}
		
	}

	function destroyPost(postId) { // send postId on server for deleting register
		if(confirm('¿Seguro de eliminar el registro?')){
			let ruta = `/panel/posts/${postId}/destroy`;
			spinner.show();
			$.ajax({
				url: ruta,
				type:'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					getPosts();
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