@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')

<div class="container">

	<div class="row mt-3">

		<section class="col-xs-12 col-sm-12 col-md-9">

			<img src="{{$market->url_image}}" class="fullimage mb-2" alt="{{$market->name}}">

			<div class="mt-3">
				<h5>Productos relacionados</h5>
				<div class="card">
					<div class="card-body">
						<div class="row">
							@foreach ($market->products as $prod)
								<div class="col-xs-6 col-md-3">
                                    <a href="/productos/{{$prod->category->slug}}/{{$prod->slug}}">
                                        <img src="{{$prod->url_image}}" alt="{{$prod->name}}">
                                        <p class="text-muted text-center">{{$prod->name}}</p>
                                    </a>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>

			<p>Compartir este mercado:</p>
			<div class="mt-2 d-flex">			
				<a target="_blank" class="social face" href="https://www.facebook.com/sharer.php?u={{url('mercado/'.$market->slug)}}">
					<i class="fab fa-facebook-f"></i>
				</a>
				<a target="_blank" class="social plus" href="https://plus.google.com/share?url={{url('mercado/'.$market->slug)}}">
					<i class="fab fa-google-plus-g"></i>
				</a>
				<a target="_blank" class="social tweet"href="https://twitter.com/intent/tweet?url={{url('mercado/'.$market->slug)}}&text={{$market->title}}">
					<i class="fab fa-twitter"></i>
				</a>
				<a target="_blank" class="social linked" href="https://www.linkedin.com/shareArticle?mini=true&url={{url('mercado/'.$market->slug)}}">
					<i class="fab fa-linkedin-in"></i>
				</a>
			</div>
			

		</section>

		<section class="col-xs-12 col-sm-12 col-md-3">
			<div class="card">
			<div class="card-header darkgray">
				<h5 class="card-title">Sellos para todo tipo de aplicaciones</h5>
			</div>	 
			  <div class="card-body gray">			    
			    <p class="card-text">Tenemos disponibles una alta gama de sellos para todo tipo de uso desde minería hasta la agricultura. Diseñados para trabajar ante las condiciones más extremas. Encuéntrelo aquí</p>
			    <a href="#" class="btn btn-orange">Buscador de Productos</a>
			  </div>
			</div>
		</section>
	</div>

</div>


@endsection