<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// Rutas sin auntenticación de usuarios
Route::get('/', function () {
    return view('web.index');
});
Route::get('productos','FrontController@getProducts')->name('products');
Route::get('productos/{categoria}','FrontController@getProductsOfCategory');
Route::get('productos/{categoria}/{tipo}','FrontController@getProduct');
Route::get('catalogos','FrontController@getCatalogs')->name('catalogs');
Route::get('noticias','FrontController@getNewsView')->name('news');
Route::get('noticias-data','FrontController@getNews');
Route::get('noticia/{slug}','FrontController@getNew')->name('new');
Route::get('eventos','FrontController@getEventsView')->name('events');
Route::get('eventos-data','FrontController@getEvents');
Route::get('evento','FrontController@getEvent')->name('event');
Route::get('videos','FrontController@getVideos')->name('videos');
Route::get('contacto','FrontController@getContact')->name('contact');

Route::get('nosotros', function () {
    return view('web.about');
});


// Peticion asyncrona
Route::get('profile/{id}/parts','FrontController@getParts');

// Rutas de autenticación
Auth::routes();
// Grupo de rutas Usuarios autenticados
Route::group(['middleware'=>'auth'],function(){

	//Rutas para usuarios autenticados
	
	// Grupo de rutas PANEL DE ADMINISTRACION
	Route::group(['prefix'=>'/panel'],function(){

		Route::get('/', 'HomeController@index')->name('dashboard');

		// Ruta para CRUD de Categorias y subcategorias
		Route::group(['middleware'=>'permision:manage_categorys'],function(){
			Route::resource('categories','CategoryController');
			Route::get('categories-data','CategoryController@getCategories');
			Route::get('categories-all-data','CategoryController@getCategoriesAll');
			/*Route::post('categories','CategoryController@store');*/

			Route::get('categories/{id}/destroy','CategoryController@destroy')->name('categories.destroy');
		});
		
		// Ruta para CRUD de mercados
		Route::group(['middleware'=>'permision:manage_markets'],function(){
			Route::resource('markets','MarketController');
			Route::get('markets/{id}/destroy','MarketController@destroy')->name('markets.destroy');
		});
		
		// Ruta para marcas
		Route::group(['middleware'=>'permision:manage_brands'],function(){
			Route::resource('brands','BrandController');
			Route::get('brands-data','BrandController@getBrands');
			Route::get('brands/{id}/destroy','BrandController@destroy')->name('brands.destroy');
		});
		
		// Ruta para productos
		Route::group(['middleware'=>'permision:manage_products'],function(){
			Route::get('profiles','ProfileController@index')->name('profiles.index');
			Route::get('profiles-data','ProfileController@getProfiles');
			Route::post('profiles','ProfileController@store');

			// Generar plantilla excel para perfiles
			Route::post('profiles/parts/template', 'ProfileController@generateTemplateExcelParts')->name('parts.template');

			// Lista toda las dimensiones
			Route::get('dimensions-data','ProfileController@getDimensions');

			// Ruta para listar partes del perfil | Panel
			Route::get('profiles/{id}/parts', 'ProfileController@getParts');
			
		});
		
		// Ruta para posts
		Route::group(['middleware'=>'permision:manage_posts'],function(){
			//Route::resource('posts','PostController');
			Route::get('posts','PostController@index')->name('posts.index');
			Route::get('posts-data','PostController@getPosts');
			Route::post('posts','PostController@store');
			Route::put('posts/{id}','PostController@update');
			Route::get('posts/{id}/photos','PostController@getPhotos');
			Route::get('posts/{id}/destroy','PostController@destroy')->name('posts.destroy');
			Route::post('posts/photos','PostController@savePhotos');
			Route::get('posts/photos/{id}/changemain','PostController@changeMainPhoto');
			Route::get('posts/photos/{id}/destroy','PostController@destroyPhoto');

			//Ruta para Videos
			Route::get('videos','VideoController@index')->name('videos.index');
			Route::get('videos-data','VideoController@getvideos');
			Route::post('videos','VideoController@store');
			Route::put('videos/{id}','VideoController@update');
			Route::get('videos/{id}/destroy','VideoController@destroy');

			//Ruta para Catálogos
			Route::get('catalogs','CatalogController@index')->name('catalog.index');
			Route::get('catalogs-data','CatalogController@getcatalogs');
			Route::post('catalogs','CatalogController@store');
			Route::put('catalogs/{id}','CatalogController@update');
			Route::get('catalogs/{id}/destroy','CatalogController@destroy');

			//Ruta para Slider
			Route::get('slides', 'SlideController@index')->name('slide.index');
			Route::get('slides-data', 'SlideController@getSlides');
			Route::post('slides','SlideController@store');
			Route::put('slides/{id}','SlideController@update');
			Route::get('slides/{id}/destroy', 'SlideController@destroy');
		});

		
		// Ruta para administradores
		Route::group(['middleware'=>'permision:manage_admin'],function(){
			Route::resource('users','UserController');
			Route::get('users/{id}/destroy','UserController@destroy')->name('users.destroy');
		});
		
	});
});

