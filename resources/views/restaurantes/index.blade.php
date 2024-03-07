@php use App\Models\Restaurante; @endphp
@extends('main')

@section('title', 'Restaurante CRUD')

@section('content')
    <div class="row">
        <div class="col-3 d-flex justify-content-center align-items-center">
            <form action="{{ route('restaurantes.index') }}" class="mb-3" method="get">
                @csrf
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                    <input type="search" class="inputSearch" name="search" id="search" placeholder="Buscar...">
                </div>
            </form>
        </div>
        <div class="col-7">

        </div>
        <div class="col-2 d-flex justify-content-center align-items-center">
            @if(Auth::check() && Auth::user()->rol === 'ADMIN')
                <a class="btn btn-success" href={{ route('restaurantes.create') }}>Nuevo Restaurante</a>
            @endif
        </div>
    </div>

            @foreach ($restaurantes as $restaurante)
                <div class="row mb-4 shadow-lg" style="background-color: white; border-bottom: 2px solid coral; padding-top: 10px">
                    <div class="col-2">
                        <img src="https://imag.bonviveur.com/salon-del-restaurante-tragabuches-marbella_800.jpg" width="300px" height="150px" alt="">
                    </div>
                    <div class="col-10 d-flex flex-column justify-content-center align-items-center">
                        <h2 style="color: #413f3d">{{ $restaurante->nombre }}</h2>
                        @if(Auth::check() && Auth::user()->rol === 'ADMIN')
                            <a href="{{ route('direcciones.show', $restaurante->direccion_id) }}">{{ $restaurante->direccion->municipio .' / '. $restaurante->direccion->calle .' '. $restaurante->direccion->numero }}</a>
                        @else
                            <p style="color: #413f3d">{{ $restaurante->direccion->municipio .' / '. $restaurante->direccion->calle .' '. $restaurante->direccion->numero }}</p>
                        @endif
                    </div>
                    <div class="row" style="width: 100%; border-top: 1px solid coral; margin: 0; padding: 10px; margin-top: 10px; background-color: #413f3d">
                        <div class="col-6 d-flex align-items-center" style="color: white">
                            <h2 style="margin-top: 10px">Capacidad para {{ $restaurante->capacidad }} personas</h2>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            @if(Auth::check() && Auth::user()->rol === 'ADMIN')
                            <a href="{{ route('restaurantes.edit', $restaurante->id) }}" class="btn" style="background-color: coral; color: white; width: 100px; height: 40px; margin-right: 10px">Editar</a>
                            <form action="{{ route('restaurantes.destroy', $restaurante->id) }}" method="POST"
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style=" margin-right: 10px; width: 100px; height: 40px"
                                        onclick="return confirm('¿Estás seguro de que deseas borrar este restaurante?')">Borrar
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
@endsection
