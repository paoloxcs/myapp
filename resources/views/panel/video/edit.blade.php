<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
   		<form onsubmit="updateVideo(this);" action="#" method="POST" enctype="multipart/form-data" id="form_edit">
   			<div class="modal-header">
   			  <h5 class="modal-title">Actualizar Video</h5>
   			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			    <span aria-hidden="true">&times;</span>
   			  </button>
   			</div>
   			<div class="modal-body">
   			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="video_id">
              <input type="hidden" name="_method" value="PUT">

               <div class="row">
                  <section class="col-xs-12 col-md-8">
                     <div class="form-group">
                        <input type="text" name="nombre" class="form-control" placeholder="Título del Video">
                     </div>
                  </section>
                  <section class="col-xs-12 col-md-4">
                     <div class="form-group">
                        <input type="text" name="embed" class="form-control" placeholder="Código de vídeo">
                     </div>
                  </section>
               </div>

               <div class="row">
                  <section class="col-xs-12 col-md-7">
                     <div class="form-group">
                        <div class="input-group">
                           <select name="category_id" class="form-control categories">
                              
                           </select>
                           <div class="input-group-append">
                              <a href="{{route('categories.index')}}" class="btn btn-warning"><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                  </section>

                  <section class="col-xs-12 col-md-5">
                        <label for="file_upload_edit" class="upload-content">
                           <div class="file-image">
                              <span id="text-info"><i class="fa fa-upload"></i> Reemplazar foto <small>(500 x 320px)</small></span>
                              
                              <img id="editImage">
                           </div>
                        </label>
                        <input id="file_upload_edit" data-validate="true" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this,'editImage');">
                  </section>
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