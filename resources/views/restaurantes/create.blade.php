@php use App\Models\Restaurante; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Crear Restaurante')

{{-- Agregamos el contenido de la página --}}
@section('content')
    <h1>Crear Restaurante</h1>

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

    <form action="{{ route("restaurantes.store") }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input class="form-control" id="nombre" name="nombre" type="text" required>
        </div>
        <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <input class="form-control" id="capacidad" min="0" name="capacidad" type="number" required value="0">
        </div>
        <div class="form-group">
            <label for="direccion">Direccion:</label>
            <select class="form-control" id="direccion" name="direccion" required>
                <option>Seleccione una direccion</option>
                @foreach($direcciones as $direccion)
                    <option value="{{ $direccion->id }}">{{ $direccion->calle }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2" href="{{ route('restaurantes.index') }}">Volver</a>
    </form>

@endsection
