@extends('main')

@section('title', 'Detalles de Usuario')

@section('content')

    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <a class="btn mx-2" href="{{ route('home') }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>
            </div>
            <div class="col">
                <h2 style="display: inline;">Detalles de Usuario:</h2>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Datos Personales</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nombre:</strong> {{ $usuario->name }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $usuario->email }}</li>
                    <li class="list-group-item"><strong>Rol:</strong> {{ $usuario->rol }}</li>
                </ul>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Detalles de Empleado</h3>
                @if($usuario->empleado())
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nombre:</strong> {{ $usuario->empleado()->first()->nombre }}</li>
                        <li class="list-group-item"><strong>Apellidos:</strong> {{ $usuario->empleado()->first()->apellidos }}</li>
                        <li class="list-group-item"><strong>Dni:</strong> {{ $usuario->empleado()->first()->dni }}</li>
                        <li class="list-group-item"><strong>Cargo:</strong> {{ $usuario->empleado()->first()->puesto }}</li>
                        <li class="list-group-item"><strong>Sueldo:</strong> {{ $usuario->empleado()->first()->nomina }}</li>
                    </ul>
                @else
                    <p>No es empleado.</p>
                @endif
            </div>
            <div class="text-right">
                <a class="btn btn-primary m-2" href="{{ route('users.index') }}">Volver</a>
            </div>
        </div>
    </div>
@endsection
