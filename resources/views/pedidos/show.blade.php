@extends('main')

@section('title', 'Detalles del Pedido')

@section('content')
    <div class="col-10 mx-auto">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Detalles del Pedido</h5>
                        <dl class="row">
                            <dt class="col-sm-3">ID del Pedido:</dt>
                            <dd class="col-sm-9">{{ $pedido['id'] }}</dd>
                            <dt class="col-sm-3">Fecha:</dt>
                            <dd class="col-sm-9">{{ $pedido['created_at'] }}</dd>
                            <dt class="col-sm-3">Precio Total:</dt>
                            <dd class="col-sm-9">{{ $pedido['precioTotal'] }}</dd>
                            <dt class="col-sm-3">Stock Total:</dt>
                            <dd class="col-sm-9">{{ $pedido['stockTotal'] }}</dd>
                            <dt class="col-sm-3">Estado:</dt>
                            <dd class="col-sm-9">{{ $pedido['estado'] }}</dd>
                            <dt class="col-sm-3">Tarjeta:</dt>
                            <dd class="col-sm-9">{{ $pedido['numero_tarjeta'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Direccion</h5>
                        <div class="row">
                            <div class="col">
                                <strong>Nombre:</strong> {{ $pedido['direccionPersonal']['nombre'] }}
                            </div>
                            <div class="col">
                                <strong>Apellidos:</strong> {{ $pedido['direccionPersonal']['apellidos'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>País:</strong> {{ $pedido['direccionPersonal']['pais'] }}
                            </div>
                            <div class="col">
                                <strong>Provincia:</strong> {{ $pedido['direccionPersonal']['provincia'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Municipio:</strong> {{ $pedido['direccionPersonal']['municipio'] }}
                            </div>
                            <div class="col">
                                <strong>Código Postal:</strong> {{ $pedido['direccionPersonal']['codigoPostal'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Calle:</strong> {{ $pedido['direccionPersonal']['calle'] }}
                            </div>
                            <div class="col">
                                <strong>Número:</strong> {{ $pedido['direccionPersonal']['numero'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Portal:</strong> {{ $pedido['direccionPersonal']['portal'] }}
                            </div>
                            <div class="col">
                                <strong>Piso:</strong> {{ $pedido['direccionPersonal']['piso'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Información Adicional:</strong> {{ $pedido['direccionPersonal']['infoAdicional'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2>Líneas de Pedido:</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>SubTotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pedido['lineaPedidos'] as $linea)
                <tr class="tr-hover">
                    <td>{{ $linea['producto']['nombre'] }}</td>
                    <td>{{ $linea['precio'] }}</td>
                    <td>{{ $linea['stock'] }}</td>
                    <td>{{ $linea['precio'] * $linea['stock'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-5">
            <a class="btn btn-secondary float-right mr-2" href="{{ route('home') }}">Volver</a>
            <a class="btn btn-primary float-right mr-2" href="{{ route('pdf',$pedido['id']) }}">Descargar en pdf</a>

        </div>
    </div>
@endsection
