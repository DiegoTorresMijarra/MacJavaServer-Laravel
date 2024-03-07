@extends('main')

@section('title', 'Editar Trabajador')

@section('content')
    <a class="btn mx-2" href="{{ route('trabajadores.index') }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>

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

    <form class="d-flex flex-column" action="{{ route("trabajadores.update", $trabajador->id) }}" method="post" style="border-top: 2px solid #413f3d; padding: 20px">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col d-flex flex-column" style="border-left: 2px solid coral">
                <h5>Actualiza el trabajador</h5>
                <p>(*) Campo obligatorio</p>
            </div>
        </div>
        <br>
        <div class="row d-flex flex-column">
            <div class="row" style="margin-left: 1px; margin-bottom: 10px">
                <div class="col-4 d-flex flex-column">
                    <label for="nombre" class="form-control-sm">(*)Nombre</label>
                    <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" required value="{{$trabajador->nombre}}" style="width: 100%; margin-bottom: 10px">
                </div>
                <div class="col-4 d-flex flex-column">
                    <label for="apellidos" class="form-control-sm">(*)Apellidos</label>
                    <input class="form-control form-control-sm" id="apellidos" name="apellidos" type="text" required value="{{$trabajador->apellidos}}" style="width: 100%; margin-bottom: 10px">
                </div>
            </div>
            <div class="col-4 d-flex flex-column">
                <label for="nomina" class="form-control-sm">(*)Nomina</label>
                <input class="form-control form-control-sm" id="nomina" name="nomina" type="number" required value="{{$trabajador->nomina}}" style="width: 100%; margin-bottom: 10px">
            </div>
            <div class="col-4 d-flex flex-column">
                <label for="puesto" class="form-control-sm">(*)Puesto</label>
                <input class="form-control form-control-sm" id="puesto" name="puesto" type="text" required value="{{$trabajador->puesto}}" style="width: 100%; margin-bottom: 10px">
            </div>
        </div>
        <br>
        <div>
            <button class="btn" type="submit" style="background-color: coral; color: white">Actualizar</button>
        </div>
    </form>

@endsection
