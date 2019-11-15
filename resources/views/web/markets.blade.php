@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')

<div class="container">
	<div class="row mt-3">
		<div class="col-md-12">
			<h3>Mercados</h3>
		</div>
	</div>
	<div class="row mt-3">
        @foreach($markets as $market)
            <article class="col-xs-12 col-sm-12 col-md-4 mt-4 product">
                <a href="{{url('mercado/'.$market->slug)}}">					
                    <img src="{{$market->url_image}}" alt="">
                    <h4>{{$market->name}}</h4>
                </a>
            </article>
        @endforeach
    </div>
	
</div>

@endsection