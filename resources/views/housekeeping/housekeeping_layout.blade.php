<!doctype html>
<html lang="es">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Impronta Housekeeping</title>
    <link rel="shortcut icon" href="{{ asset('../resources/assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/michelstyles.css') }}" />

    <script src="{{ asset('/js/michelscripts_base.js') }}"></script>

    <script>
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function (e) {
            console.log("Connection established!");
            sayHello();
        };

        conn.onmessage = function (e) {
            toastr.info(e.data, 'Información', {
                positionClass: "toast-top-left",
                timeOut: 0
            });
        };

        function sayHello(){
                    @if(Auth::check())
            var id = "{{ Auth::user()->id }}";
            conn.send(JSON.stringify({
                type: "hello" ,
                user_id: id
            }));
            @endif
        }
        function newBook(){
            conn.send(JSON.stringify({
                type: "book" ,
                user_id: global_user_id
            }));
        }
        function bookResponse(user_id, bookDate, response){
            conn.send(JSON.stringify({
                type: "bookResponse",
                user_id: user_id,
                book_date: bookDate,
                response: response
            }));
        }
        function newOrder(){
            conn.send(JSON.stringify({
                type: "order" ,
                user_id: global_user_id
            }));
        }
        function orderResponse(user_id, order_id, response){
            conn.send(JSON.stringify({
                type: "orderResponse",
                user_id: user_id,
                order_id: order_id,
                response: response
            }));
        }
    </script>
</head>

@include('header3')

<body>

    <div>
        @yield('content')
    </div>
</body>
<script src="{{ asset('/js/michelscripts_housekeeping.js') }}"></script>
</html>