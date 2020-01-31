
<div class="modal" id="modal_create" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
             <form action="#" onsubmit="saveUser(this)" method="POST">
                 <div class="modal-header">
                   <h5 class="modal-title">Nuevo usuario</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                   {{ csrf_field()}}
                   <div class="form-group">
                       <label for="">Seleccione rol</label>
                       <select name="role" class="form-control roles">
                           
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
                   <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="********">
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