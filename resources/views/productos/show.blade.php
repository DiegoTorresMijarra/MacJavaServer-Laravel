@php
    use App\Models\Producto;
    use App\Http\Controllers\CarritoController;
    $stockSession = $producto->stock - CarritoController::getStockSession($producto->id);

@endphp

@extends('main')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('plus-btn').addEventListener('click', function() {
            if (parseInt(document.getElementById('stock').value) < {{ $stockSession }}) {
                document.getElementById('stock').value = parseInt(document.getElementById('stock').value) + 1;
            }else {
                document.getElementById('stock').value ={{ $stockSession }};
            }
        });

        document.getElementById('minus-btn').addEventListener('click', function() {
            if (parseInt(document.getElementById('stock').value) > 1) {
                document.getElementById('stock').value = parseInt(document.getElementById('stock').value) - 1;
            }
        });
    });
</script>

@section('title', 'Detalles Producto')

@section('content')

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

    <div class="row mt-4">
        <div class="col-6" style="border-right: 2px solid coral">
            @if($producto->imagen != Producto::$IMAGE_DEFAULT)
                <img alt="Imagen del funko" class="img-fluid" style="height: 450px; width: 450px" src="{{ asset('storage/' . $producto->imagen) }}">
            @else
                <img alt="Imagen por defecto" class="img-fluid" style="height: 450px; width: 450px" src="{{ asset( Producto::$IMAGE_DEFAULT )}}">
            @endif
        </div>
        <div class="col-6 d-flex align-items-center" style="border-left: 2px solid coral;">
            <div class="d-flex align-items-center shadow" style="padding: 30px; border-radius: 30px; background-color: #ffeeee; color: #413f3d; width: 100%; height: 100%">
                <dl class="row d-flex flex-column" style="width: 100%">
                    <div class="d-flex justify-content-center">
                        <h1 style="color: coral;">{{ $producto->nombre }}</h1>
                    </div>
                    <dt class="col-sm-2">Descripcion:</dt>
                    <dd class="col-sm-10">{{ $producto->descripcion }}</dd>
                    <dt class="col-sm-2">Precio:</dt>
                    <dd class="col-sm-10">{{ $producto->precio }}</dd>
                    <dt class="col-sm-2">Categoría:</dt>
                    <dd class="col-sm-10">{{ $producto->categoria->nombre }}</dd>
                    <div class="row" style="margin-top: 10px; padding: 0 10px">
                        <div class="col-6">
                            @if(Auth::check() && Auth::user()->rol === 'ADMIN')
                                <a class="btn btn-sm" href="{{ route('productos.edit', $producto->id) }}" style="background: #413f3d; color: white; margin-right: 10px">Editar</a>
                                <a class="btn btn-sm" href="{{ route('productos.editImage', $producto->id) }}" style="background: coral; color: white; margin-right: 10px">Imagen</a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style=" margin-right: 10px"
                                            onclick="return confirm('¿Estás seguro de que deseas borrar este producto?')">Borrar
                                    </button>
                                </form>
                            @endif
                        </div>
                        @if(Auth::check() && Auth::user()->rol === 'USER')

                            <div class="col-6">
                            @if( $producto->stock<=0) {{-- por si hubiera algun error y se hubiera puesto a menos de 0 tb --}}
                                <p class="stockProductoNoDisponible">No hay existencias de este producto</p>
                            @elseif( $stockSession <=0)
                                <p class="stockProductoNoDisponible">Ud ya tiene la cantidad disponible del producto</p>
                            @else
                                <form action="{{ route('add-linea') }}" method="post">
                                    @csrf
                                    <input hidden name="producto_id" id="producto_id" value="{{ $producto->id }}" >
                                    <input hidden name="precio" id="precio" value="{{ $producto->precio }}" >

                                    <div class="input-group mb-3 d-flex justify-content-end" >
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" id="minus-btn">-</button>
                                        </div>
                                        <input type="text" class="form-control text-center cantidadSelector" value="1" aria-label="Cantidad"  id="stock" name="stock" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="plus-btn">+</button>
                                        </div>
                                    </div>
                                    <button class="btn float-right" type="submit" style="color: white; background-color: coral">Agregar al carrito</button>
                                </form>
                            @endif
                            </div>
                        @endif
                        @if(Auth::user()===null)
                            <p class="stockProductoNoDisponible"> Inicie Sesion para comprar</p>
                        @endif
                    </div>
                </dl>
            </div>
        </div>
    </div>

@endsection
