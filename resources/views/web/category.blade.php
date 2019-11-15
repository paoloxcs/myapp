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
			  	        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="{{url('productos/'.$category->slug.'/'.$prod->slug)}}">{{$prod->name}}</a></section>
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

			<div class="row mt-3 d-flex flex-wrap">
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
							@endforeach
							</div>
						</div>
					</a>
				</section>				
				@endforeach
				
			</div>

		</section>
			
	</div>
</div>
@endsection
@section('scripts')
@endsection
