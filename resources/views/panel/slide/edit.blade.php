<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form onSubmit="updateSlide(this);" action="#" method="POST" enctype="multipart/form-data" id="form_edit">
				<div class="modal-header">
				  <h5 class="modal-title">Actualizar Slide</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="slide_id">
					<input type="hidden" name="_method" value="PUT">
					<div class="row">
						<section class="col-4">
							<div class="form-group">
								<input type="text" name="slidename" class="form-control" placeholder="Nombre del Slide">
							</div>
						</section>
						<section class="col-8">
							<div class="form-group">
								<label for="file_uploadedit" class="upload-content">
									<div class="file-image">
										<span id="text-info"><i class="fa fa-upload"></i> Remplazar slide <small>( Opcional)</small></span>
										
										<img id="showImagedit">
									</div>

								</label>

								<input id="file_uploadedit" type="file" name="url_image" accept="image/*" style="display: none;" onchange='readImage(this,"showImagedit");'>
							</div>
						</section>
					</div>
					<div class="row">
						<section class="col-6">
							<div class="form-group">							   
							   <textarea name="headerline" class="form-control" rows="2">Ingrese Encabezado</textarea>
							</div>
						</section>
						<section class="col-6">
							<textarea name="slidetext" class="form-control" rows="3">Ingrese información de Slide</textarea>						
						</section>
					</div>
					<div class="row">
						<section class="col-12"><h6>Campos opcionales</h6></section>
						<section class="col-6">
							<div class="form-group">
								<input type="text" name="textlink" class="form-control" placeholder="">
							</div>
						</section>
						<section class="col-6">
							<div class="form-group">
								<input type="text" name="actionlink" class="form-control" placeholder="">
							</div>
						</section>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
				</div>
		</div>
	</div>
</div>