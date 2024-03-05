<?php
use App\Models\User;
?>
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
                    <li class="nav-item d-flex justify-content-evenly">
                        <a class="nav-link" href="{{ route('index') }}" style="color: coral">Inicio</a>
                        <a class="nav-link" href="{{ route('productos.index') }}" style="color: coral">Productos</a>
                        <a class="nav-link" href="{{ route('productos.offers') }}" style="color: coral">Ofertas</a>
                    </li>
                </ul>
            </div>

            <div class="col-2 d-flex justify-content-center align-items-center">
                @if(Auth::check() && Auth::user()->role === 'admin')
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="opcionesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: coral">
                        Administradores
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminDropdown" style="background-color: white; border: 1px solid coral">
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="{{ route('productos.index') }}">Productos</a>
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="#">Restaurantes</a>
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="#">Trabajadores</a>
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="#">Usuarios</a>
                        <a class="dropdown-item" style="color: coral" onmouseover="this.style.backgroundColor='coral'; this.style.color='white';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.color='coral';" href="{{ route('categorias.index') }}">Categorias</a>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-4 d-flex justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex justify-content-around">
                        @if (Route::has('login'))
                            @auth
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: coral">
                                    {{ __('Cerrar Sesion') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="nav-link" style="color: coral">Iniciar Sesion</a>
                                <a href="{{ route('register') }}" class="nav-link" style="color: coral">Registrarse</a>
                            @endauth
                        @endif
                    </li>
                    @auth()
                    <li class="nav-item ml-4">
                        <div class="d-flex justify-content-center align-items-center">

                                    <a style="margin-right: 10px" href="{{ route ('home')  }}">
                                        @if(Auth::user()->avatar!==User::$AVATAR_DEFAULT)
                                            <img  alt="Imagen del user" src="{{ asset('storage/' . Auth::user()->avatar ) }}" height="40" width="40">
                                        @else
                                            <img alt="Imagen por defecto" height="40" width="40" src="{{ User::$AVATAR_DEFAULT }}" style="background-color: #413f3d; color: white; padding: 1px; width: 40px; height: 40px; border-radius: 50%">
                                        @endif
                                    </a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <div class="d-flex justify-content-center align-items-center" style="background-color: #413f3d; color: white; padding: 10px; width: 40px; height: 40px; border-radius: 50%">
                                <span class="navbar-text" style="color: white; font-family: 'Rowdies';">
                                {{ strtoupper(substr(auth()->user()->name ?? 'invitado/a', 0, 1)) }}
                            </span>
                        </div>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

