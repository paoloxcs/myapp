
<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
   		<form onsubmit="updateCategory(this);" action="#" method="POST" id="form-edit" enctype="multipart/form-data">
   			<div class="modal-header">
   			  <h5 class="modal-title">Nueva categoría</h5>
   			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			    <span aria-hidden="true">&times;</span>
   			  </button>
   			</div>
   			<div class="modal-body">
   			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="categ_id">
   			  <div class="row">
   			  	<div class="col-xs-12 col-md-4">
   			  		<div class="form-group">
                     <label for="name">Categoría</label>
   			  			<input type="text" data-validate="true" name="name" class="form-control" placeholder="Nombre de categoría">
   			  		</div>
   			  		<div class="form-group">
   			  			<label  for="file_uploadedit" class="upload-content">
   			  				<div class="file-image">
   			  					<span id="text-info"><i class="fa fa-upload"></i> Remplazar portada <small>( Opcional)</small></span>
   			  					
   			  					<img id="showImagedit">
   			  				</div>

   			  			</label>

   			  			<input id="file_uploadedit" type="file" name="url_image" accept="image/*" style="display: none;" onchange='readImage(this,"showImagedit");'>
   			  		</div>
   			  	</div>
   			  	<div class="col-xs-12 col-md-8">
   			  		<div class="form-group">
                     <label for="description">Descripción</label>
   			  			<textarea name="description" data-validate="true" class="form-control" rows="4" placeholder="Describa la categoría"></textarea>
   			  		</div>
                  <div class="form-group">
                     <label for="status">Estado</label>
                     <select name="status" class="form-control">
                        
                     </select>
                  </div>
   			  	</div>
   			  </div>
   			</div>
   			<div class="modal-footer">
   			  <button type="submit" class="btn btn-primary"><i class="fa fa-sync-alt"></i> Actualizar</button>
   			  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
   			</div>
   		</form>
    </div>
  </div>
</div>