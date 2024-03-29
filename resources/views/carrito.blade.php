<?php
    use App\Models\Producto;
?>

<script>
    var direccionSeleccionada=null;

    function seleccionarDireccion(direccionId) {
        if(direccionSeleccionada) {
            var seleccionadaPreviaElement= document.getElementById(direccionSeleccionada)
            seleccionadaPreviaElement.classList.remove('seleccionada');
        }
        direccionSeleccionada = direccionId;

        var direccionElement = document.getElementById(direccionId);

        document.getElementById('direccion_personal_id').value = direccionId;

        direccionElement.classList.add('seleccionada');
    }
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('numero_tarjeta').addEventListener('input', function(e) {
            var target = e.target;
            var position = target.selectionEnd;
            var value = target.value.replace(/\D/g, '').replace(/(.{4})/g, '$1-').trim();

            // Si hay un guion al final, evita agregar otro guion
            if (value.charAt(value.length - 1) === '-') {
                value = value.slice(0, -1);
            }

            // Verifica si el número de caracteres excede el límite de 20 y ajusta el valor y la posición en consecuencia
            if (value.length > 20) {
                value = value.slice(0, 20);
            }

            // Aplica el formato al valor final
            target.value = value;

            // Ajusta la posición del cursor en función del cambio realizado
            var diff = target.value.length - position;
            target.setSelectionRange(position + diff, position + diff);
        });
    });

</script>

@extends('main')

@section('title', 'Carrito de Compra')

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
    <div class="container">
        <div class="card">
            <div class="card-header">  <h2>Carrito de Compra</h2></div>
            <div class="card-body">
                @if( count($carrito['lineas']) > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($carrito['lineas'] as $index => $linea)
                            <tr>
                                <td>{{ $linea['producto']->nombre }}</td>
                                <td>
                                    @if( $linea['producto']->imagen != Producto::$IMAGE_DEFAULT)
                                        <img style="height: 50px; width: 50px"  alt="Imagen del producto" src="{{ asset('storage/' . $linea['producto']->imagen) }}">
                                    @else
                                        <img style="height: 50px; width: 50px" alt="Imagen por defecto" height="50" src="{{ Producto::$IMAGE_DEFAULT }}" width="50">
                                    @endif
                                </td>
                                <td>{{ $linea['precio'] }}</td>
                                <td>{{ $linea['stock'] }}</td>
                                <td>{{ $linea['subtotal'] }}</td>
                                <td>
                                    <form action="{{ route('delete-linea', $linea['producto']->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4"><strong>Total</strong></td>
                            <td><strong>{{ $carrito['total'] }}</strong></td>
                        </tr>
                        </tfoot>
                    </table>
                @else
                    <p>No hay productos en el carrito.</p>
                @endif
            </div>
        </div>
        @if( count($carrito['lineas']) > 0)
            <div class="card">
                <div class="card-header"> <h2>Direccion de Compra</h2></div>

                <div class="card-body">
                    <div class="row">
                        @if( $direcciones && count($direcciones) > 0 )
                            @foreach($direcciones as $direccion)
                                <div class="card mt-4 col-md-4 mb-4" id="{{$direccion->id}}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title mb-2 text-center ">{{ $direccion->nombre }}</h5>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <a href="{{ route('direccion-personal.show', $direccion->id) }}" class="btn btn-secondary" style="margin-right: 10px">Detalles</a>
                                            <button type="button" class="btn btn-primary" onclick="seleccionarDireccion('{{ $direccion->id }}')">Seleccionar</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="alert alert-info" role="alert">
                                    No se encontraron direcciones
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="pagination-container">
                                {{ $direcciones->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-right">
                                <a class="btn btn-primary" href="{{ route('direccion-personal.create') }}">Nueva Dirección</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"> <h2>Datos de pago</h2></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('finalizar-pedido') }}">
                        @csrf
                        <input hidden name="direccion_personal_id" id="direccion_personal_id">
                        <div class="form-group">
                            <label for="numero_tarjeta">Número de Tarjeta</label>
                            <input type="text" class="form-control" id="numero_tarjeta" maxlength="19" name="numero_tarjeta" placeholder="Número de Tarjeta" value="{{ old('numero_tarjeta')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="cvc">Nº Seguridad</label>
                            <input type="text" class="form-control" id="cvc" name="cvc" placeholder="CVC/CDC" maxlength="4" value="{{ old('cvc')}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Finalizar Pedido</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
