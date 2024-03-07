@php use Illuminate\Support\Facades\DB; @endphp

@extends('main')

@section('title', 'Detalles de Dirección')

@section('content')

    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <a class="btn mx-2" href="{{ route('home') }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>
            </div>
            <div class="col">
                <h2 style="display: inline;">Detalles de Dirección:</h2>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Datos Personales</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nombre:</strong> {{ $direccion->nombre }}</li>
                    <li class="list-group-item"><strong>Apellidos:</strong> {{ $direccion->apellidos }}</li>
                </ul>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Datos de Dirección</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>País:</strong> {{ $direccion->pais }}</li>
                    <li class="list-group-item"><strong>Provincia:</strong> {{ $direccion->provincia }}</li>
                    <li class="list-group-item"><strong>Municipio:</strong> {{ $direccion->municipio }}</li>
                    <li class="list-group-item"><strong>Código Postal:</strong> {{ $direccion->codigoPostal }}</li>
                    <li class="list-group-item"><strong>Calle:</strong> {{ $direccion->calle }}</li>
                    <li class="list-group-item"><strong>Número:</strong> {{ $direccion->numero }}</li>
                    <li class="list-group-item"><strong>Portal:</strong> {{ $direccion->portal }}</li>
                    <li class="list-group-item"><strong>Piso:</strong> {{ $direccion->piso }}</li>
                    <li class="list-group-item"><strong>Información Adicional:</strong> {{ $direccion->infoAdicional }}</li>
                </ul>
            </div>
            <div class="text-right">
                <a class="btn btn-primary" href="{{route('direccion-personal.edit',$direccion->id)}}">Editar</a>
            </div>
        </div>
    </div>
@endsection
