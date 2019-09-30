@extends('layouts.app')
@section('title','Videos')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i> Videos</li>
					  </ol>
					</nav>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-8">
							{{-- Buscador --}}
						</div>
						<div class="col-12 col-md-4">
							<!-- Button New -->
							<button onclick="createVideo()" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</button>
						</div>
					</div>

					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Título</th>
									<th>Categoría</th>
									<th>Portada</th>
									<th>Acción</th>
								</thead>
								<tbody id="videos">
									
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
	@include('panel.video.create')
	@include('panel.video.edit')
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function (){
		getVideos();
	});
	let props = {
		tbVideos : $('#videos'),
		modal_create : $("#modal_create"),
		modal_edit : $("#modal_edit")
	}
	function getVideos(page=1) {
		spinner.show();
		$.ajax({
			url:`/panel/videos-data?page=${page}`,
			type:'GET',
			dataType:'JSON',
			success:res => {
				spinner.hide();
				props.tbVideos.empty();
				res.data.forEach(video =>{
					props.tbVideos.append(`
							<tr>
								<td> ${video.id} </td>
								<td> ${video.nombre} </td>
								<td> ${video.category.name}	</td>
								<td width="120">
									<img src="/allimages/${video.url_image}" class="img-responsive" />
								</td>
								<td>
									<button class="btn btn-orange btn-sm" onclick='editVideo(${JSON.stringify(video)})'> Editar </button>
									<button class="btn btn-danger btn-sm" onclick="destroyVideo(${video.id})"> Eliminar </button>
								</td>
							</tr>
						`)
				});
			}
		});	
	}

	function createVideo() {
		getCategories();
		props.modal_create.modal();
	}

	function saveVideo(form) { // send data on server

		event.preventDefault();
		let ruta = '/panel/videos',
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
				getVideos();
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

	function getCategories(category_id = 0) {
		props.ruta = '/panel/categories-all-data';
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				$('.categories').empty();
				if(category_id!=0){
					resp.forEach(categ =>{
						$('.categories').append(`
							<option ${category_id===categ.id ? 'selected' : '' } value="${categ.id}">${categ.name}</option>
							`);
					});

				}else{
					$('.categories').append(`
						<option selected disabled>Elige una categoría</option>
						`);
					resp.forEach(categ =>{
						$('.categories').append(`
							<option value="${categ.id}">${categ.name}</option>
							`);
					});

				}
				
			},
			error: err =>{
				console.log(err);
			}
		});
	}

	function destroyVideo(videoId) { // send postId on server for deleting register
		if(confirm('¿Seguro de eliminar el registro?')){
			let ruta = `/panel/videos/${videoId}/destroy`;
			spinner.show();
			$.ajax({
				url: ruta,
				type:'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					getVideos();
					toastr.success(res.message);
				},
				error: error =>{
					console.log(error);
				}
			});
		}
		
	}

	function editVideo(video) {
		console.log(video);
		let form_edit = $('#form_edit')[0];
		form_edit.video_id.value = video.id;
		form_edit.nombre.value = video.nombre;
		form_edit.embed.value = video.embed;
		getCategories(video.categoria_id);
		props.modal_edit.modal();
	}


	function updateVideo(form) { // send data on server for update
		event.preventDefault();
		let ruta = `/panel/videos/${form.video_id.value}`,
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
				getVideos();
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