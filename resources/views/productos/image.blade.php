@php use App\Models\Producto; @endphp

@extends('main')

@section('title', 'Editar imagen de Producto')

@section('content')
    <a class="btn mx-2" href="{{ route('productos.show', $producto->id) }}" style="background-color: transparent; font-size: 50px; color: #413f3d"><-</a>

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

    <div class="row" style="border-top: 2px solid #413f3d; padding: 20px">
        <div class="col d-flex flex-column" style="border-left: 2px solid coral">
            <h5>Actualiza la imagen</h5>
        </div>
    </div>
    <br>
    <dl class="row" style="padding-left: 20px">
        <dt class="col-sm-2" style="color: coral">ID:</dt>
        <dd class="col-sm-10">{{$producto->id}}</dd>
        <dt class="col-sm-2" style="color: coral">Nombre:</dt>
        <dd class="col-sm-10">{{$producto->nombre}}</dd>
        <dt class="col-sm-2" style="color: coral">Imagen:</dt>
        <dd class="col-sm-10">
            @if($producto->imagen != Producto::$IMAGE_DEFAULT)
                <img alt="Imagen del producto" class="img-fluid" src="{{ asset('storage/public/productos/' . $producto->imagen) }}">
            @else
                <img alt="Imagen por defecto" class="img-fluid" src="{{ Producto::$IMAGE_DEFAULT }}">
            @endif
        </dd>
    </dl>

    <form action="{{ route("productos.updateImage", $producto->id) }}" method="post" enctype="multipart/form-data" style="padding-left: 20px">
        @csrf
        @method('PATCH')
        <div class="form-group d-flex justify-content-evenly">
            <label for="imagen" style="color: coral; font-weight: bold; margin-right: 20px">Nueva imagen:</label>
            <input accept="image/*" class="form-control-file" id="imagen" name="imagen" required type="file">
            <small class="text-danger"></small>
        </div>
        <br>
        <div>
            <button class="btn" type="submit" style="background-color: coral; color: white">Actualizar</button>
        </div>
    </form>

@endsection
