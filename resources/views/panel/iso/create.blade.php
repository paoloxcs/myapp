<div class="modal" id="modal_create" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form onsubmit="saveIso(this);" action="#" method="POST">
				<div class="modal-header">
				  <h5 class="modal-title">Nueva Certificación</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<section class="col-12 col-md-6">
							<div class="form-group">
								<label for="name">Nombre de Certificación</label>
							   <input type="text" data-validate="true" name="name" class="form-control" placeholder="Ingrese aqui el nombre del ISO">
							</div>
						</section>
						<section class="col-12 col-md-6">
							<div class="form-group">
								<label for="description">Ingrese la descripción</label>
								<textarea name="description" data-validate="true" class="form-control" rows="4" required></textarea>
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