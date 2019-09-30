
<div class="modal" id="modal_photos" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Fotos del post</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
            	<div class="row">
            		<form action="#" onsubmit="savePhotos(this)" method="POST" enctype="multipart/form-data">
            			<input type="hidden" name="_token" value="{{ csrf_token() }}">
            			<input type="hidden" name="post_id" id="postphoto_id">
            			<div class="form-group">
            				<div class="input-group mb-3">
            				  <input type="file" name="photos[]" multiple class="form-control" accept="image/*" aria-describedby="basic-addon2">
            				  <div class="input-group-append">
            				    <button type="submit" class="btn btn-outline-secondary" type="button"><i class="fa fa-upload"></i> Subir fotos</button>
            				  </div>
            				</div>
            			</div>
            		</form>
            	</div>
            	<hr>
            	<div class="col-md-12 mt-2 list-photos" id="photos">
            		<!-- Render photos here -->
            	</div>

			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
			</div>
    </div>
  </div>
</div>