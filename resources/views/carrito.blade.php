<?php
    use App\Models\Producto;
?>
@extends('main')

@section('title', 'Carrito de Compra')

@section('content')
    <div class="container">
        <h2>Carrito de Compra</h2>
        @if( count($carrito['lineas']) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($carrito['lineas'] as $linea)
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
@endsection
