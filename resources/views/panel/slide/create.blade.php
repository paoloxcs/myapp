<div class="modal" id="modal_create" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form onsubmit="saveSlide(this);" action="#" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
				  <h5 class="modal-title">Nuevo Slide</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<section class="col-4">
							<div class="form-group">
								<label for="slidename"> Ingrese un nombre para el Slide </label>
								<input type="text" name="slidename" class="form-control" placeholder="ej: Rod Seals" required>
							</div>
						</section>
						<section class="col-8">
							<label id="file-upload" for="file_upload" class="upload-content">
							   <div class="file-image">
							      <span id="text-info"><i class="fa fa-upload"></i> Cargar portada <small>(608 x 206px, Max: 100Kb)</small></span>
							      
							      <img id="showImage">
							   </div>
							</label>
							<input id="file_upload" data-validate="true" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this,'showImage');">
						</section>
					</div>
					<div class="row">
						<section class="col-6">
							<div class="form-group">
								<label for="headerline">Ingrese Cabecera del Slide</label>
								<textarea name="headerline" class="form-control" rows="2" required></textarea>
							</div>
						</section>
						<section class="col-6">
							<label for="slidetext">Ingrese breve descripción del slide <small>Max: 100 caracteres</small> </label>
							<textarea name="slidetext" class="form-control" rows="3" required></textarea>						
						</section>
					</div>
					<div class="row">
						<section class="col-12"><h6>Campos opcionales</h6></section>
						<section class="col-6">
							<div class="form-group">
								<label for="textlink">Ingrese enlace (opcional)</label>
								<input type="text" name="textlink" class="form-control" placeholder="ej: Visitar, Ver Más">
							</div>
						</section>
						<section class="col-6">
							<div class="form-group">
								<label for="actionlink">Ingrese URL a donde dirigirá</label>
								<input type="text" name="actionlink" class="form-control" placeholder="ej: https://www.enlace.com">
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