@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">
            @if(session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i> Roles</li>
					  </ol>
					</nav>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<!-- Buscador -->
						</div>
						<div class="col-xs-12 col-md-4">
							<!-- Button New -->
							<a href="{{route('roles.create')}}"  class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo rol</a>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered table-sm">
								<thead>
									<th>Id</th>
									<th>Nombre</th>
									<th>Permisos</th>
									<th>Acción</th>
								</thead>
								<tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->permissions->count()}}</td>
                                            <td>
                                                <a href="{{route('roles.edit', $role->id)}}" class="btn btn-info btn-sm"><i class="fa fa-pen mr-2"></i>Editar</a>
                                                <a href="{{route('roles.destroy',$role->id)}}" onclick="return confirm('¿Seguro de realizar esta acción?')" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Eliminar</a>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection