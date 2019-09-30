
<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   		<form action="#" onsubmit="updateBrand(this);" method="POST" id="form-edit" enctype="multipart/form-data">
   			<div class="modal-header">
   			  <h5 class="modal-title">Nueva marca</h5>
   			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			    <span aria-hidden="true">&times;</span>
   			  </button>
   			</div>
   			<div class="modal-body">
               <input type="hidden" name="brand_id">
   			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="PUT">
   			  	<div class="form-group">
   			  		<input type="text" name="name" class="form-control" placeholder="Nombre de marca...">
   			  	</div>
   			  	<div class="form-group">
   			  		<label for="file_uploadedit" class="upload-content">
   			  			<div class="file-image">
   			  				<span id="text-info"><i class="fa fa-upload"></i> Remplazar logo</span>
   			  				
   			  				<img id="showImagedit">
   			  			</div>

   			  		</label>

   			  		<input id="file_uploadedit" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this,'showImagedit')">
   			  	</div>
               <div class="form-group">
                  <label for="status">Estado</label>
                  <select name="status" class="form-control">
                     
                  </select>
               </div>
   			</div>
   			<div class="modal-footer">
   			  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
   			  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
   			</div>
   		</form>
    </div>
  </div>
</div>