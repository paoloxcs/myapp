<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')  |   {{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo.png')}}" />

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendor/fontawesome/css/all.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/estilo.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/spinner.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/style-panel.css')}}"/>
    
    <link rel="stylesheet" href="{{asset('vendor/toastr/build/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/modalimg.css')}}">
    @yield('styles')
</head>
<body>
  <div class="main-container">
    <div class="spinner-inner" id="spinner">
        <div class="spinner-content">
            <span class="spinner"></span>
        </div>
    </div>
    <div class="top-nav">
      <div class="top-nav-content">
          <div class="logo">
            <a href="{{url('/panel')}}">
              <img src="{{asset('images/logo.png')}}" alt="Casdel Hnos">
            </a>
          </div>
          <div class="wrapper-user">
            <div class="box-item bordered">
              <img class="user-icon" id="user-icon" src="{{asset('images/user-icon.jpg')}}" alt="Icono del usuario">
            </div>
            <div class="user-settings" id="user-settings">
              <div class="profile">
                <img class="icon" src="{{asset('images/user-icon.jpg')}}" alt="">
                <div class="name">
                  <span>{{Auth()->user()->fullName()}}</span>
                </div>
              </div>
                <ul class="menu">
                  <li><a href="#"><i class="fas fa-cogs"></i> Configuración</a></li>
                  <li><a href="{{url('/')}}"><i class="fab fa-chrome"></i> Regresar a casdel</a></li>
                  <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
            </div>
          </div>
      </div>
      
    </div>

    <div class="app-content">
      <div class="left-nav">
          <ul class="main-menu">
            <li><a href="{{url('/panel')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="{{route('categories.index')}}"><i class="fas fa-sliders-h"></i> Categorías</a></li>
            <li><a href="{{route('brands.index')}}"><i class="fas fa-sliders-h"></i> Marcas</a></li>
            <li><a href="{{route('markets.index')}}"><i class="fas fa-sliders-h"></i> Mercados</a></li>
            <li><a href="{{route('profiles.index')}}"><i class="fas fa-sliders-h"></i> Productos</a></li>
            <li><a href="{{route('posts.index')}}"><i class="fas fa-sliders-h"></i> Posts</a></li>

            <li><a href="{{route('videos.index')}}"><i class="fas fa-sliders-h"></i> Videos</a></li>
            <li><a href="{{route('catalog.index')}}"><i class="fas fa-sliders-h"></i> Catálogos</a></li>
            <li><a href="{{route('slide.index')}}"><i class="fas fa-sliders-h"></i> Slides</a></li>
            <li><a href="{{route('iso.index')}}"><i class="fas fa-sliders-h"></i> Certificaciones</a></li>
            <li><a href="{{route('sede.index')}}"><i class="fas fa-sliders-h"></i> Sedes</a></li>
          </ul>
        </div>
        
      <div class="content-section">
        
          @yield('content')
          
      </div>
    </div>
    

  </div>
  <!-- The Modal -->
  <div id="modal-image" class="modal-image">

    <!-- The Close Button -->
    <span class="cerrar">&times;</span>

    {{-- Modal Content (The Image) --}}
    <img class="modal-image-content" id="img-show">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
  </div>
    
   <!--JavaScript at end of body for optimized loading-->
   <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
   <script src="{{asset('vendor/jquery/bootstrap.min.js')}}"></script>
   <script src="{{asset('vendor/fontawesome/js/all.min.js')}}"></script>
   <script src="{{asset('vendor/toastr/build/toastr.min.js')}}"></script>
   <script src="{{asset('js/helpers.js')}}"></script>
   <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>

   @include('layouts.messages')
   @yield('scripts')
</body>
</html>
