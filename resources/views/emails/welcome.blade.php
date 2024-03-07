<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
</head>
<body>
<div>
    <h2>Confirmación de Registro en MacJava</h2>
    <p>Estimado/a {{ $user->name }},</p>

    <p>¡Bienvenido/a a MacJava Estamos encantados/as de tenerte como parte de nuestra comunidad. Tu registro ha sido exitoso y ahora formas parte de nuestra plataforma.</p>

    <p>A continuación, encontrarás tus datos de inicio de sesión:</p>
    <ul>
        <li><strong>Email:</strong>{{ $user->email }}</li>
    </ul>

    <p>Accede a nuestra plataforma <a href="{{ route('index') }}">aquí</a> para comenzar a explorar todas las funciones y servicios que ofrecemos.</p>

    <p>Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos a través de <a href="mailto:macjavaserver@gmail.com">macjavaserver@gmail.com</a>.</p>

    <p>Gracias por unirte a MacJava. Estamos emocionados/as de trabajar contigo.</p>

    <p>Atentamente,<br>El equipo de MacJava<br></p>
</div>
</body>
