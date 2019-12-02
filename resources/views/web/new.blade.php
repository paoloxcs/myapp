@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')

<div class="container">
	<div class="row mt-5">
		<section class="col-md-12">
			<h6>Publicado {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</h6>
			<h3>{{$post->title}}</h3>
			
		</section>
	</div>

	<div class="row mt-3">

		<section class="col-xs-12 col-sm-12 col-md-9">

			<img src="{{$post->getMainImage()->url_image}}" class="fullimage mb-2" alt="{{$post->title}}">

			{!!$post->body!!}

			<div class="mt-3">
				<h5>Fotos adicionales</h5>
				<div class="card">
					<div class="card-body">
						<div class="row">
							@foreach ($post->images as $image)
							@if($image->is_main != 1)
								<div class="col-xs-6 col-md-3">
									<img src="{{$image->url_image}}" alt="{{$post->title}}">
								</div>
							@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>

			<p>Compartir este post:</p>
			<div class="mt-2 d-flex">			
				<a class="social face" href="https://www.facebook.com/sharer.php?u={{url('noticia/'.$post->slug)}}">
					<i class="fab fa-facebook-f"></i>
				</a>
				<a class="social plus" href="https://plus.google.com/share?url={{url('noticia/'.$post->slug)}}">
					<i class="fab fa-google-plus-g"></i>
				</a>
				<a class="social tweet"href="https://twitter.com/intent/tweet?url={{url('noticia/'.$post->slug)}}&text={{$post->title}}">
					<i class="fab fa-twitter"></i>
				</a>
				<a class="social linked" href="https://www.linkedin.com/shareArticle?mini=true&url={{url('noticia/'.$post->slug)}}">
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
			    <a href="{{route('productfinder')}}" class="btn btn-orange">Buscador de Productos</a>
			  </div>
			</div>
		</section>
	</div>

	<div class="row mt-5">
		<section class="col-md-12">
			<h3>Otras Noticias</h3>			
		</section>
	</div>


	<div class="row mt-3">
		@foreach($relations as $relation)
		<section class="col-xs-12 col sm-12 col-md-4">
			<a class="new" href="{{route('new',$relation->slug)}}">
				<img src="{{$relation->getMainImage()->url_image}}" alt="">
				{{$relation->title}} <br>
				<span>{{date('d/m/Y',strtotime($relation->created_at))}}</span>
			</a>
		</section>
		@endforeach
	</div>
</div>


@endsection