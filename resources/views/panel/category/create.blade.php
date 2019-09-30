
<div class="modal" id="modal_create" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
   		<form onsubmit="saveCategory(this);" action="#" method="POST" enctype="multipart/form-data">
   			<div class="modal-header">
   			  <h5 class="modal-title">Nueva categoría</h5>
   			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			    <span aria-hidden="true">&times;</span>
   			  </button>
   			</div>
   			<div class="modal-body">
   			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
   			  <div class="row">
   			  	<div class="col-xs-12 col-md-4">
   			  		<div class="form-group">
   			  			<input type="text" data-validate="true" name="name" class="form-control" placeholder="Nombre de categoría">
   			  		</div>
   			  		<div class="form-group">
   			  			<label id="file-upload" for="file_upload" class="upload-content">
   			  				<div class="file-image">
   			  					<span id="text-info"><i class="fa fa-upload"></i> Cargar portada <small>(384 x 216px)</small></span>
   			  					
   			  					<img id="showImage">
   			  				</div>

   			  			</label>

   			  			<input id="file_upload" data-validate="true" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this,'showImage');">
   			  		</div>
   			  	</div>
   			  	<div class="col-xs-12 col-md-8">
   			  		<div class="form-group">
   			  			<textarea name="description" data-validate="true" class="form-control" rows="4" placeholder="Describa la categoría"></textarea>
   			  		</div>
   			  	</div>
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