<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Iconos -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link href="../resources/assets/css/teststyles.css" rel="stylesheet">
    <link href="../resources/assets/css/mycss.css" rel="stylesheet">
    <script src="../resources/assets/js/testscripts.js"></script>

</head>

<body>
@include('banner')

<ul id="accordion" class="accordion">
    <li>
        <div class="link"><i class="fa fa-paint-brush"></i>Diseño web<i class="fa fa-chevron-down"></i></div>
        <ul class="submenu">
            <li><a href="#">Photoshop</a></li>
            <li><a href="#">HTML</a></li>
            <li><a href="#">CSS</a></li>
            <li><a href="#">Maquetacion web</a></li>
        </ul>
    </li>
    <li>
        <div class="link"><i class="fa fa-code"></i>Desarrollo front-end<i class="fa fa-chevron-down"></i></div>
        <ul class="submenu">
            <li><a href="#">Javascript</a></li>
            <li><a href="#">jQuery</a></li>
            <li><a href="#">Frameworks javascript</a></li>
        </ul>
    </li>
    <li>
        <div class="link"><i class="fa fa-mobile"></i>Diseño responsive<i class="fa fa-chevron-down"></i></div>
        <ul class="submenu">
            <li><a href="#">Tablets</a></li>
            <li><a href="#">Dispositivos mobiles</a></li>
            <li><a href="#">Medios de escritorio</a></li>
            <li><a href="#">Otros dispositivos</a></li>
        </ul>
    </li>
    <li><div class="link"><i class="fa fa-globe"></i>Posicionamiento web<i class="fa fa-chevron-down"></i></div>
        <ul class="submenu">
            <li><a href="#">Google</a></li>
            <li><a href="#">Bing</a></li>
            <li><a href="#">Yahoo</a></li>
            <li><a href="#">Otros buscadores</a></li>
        </ul>
    </li>
</ul>
</body>


</html>