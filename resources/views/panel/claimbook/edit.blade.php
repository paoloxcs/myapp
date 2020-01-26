<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form onsubmit="updateClaim(this);" action="#" method="POST" id="form_edit">
				<div class="modal-header">
				  <h5 class="modal-title">Responder Reclamo</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="queja_id">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<section class="col-12 col-md-3">
							<div class="form-group">
								<label for="booknumber">Número de Libro</label>
							   <input type="text" name="booknumber" class="form-control" placeholder="Nro del Libro" readonly>
							</div>
						</section>
						<section class="col-12 col-md-4">
							<div class="form-group">
								<label for="name">Nombres</label>
							   <input type="text" name="name" class="form-control" placeholder="Nombres" readonly>
							</div>
						</section>
						<section class="col-12 col-md-5">
							<div class="form-group">
								<label for="last_name">Apellidos</label>
							   <input type="text" name="last_name" class="form-control" placeholder="Apellidos" readonly>
							</div>
						</section>
					</div>
					<div class="row">
						<section class="col-12 col-md-8">
							<div class="form-group">
								<label for="nrs">Razón Social</label>
						  		<input type="text" name="nrs" class="form-control" placeholder="Razón Social" readonly>
							</div>
						</section>

						<section class="col-12 col-md-4">
							<div class="form-group">
								<label for="fecharegistro">Ingresado el</label>
							   <input type="text" name="fecharegistro" class="form-control" readonly>
							</div>
						</section>
					</div>

					<div class="row">
						<section class="col-12">
							<div class="form-group">
								<label for="reason">Reclamo</label>
								<input type="text" name="reason" class="form-control" placeholder="Título del reclamo" readonly>
							</div>
						</section>
					</div>

					<div class="row">
						<section class="col-12">
							<div class="form-group">
								<label for="detail">Detalles de Reclamo</label>
							 	<input type="text" name="detail" class="form-control" placeholder="Detalle del reclamo" readonly>
							 </div>
						</section>
					</div>

					<div class="row">
						<section class="col-12">
							<label for="request_client">Solicitud del Cliente</label>
							<textarea name="request_client" id="request_client" class="form-control" rows="4" placeholder="Solicitud del Cliente" readonly></textarea>
						</section>
					</div>

					<div class="row">
						<section class="col-12">
							<label for="response">Responder Reclamo de Cliente</label>
							<textarea name="response" id="response" class="form-control" rows="4" placeholder="Ingrese la respuesta"></textarea>
						</section>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Ingresar Respuesta</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
				</div>
			</form>
		</div>
	</div>
</div>