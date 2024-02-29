@php use App\Models\Direccion; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Crear Direccion')

{{-- Agregamos el contenido de la página --}}
@section('content')
    <h1>Primero crear una nueva direccion</h1>

    {{-- Codigos de validación de los errores, ver request validate del controlador --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br/>
    @endif

    <form action="{{ route("direcciones.store") }}" method="post">
        @csrf
        <div class="form-group">
            <label for="pais">Pais:</label>
            <input class="form-control" id="pais" name="pais" type="text" required>
        </div>
        <div class="form-group">
            <label for="provincia">Provincia:</label>
            <input class="form-control" id="provincia" name="provincia" type="text" required>
        </div>
        <div class="form-group">
            <label for="municipio">Municipio:</label>
            <input class="form-control" id="municipio" name="municipio" type="text" required>
        </div>
        <div class="form-group">
            <label for="codigoPostal">Codigo Postal:</label>
            <input class="form-control" id="codigoPostal" name="codigoPostal" type="text" required>
        </div>
        <div class="form-group">
            <label for="calle">Calle:</label>
            <input class="form-control" id="calle" name="calle" type="text" required>
        </div>
        <div class="form-group">
            <label for="numero">Numero:</label>
            <input class="form-control" id="numero" name="numero" type="text" required>
        </div>
        <div class="form-group">
            <label for="portal">Portal:</label>
            <input class="form-control" id="portal" name="portal" type="text" required>
        </div>
        <div class="form-group">
            <label for="piso">Piso:</label>
            <input class="form-control" id="piso" name="piso" type="text" required>
        </div>
        <div class="form-group">
            <label for="infoAdicional">Info Adicional:</label>
            <input class="form-control" id="infoAdicional" name="infoAdicional" type="text" required>
        </div>

        <button class="btn btn-primary" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2" href="{{ route('direcciones.index') }}">Volver</a>
    </form>

@endsection
