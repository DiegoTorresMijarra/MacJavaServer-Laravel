<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        dl {
            margin-bottom: 20px;
        }
        dt, dd {
            display: inline-block;
            width: 45%;
            margin-right: 5%;
            margin-bottom: 10px;
        }
        dt {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .thank-you {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="thank-you">
        <h1>MacJava</h1>
        <p>¡Gracias por comprar en nuestra tienda!</p>
    </div>

    <div class="card">
        <h2 class="card-title">Detalles del Pedido</h2>
        <dl>
            <dt>ID del Pedido:</dt>
            <dd>{{ $pedido['id'] }}</dd>
            <dt>Fecha:</dt>
            <dd>{{ $pedido['created_at'] }}</dd>
            <dt>Precio Total:</dt>
            <dd>{{ $pedido['precioTotal'] }}</dd>
            <dt>Stock Total:</dt>
            <dd>{{ $pedido['stockTotal'] }}</dd>
            <dt>Estado:</dt>
            <dd>{{ $pedido['estado'] }}</dd>
            <dt>Tarjeta:</dt>
            <dd>{{ $pedido['numero_tarjeta'] }}</dd>
        </dl>
    </div>

    <div class="card">
        <h2 class="card-title">Dirección</h2>
        <dl>
            <dt>Nombre:</dt>
            <dd>{{ $pedido['direccionPersonal']['nombre'] }}</dd>
            <dt>Apellidos:</dt>
            <dd>{{ $pedido['direccionPersonal']['apellidos'] }}</dd>
            <dt>País:</dt>
            <dd>{{ $pedido['direccionPersonal']['pais'] }}</dd>
            <dt>Provincia:</dt>
            <dd>{{ $pedido['direccionPersonal']['provincia'] }}</dd>
            <dt>Municipio:</dt>
            <dd>{{ $pedido['direccionPersonal']['municipio'] }}</dd>
            <dt>Código Postal:</dt>
            <dd>{{ $pedido['direccionPersonal']['codigoPostal'] }}</dd>
            <dt>Calle:</dt>
            <dd>{{ $pedido['direccionPersonal']['calle'] }}</dd>
            <dt>Número:</dt>
            <dd>{{ $pedido['direccionPersonal']['numero'] }}</dd>
            <dt>Portal:</dt>
            <dd>{{ $pedido['direccionPersonal']['portal'] }}</dd>
            <dt>Piso:</dt>
            <dd>{{ $pedido['direccionPersonal']['piso'] }}</dd>
            <dt>Información Adicional:</dt>
            <dd>{{ $pedido['direccionPersonal']['infoAdicional'] }}</dd>
        </dl>
    </div>

    <h2>Líneas de Pedido:</h2>
    <table>
        <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>SubTotal</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pedido['lineaPedidos'] as $linea)
            <tr>
                <td>{{ $linea['producto']['nombre'] }}</td>
                <td>{{ $linea['precio'] }}</td>
                <td>{{ $linea['stock'] }}</td>
                <td>{{ $linea['precio'] * $linea['stock'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
