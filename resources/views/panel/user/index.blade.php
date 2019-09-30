@extends('layouts.app')
@section('title','Usuarios del sistema')
@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i> Usuarios</li>
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
							<a href="{{route('users.create')}}" class="btn btn-orange"><i class="fa fa-plus"></i> Nuevo registro</a>
						</div>
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<th>Id</th>
									<th>Nombres</th>
									<th>Correo electrónico</th>
									<th>Rol asignado</th>
									<th>F. registro</th>
									<th>Acción</th>
								</thead>
								<tbody>
									@foreach($users as $user)
									<tr>
										<td>{{$user->id}}</td>
										<td>{{$user->uname}} {{$user->last_name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->rule->name}}</td>
										<td>{{date('d/m/Y',strtotime($user->created_at))}}</td>
										<td>
											<a class="btn btn-blue btn-sm" href="{{route('users.edit',$user->id)}}"><i class="fa fa-pen"></i> Editar</a>
											@if(Auth()->user()->id != $user->id)
											<a class="btn btn-danger btn-sm" href="{{route('users.destroy',$user->id)}}" onclick="return confirm('¡Advertencia!\n¿Seguro de eliminar el registro?');"><i class="fa fa-trash"></i> Eliminar</a>
											@endif
											
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