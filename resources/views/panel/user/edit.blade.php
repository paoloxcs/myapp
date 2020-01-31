
<div class="modal" id="modal_edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
             <form action="#" onsubmit="updateUser(this)" method="POST" id="form-edit">
                 <div class="modal-header">
                   <h5 class="modal-title">Editar usuario</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                    {{ csrf_field()}}
                    {{ method_field('PUT')}}
                   <input type="hidden" name="user_id">
                   <div class="form-group">
                       <label for="">Seleccione rol</label>
                       <select name="role"  class="form-control roles">
                           
                       </select>
                   </div>
                   <div class="form-group">
                        <label for="">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" placeholder="Correo electrónico">
                    </div>
                   <div class="form-group">
                       <label for="">Nombres</label>
                       <input type="text" name="name" class="form-control" placeholder="Nombres">
                   </div>
                   <div class="form-group">
                    <label for="">Apellidos</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Apellidos">
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