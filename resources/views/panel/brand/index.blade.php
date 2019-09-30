@extends('layouts.app')
@section('title','Marcas')
@section('content')
<div class="container" id="brand">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><span class="badge badge-secondary" id="counter"></span> Marcas </li>
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
							<button onclick="createBrand()" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</button>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-sm table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Marca</th>
									<th>Logo</th>
									<th>Estado</th>
									<th>Acción</th>
								</thead>
								<tbody id="brands">
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
	@include('panel.brand.create')
	@include('panel.brand.edit')
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getBrands();
	});

	const modal_create = $("#modal_create");
	const modal_edit = $("#modal_edit");
	let counter = $("#counter");

	function getBrands(page = 0) {
		spinner.show();
		tbBrands = $("#brands");
		let ruta = '/panel/brands-data';
		if(page != 0) ruta =`/panel/brands-data/?page=${page}`;

		$.ajax({
			url: ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res =>{
				tbBrands.empty();
				spinner.hide();
				counter.text(res.total);
				res.data.forEach(brand =>{
					tbBrands.append(`
						<tr>
							<td>${brand.id}</td>
							<td>${brand.name}</td>
							<td><button onclick="showImageModal('${brand.url_image}','${brand.name}');" class="btn btn-link">Ver logo</button></td>
							<td>${brand.status == 1 ? 'Activo' : 'Inactivo'}</td>
							<td>
								<button onclick='editBrand(${JSON.stringify(brand)});' class="btn btn-blue btn-sm"><i class="fa fa-pen"></i> Editar</button>
								<button onclick="deleteBrand(${brand.id})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</button>
							</td>
						</tr>
						`);
				});

				renderPagination(res, 'getBrands');
			},
			error: error =>{
				console.log(error);
			}
		});
	}
	function createBrand() {
		$("#showImage").attr('src','');
		modal_create.modal();

	}
	function saveBrand(form) {
		event.preventDefault();
		let formdata = new FormData($(form)[0]);

		spinner.show();
		let ruta = '/panel/brands';

		$.ajax({
			url: ruta,
			type: 'POST',
			headers: {'X-CSRF-TOKEN': form._token.value},
			data: formdata,
			contentType: false,
			cache: false,
			processData: false,
			success: res =>{
				spinner.hide();
				modal_create.modal('hide');
				getBrands();
				toastr.success(res.message,'Exito');

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
	function editBrand(brand) {
		console.log(brand);
		let formedit = $("#form-edit")[0];
		formedit.brand_id.value = brand.id;
		formedit.name.value = brand.name;
		$(formedit.status).empty();
		$(formedit.status).append(`
				<option ${brand.status == 1 ? 'selected':''} value="1">Activo</option>
				<option ${brand.status == 0 ? 'selected':''} value="0">Inactivo</option>
			`);

		$("#showImagedit").attr('src',`/allimages/${brand.url_image}`);
		modal_edit.modal();
	}
	function updateBrand(form) {
		event.preventDefault();
		let formdata = new FormData($(form)[0]);

		let ruta = `/panel/brands/${form.brand_id.value}`;

		spinner.show();
		$.ajax({
			url: ruta,
			type: 'POST',
			headers: {'X-CSRF-TOKEN': form._token.value},
			data: formdata,
			contentType: false,
			cache: false,
			processData: false,
			success: res =>{
				spinner.hide();
				modal_edit.modal('hide');
				getBrands();
				toastr.success(res.message,'Exito');

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

	function deleteBrand(brandId) {
		if(confirm('¿Seguro de eliminar el registro?')){
			let ruta = `/panel/brands/${brandId}/destroy`;
			spinner.show();
			$.ajax({
				url:ruta,
				type: 'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					getBrands();
					toastr.success(res.message,'Exito');
				},
				error: error =>{
					console.log(error);
				}
			});
		}
	}
</script>
@endsection