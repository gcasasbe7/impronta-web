<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Impronta Pizza</title>
    <link rel="shortcut icon" href="{{ asset('../resources/assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ url('css/michelstyles.css') }}" />
    <script src="{{ url('js/michelscripts_base.js') }}"></script>
    <script src= "{{ url('../resources/assets/js/mainOrder.js') }} "></script>
    @include("ws")
</head>

@include('header2')

<body>
    <div id="mainOrder">
        @yield('content')
    </div>
</body>

@include('footer')

</html>