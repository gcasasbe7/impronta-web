<script>
            @if(\Illuminate\Support\Facades\Auth::check())
    var global_user_id = "{{ Auth::user()->id }}";
            @endif

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