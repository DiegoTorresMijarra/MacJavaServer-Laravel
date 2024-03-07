@php use Illuminate\Support\Facades\DB; @endphp

@extends('main')

@section('title', 'Crear Trabajador')

@section('content')

    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <a class="btn mx-2" href="{{ route('users.index') }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>
            </div>
            <div class="col">
                <h2 style="display: inline;">Crear Empleado:</h2>
            </div>
        </div>
    </div>

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

    <div class="container">

        <form class="form" action="{{ route("users.store") }}" method="post" style="border-top: 2px solid #413f3d; padding: 20px">
            @csrf
            <hr>
            <h3> Datos Personales:</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre">(*)Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" required value="{{ old('nombre') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellidos">(*)Apellidos</label>
                    <input class="form-control" id="apellidos" name="apellidos" type="text" required value="{{ old('apellidos') }}">
                </div>
            </div>
            <hr>
            <h3> Datos Laborales:</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dni">(*)DNI</label>
                    <input class="form-control" id="dni" name="dni" type="text" required value="{{ old('dni') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomina">(*)Nómina</label>
                    <input class="form-control" id="nomina" name="nomina" type="number" required value="{{ old('nomina') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="puesto">(*)Puesto</label>
                    <input class="form-control" id="puesto" name="puesto" type="text" required value="{{ old('puesto') }}">
                </div>
            </div>

            <div class="form-group d-flex justify-content-evenly">
                <label for="imagen" style="color: coral; font-weight: bold; margin-right: 20px">Avatar:</label>
                <input accept="image/*" class="form-control-file" id="avatar" name="avatar" required type="file">
                <small class="text-danger"></small>
            </div>

            <hr>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button class="btn" type="submit" style="background-color: coral; color: white">Crear</button>
                </div>
            </div>
        </form>
    </div>
@endsection
