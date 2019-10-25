@extends('layouts.app')
@section('title','Gestion Certificaciones para')
@section('content')
<div class="container">
	@if(session('message'))
	<div class="alert alert-success" role="alert">
	    <span> {{session('message')}} </span>
	</div>
	@endif
	<div class="row-mt-3">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Adicionar Isos</div>
				</div>
				<div class="card-body">
					<div class="row">
						<!-- form -->
					</div>
					<div class="row mt-2">
						<div class="table-responsive">
							<table class="table table-hover table-condensed table-bordered">
								<thead>
									<th>ID</th>
									<th>Certificación</th>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>ISO-9865</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row text-center">
						<button class="btn btn-orange"><i class="fa fa-save"></i> Cancelar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection