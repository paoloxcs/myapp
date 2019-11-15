@extends('layouts.app')
@section('title', 'Slides')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i>Slides</li>
					  </ol>
					</nav>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-8">
							<!-- Buscador -->
						</div>
						<div class="col-12 col-md-4">
							<button onclick="createSlide()" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Nombre</th>
									<th>Imagen</th>
									<th>Cabecera</th>
									<th>Enlace</th>
									<th>Estado</th>
									<th>Acciones</th>
								</thead>
								<tbody id="slides">
									
								</tbody>
							</table>							
						</div>
					</div>
					<div class="row mt-1">
						<div class="col-12">
							<div class="input-group custom-pagination">
								<!-- Render pagination here -->
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	@include('panel.slide.create')
	@include('panel.slide.edit')
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		getSlides();
	});
	let props={
		tbSlides: $('#slides'),
		modal_create: $('#modal_create'),
		modal_edit: $('#modal_edit')
	}

	function getSlides(page=1){
		spinner.show();

		$.ajax({
			url:`/panel/slides-data?page=${page}`,
			type: 'GET',
			dataType: 'JSON',
			success:res=>{
				spinner.hide();
				props.tbSlides.empty();

				res.data.forEach(slide=>{
					props.tbSlides.append(`
						<tr>
							<td> ${slide.id} </td>
							<td> ${slide.slidename} </td>
							<td width="100"> <img src="/images/${slide.url_image}" class="img-responsive" alt="${slide.slidename}" /> 
							</td>
							<td> ${slide.headerline} </td>
							<td> <a href="${slide.actionlink}" class="btn btn-orange btn-sm"> ${slide.textlink} </a> </td>
							<td> ${slide.status} </td>
							<td>
								<button class="btn btn-orange btn-sm" onclick='editSlide(${JSON.stringify(slide)})'> Editar </button>
								<button class="btn btn-danger btn-sm" onclick="destroySlide(${slide.id})"> Eliminar </button>
							</td>
						</tr>
						`)
				})
			}
		});
	}
	function createSlide() {
		props.modal_create.modal();
	}

	function saveSlide(form) { // send data on server

		event.preventDefault();
		let ruta = '/panel/slides',
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
				getSlides();
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

	function editSlide(slide) {
		console.log(slide);		
		let form_edit = $('#form_edit')[0];
		form_edit.slide_id.value = slide.id;
		props.modal_edit.modal();
	}

	function updateSlide(form) { // send data on server for update
		event.preventDefault();
		let ruta = `/panel/slides/${form.slide_id.value}`,
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
				getSlides();
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
	
	function destroySlide(slideId) { // send postId on server for deleting register
		if(confirm('¿Seguro de eliminar el slide?')){
			let ruta = `/panel/slides/${slideId}/destroy`;
			spinner.show();
			$.ajax({
				url: ruta,
				type:'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					getSlides();
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