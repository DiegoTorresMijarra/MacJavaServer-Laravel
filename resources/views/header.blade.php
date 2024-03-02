<header class="shadow-sm" style="background: #ffeeee; padding: 10px 0; margin-bottom: 30px; border-bottom: 2px solid coral; border-bottom-left-radius: 30px; border-bottom-right-radius: 30px">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="row collapse navbar-collapse" id="navbarNav">
            <div class="col-2" style="text-align: center">
                <a class="navbar-brand" style="color: coral; font-size: 30px; font-family: 'Rowdies';" href="{{ url('/') }}">
                    {{ config('name', 'MacJava') }}
                </a>
            </div>
            <div class="col-4">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        @if (Route::has('login'))
                            @auth
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesion') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            @endauth
                        @endif
                    </li>
                    <li class="nav-item d-flex justify-contente-evenly">
                        <a class="nav-link" href="{{ route('productos.index') }}" style="color: coral">Inicio</a>
                        <a class="nav-link" href="{{ route('productos.index') }}" style="color: coral">Productos</a>
                        <a class="nav-link" href="{{ route('productos.offers') }}" style="color: coral">Ofertas</a>
                    </li>
                </ul>
            </div>

            <div class="col-4 d-flex justify-content-center align-items-center">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="opcionesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: coral">
                        Administradores
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminDropdown" style="background-color: #ffeeee">
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="{{ route('productos.create') }}">Productos</a>
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="#">Restaurantes</a>
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="#">Trabajadores</a>
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="#">Usuarios</a>
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="#">Categorias</a>
                    </div>
                </div>
            </div>

            <div class="col-2 d-flex justify-content-end">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <div class="d-flex justify-content-center align-items-center">
                            @if (Route::has('login'))
                                @auth()
                                    <a style="margin-right: 10px" href="{{ route ('home')  }}"><img src="https://sede.seg-social.gob.es/SedeThemeStatic/themes/Portal8.5/images/sede_img/usuario_r.png" alt="" width="30px" height="30px"></a>
                                @endauth
                            @endif
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex justify-content-center align-items-center" style="background-color: #413f3d; color: white; padding: 10px; width: 40px; height: 40px; border-radius: 50%">
                                <span class="navbar-text" style="color: white">
                                {{ strtoupper(substr(auth()->user()->role ?? 'invitado/a', 0, 1)) }}
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

