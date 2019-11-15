<div class="modal" id="modal_create" role="modal">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<form action="#" onsubmit="saveProduct(this);" method="POST">
				{{ csrf_field() }}
				<div class="modal-header">
					<h5><i class="fa fa-plus"></i> Nuevo producto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h6><i class="fa fa-check"></i> Datos básicos</h6>
					<hr>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="row">
								<div class="col-xs-12 col-md-8">
									<div class="form-group">
										<div class="input-group">
											<select name="category" class="form-control categories">
												
											</select>
											<div class="input-group-append">
												<a href="{{route('categories.index')}}" class="btn btn-warning"><i class="fa fa-plus"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<input type="text" name="name" class="form-control" placeholder="Nombre">
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<textarea name="summary" rows="3" class="form-control" placeholder="Escriba aquí un breve resumén"></textarea>
									</div>
								</div>
								<div class="col-md-4">
									<label id="file-upload" for="file_upload" class="upload-content">
										<div class="file-image">
											<span id="text-info"><i class="fa fa-upload"></i> Cargar foto <small>(384 x 216px)</small></span>
											
											<img id="showImage">
										</div>
									</label>
									<input id="file_upload" data-validate="true" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this,'showImage');">
								</div>
								<div class="col-md-12">
									{{-- Las unidades de medida tambien son renderizados desde la BD --}}
									<div class="form-group">
										<h6><i class="fa fa-check"></i> Unidad de medida</h6>
										<div class="unit_measurements">
											
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<hr>
									<div class="form-group">
										<h6><i class="fa fa-check"></i> Marque las dimensiones que corresponde:</h6><br>
										<div class="dimensions">

										</div>

									</div>
									<hr>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="body">Especificaciones del perfil</label>
								<textarea name="body" class="ckeditor"></textarea>
							</div>
						</div>

					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-orange col-md-4 mx-auto"><i class="fa fa-save"></i> Guardar</button>
				</div>
				
			</form>
		</div>
	</div>
</div>