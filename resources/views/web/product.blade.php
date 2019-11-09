@extends('layouts.front')
@section('title')
{{$category->name}}
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
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
			  	      @foreach($category->products as $prod)
			  	        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="{{url('productos/'.$category->slug.'/'.$prod->slug)}}">{{$prod->name}}</a></section>
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
				@foreach ($product->docs as $doc)
					<section class="col-3">
						<a target="_blank" href="/docs/{{$doc->url_doc}}" class="orange-link">
							<i class="far fa-file-pdf"></i> {{$doc->name}}
						</a>
					</section>
				@endforeach
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
					    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#specs" role="tab" aria-controls="specs" aria-selected="true"><small>Especificación del producto</small></a>
					    <a class="nav-item nav-link" id="conditions-tab" data-toggle="tab" href="#conditions" role="tab" aria-controls="conditions" aria-selected="false"><small>Condiciones de operación</small></a>
					    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#compatible" role="tab" aria-controls="compatible" aria-selected="false"><small>Compatibilidad de fluídos</small></a>
					    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#material" role="tab" aria-controls="material" aria-selected="false"><small>Materiales disponibles</small></a>
					  </div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
					  <div class="tab-pane fade show active" id="specs" role="tabpanel" aria-labelledby="nav-home-tab">
					  	
					  	<div class="row mt-4">
					  		<section class="col-12">
					  			@if(session('msg'))
					  			<div class="alert alert-success">
					  				{{session('msg')}}
					  			</div>									
					  			@endif
					  		<table class="table" id="parts-table">
					  		  <thead class="thead-dark">
								<tr>
									<th scope="col">N° parte</th>
									@foreach ($product->dimensions as $dimen2)
										<th scope="col">{{$dimen2->sigla}}</th>
									@endforeach
									<th> Medida </th>
									<th width="10%" scope="col">Acción</th>
								</tr>
					  		  </thead>
					  		  <tbody>
					  		  	@foreach ($product->parts()->orderBy('id','DESC')->get() as $part)
					  		  		<tr>
					  		  			<td> {{$part->part_nro}} </td>
					  		  			
					  		  			@foreach (json_decode($part->dimensions) as $index => $part_dimen)
					  		  				<td> {{$part_dimen}}</td>
					  		  			@endforeach
					  		  			<td> {{$part->measurement->sigla}}</td>

					  		  			<td>
					  		  				{{-- <button class="btn btn-outline-orange btn-sm">Solicitar</button> --}}

					  		  				<button type="button" class="btn btn-outline-orange btn-sm" data-toggle="modal" data-target="#formPart{{$part->id}}">
					  		  				  Solicitar
					  		  				</button>
					  		  				{{-- Modal Quote --}}
					  		  				<div class="modal fade" id="formPart{{$part->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  		  				  <div class="modal-dialog" role="document">
					  		  				    <div class="modal-content">
					  		  				      <div class="modal-header">
					  		  				        <h5 class="modal-title" id="exampleModalLabel">Solicitar Información para {{$part->part_nro}}</h5>
					  		  				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  		  				          <span aria-hidden="true">&times;</span>
					  		  				        </button>
					  		  				      </div>
					  		  				      <form action="{{route('sendquotepart')}}" method="POST">
					  		  				      {{csrf_field()}}
					  		  				      <div class="modal-body">
					  		  				      	<input type="hidden" name="part_nro" value="{{$part->part_nro}}">
					  		  				       	<div class="row">
					  		  				       		<div class="col-12">
					  		  				       			<div class="form-group">
					  		  				       			  <label for="comment"><small>Comentario</small></label>
					  		  				       			  <textarea name="comment" id="comment" class="form-control form-control-sm" rows="3">Desearía más información sobre la Parte  {{$part->part_nro}}</textarea>
					  		  				       			</div>					  		  				       			
					  		  				       		</div>
					  		  				       	</div>
					  		  				       	<div class="row">
					  		  				       		<div class="col-12">
					  		  				       			<div class="form-group">
					  		  				       				<label for="name"><small>Nombres y Apellidos</small></label>
					  		  				       				<input type="name" name="name" class="form-control form-control-sm" placeholder="Ingrese sus nombres completos">
					  		  				       			</div>
					  		  				       		</div>
					  		  				       	</div>
					  		  				       	<div class="row">
					  		  				       		<div class="col-12">
					  		  				       			<div class="form-group">
					  		  				       				<label for="email"><small>Correo electrónico</small></label>
					  		  				       				<input type="email" name="email" class="form-control form-control-sm" placeholder="Ingreso un correo electrónico">
					  		  				       			</div>
					  		  				       		</div>
					  		  				       	</div>

					  		  				       	<div class="row">
					  		  				       		<div class="col-12 col-md-6">
					  		  				       			<div class="form-group">
					  		  				       				<label for="mobile"><small>Telf</small></label>
					  		  				       				<input type="text" name="mobile" class="form-control form-control-sm" placeholder="Ingreso un nro de teléfono/móvil">
					  		  				       			</div>
					  		  				       		</div>
					  		  				       		<div class="col-12 col-md-6">
					  		  				       			<div class="form-group">
					  		  				       				<label for="company"><small>Empresa</small></label>
					  		  				       				<input type="text" name="company" class="form-control form-control-sm" placeholder="Ingreso el nombre de la empresa en la que trabaja">
					  		  				       			</div>
					  		  				       		</div>
					  		  				       	</div>
					  		  				       	<div class="row">
					  		  				       		<div class="col-12">
					  		  				       			<div class="form-group form-check">
					  		  				       			  <input type="checkbox" class="form-check-input" id="exampleCheck1">
					  		  				       			  <label class="form-check-label" for="exampleCheck1"><small>Doy mi consentimiento para recibir comunicaciones sobre productos, servicios y eventos por de parte de CASDEL.</small></label>
					  		  				       			</div>
					  		  				       			
					  		  				       		</div>
					  		  				       	</div>
					  		  				       	
					  		  				      </div>
					  		  				      <div class="modal-footer">
					  		  				      	<div class="row">
					  		  				      		<div class="col-12">
					  		  				      			<button type="submit" class="btn btn-orange btn-sm">Enviar</button>
					  		  				      			<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
					  		  				      		</div>
					  		  				      	</div>				  		  				        
					  		  				      </div>
					  		  				      </form>
					  		  				    </div>
					  		  				  </div>
					  		  				</div>
					  		  				{{-- Modal Quote --}}
					  		  			</td>
					  		  		</tr>
					  		  	@endforeach
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
					  		</section>					  		
					  	</div>

					  </div>
					  <div class="tab-pane fade" id="compatible" role="tabpanel" aria-labelledby="compatible-tab">
					  	<div class="row mt-4">
					  		<section class="col-12">
					  			<p><strong>Leyenda:</strong>
					  				
					  				<span class="mx-3"><i class="fa fa-check text-success"></i> &nbsp; Recomendado</span>
					  				<span class="mx-3"><i class="fa fa-dot-circle text-primary"></i> &nbsp; Posible</span>
					  				<span class="mx-3"><i class="fa fa-times text-danger"></i> &nbsp; No adecuado</span>
					  				
					  			</p>
					  		</section>
					  		<section class="col-12">
								@foreach($compatibilities as  $compat)
								@if($compat->level == 1)
								<table class="table table-striped table-bordered table-sm">
										<thead>
											<tr>
											<th scope="col">{{$compat->name}}</th>
											<th scope="col" colspan="2">Aplicación</th>
											
											</tr>
										</thead>
										<tbody>
											@foreach($compatibilities as $compat2)
											@if($compat2->parent_id == $compat->id)
												<tr>
													<td scope="row">{{$compat2->name}}</td>
													<input type="hidden" name="compats[]" value="{{$compat2->id}}">
													
													@if($product->compatibilities->contains('compatibility_id', $compat2->id))
														@foreach ($product->compatibilities as $index => $prod_compat)
														@if($prod_compat->compatibility_id == $compat2->id)
															@if($prod_compat->type_field === 'DYNAMIC')
																<td align="center">
																	<p><small>Dinámica</small></p>
																	<i class="fa {{$prod_compat->value_field == 1 ? 'fa-check text-success' : ($prod_compat->value_field == 2 ? 'fa-dot-circle text-primary':'fa-times text-danger')}}">
																	</i>
																</td>
															@else
															<td align="center">
																	<p><small>Estática</small></p>
																	<i class="fa {{$prod_compat->value_field == 1 ? 'fa-check text-success' : ($prod_compat->value_field == 2 ? 'fa-dot-circle text-primary':'fa-times text-danger')}}">
																	</i>
																</td>
															@endif
														@endif
														@endforeach
														
													@endif
													
												</tr>
											@endif
												
											@endforeach
											
										</tbody>
									</table>
								@endif
								@endforeach
					  		</section>
					  	</div>
					  </div>

					  <div class="tab-pane fade" id="material" role="tabpanel" aria-labelledby="material-tab">
					  	<div class="row mt-4">
					  		<section class="col-12">
					  			<p><strong>Material:</strong>

					  				@foreach($product->materials as $mat)
									<h5 class="orange-text">{{$mat->name}}</h5>
					  				<table class="table table-bordered">
					  				  <thead class="thead-dark">
					  				    <tr>					  				      
					  				      <th scope="col"><small>Tipo</small></th>
					  				      <th scope="col"><small>Color</small></th>
					  				      <th scope="col"><small>Opciones</small></th>
					  				    </tr>
					  				  </thead>
					  				  <tbody>
					  				    <tr>					  				      
					  				      <td><small>{{$mat->type}}</small></td>
					  				      <td><small>{{$mat->colour}}</small></td>
					  				      <td><small>{{$mat->options}}</small></td>
					  				    </tr>
					  				  </tbody>
					  				</table>
					  				<p><strong>Información Adicional</strong></p>
					  				<ul>
					  					@if($mat->custom1!='')
					  						<li>{{$mat->custom1}}</li>
					  					@endif

					  					@if($mat->custom2!='')
					  						<li>{{$mat->custom2}}</li>
					  					@endif
					  					@if($mat->custom3!='')
					  						<li>{{$mat->custom3}}</li>
					  					@endif
					  					
					  					
					  				</ul>
					  				@endforeach
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
<script src="{{asset('js/calculator.js')}}"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script>
	$(document).ready(function(){
		$('#parts-table').DataTable();
		
	});
</script>
@endsection
