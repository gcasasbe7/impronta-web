<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <h1>¡{{ $user->name }}, no te lo pierdas!</h1>
    <h1>{{ $title }}</h1>
    <h2>Fecha: {{ $date }}</h2>

    <p>{{ $body }}</p>


    <br><br><small>Si deseas dejar de recibir correos de nuestras promociones, eventos y actividades, por favor ponte en contacto con el equipo administrativo.</small>
</body>
</html>