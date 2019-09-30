<div class="modal" id="modal_create" role="modal">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<form action="#" onsubmit="saveProfile(this);" method="POST">
				{{ csrf_field() }}
				<div class="modal-header">
					<h5><i class="fa fa-plus"></i> Nuevo perfil</h5>
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
										<input type="text" name="type" class="form-control" placeholder="Tipo">
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
									<div class="form-group">
										<h6><i class="fa fa-check"></i> Unidad de medida</h6>
										<div class="unit_measurements">
											<div class="form-check form-check-inline p-2">
												<input type="checkbox" name="unit_measurements[]" id="inline-checkbox1" class="form-check-input" value="METRIC">
												<label for="inline-checkbox1" class="form-check-label">Milimetrico</label>
											</div>
											<div class="form-check form-check-inline p-2">
												<input type="checkbox" name="unit_measurements[]" id="inline-checkbox2" class="form-check-input" value="INCH">
												<label for="inline-checkbox2" class="form-check-label">Pulgada</label>
											</div>
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
								
								{{-- <div class="col-md-12">
									<h6><i class="fa fa-check"></i> Condiciones de operación</h6>
									<div class="row">
										<div class="col-xs-12 col-md-6">
											<div class="form-group">
												<label for="max_pressure">Presión máxima</label>
												<div class="input-group input-group-sm">
													<input type="text" name="max_pressure" class="form-control">
													<div class="input-group-append">
														<span class="input-group-text">bar</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-md-6">
											<div class="form-group">
												<label for="max_speed">Velocidad máxima</label>
												<div class="input-group input-group-sm">
													<input type="text" name="max_speed" class="form-control">
													<div class="input-group-append">
														<span class="input-group-text">mt/sec</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-md-6">
											<div class="form-group">
												<label for="min_temp">Temperatura mínima</label>
												<div class="input-group input-group-sm">
													<input type="text" name="min_temp" class="form-control">
													<div class="input-group-append">
														<span class="input-group-text">°C</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-md-6">
											<div class="form-group">
												<label for="max_temp">Temperatura máxima</label>
												<div class="input-group input-group-sm">
													<input type="text" name="max_temp" class="form-control">
													<div class="input-group-append">
														<span class="input-group-text">°C</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div> --}}
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