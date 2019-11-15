<div class="modal" id="modal_create" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form onsubmit="saveCatalog(this);" action="#" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
				  <h5 class="modal-title">Nuevo Catálogo</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<section class="col-12">
							<div class="form-group">
							   <input type="text" name="name" class="form-control" placeholder="Nombre del Catálogo">
							</div>
						</section>
					</div>
					<div class="row">
						<section class="col-12 col-md-8">
							<div class="form-group">
							   <div class="input-group">
							      <select name="brand_id" class="form-control brands">
							         
							      </select>
							      <div class="input-group-append">
							         <a href="{{route('brands.index')}}" class="btn btn-warning"><i class="fa fa-plus"></i></a>
							      </div>
							   </div>
							</div>
						</section>

						<section class="col-4 col-md-4">
							<div class="form-group">
							   <input type="number" name="edicion" class="form-control" placeholder="Edición Ej: 20xx">
							</div>
						</section>
					</div>

					<div class="row">
						<section class="col-12 col-md-6">
							<label id="file-upload" for="file_upload" class="upload-content">
							   <div class="file-image">
							      <span id="text-info"><i class="fa fa-upload"></i> Cargar portada <small>(400 x 480px)</small></span>
							      
							      <img id="showImage">
							   </div>
							</label>
							<input id="file_upload" data-validate="true" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this,'showImage');">
							
						</section>
						<section class="col-12 col-md-6">
							<div class="form-group">
								<input data-validate="true" type="file" name="ruta" accept="pdf/*">
							</div>
						</section>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
				</div>
			</form>
		</div>
	</div>
</div>