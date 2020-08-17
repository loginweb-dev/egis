<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Panel</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="{{ asset('vendor/mdb/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mdb/css/mdb.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/mdb/css/addons-pro/timeline.min.css') }}">
    
    @laravelPWA
    @yield('css')
</head>

<body>

<div class="container my-5">

  <!-- Navigation -->
  <header>
    
    <style>
     .navbar .navbar-brand img {
      height: 20px;
    }

    .navbar .navbar-brand {
      padding-top: 0;
    }

    .navbar .nav-link {
      color: #444343!important;
    }

    .navbar .button-collapse {
      padding-top: 1px;
    }

    .card-intro .card-body {
      padding-top: 1.5rem;
      padding-bottom: 1.5rem;
      border-radius: 0 !important;
    }

    .card-intro .card-body h1 {
      margin-bottom: 0;
    }

    .card-intro {
      margin-top: 64px;
    }

    @media (max-width: 450px) {
      .card-intro {
        margin-top: 56px;
      }
    }

    @media (min-width: 1441px) {
      .card-intro {
        padding-left: 0 !important;
      }
    }
    </style>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
          <img src="https://mdbootstrap.com/wp-content/uploads/2018/06/logo-mdb-jquery-small.png" alt="Logo">
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">jQuery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/angular/" target="_blank">Angular</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/react/" target="_blank">React</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/vue/" target="_blank">Vue</a>
            </li>
          </ul>
 
          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="https://www.facebook.com/mdbootstrap" class="nav-link waves-effect" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li> 
            <li class="nav-item">
              <a href="https://twitter.com/MDBootstrap" class="nav-link waves-effect" target="_blank">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link waves-effect"
                target="_blank">
                <i class="fab fa-github"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="https://mdbootstrap.com/docs/jquery/newsletter/"
                class="nav-link border border-light rounded waves-effect mr-2" target="_blank">
                <i class="fas fa-envelope mr-1"></i>Newsletter
              </a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

    <!-- Intro -->
    <div class="card card-intro blue-gradient m-4">

      <div class="card-body white-text rgba-black-light text-center">

        <!--Grid row-->
        <div class="row d-flex justify-content-center">

          <!--Grid column-->
          <div class="col-md-6">

            <p class="h5 mb-2">
              Panel de Control
            </p>

            <p class="mb-0">Aceeso directo a todas las funcionalidades de sistema, para cada enlaze existe restricciones segun el rol asignado al usuario.</p>

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </div>

    </div>
    <!-- Intro -->

  </header>
  <!-- Navigation -->


  <!--Section: Content-->
  <section class="team-section text-center dark-grey-text">

    <!-- Section heading -->
    {{-- <h3 class="font-weight-bold pb-2 mb-4">Panel de Control</h3> --}}
    <!-- Section description -->
    {{-- <p class="text-muted w-responsive mx-auto mb-5">Aceeso directo a todas las funcionalidades de sistema, para cada enlaze existe restricciones segun el rol asignado al usuario.</p> --}}

    <!-- Grid row-->
    <div class="row text-center text-md-left">

      <!-- Grid column -->
      <div class="col-lg-6 col-md-12 mb-5 d-md-flex justify-content-between">
        <div class="avatar mb-md-0 mb-4 mx-4">
          <a href="/buscador">
            <img src="{{ asset('/images/panel/016-search.png') }}" class="rounded z-depth-1" alt="Sample avatar">
          </a>
          
        </div>
        <div class="mx-4">
          <h4 class="font-weight-bold mb-3">Buscador</h4>
          {{-- <h6 class="font-weight-bold grey-text mb-3">Web Designer</h6> --}}
          <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
            tenetur.</p>
          
          {{-- <a class="p-2 fa-lg fb-ic">
            <i class="fab fa-facebook-f"> </i>
          </a>
          
          <a class="p-2 fa-lg tw-ic">
            <i class="fab fa-twitter"> </i>
          </a>
       
          <a class="p-2 fa-lg dribbble-ic">
            <i class="fab fa-dribbble"> </i>
          </a> --}}
        </div>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-lg-6 col-md-12 mb-5 d-md-flex justify-content-between">
        <div class="avatar mb-md-0 mb-4 mx-4">
          <img src="{{ asset('/images/panel/033-compass.png') }}" class="rounded z-depth-1" alt="Sample avatar">
        </div>
        <div class="mx-4">
          <h4 class="font-weight-bold mb-3">Proyectos</h4>
          {{-- <h6 class="font-weight-bold grey-text mb-3">Photographer</h6> --}}
          <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
            tenetur.</p>
        
          {{-- <a class="p-2 fa-lg fb-ic">
            <i class="fab fa-facebook-f"> </i>
          </a>
          
          <a class="p-2 fa-lg yt-ic">
            <i class="fab fa-youtube"> </i>
          </a>
       
          <a class="p-2 fa-lg ins-ic">
            <i class="fab fa-instagram"> </i>
          </a> --}}
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

    <!-- Grid row-->
    <div class="row text-center text-md-left">

      <!-- Grid column -->
      <div class="col-lg-6 col-md-12 mb-5 d-md-flex justify-content-between">
        <div class="avatar mb-md-0 mb-4 mx-4">
          <img src="{{ asset('/images/panel/033-bell.png') }}" class="rounded z-depth-1" alt="Sample avatar">
        </div>
        <div class="mx-4">
          <h4 class="font-weight-bold mb-3">Reclamos</h4>
          {{-- <h6 class="font-weight-bold grey-text mb-3">Web Developer</h6> --}}
          <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
            tenetur.</p>
          {{-- <a class="p-2 fa-lg fb-ic">
            <i class="fab fa-facebook-f"> </i>
          </a>
         
          <a class="p-2 fa-lg tw-ic">
            <i class="fab fa-twitter"> </i>
          </a>
         
          <a class="p-2 fa-lg git-ic">
            <i class="fab fa-github"> </i>
          </a> --}}
        </div>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-lg-6 col-md-12 mb-5 d-md-flex justify-content-between">
        <div class="avatar mb-md-0 mb-4 mx-4">
          <img src="{{ asset('/images/panel/012-car.png') }}" class="rounded z-depth-1 img-fluid"
            alt="Sample avatar">
        </div>
        <div class="mx-4">
          <h4 class="font-weight-bold mb-3">Bitacoras</h4>
          {{-- <h6 class="font-weight-bold grey-text mb-3">Front-end Developer</h6> --}}
          <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
            tenetur.</p>
       
          {{-- <a class="p-2 fa-lg gplus-ic">
            <i class="fab fa-google-plus-g"> </i>
          </a>
         
          <a class="p-2 fa-lg li-ic">
            <i class="fab fa-linkedin-in"> </i>
          </a>
          
          <a class="p-2 fa-lg email-ic">
            <i class="fas fa-envelope"> </i>
          </a> --}}
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->


