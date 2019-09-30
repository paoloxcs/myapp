
<div class="modal" id="modal_create" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
   		<form action="#" onsubmit="savePost(this)" method="POST" enctype="multipart/form-data">
   			<div class="modal-header">
   			  <h5 class="modal-title">Nuevo post</h5>
   			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			    <span aria-hidden="true">&times;</span>
   			  </button>
   			</div>
   			<div class="modal-body">
   			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              
   			  <div class="row">
   			  	<div class="col-md-12">
   			  		<div class="form-group">
   			  			<input type="text" name="title" class="form-control" placeholder="Título de la noticia">
   			  		</div>
   			  	</div>
   			  </div>

   			  <div class="form-group">
   			  	<label for="body">Contenido de la noticia</label>
   			  	<textarea name="body" rows="4" class="form-control ckeditor"></textarea>
   			  </div>
   			  <div class="row">
   			  	<div class="col-xs-12 col-md-8">
   			  		<div class="form-group">
   			  			<textarea name="summary" rows="4" placeholder="Resúmen para motores de búsqueda..." class="form-control"></textarea>
   			  		</div>
   			  	</div>
   			  	<div class="col-xs-12 col-md-4">
   			  		<div class="form-group">
   			  			<label id="file-upload" for="file_upload" class="upload-content">
   			  				<div class="file-image">
   			  					<span id="text-info"><i class="fa fa-upload"></i> Foto principal</span>
   			  					<img id="showImage">
   			  				</div>
   			  			</label>
   			  			<input id="file_upload" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this,'showImage');">
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