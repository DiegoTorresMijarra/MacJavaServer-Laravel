<?php
    use App\Models\DireccionPersonal;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    $trabajador = Auth::user()->empleado;
?>

@extends('main')
@section('title','Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenidx: {{ Auth::user()->name}}</div>
                <div class="card-body">
                    <dt class="col-sm-2" style="color: coral">Rol:</dt>
                    <dd class="col-sm-10">{{ Auth::user()->rol }}</dd>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Datos Trabajador') }}</div>
                <div class="card-body">
                    <dt class="col-sm-2" style="color: coral">ID:</dt>
                    <dd class="col-sm-10">{{ $trabajador->id }}</dd>
                    <dt class="col-sm-2" style="color: coral">Nombre:</dt>
                    <dd class="col-sm-10">{{ $trabajador->nombre }}</dd>
                    <dt class="col-sm-2" style="color: coral">Apellidos:</dt>
                    <dd class="col-sm-10">{{ $trabajador->apellidos }}</dd>
                    <dt class="col-sm-2" style="color: coral">Nomina:</dt>
                    <dd class="col-sm-10">{{ $trabajador->nomina }}€</dd>
                    <dt class="col-sm-2" style="color: coral">Puesto:</dt>
                    <dd class="col-sm-10">{{ $trabajador->puesto }}</dd>
                    <dt class="col-sm-2" style="color: coral">Usuario:</dt>
                    <dd class="col-sm-10">{{ $trabajador->user->name }}</dd>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
