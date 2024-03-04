@php use App\Models\Direccion; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Detalles Direccion')

{{-- Agregamos el contenido de la página --}}
@section('content')

    {{-- Agregamos el contenido de la página --}}

    <h1>Detalles de la Direccion</h1>
    <dl class="row">
        <dt class="col-sm-2">ID:</dt>
        <dd class="col-sm-10">{{ $direccion->id }}</dd>
        <dt class="col-sm-2">Pais:</dt>
        <dd class="col-sm-10">{{ $direccion->pais }}</dd>
        <dt class="col-sm-2">Provincia:</dt>
        <dd class="col-sm-10">{{ $direccion->provincia }}</dd>
        <dt class="col-sm-2">Municipio:</dt>
        <dd class="col-sm-10">{{ $direccion->municipio }}</dd>
        <dt class="col-sm-2">Codigo Postal:</dt>
        <dd class="col-sm-10">{{ $direccion->codigoPostal }}</dd>
        <dt class="col-sm-2">Calle:</dt>
        <dd class="col-sm-10">{{ $direccion->calle }}</dd>
        <dt class="col-sm-2">Numero:</dt>
        <dd class="col-sm-10">{{ $direccion->numero }}</dd>
        <dt class="col-sm-2">Portal:</dt>
        <dd class="col-sm-10">{{ $direccion->portal }}</dd>
        <dt class="col-sm-2">Piso:</dt>
        <dd class="col-sm-10">{{ $direccion->piso }}</dd>
        <dt class="col-sm-2">Info Adicional:</dt>
        <dd class="col-sm-10">{{ $direccion->infoAdicional }}</dd>
    </dl>
    <a class="btn btn-primary" href="{{ route('direcciones.index') }}">Volver</a>

@endsection
