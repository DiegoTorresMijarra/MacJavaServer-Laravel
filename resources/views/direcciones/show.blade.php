@php use App\Models\Direccion; @endphp

@extends('main')

@section('title', 'Detalles Direccion')

@section('content')
    <a class="btn mx-2" href="{{ route('restaurantes.index') }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>
    <div class="row" style="border-top: 2px solid #413f3d; padding: 20px">
        <div class="col d-flex flex-column" style="border-left: 2px solid coral">
            <h5>Detalles de la direccion</h5>
        </div>
    </div>
    <br>
    <dl class="row" style="padding-left: 20px">
        <dt class="col-sm-2" style="color: coral">ID:</dt>
        <dd class="col-sm-10">{{ $direccion->id }}</dd>
        <dt class="col-sm-2" style="color: coral">Pais:</dt>
        <dd class="col-sm-10">{{ $direccion->pais }}</dd>
        <dt class="col-sm-2" style="color: coral">Provincia:</dt>
        <dd class="col-sm-10">{{ $direccion->provincia }}</dd>
        <dt class="col-sm-2" style="color: coral">Municipio:</dt>
        <dd class="col-sm-10">{{ $direccion->municipio }}</dd>
        <dt class="col-sm-2" style="color: coral">Codigo Postal:</dt>
        <dd class="col-sm-10">{{ $direccion->codigoPostal }}</dd>
        <dt class="col-sm-2" style="color: coral">Calle:</dt>
        <dd class="col-sm-10">{{ $direccion->calle }}</dd>
        <dt class="col-sm-2" style="color: coral">Numero:</dt>
        <dd class="col-sm-10">{{ $direccion->numero }}</dd>
        <dt class="col-sm-2" style="color: coral">Portal:</dt>
        <dd class="col-sm-10">{{ $direccion->portal }}</dd>
        <dt class="col-sm-2" style="color: coral">Piso:</dt>
        <dd class="col-sm-10">{{ $direccion->piso }}</dd>
        <dt class="col-sm-2" style="color: coral">Info Adicional:</dt>
        <dd class="col-sm-10">{{ $direccion->infoAdicionale }}</dd>
    </dl>

    <div class="row d-flex justify-content-center">
        <a class="btn btn-success btn-sm" href="{{ route('direcciones.create') }}" style="margin-right: 10px">Nueva Direccion</a>
        <a class="btn btn-sm" href="{{ route('direcciones.edit', $direccion->id) }}" style="background: #413f3d; color: white; margin-right: 10px">Editar</a>
        <form action="{{ route('direcciones.destroy', $direccion->id) }}" method="POST"
              style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" style=" margin-right: 10px"
                    onclick="return confirm('¿Estás seguro de que deseas borrar este direccion?')">Borrar
            </button>
        </form>
    </div>

@endsection
