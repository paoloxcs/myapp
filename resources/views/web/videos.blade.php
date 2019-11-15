@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')
<div class="container">
	<div class="row mt-5">
		<h3>Videos</h3>
	</div>
	<div class="row mt-3" id="videos">
		<!-- <section class="col-xs-12 col-sm-4 col-md-4 mb-3">
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/lzgqNiPWwtA" allowfullscreen></iframe>
			</div>
		</section>
		<section class="col-xs-12 col-sm-4 col-md-4 mb-3">
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/SJIFcsLWu8E" allowfullscreen></iframe>
			</div>
		</section>
		<section class="col-xs-12 col-sm-4 col-md-4 mb-3">
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/TxpA-2eEBBA" allowfullscreen></iframe>
			</div>
		</section> -->
	</div>
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getVideos();
	});
	let props = {
		ruta : '',
		videoList : $("#videos"),
	}
	function getVideos(page = 0) {
		props.ruta = '/videos-data';
		if(page != 0) props.ruta = `/videos-data/?page=${page}`;

		spinner.show();
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res =>{
				console.log(res);
				spinner.hide();
				props.videoList.empty();
				res.data.forEach(video =>{
					props.videoList.append(`
						<section class="col-12 col-sm-4 col-md-4 mb-3">
							<div class="embed-responsive embed-responsive-16by9">
							  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/${video.embed}" allowfullscreen></iframe>
							</div>
						</section>						
						`);
				});
				
				renderPagination(res,'getVideos');
			},
			error: error =>{
				console.log(error);
			}
		});
	}
</script>
@endsection