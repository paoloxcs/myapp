@extends('layouts.app')
@section('title', 'Nuevo rol')
@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-xs-12 col-md-6 mx-auto">
			<div class="card">
				<div class="card-header">
                    Nuevo rol 
                    <a href="{{route('roles.index')}}" class="btn btn-orange btn-sm float-right"><i class="fa fa-arrow-left"></i> Regresar</a>
                </div>
                <form action="{{route('roles.store')}}" method="POST">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nombre del rol</label>
                            <input type="text" name="name" class="form-control" placeholder="Ej: Supervisor" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <h6><i class="fa fa-check"></i> Permisos para el rol</h6><br>
                            <div class="permissions">
                                @foreach ($permissions as $permission)     
                                <div class="form-check form-check-inline p-2" title="{{$permission->name}}">
                                    <input type="checkbox" name="permissions[]" id="inline-checkbox{{$permission->id}}"  class="form-check-input" value="{{$permission->id}}">
                                    <label for="inline-checkbox{{$permission->id}}"  class="form-check-label">{{$permission->name}}</label>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-blue btn-block"><i class="fa fa-save mr-2"></i> Guardar</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection