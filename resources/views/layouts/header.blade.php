  <!-- Navigation & Intro -->
  <header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="#">{{ setting('site.title') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto smooth-scroll">
            {{ menu('LandingPage', 'menus.LandingPage') }}
          </ul>
          <!-- Social Icon  -->
          <ul class="navbar-nav nav-flex-icons">
            @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">
                    Ingresar
                  </a>
              </li>
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">
                        Registrarme
                      </a>
                  </li>
              @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                      <a class="dropdown-item" href="/home">
                            Perfil
                      </a>

                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                          Salir
                      </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest 
          </ul>
        </div>
      </div>
    </nav>

    <!-- Intro Section -->
    <div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(https://enrutador.aisig.live/storage/fondomaps.png);">
      <div class="mask rgba-black-strong">
        <div class="container h-100 d-flex justify-content-center align-items-center mt-5">
          <div class="row smooth-scroll">
            <div class="col-md-12 text-center white-text">
              <div class="wow fadeInDown" data-wow-delay="0.2s">
                <h3 class="display-4 font-weight-bold mb-2 rgba-black-light py-2">Enrutador GIS</h3>
                <hr class="hr-light my-4">
                <h4 class="subtext-header mt-2 mb-4">Softwate Inteligente para administratar y gestionar Redes Electricas con Datos Geograficos.
                  {{--  <p class="clearfix d-none d-md-inline-block">Deleniti onsequuntur, nihil voluptatem modi.</p>  --}}
                </h4>
              </div>
              <a href="/home" data-offset="90" class="btn btn-rounded btn-pink wow fadeInUp" data-wow-delay="0.2s">
                Ir al Panel</a>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

  </header>
  <!-- Navigation & Intro -->