@extends('layouts.front')
@section('title')
{{$category->name}}
@endsection
@section('content')

<div class="container">
	<div class="row mt-5">
		<section class="col-xs-12 col-sm-12 col-md-3">
			
			<div class="accordion" id="accordionExample">
			  <div class="card browser">
			    <div class="card-header" id="headingOne">
			      <h5 class="mb-0">	Filtro </h5>
			    </div>
			  </div>
			    <div class="card filterbrowser">
			      <div class="card-header" id="head2">
			      	<a class="white" data-toggle="collapse" data-target="#colapso1" aria-expanded="false" aria-controls="colapso1">{{$category->name}} <i class="fas fa-caret-down"></i></a>		      
			      </div>
			      <div id="colapso1" class="collapse show" aria-labelledby="head2" data-parent="#accordionExample">
			        <div class="card-body d-flex flexwrapper">
			  	      @foreach($category->products as $product)
			  	        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="{{url('productos/'.$category->slug.'/'.$product->slug)}}">{{$product->name}}</a></section>
			  	      @endforeach
			        </div>
			      </div>
			    </div>

			</div>		

		<div class="row mt-5 mx-auto">
			 @include('layouts.calculator')
		</div>

		<div class="row mt-5 mx-auto">
			<h5>Sellos a Medida</h5>
			<p>Además de nuestra amplia gama de productos almacenados, ofrecemos soluciones de sellado diseñadas a medida y sellos maquinados.</p>
			<button type="button" class="btn btn-outline-primary btn-lg btn-block">Arme su Sello</button>
		</div>



		</section>

		<section class="col-xs-12 col-sm-12 col-md-9">
			<div class="row">
				<section class="col-12"><h3><strong>{{$product->name}}</h3></strong></section>
			</div>

			<div class="row mt-2">
				<section class="col-3"><a href="#" class="orange-link"><i class="far fa-file-pdf"></i> Data en Métrica</a></section>
				<section class="col-3"><a href="#" class="orange-link"><i class="far fa-file-pdf"></i> Data en Pulgadas</a></section>
				<section class="col-3"><a href="#" class="orange-link"><i class="far fa-question-circle"></i> Hacer una pregunta</a></section>
			</div>

			<div class="row mt-4">
				<section class="col-9">
					<p class="graytext">{!! nl2br($product->body) !!}</p>					
				</section>
				<section class="col-3">
					<img src="{{$product->url_image}}" class="img-fluid img-thumbnail" alt="">
				</section>
			</div>

			<div class="row mt-4">
				<section class="col-12">
					<nav>
					  <div class="nav nav-tabs" id="nav-tab" role="tablist">
					    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#specs" role="tab" aria-controls="specs" aria-selected="true">Especificación del producto</a>
					    <a class="nav-item nav-link" id="conditions-tab" data-toggle="tab" href="#conditions" role="tab" aria-controls="conditions" aria-selected="false">Condiciones de operación</a>
					    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#compatible" role="tab" aria-controls="compatible" aria-selected="false">Compatibilidad de fluídos</a>
					  </div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
					  <div class="tab-pane fade show active" id="specs" role="tabpanel" aria-labelledby="nav-home-tab">
					  	<div class="row mt-4">
					  		<section class="col-12">
					  		<h5>Filtros</h5>
					  		<form>
							<div class="col-auto mb-2">
								<label for="unit_measurement">Unida de medida</label><br>
								@foreach($product->measurements as $index => $measurement)
									<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="unit_measurememt" id="inlineRadio{{$index}}" value="{{$measurement->id}}" {{$index == 0 ? 'checked' : 'disabled'}}>
									<label class="form-check-label" for="inlineRadio{{$index}}">{{$measurement->name}}</label>
									</div>
								@endforeach
							</div>
					  		  <div class="form-row align-items-center">
					  		    <div class="col-auto">
					  		      <div class="input-group mb-2">
					  		        <div class="input-group-prepend">
					  		          <div class="input-group-text"> Nro parte </div>
					  		        </div>
					  		        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="99999999">
					  		      </div>
								  </div>
								

					  		    {{-- @foreach($product->dimensions as $dimen)
					  		    <div class="col-auto">					  		      
					  		      <div class="input-group mb-2">
					  		        <div class="input-group-prepend">
					  		          <div class="input-group-text"> {{$dimen->dimension->sigla}} </div>
					  		        </div>
					  		        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="valor">
					  		      </div>
					  		    </div>
								  @endforeach --}}

					  		    <div class="col-auto">
					  		      <button type="submit" class="btn btn-orange mb-2">Actualizar</button>
					  		    </div>
					  		  </div>
					  		</form>
					  		</section>
					  	</div>

					  	<div class="row mt-4">
					  		<section class="col-12">
					  		<table class="table">
					  		  <thead class="thead-dark">
					  		    {{-- <tr>
					  		      <th scope="col">Nro Parte</th>
					  		      @foreach($product->dimensions as $dimen2)
					  		      <th scope="col">{{$dimen2->dimension->sigla}}</th>					  		      
					  		      @endforeach
					  		    </tr> --}}
					  		  </thead>
					  		  <tbody id="parts">
					  		  	
					  		  </tbody>
					  		 
					  		</table>
					  		</section>
					  		
					  	</div>


					  </div>
					  <div class="tab-pane fade" id="conditions" role="tabpanel" aria-labelledby="conditions-tab">
					  	<div class="row mt-4">
					  		<section class="col-12">
					  			{{-- <h5>Condiciones Operativas</h5> --}}

					  			<div class="col-auto mb-2">
					  				{{-- <label for="unit_measurement">Unida de medida</label><br> --}}
					  				{{-- @foreach($product->unit_measurements as $index => $measurement)
					  					<div class="form-check form-check-inline">
					  					<input class="form-check-input" type="radio" name="unit_measurememt" id="inlineRadio{{$index}}" value="{{$measurement->id}}" {{$measurement->enabled == 1 ? 'checked' : 'disabled'}}>
					  					<label class="form-check-label" for="inlineRadio{{$index}}">{{$measurement->name}}</label>
					  					</div>
					  				@endforeach --}}
					  			</div>
								@foreach ($product->operating_conditions as $opera)
									<ul class="list-group">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span>Presión Máxima <small class="badge badge-info">{{$opera->measurement->sigla}}</small></span>	 
											<span class="badge badge-secondary badge-pill"> {{$opera->max_pressure}} </span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span>Rango de Temperatura <small class="badge badge-info">{{$opera->measurement->sigla}}</small></span> 					  			    
											<span class="badge badge-secondary badge-pill">{{$opera->min_temp}}</span>
											<span class="badge badge-secondary badge-pill">{{$opera->max_temp}}</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span>Velocidad máxima <small class="badge badge-info">{{$opera->measurement->sigla}}</small></span> 
											<span class="badge badge-secondary badge-pill">{{$opera->max_speed}}</span>
										</li>
									</ul>	  		
									
								@endforeach
				  				
				  				{{-- <h6 class="graytext mt-4"><strong>Presión Máxima</strong></h6>
				  				<div class="progress" style="height: 10px;">				  					
				  				  <div class="progress-bar bg-orange" role="progressbar" style="width: {{ceil($product->max_pressure/10)}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>				  				  
				  				</div>
				  				<p class="graytext"><small>{{$product->max_pressure}} bar | {{round($product->max_pressure / 0.06895,2)}} p.s.i.</small></p>
					  				
				  				<h6 class="graytext mt-4"><strong>Rango de temperatura</strong></h6>

				  				<div class="progress" style="height: 10px;">				  				  
				  				  <div class="progress-bar bg-info" role="progressbar" style="width: {{ceil((($product->min_temp_range*-1)*100)/150)}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="150"></div>
				  				  <div class="progress-bar bg-orange" role="progressbar" style="width: {{ceil(($product->max_temp_range*100)/150)}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="150"></div>
				  				</div>
				  				<div class="col-12 d-flex justify-content-between">
				  					<p class="graytext"><small>{{$product->min_temp_range}}°C | {{round(($product->min_temp_range*1.8))+32}}°F</small></p>
				  					<p class="graytext"><small>{{$product->max_temp_range}}°C | {{round(($product->max_temp_range*1.8))+32}}°F</small></p>
				  					
				  				</div>

				  				<h6 class="graytext mt-4"><strong>Velocidad máxima</strong></h6>			  				

				  				<div class="progress" style="height: 10px;">	  				  
				  				  <div class="progress-bar position-relative bg-orange" role="progressbar" style="width: {{$product->max_speed*10}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">				  				  	
				  				  </div>
				  				</div>
				  				<p class="graytext"><small>{{$product->max_speed}} m/sec | {{round(($product->max_speed*3.28084),2)}} ft/s</small></p>	 --}}				  									  			
					  		</section>					  		
					  	</div>

					  </div>
					  <div class="tab-pane fade" id="compatible" role="tabpanel" aria-labelledby="compatible-tab">
					  	<div class="row mt-4">
					  		<section class="col-12">
					  			{{-- <p><strong>Leyenda:</strong>
					  				@foreach($fluid_keys as $fkey)
					  					<span class="mx-3"><i class="fa {{$fkey->sigla=='R'?'fa-check text-success':($fkey->sigla=='P'?'fa-dot-circle text-primary':'fa-times text-danger')}}"></i> &nbsp; {{$fkey->name}}</span>
					  				@endforeach
					  			</p> --}}
					  		</section>
					  		<section class="col-12">
					  			<table class="table table-sm">					  				
					  		  		<thead class="thead-dark">
					  		  			{{-- <tr>
					  		  				<th> &nbsp; </th>
					  		  				@foreach($type_applications as $typeapp)
					  		  				<th>{{$typeapp->name}}</th>
					  		  				@endforeach
					  		  			</tr> --}}
					  		  		</thead>
					  		  		{{-- <tbody>
					  		  			@foreach($fluid_groups as $group)
					  		  				<tr>
					  		  					<td>
					  		  						<strong><span class="orange-text">{{$group->name}}</span></strong>
					  		  					</td>
					  		  					<td> &nbsp; </td>
					  		  					<td> &nbsp; </td>
					  		  				</tr>
					  		  				@foreach($group->items as $item)
					  		  				<tr>
					  		  						<td><small class="graytext">{{ $item->name}}</small></td>
					  		  						@foreach($item->profile_compatibilities as $comp)
					  		  						<td align="center">
					  		  							<i class="fa {{$comp->fluid_key->sigla=='R'?'fa-check text-success':($comp->fluid_key->sigla=='P'?'fa-dot-circle text-primary':'fa-times text-danger')}}">
					  		  							</i>
					  		  							{{$comp->fluid_key->sigla}}
					  		  						</td>
					  		  						@endforeach
					  		  				</tr>
					  		  				@endforeach
					  		  			@endforeach
					  		  		</tbody> --}}
					  		  	</table>
					  		</section>
					  	</div>
					  </div>
					</div>
				</section>
			</div>			


		</section>
			
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/calculator.js')}}">
	
</script>
<script>
	$(document).ready(function(){
		//getParts();
	});
	let props = {
		profile_id : {{$product->id}},
		tbParts : $("#parts"),
		ruta : '',
	}
	function getParts() {
		props.ruta = `/profile/${props.profile_id}/parts`;
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: resp =>{
				props.tbParts.empty();
				resp.forEach(part =>{
					props.tbParts.append(`
						<tr>
							<td>${part.part_nro}</td>
							${renderValues(part.dimensions_profile)}

						</tr>
						`);
				});
			},
			error: err =>{
				console.log(err);
			}
		});
	}
	function renderValues(dimension_values) {
		let html = '';
		dimension_values.forEach(value =>{
			html += `<td>${value.pivot.value_field} - ${value.dimension.sigla}</td>`;
		});
		return html;
	}
</script>
@endsection
