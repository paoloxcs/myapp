@extends('layouts.app')
@section('title','Categorías')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="panel-title"><span class="badge badge-secondary" id="counter"></span> Categorías</div>
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
							<table class="table table-sm table-hover table-condesed table-bordered">
								<thead>
									<th>Id</th>
									<th>Nombre</th>
									<th>Portada</th>
									<th>Acción</th>
								</thead>
								<tbody id="categories">
									
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
	@include('panel.category.create')
	@include('panel.category.edit')
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getCategories();
	});

	const modal_create = $("#modal_create");
	const modal_edit = $("#modal_edit");
	let counter = $("#counter");

	function getCategories(page = 0) {
		let tbcategories = $("#categories"),
			ruta = '/panel/categories-data'; // Declaracion de variables

		if(page != 0) ruta = `/panel/categories-data/?page=${page}`;

		spinner.show();
		$.ajax({url: ruta,type: 'GET',dataType: 'JSON',
			success: response =>{
				tbcategories.empty();
				spinner.hide();
				counter.text(response.total);
				response.data.forEach(categ =>{
					
					tbcategories.append(`
							<tr>
								<td>${categ.id}</td>
								<td>${categ.name}</td>
								<td>
									<button onclick="showImageModal('${categ.url_image}','${categ.name}');" class="btn btn-link">Ver portada</button>
								</td>
								<td>
									<button onclick='editCategory(${JSON.stringify(categ)})' class="btn btn-blue btn-sm"><i class="fa fa-pen"></i> Editar</button>
									<button onclick="deleteCategory(${categ.id})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</button>
								</td>
							</tr>
						`);
				});

				renderPagination(response,'getCategories'); // Eviando parametros para la paginacion
			},
			error: error =>{
				console.log(error);
			}
		});
	}

	function saveCategory(form) { // Save category method
		event.preventDefault();
		if(validateForm(form)){
			let ruta = '/panel/categories',
				data = new FormData($(form)[0]);
			spinner.show();
			$.ajax({url: ruta, type: 'POST',data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: res =>{
					spinner.hide();
					if(res.status == 200){
						modal_create.modal('hide');
						getCategories();
						toastr.success(res.message,'Éxito');
						$(form).trigger('reset');
						$("#showImage").attr("src","");
					}

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

	function editCategory(category) {
		let formEdit = $("#form-edit")[0];
		$("#showImagedit").attr('src',`${category.url_image}`);
		modal_edit.modal();
		formEdit.categ_id.value = category.id;
		formEdit.name.value = category.name;
		formEdit.description.value = category.description;
		$(formEdit.status).empty();
		$(formEdit.status).append(`
				<option ${category.status == 1 ? 'selected': ''} value="1">Activo</option>
				<option ${category.status == 0 ? 'selected': ''} value="0">Inactivo</option>
			`);
	}

	function updateCategory(form) {
		event.preventDefault();
		if(validateForm(form)){
			let ruta = `/panel/categories/${form.categ_id.value}`,
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
					if(res.status == 200){
						modal_edit.modal('hide');
						getCategories();
						toastr.success(res.message,'Éxito');
					}

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

	function deleteCategory(categ_id) {
		if(confirm('¿Seguro de eliminar el registro?')){
			let ruta = `/panel/categories/${categ_id}/destroy`;
			spinner.show();
			$.ajax({
				url: ruta,
				type:'GET',
				dataType: 'JSON',
				success: res =>{
					spinner.hide();
					toastr.success(res.message,'Éxito');
					getCategories();
				},
				error: error =>{
					console.log(error);
				}
			});
		}
		
	}
</script>
@endsection