@php use App\Models\Restaurante; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Restaurante CRUD')

{{-- Agregamos el contenido de la página --}}
@section('content')
    <h1>Listado de Restaurantes</h1>

    {{-- Agregamos el contenido de la página --}}

    <form action="{{ route('restaurantes.index') }}" class="mb-3" method="get">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" id="search" name="search" placeholder="Nombre">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </form>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Direccion</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            {{-- Por cada producto --}}
            @foreach ($restaurantes as $restaurante)
                <tr>
                    <td>{{ $restaurante->id }}</td>
                    <td>{{ $restaurante->nombre }}</td>
                    <td>{{ $restaurante->capacidad }}</td>
                    <td>{{ $restaurante->direccion_id }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm"
                           href="{{ route('restaurantes.show', $restaurante->id) }}">Detalles</a>
                        <a class="btn btn-secondary btn-sm"
                           href="{{ route('restaurantes.edit', $restaurante->id) }}">Editar</a>
                        <form action="{{ route('restaurantes.destroy', $restaurante->id) }}" method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que deseas borrar este restaurante?')">Borrar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    <a class="btn btn-success" href="{{ route('restaurantes.create') }}">Nuevo Restaurante</a>
@endsection
