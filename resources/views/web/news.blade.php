@extends('layouts.front')
@section('title','Sellos Hidráulicos | Orings | Retenes Radiales | Sellos Neumáticos | Fajas de Transmisión | Retenes')
@section('content')

<div class="container">
	<div class="row mt-3">
		<div class="col-xs-12 col-md-8">
			<h3>Noticias</h3>
		</div>
	   <div class="col-xs-12 col-md-4">
	       <div class="input-group custom-pagination">
	        <!-- Render pagination here -->
	       </div>
	     </div>
	</div>
	<div class="news-content" id="posts">
		
	</div>
	
</div>

@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getPosts();
	});

	let props = {
		ruta : '',
		postList : $("#posts"),
	}

	function getPosts(page = 0) {
		props.ruta = '/noticias-data';
		if(page != 0) props.ruta = `/noticias-data/?page=${page}`;

		spinner.show();
		$.ajax({
			url: props.ruta,
			type: 'GET',
			dataType: 'JSON',
			success: res =>{
				spinner.hide();
				props.postList.empty();
				res.data.forEach(post =>{
					props.postList.append(`
						<div class="news-item">
							<a href="/noticia/${post.slug}">
								<img src="${getImageMain(post.images)}" alt="">
							</a>
							<small>${dateFormat(post.created_at)}</small>
							<h4 class="title">
								<a href="/noticia/${post.slug}">${post.title}</a>
							</h4>
						</div>
						`);
				});
				
				renderPagination(res,'getPosts');
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