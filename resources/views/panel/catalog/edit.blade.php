<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form onsubmit="updateCatalog(this);" action="#" method="POST" enctype="multipart/form-data" id="form_edit">
				<div class="modal-header">
				  <h5 class="modal-title">Actualizar Catálogo</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="catalog_id">
					<input type="hidden" name="_method" value="PUT">
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
							<div class="form-group">
								<label for="file_uploadedit" class="upload-content">
									<div class="file-image">
										<span id="text-info"><i class="fa fa-upload"></i> Remplazar portada <small>( Opcional)</small></span>
										
										<img id="showImagedit">
									</div>

								</label>

								<input id="file_uploadedit" type="file" name="url_image" accept="image/*" style="display: none;" onchange='readImage(this,"showImagedit");'>
							</div>
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