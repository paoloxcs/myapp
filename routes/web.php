<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// Rutas sin auntenticación de usuarios

Route::get('/','FrontController@index');
// Route::get('/', function () {
//     return view('web.index');
// });
Route::get('productos','FrontController@getProducts')->name('products');
Route::get('productos/{categoria}','FrontController@getProductsOfCategory');
Route::get('productos/{categoria}/{tipo}','FrontController@getProduct');

Route::get('catalogos','FrontController@getCatalogsViews')->name('catalogs');
Route::get('catalogos-data', 'FrontController@getCatalogs');
Route::get('editions-data', 'FrontController@getAllEditions');

Route::get('noticias','FrontController@getNewsView')->name('news');
Route::get('noticias-data','FrontController@getNews');
Route::get('noticia/{slug}','FrontController@getNew')->name('new');
Route::get('eventos','FrontController@getEventsView')->name('events');
Route::get('eventos-data','FrontController@getEvents');
Route::get('evento/{slug}','FrontController@getEvent')->name('event');

Route::get('videos','FrontController@getVideosView')->name('videos');
Route::get('videos-data', 'FrontController@getVideos');

Route::get('product-finder','FrontController@getSearchResults')->name('productfinder');

Route::get('contacto','FrontController@getContactView')->name('contacto');
Route::get('sedes-data','FrontController@getSedes');

Route::get('nosotros', function () {
    return view('web.about');
});


// Ruta para busqueda de productos
Route::get('search', 'FrontController@searchQuery')->name('products.search');

// Ruta para busqueda por numero de parte
Route::get('search-by', 'FrontController@searchByPart')->name('products.search.part');

Route::get('mercados', 'FrontController@getMarkets')->name('markets');
Route::get('mercado/{slug}', 'FrontController@getMarket');

//Solicitar Info de Part
Route::post('sendquotepart', 'FrontController@sendQuotePart')->name('sendquotepart');
Route::post('askprofile', 'FrontController@askQuestion')->name('askprofile');
Route::post('contact', 'FrontController@contact')->name('contact');

// Peticion asyncrona
Route::get('products/{id}/parts','FrontController@getParts');

// Rutas para libro de reclamaciones
// Route::get('claim-book', 'FrontController@showClaimBookForm')->name('claim.book.form');

Route::get('claim-book', 'FrontController@showClaimBookForm')->name('web.claimbook');
Route::post('storeclaimbook', 'FrontController@storeClaimBook')->name('storeclaimbook');

// Rutas de autenticación
Auth::routes();
// Grupo de rutas Usuarios autenticados
Route::group(['middleware'=>'auth'],function(){

	//Rutas para usuarios autenticados
	
	// Grupo de rutas PANEL DE ADMINISTRACION
	Route::group(['prefix'=>'/panel'],function(){

		// Route::get('/', 'HomeController@index')->name('dashboard');
		Route::get('/', function(){
			return redirect('/panel/categories');
		});


		// Ruta para CRUD de Categorias y subcategorias
		Route::group(['middleware'=>'permision:manage_categories'],function(){
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

			//Llenado de Combo
			Route::get('brands-all-data','BrandController@getBrandsAll');


			Route::get('brands/{id}/destroy','BrandController@destroy')->name('brands.destroy');
		});
		
		// Ruta para productos
		Route::group(['middleware'=>'permision:manage_products'],function(){
			Route::get('products','ProductController@index')->name('products.index');
			Route::get('products-data','ProductController@getProducts');
			Route::post('products','ProductController@store');

			Route::get('products/{id}/edit', 'ProductController@edit');
			Route::put('products/{id}', 'ProductController@update')->name('products.update');
			//Ruta para eliminar el producto
			Route::get('products/{id}/destroy','ProductController@destroy')->name('products.destroy');

			// Ruta para agregar condiciones de operacion del producto
			Route::put('products/{id}/operating-condition', 'ProductController@storeOperatingCondition')->name('product.operating.condition');
			Route::get('operating-condition/{id}/destroy', 'ProductController@destroyOperatingCondition')->name('operating.condition.destroy');

			Route::get('products/{id}/compatibility', 'ProductController@editCompatibility');
			Route::put('products/compatibility/{id}','ProductController@storeCompatibility')->name('products.compatibility');


			// Gestion de partes del producto
			Route::get('products/{id}/parts','ProductController@ediParts');
			Route::put('products/parts/{id}','ProductController@storeParts')->name('products.parts.store');
			Route::get('parts/{part_id}/destroy','ProductController@destroyPart')->name('parts.destroy');

			// Administración de Documentos por Perfil
			Route::get('products/{id}/docs','ProductController@getDocs');
			Route::put('products/docs/{id}','ProductController@storeDocs')->name('products.docs.store');
			Route::get('docs/{doc_id}/destroy','ProductController@destroyDoc')->name('docs.destroy');

			//Gestión de los materiales disponibles por Perfil
			Route::get('products/{id}/materials', 'ProductController@getMaterials');
			Route::put('products/materials/{id}','ProductController@storeMaterials')->name('products.materials.store');
			Route::get('materials/{material_id}/destroy','ProductController@destroyMaterial')->name('materials.destroy');

			//Administración de Certificados por Perfil
			Route::get('products/{id}/isos', 'ProductController@getIsos');
			Route::put('products/isos/{id}','ProductController@storeProductIso')->name('products.isos.store');
			Route::get('productos.isos/{iso_id}/destroy','ProductController@destroyProductIso')->name('isos.destroy');

			



			// Lista toda las dimensiones
			Route::get('dimensions-data','ProductController@getDimensions');
			// Lista de unidades de medida
			Route::get('measurements-data','ProductController@getMeasurements');
			// Lista compatibilidades disponibles
			Route::get('compatibilities-data','ProductController@getCompatibilities');
			
		});
		
		// Ruta para posts
		Route::group(['middleware'=>'permision:manage_general'],function(){
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

			// Ruta para Videos
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

			//Ruta para Isos
			Route::get('isos', 'IsoController@index')->name('iso.index');
			Route::get('isos-data','IsoController@getIsos');
			Route::post('isos','IsoController@store');
			Route::put('isos/{id}', 'IsoController@update');
			Route::get('isos/{id}/destroy','IsoController@destroy');

			//Ruta para Sedes
			Route::get('sedes','SedeController@index')->name('sede.index');
			Route::get('sedes-data','SedeController@getSedes');
			Route::post('sedes','SedeController@store');
			Route::put('sedes/{id}','SedeController@update');
			Route::get('sedes/{id}/destroy','SedeController@destroy');

			//Ruta para reclamos registrados
			Route::get('claimbook','ClaimbookController@index')->name('claimbook.index');
			Route::get('claims-data','ClaimbookController@getClaims');
			Route::put('claims/{id}','ClaimbookController@update');
		});

		
		// Ruta para administradores
		Route::group(['middleware'=>'permision:manage_admin'],function(){
			Route::resource('users','UserController');
			Route::get('users/{id}/destroy','UserController@destroy')->name('users.destroy');

			// Ruta para roles
			Route::resource('roles','RoleController');
			Route::get('roles/{id}/destroy', 'RoleController@destroy')->name('roles.destroy');

			
		});
		
	});
});

