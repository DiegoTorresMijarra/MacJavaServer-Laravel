@extends('main')

@section('title', 'Detalles Categoria')

@section('content')
    <a class="btn mx-2" href="{{ route('categorias.index') }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>
    <div class="row" style="border-top: 2px solid #413f3d; padding: 20px">
        <div class="col d-flex flex-column" style="border-left: 2px solid coral">
            <h5>Detalles de la categoria</h5>
        </div>
    </div>
    <br>
    <dl class="row" style="padding-left: 20px">
        <dt class="col-sm-2" style="color: coral">ID:</dt>
        <dd class="col-sm-10">{{ $categoria->id }}</dd>
        <dt class="col-sm-2" style="color: coral">Nombre:</dt>
        <dd class="col-sm-10">{{ $categoria->nombre }}</dd>
    </dl>


@endsection
