@php use App\Models\Restaurante; @endphp

@extends('main')

@section('title', 'Crear Restaurante')

@section('content')
    <a class="btn mx-2" href="{{ route('restaurantes.index') }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>

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

    <form class="d-flex flex-column" action="{{ route("restaurantes.store") }}" method="post" style="border-top: 2px solid #413f3d; padding: 20px">
        @csrf
        <div class="row">
            <div class="col d-flex flex-column" style="border-left: 2px solid coral">
                <h5>Crea un restaurante</h5>
                <p>(*) Campo obligatorio</p>
            </div>
        </div>
        <br>
        <div class="row d-flex flex-column">
            <div class="col-4 d-flex flex-column">
                <label for="nombre" class="form-control-sm">(*)Nombre</label>
                <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" required style="width: 100%; margin-bottom: 10px">
            </div>
            <div class="col-4 d-flex flex-column">
                <label for="capacidad" class="form-control-sm">(*)Capacidad</label>
                <input class="form-control form-control-sm" id="capacidad" name="capacidad" type="number" required style="width: 100%; margin-bottom: 10px">
            </div>
            <div class="col-4 d-flex flex-column">
                <label class="form-control-sm" for="direccion">(*)Direccion</label>
                <select class="form-control form-control-sm" id="direccion" name="direccion" required style="margin-bottom: 10px">
                    <option>Seleccione una direccion</option>
                    @foreach($direcciones as $direccion)
                        <option value="{{ $direccion->id }}">{{ $direccion->calle }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div>
            <button class="btn" type="submit" style="background-color: coral; color: white">Crear</button>
        </div>
    </form>
@endsection
