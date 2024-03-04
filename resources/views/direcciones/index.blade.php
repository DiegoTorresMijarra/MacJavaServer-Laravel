@php use App\Models\Direccion; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Direccion CRUD')

{{-- Agregamos el contenido de la página --}}
@section('content')
    <h1>Listado de Direcciones</h1>

    {{-- Agregamos el contenido de la página --}}

    <form action="{{ route('direcciones.index') }}" class="mb-3" method="get">
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
            <th>Pais</th>
            <th>Provincia</th>
            <th>Municipio</th>
            <th>Codigo Postal</th>
            <th>Calle</th>
            <th>Numero</th>
            <th>Portal</th>
            <th>Piso</th>
            <th>Info Adicional</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>

        {{-- Por cada producto --}}
        @foreach ($direcciones as $direccion)
            <tr>
                <td>{{ $direccion->id }}</td>
                <td>{{ $direccion->pais }}</td>
                <td>{{ $direccion->provincia }}</td>
                <td>{{ $direccion->municipio }}</td>
                <td>{{ $direccion->codigoPostal }}</td>
                <td>{{ $direccion->calle }}</td>
                <td>{{ $direccion->numero }}</td>
                <td>{{ $direccion->portal }}</td>
                <td>{{ $direccion->piso }}</td>
                <td>{{ $direccion->infoAdicional }}</td>
                <td>
                    <a class="btn btn-primary btn-sm"
                       href="{{ route('direcciones.show', $direccion->id) }}">Detalles</a>
                    <a class="btn btn-secondary btn-sm"
                       href="{{ route('direcciones.edit', $direccion->id) }}">Editar</a>
                    <form action="{{ route('direcciones.destroy', $direccion->id) }}" method="POST"
                          style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de que deseas borrar esta direccion?')">Borrar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="{{ route('direcciones.create') }}">Nueva Direccion</a>
    <a class="btn btn-success" href="{{ route('restaurantes.index') }}">Restaurantes</a>
@endsection
