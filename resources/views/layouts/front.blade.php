  <!DOCTYPE html>
  <html lang="{{ app()->getLocale() }}">
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/css?family=Poppins|Roboto" rel="stylesheet">
      <!--Import bootstrap.css-->
      <link type="text/css" rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}"/>
      <link type="text/css" rel="stylesheet" href="{{asset('vendor/fontawesome/css/all.min.css')}}"/>
      <link type="text/css" rel="stylesheet" href="{{asset('css/estilo.css')}}"/>
      <link type="text/css" rel="stylesheet" href="{{asset('css/spinner.css')}}"/>
      <link rel="stylesheet" href="{{asset('vendor/toastr/build/toastr.min.css')}}">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('title')  |  {{ config('app.name', 'Laravel') }}</title>
      {{-- Font AWESOME 5 --}}
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <!-- Imagen - Favicon  -->
      <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo.png')}}" />

      @yield('styles')
    </head>

    <body>
      <div class="spinner-inner" id="spinner"> <!-- Spinner -->
          <div class="spinner-content">
              <span class="spinner"></span>
          </div>
      </div>
      <!-- /Init mobile header -->
      <div class="mobile-header">
        <div class="logo-mobile">
          <a style="width: 100%;" href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="Casdel"></a>
        </div>
        <div class="header-mobile-wrapper">
          <span onclick="switchMenu(this);" id="icono" class="fa fa-bars"></span>
        </div>
      </div>
      <!-- /End mobile header -->
      <!-- /Init header -->
      <div id="header-master" class="header-master">
        <div class="header-top">
          <div class="container d-flex justify-content-end">
            <div class="header-top-menu">
              <ul class="child-menu">
                <li><a href="{{url('nosotros')}}">Nosotros</a></li>
                <li><a href="{{route('contact')}}">Contacto</a></li>
                <li><a class="whatsapp-color" href="#"><i class="fab fa-whatsapp"></i> Whatsapp</a></li>
                <li><a class="active" href="mailto:ventas@casdel.com.pe"><i class="fas fa-envelope"></i> ventas@casdel.com.pe</a></li>
                <li><a href="#"><i class="fas fa-phone"></i> (+511) 202 0777</a></li>
                
              </ul>
            </div>
            
          </div>
        </div>
        <div class="header-main">
          <div class="container">
            <div class="d-flex justify-content-between pt-2 pb-2 flex-wrap">
               <div class="logo d-none d-lg-block">
                <a href="{{url('/')}}">
                  <img src="{{asset('images/logo.png')}}" alt="">
                </a>
               </div>
               <div class="wrapper-nav">
                <div class="d-flex justify-content-end mt-3 flex-wrap">
                  <ul class="main-menu">
                    <li><a href="{{route('products')}}">Productos</a></li>
                    <li><a href="{{route('catalogs')}}">Catálogos</a></li>
                    <li><a href="{{route('events')}}">Eventos</a></li>
                    <li><a href="{{route('news')}}">Noticias</a></li>
                    <li><a href="{{route('videos')}}">Videos</a></li>
                    <li><a href="{{route('markets')}}">Mercados</a></li>
                  </ul>
                  <div class="user-wrapper">
                    
                    <ul class="user-menu">
                      <li><a id="search-button" data-toggle="dropdown" href="#"><span class="fa fa-search"></span></a></li>
                      @if(Auth::guest())
                      <li><a href="{{route('login')}}"><i class="fas fa-unlock-alt"></i> Login</a></li>
                      <li><a href="{{route('register')}}"><i class="fas fa-user-plus"></i> Registrate</a></li>
                      @else
                      <li class="dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth()->user()->name}}
                          </a>
                          <div class="dropdown-menu" id="user-dropdown" aria-labelledby="navbarDropdownMenuLink">
                            {{-- <a class="dropdown-item" href="#">Perfil</a>
                            <a class="dropdown-item" href="#">Settings</a> --}}
                            @if(Auth()->user()->accessPanel())
                              <a class="dropdown-item" href="{{url('panel')}}">Ver panel</a>
                            @endif
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                          </div>
                        </li>
                      @endif
                      
                    </ul>
                  </div>
                </div>
                <div class="search-form" id="search-form">
                      <form class="form-inline mt-md-0">
                        <div class="input-group">
                          <input type="text" class="form-control form-control-sm" placeholder="Buscar en CASDEL" aria-label="Buscar en CASDEL" aria-describedby="button-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-outline-orange btn-sm" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                </div>
                 
               </div>
            </div>
          </div>
        </div>
        
      </div>
      <!-- /End header -->      

    <main role="main">
      @yield('content')
    </main>

    <footer class="mt-5">
    <div class="container mt-5">
      <div class="row mt-5">
        <section class="col-xs-12 col-sm-12 col-md-9">
          <p class="graytext">Nuestras redes sociales</p>
            {{-- <ul class="menufooter d-flex">
              <li><a href="#">Política de Privacidad</a></li>
              <li><a href="#">Legal</a></li>
              <li><a href="#">Términos y Condiciones</a></li>
              <li><a href="#">Mapa del Sitio</a></li>
            </ul> --}}
        </section>
        <section class="col-xs-12 col-sm-12 col-md-3 redes">          
            <ul class="menufooter d-flex justify-content-end">
              <li><a class="social face" href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a class="social youtube" href="#"><i class="fab fa-youtube"></i></a></li>
              <li><a class="social linked" href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>          
        </section>

        <section class="col-xs-12 col-sm-12 col-md-12 mt-3">
          <p>Copyright 2019 - CASDEL Hnos.</p>
        </section>
      </div>
    </div>
    </footer>
      
      <!--JavaScript at end of body for optimized loading-->

      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
          <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
          <script src="{{asset('vendor/jquery/bootstrap.min.js')}}"></script>
          <script src="{{asset('vendor/fontawesome/js/all.min.js')}}"></script>
          <script src="{{asset('js/main.js')}}"></script>
          <script src="{{asset('vendor/toastr/build/toastr.min.js')}}"></script>
          <script src="{{asset('js/helpers.js')}}"></script>
          
          @yield('scripts')

    </body>
  </html>