<div class="modal" id="modal_parts" role="modal">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5><i class="fas fa-water"></i> Gestionar Partes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<section class="col-12">
					<form action="">
						<div class="form-group">
							<h6><i class="fa fa-check"></i> Unidad de medida</h6><br>
							<div id="unit_measurements">

							</div>
						</div>
						<h6>Agregar Parte</h6>
						<table class="table table-striped table-bordered table-sm">
							<tbody>
								<tr>
									<td>
										<div class="form-group">
											<input class="form-control form-control-sm" type="text" name="part_nro" placeholder="nro part">
										</div>
									</td>
									<td>						  				
										<input type="file" class="form-control-file" name="file_pdf" id="exampleFormControlFile1">
									</td>
									

									<td width="8%">
										<button type="submit" class="btn btn-orange btn-sm"><i class="fa fa-save"></i> Guardar</button>
									</td>						  			
								</tr>
							</tbody>
						</table>
						<div id="dimensions">
								{{-- <td>
									<div class="form-group">
										<input class="form-control form-control-sm" type="text" placeholder="Ød1">
									</div>
								</td>
								<td>
									<div class="form-group">
										<input class="form-control form-control-sm" type="text" placeholder="ØD1">
									</div>
								</td><td>
									<div class="form-group">
										<input class="form-control form-control-sm" type="text" placeholder="L1">
									</div>
								</td> --}}
							</div>

					</form>
					
					<h6>Lista de partes ingresadas</h6>
					<table class="table table-striped table-bordered table-sm">
						 <thead>
						    <tr>
						      <th scope="col">Tipo</th>

						      <th scope="col">Ød1</th>
						      <th scope="col">ØD1</th>
							  <th scope="col">L1</th>
							  <th>U. Medida</th>

						      <th width="10%" scope="col">Acción</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<td><a href="#" class="orange-text"><i class="far fa-file-pdf fa-2x"></i></a> 0754300</td>
						  	<td>16</td>
						  	<td>26</td>
						  	<td>8</td>
							<td>METRIC</td>
						  	<td align="center">							  	
							  	<a href="#" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
						  	</td>
						  	
						  </tbody>
					</table>					
				</section>
			</div>
			<div class="modal-footer">
				{{-- <button type="submit" class="btn btn-orange col-md-4 mx-auto"><i class="fa fa-save"></i> Guardar</button> --}}
			</div>
		</div>
	</div>
</div>