<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form onsubmit="updateSlide(this);" action="#" method="POST" enctype="multipart/form-data" id="form_edit">
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
								<label for="slidename"> Ingrese un nombre para el Slide </label>
								<input type="text" name="slidename" class="form-control" placeholder="Nombre del Slide" required>
							</div>
						</section>
						<section class="col-8">
							<div class="form-group">
								<label for="file_uploadedit" class="upload-content">
									<div class="file-image">
										<span id="text-info"><i class="fa fa-upload"></i> Remplazar slide <small>(Opcional | 608 x 206px | Max: 100Kb</small></span>
							      )</small></span>
										<img id="showImagedit">
									</div>

								</label>

								<input id="file_uploadedit" type="file" name="url_image" accept="image/*" style="display: none;" onchange='readImage(this,"showImagedit");'>
							</div>
						</section>
					</div>
					<div class="row">
						<section class="col-5">
							<div class="form-group">
								<label for="headerline">Ingrese Cabecera del Slide</label>						   
								<textarea name="headerline" class="form-control" rows="2" required></textarea>
							</div>
						</section>
						<section class="col-5">
							<div class="form-group">
								<label for="slidetext">Ingrese breve descripción del slide <small>Max: 100 caracteres</small> </label>
								<textarea name="slidetext" class="form-control" rows="3" required></textarea>
							</div>
						</section>
						<section class="col-2">
							<div class="form-group">
								<label for="status">Mostrar Slide</label>
								<select name="status" class="form-control">
									<option value="1" selected>Activo</option>
									<option value="0">Inactivo</option>
								</select>
							</div>
						</section>
					</div>
					<div class="row">
						<section class="col-12"><h6>Campos opcionales</h6></section>
						<section class="col-6">
							<div class="form-group">
								<label for="textlink">Ingrese enlace (opcional)</label>
								<input type="text" name="textlink" class="form-control" placeholder="">
							</div>
						</section>
						<section class="col-6">
							<div class="form-group">
								<label for="actionlink">Ingrese URL a donde dirigirá</label>
								<input type="text" name="actionlink" class="form-control" placeholder="">
							</div>
						</section>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
				</div>
			</form>
		</div>
	</div>
</div>