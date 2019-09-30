@extends('layouts.app')
@section('title','Nuevo registro')
@section('content')
<div class="container">
	<div class="row mt-3">
		<div class="col-xs-12 col-md-6 mx-auto">
			<div class="card">
				<div class="card-header">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					  	<li class="breadcrumb-item"><a href="{{route('markets.index')}}"><i class="fas fa-table"></i> Mercados</a></li>
					    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-plus"></i> Nuevo registro</li>
					  </ol>
					</nav>
				</div>
				<div class="card-body">
					<form action="{{route('markets.store')}}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<input type="text" name="name" class="form-control{{$errors->has('name') ? ' is-invalid' : ''}}" placeholder="Nombre de mercado..." value="{{old('name')}}">
							@if($errors->has('name'))
							<span class="invalid-feedback">
								{{ $errors->first('name') }}
							</span>
							@endif
						</div>
						<div class="form-group">
							<label id="file-upload" for="file_upload" class="upload-content">
								<div class="file-image">
									<span id="text-info"><i class="fa fa-upload"></i> Cargar imagen</span>
									<img id="showImage">
								</div>
							</label>
							@if($errors->has('url_image'))
							<span style="color: #ff0000;">{{ $errors->first('url_image') }}</span>
							@endif
							<input id="file_upload" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this);">
						</div>
						<div class="form-group text-center">
							<hr>
							<button type="submit" class="btn btn-orange"><i class="fa fa-save"></i> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection