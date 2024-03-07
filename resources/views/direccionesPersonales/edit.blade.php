@php use Illuminate\Support\Facades\DB; @endphp

@extends('main')

@section('title', 'Editar Dirección')

@section('content')

    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <a class="btn mx-2" href="{{ route('home') }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>
            </div>
            <div class="col">
                <h2 style="display: inline;">Editar Dirección:</h2>
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

        <form class="form" action="{{ route("direccion-personal.update", $direccion->id) }}" method="post" style="border-top: 2px solid #413f3d; padding: 20px">
            @csrf
            @method('PUT')
            <hr>
            <h3> Datos Personales:</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre">(*)Nombre</label>
                    <input class="form-control" id="nombre" name="nombre" type="text" required value="{{ old('nombre', $direccion->nombre) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellidos">(*)Apellidos</label>
                    <input class="form-control" id="apellidos" name="apellidos" type="text" required value="{{ old('apellidos', $direccion->apellidos) }}">
                </div>
            </div>
            <hr>
            <h3> Datos Direccion:</h3>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="pais">(*)País</label>
                    <input class="form-control" id="pais" name="pais" type="text" required value="{{ old('pais', $direccion->pais) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="provincia">(*)Provincia</label>
                    <input class="form-control" id="provincia" name="provincia" type="text" required value="{{ old('provincia', $direccion->provincia) }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="municipio">(*)Municipio</label>
                    <input class="form-control" id="municipio" name="municipio" type="text" required value="{{ old('municipio', $direccion->municipio) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="codigoPostal">(*)Código Postal</label>
                    <input class="form-control" id="codigoPostal" name="codigoPostal" type="text" required value="{{ old('codigoPostal', $direccion->codigoPostal) }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="calle">(*)Calle</label>
                    <input class="form-control" id="calle" name="calle" type="text" required value="{{ old('calle', $direccion->calle) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="numero">(*)Número</label>
                    <input class="form-control" id="numero" name="numero" type="text" required value="{{ old('numero', $direccion->numero) }}">
                </div>
            </div>

            <hr>
            <h3> Datos Opcionales:</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="portal">Portal</label>
                    <input class="form-control" id="portal" name="portal" type="text" value="{{ old('portal', $direccion->portal) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="piso">Piso</label>
                    <input class="form-control" id="piso" name="piso" type="text" value="{{ old('piso', $direccion->piso) }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="infoAdicional">Información Adicional</label>
                    <textarea class="form-control" id="infoAdicional" name="infoAdicional" rows="4">{{ old('infoAdicional', $direccion->infoAdicional) }}</textarea>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button class="btn" type="submit" style="background-color: coral; color: white">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
