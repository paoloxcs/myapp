
<div class="modal" id="modal_create" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   		<form action="#" onsubmit="saveBrand(this);" method="POST" enctype="multipart/form-data">
   			<div class="modal-header">
   			  <h5 class="modal-title">Nueva marca</h5>
   			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			    <span aria-hidden="true">&times;</span>
   			  </button>
   			</div>
   			<div class="modal-body">
   			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
   			  	<div class="form-group">
   			  		<input type="text" name="name" class="form-control" placeholder="Nombre de marca...">
   			  	</div>
   			  	<div class="form-group">
   			  		<label id="file-upload" for="file_upload" class="upload-content">
   			  			<div class="file-image">
   			  				<span id="text-info"><i class="fa fa-upload"></i> Cargar logo</span>
   			  				<img id="showImage">
   			  			</div>
   			  		</label>
   			  		<input id="file_upload" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this,'showImage')">
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