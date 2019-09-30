
<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
   		<form action="#" onsubmit="updatePost(this)" method="POST" id="form-edit">
   			<div class="modal-header">
   			  <h5 class="modal-title">Editar post</h5>
   			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   			    <span aria-hidden="true">&times;</span>
   			  </button>
   			</div>
   			<div class="modal-body">
   			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="post_id">
   			  <div class="row">
   			  	<div class="col-md-12">
   			  		<div class="form-group">
                     <label for="title">Título</label>
   			  			<input type="text" name="title" class="form-control" placeholder="Título de la noticia">
   			  		</div>
   			  	</div>
   			  </div>

   			  <div class="form-group">
   			  	<label for="bodyedit">Contenido de la noticia</label>
   			  	<textarea name="bodyedit" rows="4" class="form-control ckeditor"></textarea>
   			  </div>
   			  <div class="row">
   			  	<div class="col-xs-12 col-md-8">
   			  		<div class="form-group">
                     <label for="summary">Resúmen</label>
   			  			<textarea name="summary" rows="4" placeholder="Resúmen para motores de búsqueda..." class="form-control"></textarea>
   			  		</div>
   			  	</div>
   			  	<div class="col-xs-12 col-md-4">
   			  		<div class="form-group">
   			  			<label for="status">Estado</label>
                     <select name="status" class="form-control">
                        
                     </select>
   			  			
   			  		</div>
   			  	</div>
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