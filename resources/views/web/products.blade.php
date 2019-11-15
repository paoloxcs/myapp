@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
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
			  @foreach($categories as $index => $category)
			  <div class="card filterbrowser">
			    <div class="card-header" id="head2">
			    	<a class="white" data-toggle="collapse" data-target="#colapso{{$index}}" aria-expanded="false" aria-controls="colapso{{$index}}">{{$category->name}} <i class="fas fa-caret-down"></i></a>		      
			    </div>
			    <div id="colapso{{$index}}" class="collapse {{$index == 0 ? 'show' : ''}}" aria-labelledby="head2" data-parent="#accordionExample">
			      <div class="card-body d-flex flexwrapper">
				      @foreach($category->products as $product)
				        <section class="category"><i class="fas fa-caret-right"></i> <a class="white" href="{{url('productos/'.$category->slug.'/'.$product->slug)}}">{{$product->name}}</a></section>
				      @endforeach
			      </div>
			    </div>
			  </div>
			@endforeach

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
				<h3>Productos</h3>
				<p></p>
			</div>

			<div class="row mt-3">
				@foreach($categories as $category)
					<article class="col-xs-12 col-sm-12 col-md-4 mt-4 product">
						<a href="{{url('productos/'.$category->slug)}}">					
							<img src="{{$category->url_image}}" alt="">
							<h4>{{$category->name}}</h4>
							<p class="mt-2">{!! substr($category->description, 0,80)  !!} ...</p>
						</a>
					</article>
				@endforeach
			</div>
		</section>
			
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/calculator.js')}}">
</script>

@endsection
