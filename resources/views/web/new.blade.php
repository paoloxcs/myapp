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

			<img src="{{asset('allimages/'.$post->getMainImage()->url_image)}}" class="fullimage mb-2" alt="Empleo formal en la minería creció 10.9%">

			{!!$post->body!!}

			{{-- <p>De acuerdo con el tipo de empleador, los puestos de trabajo generados por las compañías (empresas mineras) constituyeron el 33.5% del total.</p>

			<p>Los puestos de trabajo generados por las contratistas (empresas mineras y empresas conexas) representaron el 66.5% restante.</p>

			<p>Por otro lado, el MEM aprobó, mediante Resolución Ministerial Nº 354-2018-MEM/DM, la creación de los comités de gestión e información minero-energética como un mecanismo de coordinación y articulación de alcance regional, en relación con el desarrollo sostenible de las actividades mineras y energéticas.</p>

			<p>El ministro de Energía y Minas, Francisco Ísmodes, adelantó que los referidos comités buscan atender las preocupaciones ambientales y asegurar el cumplimiento de los compromisos del Estado y empresa privada en las zonas mineras. </p>

			<p>“La conformación de estos comités permitirá al Gobierno nacional tener una coordinación más estrecha con los gobiernos regionales en la gestión de los nuevos proyectos mineros y energéticos. Facultará, además, a informar de manera proactiva a la población sobre los alcances de las actividades que se desarrollan y velar por el cumplimiento de los compromisos y las buenas prácticas medioambientales”, expresó.</p>

			<p><strong>Fuente: El Peruano</strong></p> --}}

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
			    <a href="#" class="btn btn-orange">Buscador de Productos</a>
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
				<img src="{{asset('allimages/'.$relation->getMainImage()->url_image)}}" alt="">
				{{$relation->title}} <br>
				<span>{{date('d/m/Y',strtotime($relation->created_at))}}</span>
			</a>
		</section>
		@endforeach

		{{-- <section class="col-xs-12 col sm-12 col-md-4">
			<a class="new" href="{{route('new')}}">
				<img src="http://www.casdel.com.pe/images/noticias/thumbnail_1537558031.jpg" alt="">
				Empleo formal en la minería creció 10.9% <br>
				<span>20-02-2019</span>
			</a>
		</section>

		<section class="col-xs-12 col sm-12 col-md-4">
			<a class="new" href="{{route('new')}}">
				<img src="http://www.casdel.com.pe/images/noticias/thumbnail_1537558031.jpg" alt="">
				Empleo formal en la minería creció 10.9% <br>
				<span>20-02-2019</span>
			</a>
		</section> --}}
	</div>


		


</div>


@endsection