<!-- Grid row-->
    <div class="row text-center text-md-left">

      <!-- Grid column -->
      <div class="col-lg-6 col-md-12 mb-5 d-md-flex justify-content-between">
        <div class="avatar mb-md-0 mb-4 mx-4">
          <img src="{{ asset('/images/panel/015-adjust.png') }}" class="rounded z-depth-1" alt="Sample avatar">
        </div>
        <div class="mx-4">
          <h4 class="font-weight-bold mb-3">Lecturacion</h4>
          {{-- <h6 class="font-weight-bold grey-text mb-3">Web Developer</h6> --}}
          <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
            tenetur.</p>
          {{-- <a class="p-2 fa-lg fb-ic">
            <i class="fab fa-facebook-f"> </i>
          </a>
         
          <a class="p-2 fa-lg tw-ic">
            <i class="fab fa-twitter"> </i>
          </a>
         
          <a class="p-2 fa-lg git-ic">
            <i class="fab fa-github"> </i>
          </a> --}}
        </div>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-lg-6 col-md-12 mb-5 d-md-flex justify-content-between">
        <div class="avatar mb-md-0 mb-4 mx-4">
          <img src="{{ asset('/images/panel/017-battery.png') }}" class="rounded z-depth-1 img-fluid"
            alt="Sample avatar">
        </div>
        <div class="mx-4">
          <h4 class="font-weight-bold mb-3">Corte y Reconexion</h4>
          {{-- <h6 class="font-weight-bold grey-text mb-3">Front-end Developer</h6> --}}
          <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
            tenetur.</p>
       
          {{-- <a class="p-2 fa-lg gplus-ic">
            <i class="fab fa-google-plus-g"> </i>
          </a>
         
          <a class="p-2 fa-lg li-ic">
            <i class="fab fa-linkedin-in"> </i>
          </a>
          
          <a class="p-2 fa-lg email-ic">
            <i class="fas fa-envelope"> </i>
          </a> --}}
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->
  </section>
  <!--Section: Content-->


</div>

  <script type="text/javascript" src="{{ asset('vendor/mdb/js/jquery-3.4.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('vendor/mdb/js/popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('vendor/mdb/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('vendor/mdb/js/mdb.min.js') }}"></script>

  @yield('js')
</body>

</html>
