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
			  	      @foreach($category->products as $prod)			  	      
			  	        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="{{url('products/'.$category->slug.'/'.$prod->slug)}}">{{$prod->name}}</a></section>
			  	      @endforeach
			        </div>
			      </div>
			    </div>

			</div>		

		<div class="row mt-5 mx-auto">
			<h5>Sellos a Medida</h5>
			<p>Además de nuestra amplia gama de productos almacenados, ofrecemos soluciones de sellado diseñadas a medida y sellos maquinados.</p>
			<button type="button" class="btn btn-outline-primary btn-lg btn-block">Arme su Sello</button>
		</div>



		</section>

		<section class="col-xs-12 col-sm-12 col-md-9">
			<div class="row">
				<h3>{{$category->name}}</h3>
				<p>{!! nl2br($category->description) !!}</p>

			</div>

			{{-- <div class="row mt-3">
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
				  <label class="form-check-label" for="inlineRadio1">Todos</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
				  <label class="form-check-label" for="inlineRadio2">Metric</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
				  <label class="form-check-label" for="inlineRadio3">Inch</label>
				</div>
			</div> --}}

			<div class="row mt-3 d-flex flex-wrap">
				{{-- <section class="profile">
					<a href="#">
						<div class="row d-flex align-items-center">
							<div class="col-6"><img src="http://localhost:8000/allimages/5dc44e11bf40f.jpg" class="img-fluid img-thumbnail" alt=""></div>
							<div class="col-6"><h3>15</h3></div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								
								<ul class="nav nav-tabs" id="myTab" role="tablist">
								  <li class="nav-item">
								    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
								  </li>
								  <li class="nav-item">
								    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
								  </li>
								</ul>

								
								<div class="tab-content" id="myTabContent">
								  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								  	<table class="table table-sm table-condensed table-borderless">
								  		<tbody>
								  			<tr>
								  				<td><small>Presión Máxima</small></td>
								  				<td><small class="orange-text">300 Bar</small></td>
								  			</tr>
								  			<tr>
								  				<td><small>Rango Temperatura</small></td>
								  				<td><small class="orange-text">-30°C a 150°C</small></td>
								  			</tr>
								  			<tr>
								  				<td><small>Velocidad Máxima</small></td>
								  				<td><small class="orange-text">0.5m/sec</small></td>
								  			</tr>
								  		</tbody>
								  	</table>									  	
								  </div>
								  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								  	<table class="table table-sm table-condensed table-borderless">
								  		<tbody>
								  			<tr>
								  				<td><small>Presión Máxima</small></td>
								  				<td><small class="orange-text">5000 P.S.I</small></td>
								  			</tr>
								  			<tr>
								  				<td><small>Rango Temperatura</small></td>
								  				<td><small class="orange-text">-400°F a 550°F</small></td>
								  			</tr>
								  			<tr>
								  				<td><small>Velocidad Máxima</small></td>
								  				<td><small class="orange-text">0.75ft/sec</small></td>
								  			</tr>
								  		</tbody>
								  	</table>									  	
								  </div>
								</div>
							</div>
						</div>
					</a>
				</section>

				<section class="profile">
					<a href="#">
						<div class="row d-flex align-items-center">
							<div class="col-6"><img src="http://localhost:8000/allimages/5dc44e11bf40f.jpg" class="img-fluid img-thumbnail" alt=""></div>
							<div class="col-6"><h3>15</h3></div>
						</div>
						<div class="row mt-2">
							<div class="col-12">
								
								<ul class="nav nav-tabs" id="myTab" role="tablist">
								  <li class="nav-item">
								    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Home</a>
								  </li>
								  <li class="nav-item">
								    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
								  </li>
								</ul>

								
								<div class="tab-content" id="myTabContent">
								  <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
								  	<table class="table table-sm table-condensed table-borderless">
								  		<tbody>
								  			<tr>
								  				<td><small>Presión Máxima</small></td>
								  				<td><small class="orange-text">300 Bar</small></td>
								  			</tr>
								  			<tr>
								  				<td><small>Rango Temperatura</small></td>
								  				<td><small class="orange-text">-30°C a 150°C</small></td>
								  			</tr>
								  			<tr>
								  				<td><small>Velocidad Máxima</small></td>
								  				<td><small class="orange-text">0.5m/sec</small></td>
								  			</tr>
								  		</tbody>
								  	</table>									  	
								  </div>
								  <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab">
								  	<table class="table table-sm table-condensed table-borderless">
								  		<tbody>
								  			<tr>
								  				<td><small>Presión Máxima</small></td>
								  				<td><small class="orange-text">5000 P.S.I</small></td>
								  			</tr>
								  			<tr>
								  				<td><small>Rango Temperatura</small></td>
								  				<td><small class="orange-text">-400°F a 550°F</small></td>
								  			</tr>
								  			<tr>
								  				<td><small>Velocidad Máxima</small></td>
								  				<td><small class="orange-text">0.75ft/sec</small></td>
								  			</tr>
								  		</tbody>
								  	</table>									  	
								  </div>
								</div>
							</div>
						</div>
					</a>
				</section> --}}
				@foreach($category->products as $product)
				<section class="profile">
					<a href="{{url('productos/'.$category->slug.'/'.$product->slug)}}">
						<div class="row d-flex align-items-center">
							<div class="col-6"><img src="{{$product->url_image}}" class="img-fluid img-thumbnail" alt=""></div>
							<div class="col-6"><h3>{{$product->name}}</h3></div>
						</div>
						<div class="row mt-2">
							@foreach($product->operating_conditions as $index => $opera)
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							@if($index==0)
							<li class="nav-item">
							  <a class="nav-link" id="home-tab" data-toggle="tab" href="#{{$opera->measurement->sigla}}{{$product->id}}" role="tab" aria-controls="home" aria-selected="true"><small>{{$opera->measurement->sigla}}</small></a>
							</li>
							@else
							<li class="nav-item">
							  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#{{$opera->measurement->sigla}}{{$product->id}}" role="tab" aria-controls="profile" aria-selected="false"><small>{{$opera->measurement->sigla}}</small></a>
							</li>
							@endif
							</ul>
							{{-- <p>{{$opera->measurement->sigla}}</p> --}}
							@endforeach

							<div class="tab-content" id="myTabContent">

							@foreach($product->operating_conditions as $index2 => $content)
							@if($index2==0)
							<div class="tab-pane fade show active" id="{{$content->measurement->sigla}}{{$product->id}}" role="tabpanel" aria-labelledby="home-tab">
								<table class="table table-sm table-condensed table-borderless">
									<tbody>
										<tr>
											<td><small>Presión Máxima</small></td>
											<td><small class="orange-text">{{$content->max_pressure}}</small></td>
										</tr>
										<tr>
											<td><small>Rango Temperatura</small></td>
											<td><small class="orange-text">{{$content->min_temp}} a {{$content->max_temp}}</small></td>
										</tr>
										<tr>
											<td><small>Velocidad Máxima</small></td>
											<td><small class="orange-text">{{$content->max_speed}}</small></td>
										</tr>
									</tbody>
								</table>
							</div>
							@else
							<div class="tab-pane fade show" id="{{$content->measurement->sigla}}{{$product->id}}" role="tabpanel" aria-labelledby="home-tab">
								<table class="table table-sm table-condensed table-borderless">
									<tbody>
										<tr>
											<td><small>Presión Máxima</small></td>
											<td><small class="orange-text">{{$content->max_pressure}}</small></td>
										</tr>
										<tr>
											<td><small>Rango Temperatura</small></td>
											<td><small class="orange-text">{{$content->min_temp}} a {{$content->max_temp}}</small></td>
										</tr>
										<tr>
											<td><small>Velocidad Máxima</small></td>
											<td><small class="orange-text">{{$content->max_speed}}</small></td>
										</tr>
									</tbody>
								</table>
							</div>
							@endif
								{{-- <p>{{$content->measurement->name}}</p> --}}
							@endforeach
							</div>
						</div>
						{{-- <p>ID Único de Producto {{$product->id}}</p> --}}
					</a>
				</section>				
				@endforeach
				{{-- @foreach($category->products as $product)
					<section class="profile">
						<a href="{{url('productos/'.$category->slug.'/'.$product->slug)}}">
							<div class="row d-flex align-items-center">
								<div class="col-6"><img src="{{$product->url_image}}" class="img-fluid img-thumbnail" alt=""></div>
								<div class="col-6"><h3>{{$product->name}}</h3></div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									@foreach($product->operating_conditions as $index => $opera)
									<pre>
										 {{$opera->measurement->sigla}}
										 {{$product->id}}
									</pre>
									{{$opera->measurement->sigla}}
									@if($index==0)
										<table class="table table-sm table-condensed table-borderless">
											<tbody>

												<tr>
													<td><small>Presión Máxima</small></td>
													<td><small class="orange-text">{{$opera->max_pressure}}</small></td>
												</tr>
												<tr>
													<td><small>Rango Temperatura</small></td>
													<td><small class="orange-text">{{$opera->min_temp}} a {{$opera->max_temp}}</small></td>
												</tr>
												<tr>
													<td><small>Velocidad Máxima</small></td>
													<td><small class="orange-text">{{$opera->max_speed}}</small></td>
												</tr>
											</tbody>
										</table>
									@else
										<table class="table table-sm table-condensed table-borderless">
											<tbody>

												<tr>
													<td><small>Presión Máxima</small></td>
													<td><small class="orange-text">{{$opera->max_pressure}} Bar</small></td>
												</tr>
												<tr>
													<td><small>Rango Temperatura</small></td>
													<td><small class="orange-text">{{$opera->min_temp}}° a {{$opera->max_temp}}°</small></td>
												</tr>
												<tr>
													<td><small>Velocidad Máxima</small></td>
													<td><small class="orange-text">{{$opera->max_speed}}mt/sec</small></td>
												</tr>
											</tbody>
										</table>
									@endif
									@endforeach

									
								</div>
							</div>
							
						</a>
					</section>
				@endforeach --}}
				
			</div>

		</section>
			
	</div>
</div>
@endsection
@section('scripts')
@endsection
