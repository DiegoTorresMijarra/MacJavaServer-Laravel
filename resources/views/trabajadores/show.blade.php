@extends('main')

@section('title', 'Detalles Trabajador')

@section('content')
    <a class="btn mx-2" href="{{ route('trabajadores.index') }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>
    <div class="row" style="border-top: 2px solid #413f3d; padding: 20px">
        <div class="col d-flex flex-column" style="border-left: 2px solid coral">
            <h5>Detalles del trabajador</h5>
        </div>
    </div>
    <br>
    <dl class="row" style="padding-left: 20px">
        <dt class="col-sm-2" style="color: coral">ID:</dt>
        <dd class="col-sm-10">{{ $trabajador->id }}</dd>
        <dt class="col-sm-2" style="color: coral">Nombre:</dt>
        <dd class="col-sm-10">{{ $trabajador->nombre }}</dd>
        <dt class="col-sm-2" style="color: coral">Apellidos:</dt>
        <dd class="col-sm-10">{{ $trabajador->apellidos }}</dd>
        <dt class="col-sm-2" style="color: coral">Nomina:</dt>
        <dd class="col-sm-10">{{ $trabajador->nomina }}</dd>
        <dt class="col-sm-2" style="color: coral">Puesto:</dt>
        <dd class="col-sm-10">{{ $trabajador->puesto }}</dd>
        <dt class="col-sm-2" style="color: coral">Usuario:</dt>
        <dd class="col-sm-10">{{ $trabajador->user->name }}</dd>
    </dl>


@endsection
