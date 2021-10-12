<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <h1>Cambio de correo electrónico</h1>
    <h2>Petición de cambio de correo electrónico</h2>

    <p>Hemos recibido una solicitud de cambio de correo electrónico, a nombre de esta cuenta.</p>
    <p>Si no es así porfavor contacta con el equipo de administración del servicio.</p>

    <p>A continuación, te permitiremos volver a definir el correo electrónico de tu cuenta.</p>
    <br><p><a href="{{ url('email/newreset/' . $user->remember_token) }}">Haz click aquí para restablecer el correo electrónico.</a></p><br>


</body>
</html>