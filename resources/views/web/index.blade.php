@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- <ol class="carousel-indicators">
	  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	  <li data-target="#myCarousel" data-slide-to="1"></li>
	  <li data-target="#myCarousel" data-slide-to="2"></li>
	</ol> -->
	<div class="carousel-inner">
	<!-- Programación de slides dinámicos -->
	  @foreach($slides as $index => $slide)
	  @if($index===0)
	  <div class="carousel-item active">
	  @else
	  <div class="carousel-item ">
	  @endif
	    <img class="first-slide" src="{{asset('images/'.$slide->url_image)}}" alt="{{$slide->slidename}}">
	    <div class="container">
	      <div class="carousel-caption text-left">
	        <h1 class="text-xlg">{{$slide->headerline}}</h1>
	        <p>{{$slide->slidetext}}</p>
	        @if($slide->actionlink!='')
	        <p>
	        	<a class="btn btn-lg btn-orange" target="_blank" href="{{$slide->actionlink}}" role="button">{{$slide->textlink}}</a>
	        </p>
	        @endif
	      </div>
	    </div>
	  </div>
	  @endforeach
	</div>
	<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
	  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	  <span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
	  <span class="carousel-control-next-icon" aria-hidden="true"></span>
	  <span class="sr-only">Next</span>
	</a>
</div>

<div class="container">
	<div class="mt-4 news-content">
		<section class="news-item">
			<img src="{{asset('images/seal1.jpg')}}" class="img-fluid" alt="">
			<h5 class="mt-4"> Identificando el Sello Correcto</h5>
			<p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa ratione laborum nesciunt optio enim quasi consectetur dicta reiciendis sint, in commodi a.</p>
			<a class="text-blue" href="#"> <i class="fas fa-arrow-circle-right"></i> Leer más</a>
		</section>

		<section class="justify-content-center news-item">
			<img src="{{asset('images/seal2.jpg')}}" class="img-fluid" alt="">
			<h5 class="mt-4"> Sellos personalizados </h5>
			<p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa ratione laborum nesciunt optio enim quasi consectetur dicta reiciendis sint, in commodi a.</p>
			<a class="text-blue" href="#"> <i class="fas fa-arrow-circle-right"></i> Leer más</a>
		</section>

		<section class="justify-content-center news-item">
			<img src="{{asset('images/seal3.jpg')}}" class="img-fluid" alt="">
			<h5 class="mt-4"> Catálogos Disponibles </h5>
			<p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa ratione laborum nesciunt optio enim quasi consectetur dicta reiciendis sint, in commodi a.</p>
			<a class="text-blue" href="#"> <i class="fas fa-arrow-circle-right"></i> Leer más</a>
		</section>
	</div>
</div>


<div class="container-fluid bgparallax range mt-5">
	<div class="container mt-5">
		<div class="row mt-5">
			<section class="col-xs-12 col-sm-12 col-md-8 white">
				<h4>Lorem ipsum dolor sit amet</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque id consequuntur dolor eligendi fugiat facilis, asperiores quidem, perspiciatis blanditiis laudantium, eos, aut! Incidunt, beatae iusto error ab rem animi at!</p>
			</section>
			<section class="col-xs-12 col-sm-12 col-md-4 col align-self-center">
				<button type="button" class="btn btn-orange btn-lg col align-self-center">Alcance de Productos</button>
			</section>	
		</div>
	</div>
</div>

