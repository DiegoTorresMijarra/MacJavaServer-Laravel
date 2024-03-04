@php use App\Models\Restaurante; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Editar Restaurante')

{{-- Agregamos el contenido de la página --}}
@section('content')
    <h1>Editar Restaurante</h1>

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

    <form action="{{ route("restaurantes.update", $restaurante->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Marca:</label>
            <input class="form-control" id="nombre" name="nombre" type="text" required value="{{$restaurante->nombre}}">
        </div>
        <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <input class="form-control" id="capacidad" min="0" name="capacidad" type="number" required
                   value="{{$restaurante->capacidad}}">
        </div>
        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select class="form-control" id="categoria" name="categoria" required>
                <option>Seleccione una categoría</option>
                @foreach($direcciones as $direccion)
                    <option @if($restaurante->direccion->id == $direccion->id) selected
                            @endif value="{{ $direccion->id }}">{{ $direccion->calle }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary" type="submit">Actualizar</button>
        <a class="btn btn-secondary mx-2" href="{{ route('restaurantes.index') }}">Volver</a>
    </form>

@endsection
