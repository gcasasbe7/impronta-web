<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <h1>Cambio de contraseña</h1>
    <h2>Petición de cambio de contraseña</h2>

    <p>Hemos recibido una solicitud de cambio de contraseña, a nombre de esta cuenta.</p>
    <p>Si no es así porfavor contacta con el equipo de administración del servicio.</p>

    <p>A continuación, te permitiremos volver a definir la contraseña con la que realizas el inicio de sesión.</p>
    <br><p><a href="{{ url('password/newreset/' . $user->remember_token) }}">Haz click aquí para restablecer la contraseña.</a></p><br>


</body>
</html>