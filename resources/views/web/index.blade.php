@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">

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
	        <h1 class="text-xlg bg-slide-title">{{$slide->headerline}}</h1>
	        <p class="bg-slide-subtitle">{{$slide->slidetext}}</p>
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
			<h5 class="mt-4"> Asesoría </h5>
			<p class="mt-3">Ponemos a nuestros asesores comerciales a su servicio quienes darán soluciones técnicas a sus consultas. </p>
			<!-- <a class="text-blue" href="#"> <i class="fas fa-arrow-circle-right"></i> Leer más</a> -->
		</section>

		<section class="justify-content-center news-item">
			<img src="{{asset('images/seal2.jpg')}}" class="img-fluid" alt="">
			<h5 class="mt-4"> Ventas </h5>
			<p class="mt-3">Contamos con el mejor equipo de ventas para brindarle la más óptima solución a sus necesidades.</p>
			
		</section>

		<section class="justify-content-center news-item">
			<img src="{{asset('images/seal3.jpg')}}" class="img-fluid" alt="">
			<h5 class="mt-4"> Fabricación </h5>
			<p class="mt-3">Diseñamos una gran variedad de sellos a medida de acuerdo a sus requerimientos.</p>
			
		</section>
	</div>
</div>


<div class="container-fluid bgparallax range mt-5">
	<div class="container mt-5">
		<div class="row mt-5">
			<section class="col-xs-12 col-sm-12 col-md-8 white">
				<!-- <h4>Lorem ipsum dolor sit amet</h4> -->
				<p>Casdel Hnos S.A. es una empresa Peruana con 24 años en el mercado nacional, desde el 18 de Julio de 1991, ofreciendo a nuestros clientes calidad, garantía, confianza, mejores precios, stock amplio, atención rápida y soporte técnico en la distribución de elementos de estanqueidad como: orings, sellos hidráulicos, retenes radiales y fabricaciones de sellos especiales en nuestro torno CNC especial solo para sellos y de sobre medida según el requerimiento de nuestros clientes.</p>
			</section>
			<section class="col-xs-12 col-sm-12 col-md-4 col align-self-center">
				<a href="{{route('markets')}}" class="btn btn-orange btn-lg col align-self-center">Alcance de Productos</a>
			</section>	
		</div>
	</div>
</div>

<div class="container-fluid bgparallax c mt-5">
	<div class="container mt-5">
		<div class="row mt-5">
			<section class="col-xs-12 col-sm-12 col-md-6">				
				<p>Brindamos soluciones confiables, rentables e inmediatas a nuestros clientes bajo la asesoría técnica de nuestro staff durante proceso de venta y también post venta asegurando el óptimo funcionamiento de nuestros productos.</p>
				<p>Para el 2020 seremos reconocidos como una marca líder en distribución y fabricación de elementos de estanqueidad como: o´rings, sellos hidráulicos, retenes radiales y fabricaciones de sellos especiales en nuestro torno CNC y de sobre medida, comprometidos con la completa satisfacción de nuestros clientes.</p>
			</section>
			<section class="col-xs-12 col-sm-12 col-md-6">
				<ul>
					<li>Mejorar continuamente nuestro desempeño y eficacia de nuestro sistema gestión de la calidad.</li>
					<li>Brindar productos enfocados hacia el cliente, mejorando permanentemente nuestra tecnología para lograr su satisfacción.</li>
					<li>Cumplir con sus requisitos y exigencias recibidas mediante una constante retroalimentación; evaluando y midiendo la calidad del producto en base a los indicadores de procesos implementados para la mejora continua de la calidad.</li>
					<li>Definir metas y objetivos medibles, consistentes y dinámicos que permitan seguir y elevar nuestro desempeño empresarial.</li>
					<li>A proteger la seguridad y salud integral de todos los miembros de la organización mediante la prevención de las lesiones, dolencias, enfermedades e incidentes relacionados con el trabajo.</li>
				</ul>
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
			    <!-- <h6 class="card-subtitle mb-2 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6> -->
			  </div>
			</div>
		</section>

		<section class="col-xs-12 col-sm-12 col-md-4 text-center">
			<div class="card" style="width: 18rem;">
			<hr style="width: 100%; border-top:10px solid #EF6A0B;">
			  <div class="card-body">
			  	<div class="mt-2 mb-2"> <i class="fas fa-envelope-open fa-7x" style="color: #EF6A0B;"></i> </div>			  	
			    <h5 class="card-title mt-3">Suscríbete para novedades</h5>
			    <!-- <h6 class="card-subtitle mb-2 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6> -->
			  </div>
			</div>
		</section>

		<section class="col-xs-12 col-sm-12 col-md-4 text-center">
			<div class="card" style="width: 18rem;">
			<hr style="width: 100%; border-top:10px solid #797979;">
			  <div class="card-body">
			  	<div class="mt-2 mb-2"> <i class="fas fa-phone fa-7x" style="color: #797979;"></i> </div>			  	
			    <h5 class="card-title mt-3">Llámanos si tienes dudas</h5>
			    <!-- <h6 class="card-subtitle mb-2 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h6> -->
			  </div>
			</div>
		</section>
	</div>
</div>

<div class="container mt-5">
	<div class="row">
		<section class="col-xs-12 col-sm-12 col-md-10"><h4>Noticias y Eventos</h4></section>
		<section class="col-xs-12 col-sm-12 col-md-2 text-right">
			<a href="/noticias" class="btn btn-secondary btn-sm">Más noticias</a>
		</section>
	</div>
	<div class="row mt-5">
		@foreach($posts as $index => $post)		
		<section class="col-xs-12 col-sm-12 col-md-4 text-center">
			<a href="{{ $post->post_type == 'N' ? '/noticia/'.$post->slug : '/evento/'.$post->slug }}">
				<img src="{{$post->getMainImage()->url_image}}" class="img-fluid" alt="{{$post->title}}">
			</a>
			<h5 class="text-blue">{{$post->title}}</h3>
			<small>{{date('d/M/Y g:ia',strtotime($post->created_at))}}</small>
		</section>
		@endforeach
	</div>
</div>
@endsection