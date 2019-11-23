@extends('layouts.app')
@section('title', 'Nuevo rol')
@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-xs-12 col-md-6 mx-auto">
			<div class="card">
				<div class="card-header">
                    Editar rol 
                    <a href="{{route('roles.index')}}" class="btn btn-orange btn-sm float-right"><i class="fa fa-arrow-left"></i> Regresar</a>
                </div>
                <form action="{{route('roles.update', $role->id)}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nombre del rol</label>
                            <input type="text" name="name" class="form-control" value="{{old('name', $role->name)}}" placeholder="Ej: Supervisor">
                        </div>
                        <div class="form-group">
                            <h6><i class="fa fa-check"></i> Permisos para el rol</h6><br>
                            <div class="permissions">
                                @foreach ($permissions as $permission)     
                                    <div class="form-check form-check-inline p-2" title="{{$permission->name}}">
                                        <input type="checkbox" name="permissions[]" id="inline-checkbox{{$permission->id}}" {{$role->permissions->contains('id',$permission->id) ? 'checked' : ''}}  class="form-check-input" value="{{$permission->id}}">
                                        <label for="inline-checkbox{{$permission->id}}"  class="form-check-label">{{$permission->name}}</label>
                                    </div>
                                @endforeach
                                
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-blue btn-block"><i class="fa fa-save mr-2"></i> Actualizar</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection