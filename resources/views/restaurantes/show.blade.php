@php use App\Models\Restaurante; @endphp
{{-- Heredamos de nuestra plantilla --}}
@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Detalles Restaurante')

{{-- Agregamos el contenido de la página --}}
@section('content')

    {{-- Agregamos el contenido de la página --}}

    <h1>Detalles del Restaurante</h1>
    <dl class="row">
        <dt class="col-sm-2">ID:</dt>
        <dd class="col-sm-10">{{ $restaurante->id }}</dd>
        <dt class="col-sm-2">Nombre:</dt>
        <dd class="col-sm-10">{{ $restaurante->nombre }}</dd>
        <dt class="col-sm-2">Capacidad:</dt>
        <dd class="col-sm-10">{{ $restaurante->capacidad }}</dd>
        <dt class="col-sm-2">Direccion:</dt>
        <dd class="col-sm-10"><a href="{{ route('direcciones.show', $restaurante->direccion_id) }}">{{ $restaurante->direccion_id }}</a></dd>
    </dl>
    <a class="btn btn-primary" href="{{ route('restaurantes.index') }}">Volver</a>

@endsection
