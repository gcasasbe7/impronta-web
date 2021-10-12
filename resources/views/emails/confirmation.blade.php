<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <h1>Gracias {{ $user->name }}, por darte de alta!</h1>
    <h2>Estás a un solo paso de poder disfrutar de todas las ventajas que te ofrecemos.</h2>

    <p>Ya falta muy poco para que puedas empezar a navegar por nuestra web y a sacarle partido a todas las ventajas que te ofrece. Solo falta un ultimo paso.</p>
    <p>Para una mayor seguridad en la aplicación, deberás confirmar tu dirección de correo electrónico.</p>
    <br><p><a href="{{ url('register/confirm/' . $user->token) }}">Haz click aquí para confirmar tu dirección de correo electrónico.</a></p><br>


</body>
</html>