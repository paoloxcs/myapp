@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')
<div class="container">
	<div class="row mt-5">
		<h3>Eventos</h3>
	</div>

	<div class="row mt-1">
		<section class="col-12">
			<div class="input-group custom-pagination">
	        	<!-- Render pagination here -->
	       </div>
		</section>
	</div>

	<div class="row mt-3" id="events">
		{{-- <section class="col-xs-12 col-sm-4 col-md-4 mb-3">
			<a class="new" href="{{route('event')}}">
				<img src="http://pribatu.casdel.com.pe/images/images/CHARLAHALLITE.jpg" alt="">
				CASDEL realizará capacitación sobre Sellos para Cilindros Hidráulicos <br>
				<span>20-02-2019</span>
			</a>
		</section> --}}		
	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		getEvents();
	});

	let props = {
		ruta : '',
		eventList : $("#events"),
	}

	function getEvents(page = 0) {
		props.ruta = '/eventos-data';
		if(page != 0) props.ruta = `/eventos-data/?page=${page}`;

		spinner.show();
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res =>{
				console.log(res);
				spinner.hide();
				props.eventList.empty();
				res.data.forEach(event =>{
					props.eventList.append(`
						<section class="col-xs-12 col-sm-4 col-md-4 mb-3">
							<a class="new" href="/evento/${event.slug}">
								<img src="/allimages/${getImageMain(event.images)}" alt="${event.title}">
								${event.title} <br><span>${dateFormat(event.created_at)}</span>
							</a>
						</section>
						`);
				});
				
				renderPagination(res,'getEvents');
			},
			error: error =>{
				console.log(error);
			}
		});
	}

	function getImageMain(images) {
		let url_imagestr = '';
		images.forEach(img =>{
			if(img.is_main == true){
				url_imagestr = img.url_image;

			}
		});

		return url_imagestr;
	}
</script>
@endsection