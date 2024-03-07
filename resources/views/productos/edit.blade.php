@php use App\Models\Producto; @endphp

@extends('main')

@section('title', 'Editar Producto')

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

    <form class="d-flex flex-column" action="{{ route("productos.update", $producto->id) }}" method="post" style="border-top: 2px solid #413f3d; padding: 20px">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col d-flex flex-column" style="border-left: 2px solid coral">
                <h5>Actualiza el producto</h5>
                <p>(*) Campo obligatorio</p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="nombre" class="form-control-sm">(*)Nombre</label>
                <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" required style="margin-bottom: 10px" value="{{$producto->nombre}}">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="descripcion" class="form-control-sm">(*)Descripcion</label>
                <input class="form-control form-control-sm" id="descripcion" name="descripcion" type="text" value="{{ $producto->descripcion }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="precio" class="form-control-sm">(*)Precio</label>
                <input class="form-control form-control-sm" id="precio" min="0.0" name="precio" step="0.01" type="number" required style="margin-bottom: 10px"
                       value="{{$producto->precio}}">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="stock" class="form-control-sm">(*)Stock</label>
                <input class="form-control form-control-sm" id="stock" min="0" name="stock" type="number" required style="margin-bottom: 10px"
                       value="{{$producto->stock}}">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="categoria_id" class="form-control-sm">(*)Categoría</label>
                <select class="form-control form-control-sm" id="categoria_id" name="categoria_id" required style="margin-bottom: 10px">
                    <option>Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                        <option @if($producto->categoria->id == $categoria->id) selected
                                @endif value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div>
            <button class="btn" type="submit" style="background-color: coral; color: white">Actualizar</button>
        </div>
    </form>
@endsection