<div class="container-fluid bgparallax c mt-5">
	<div class="container mt-5">
		<div class="row mt-5">
			<section class="col-xs-12 col-sm-12 col-md-6">				
				<p><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla rerum ratione sapiente provident asperiores molestias, neque, error repellat deleniti amet itaque officia pariatur aliquid dolorem, aut quaerat sequi. Nam, repudiandae.</strong></p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla rerum ratione sapiente provident asperiores molestias, neque, error repellat deleniti amet itaque officia pariatur aliquid dolorem, aut quaerat sequi. Nam, repudiandae.</p>
			</section>
			<section class="col-xs-12 col-sm-12 col-md-6">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic rerum quasi provident quis voluptate ad ipsam labore 
				alias quisquam dolorum suscipit, ducimus ratione harum nesciunt. Tenetur, illo doloribus qui quibusdam!</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic rerum quasi provident quis voluptate ad ipsam labore alias quisquam dolorum suscipit, ducimus ratione harum nesciunt. Tenetur, illo doloribus qui quibusdam!</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic rerum quasi provident quis voluptate ad ipsam labore alias quisquam dolorum suscipit, ducimus ratione harum nesciunt. Tenetur, illo doloribus qui quibusdam!</p>
			</section>	
		</div>
	</div>
</div>
 
<div class="container mt-5">
	<div class="row">
		<h4>Comúnicate con nosotros</h4>
	</div>
	<div class="row mt-5">
		<section class="col-xs-12 col-sm-12 col-md-4 text-center">
			<div class="card" style="width: 18rem;">
			<hr style="width: 100%; border-top:10px solid #1D509E">
			  <div class="card-body">
			  	<div class="mt-2 mb-2"> <i class="fas fa-comments fa-7x" style="color: #1D509E;"></i> </div>
			    <h5 class="card-title mt-3">Chatea con nuestros Expertos</h5>
			    <h6 class="card-subtitle mb-2 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6>
			  </div>
			</div>
		</section>

		<section class="col-xs-12 col-sm-12 col-md-4 text-center">
			<div class="card" style="width: 18rem;">
			<hr style="width: 100%; border-top:10px solid #EF6A0B;">
			  <div class="card-body">
			  	<div class="mt-2 mb-2"> <i class="fas fa-envelope-open fa-7x" style="color: #EF6A0B;"></i> </div>			  	
			    <h5 class="card-title mt-3">Suscríbete para novedades</h5>
			    <h6 class="card-subtitle mb-2 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6>
			  </div>
			</div>
		</section>

		<section class="col-xs-12 col-sm-12 col-md-4 text-center">
			<div class="card" style="width: 18rem;">
			<hr style="width: 100%; border-top:10px solid #797979;">
			  <div class="card-body">
			  	<div class="mt-2 mb-2"> <i class="fas fa-phone fa-7x" style="color: #797979;"></i> </div>			  	
			    <h5 class="card-title mt-3">Llámanos si tienes dudas</h5>
			    <h6 class="card-subtitle mb-2 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6>
			  </div>
			</div>
		</section>
	</div>
</div>

<div class="container mt-5">
	<div class="row">
		<section class="col-xs-12 col-sm-12 col-md-10"><h4>Noticias y Eventos</h4></section>
		<section class="col-xs-12 col-sm-12 col-md-2 text-right">
			<a href="#" class="btn btn-secondary btn-sm">Más noticias</a>
		</section>
	</div>
	<div class="row mt-5">
		<section class="col-xs-12 col-sm-12 col-md-4 text-center">
			<img src="{{asset('images/new1.jpg')}}" class="img-fluid" alt="">
			<h5 class="text-blue">Lorem ipsum dolor sit amet, consectetur.</h3>
			<small>17, Enero</small>
		</section>
		<section class="col-xs-12 col-sm-12 col-md-4 text-center">
			<img src="{{asset('images/new2.jpg')}}" class="img-fluid" alt="">
			<h5 class="text-blue">Lorem ipsum dolor sit amet, consectetur.</h3>
			<small>17, Enero</small>
		</section>
		<section class="col-xs-12 col-sm-12 col-md-4 text-center">
			<img src="{{asset('images/new3.jpg')}}" class="img-fluid" alt="">
			<h5 class="text-blue">Lorem ipsum dolor sit amet, consectetur.</h3>
			<small>17, Enero</small>
		</section>
	</div>
</div>
@endsection