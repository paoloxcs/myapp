<div class="modal" id="modal_create" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form onsubmit="saveSede(this);" action="#" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
				  <h5 class="modal-title">Nueva Sede</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<section class="col-12 col-md-4">
							<div class="form-group">
							   <input type="text" name="name" class="form-control" placeholder="Nombre de la Sede">
							</div>
						</section>
						<section class="col-12 col-md-8">
							<div class="form-group">
							   <input type="text" name="address" class="form-control" placeholder="Dirección la Sede">
							</div>
						</section>
					</div>
					<div class="row">
						<section class="col-12 col-md-3">
							<div class="form-group">
							   <input type="text" name="district" class="form-control" placeholder="Distrito la Sede">
							</div>
						</section>

						<section class="col-12 col-md-3">
							<div class="form-group">
							   <input type="text" name="city" class="form-control" placeholder="Ciudad">
							</div>
						</section>

						<section class="col-12 col-md-3">
							<div class="form-group">
							   <input type="text" name="telf" class="form-control" placeholder="Teléfono">
							</div>
						</section>

						<section class="col-12 col-md-3">
							<div class="form-group">
							   <input type="text" name="anexo" class="form-control" placeholder="Anexo">
							</div>
						</section>
					</div>

					<div class="row">
						<section class="col-12">
							<label for="maps_code">Ingresar el Código de Maps</label>
							<textarea name="maps_code" rows="3" class="form-control" ></textarea>								
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