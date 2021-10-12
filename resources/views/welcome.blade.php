@extends('main_layout')

@section('content')

    <section class="mycontainer headerbackground mt-5">
        <div class="title clear">
            <div class="gw txt-c">
                <div class="g8 g-center txt-c">
                    <h1 class="customTitle">L'Impronta Pizza9</h1>
                    <!-- <h3 class="c-wh mb0 subtitle">¡Bienvenido a nuestra página web, descubre todas nuestras novedades!</h3>-->
                </div>
                <div class="g8 g-center txt-c">
                    <div class="row">
                        <div class="cta2" style="margin-top: 20px">
                            <div class="meta">
                                <h2 style="color: white;">PIZZAS HECHAS AL HORNO DE LEÑA</h2>
                                <div class="row" style="margin-top: 20px;">

                                    <div class="col-sm-6 mt-4">
                                        <img src="{{ asset('../resources/assets/img/phone-call.png') }}" alt="">
                                        <h4 class="utils-header">93 174 78 76</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ asset('../resources/assets/img/stopwatch.png') }}" alt="">
                                        <h4 class="utils-header"> 13:00 - 16:00</h4>
                                        <h4 class="utils-header"> 19:00 - 00:00</h4>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-md-4">
                                        <a href="https://www.instagram.com/improntapizza/" target="_blank"><img src="{{ asset('../resources/assets/img/instagram-logo.png') }}" alt=""></a>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="socialmedia">@improntapizza</span>
                                        <hr style="border-top: 1px solid white;">
                                        <span class="socialmedia" style="font-size: 25px;">C/Pintors Masriera nº2</span>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="https://www.facebook.com/Improntapizza/" target="_blank"><img src="{{ asset('../resources/assets/img/facebook-logo.png') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="gradient-diamond"></div>
        </div>


        <div class="txt-c mt40 mb-4" style="padding: 0px 30px;">
            <h2>Bienvenido a nuestra página web</h2>
            <div class="row" style="margin-top:30px;">
                <div class="col-md-4">
                    <img class="mb-4" src="{{url('/assets/img/menu.png')}}">
                    <h4 class="b c-db"><b>¡Crea, comparte y recomienda!</b></h4>
                    <p>¡Crea tus pizzas y muestraselas al mundo!<br> ¡Observa las opiniones de otros usuarios, y déjate guiar por ellas!<br>
                        ¡Comparte tus experiencias y valoraciones de los platos que has provado con toda la comunidad!</p>
                    <a href="{{ url('/menu') }}" style="text-decoration: none"><button type="button" class="btn btn-outline-dark btn-lg btn-block">Carta</button></a>
                </div>
                <div class="col-md-4">
                    <img class="mb-4" src="{{ url('/assets/img/calendar.png')}}">
                    <h4 class="b c-db"><b>¡Los mejores eventos!</b></h4>
                    <p>¡Entérate de todos los eventos que organizamos muy a menudo, para todos los públicos, donde podrás pasar grandes momentos con nosotros y con toda la comunidad a la vez ganar recompensas!<br>¡Te escuchamos! ¿Qué evento podríamos organizar?</p>
                    <a href="#eventos" style="text-decoration: none"><button type="button" class="btn btn-outline-dark btn-lg btn-block">Eventos</button></a>
                </div>
                <div class="col-md-4">
                    <img class="mb-4" src="{{url('/assets/img/score.png')}}">
                    <h4 class="b c-db"><b>¡Gana puntos y consigue recompensas!</b></h4>
                    <p>¡Para que disfrutes todavía más de tu experiencia con nosotros! <br> ¡Con nuestro nuevo sistema de puntos, podrás llegar a obtener mayores ventajas y disfrutar al máximo de todos nuestros productos! ¡Fácil, rápido y seguro... ¿Te lo vas a perder?!</p>
                    <a href="#sispuntos" style="text-decoration: none"><button type="button" class="btn btn-outline-dark btn-lg btn-block">Puntos</button></a>
                </div>
            </div>
        </div>

        <div class="clear"></div>


        <div class="bubble mybubblebg">
            <h2 style="color: white; margin-bottom: 50px;">La nueva forma de realizar los pedidos</h2>

            <div class="row">
                <div class="col-md-6" style="color: white; text-align: center;">
                    <p><img src="{{ url('/assets/img/star.png') }}"> ¡Haz tu pedido cuando quieras y donde quieras!</p>
                    <p><img src="{{ url('/assets/img/star.png') }}"> ¡Personaliza al máximo tu pedido!</p>
                    <p><img src="{{ url('/assets/img/star.png') }}"> ¡Rápido, fácil y muy cómodo!</p>

                </div>
                <div class="col-md-6" style="color: white;">
                    <img src="{{ url('/assets/img/star.png') }}"> ¡A la puerta de tu casa!</p>
                    <img src="{{ url('/assets/img/star.png') }}"> ¡Recibe puntos como recompensa por tu pedido!</p>
                    <img src="{{ url('/assets/img/star.png') }}"> ¡Guarda tus pedidos y repítelos cuando quieras!</p>
                </div>
            </div>

            <div style="margin: 40px 0px">
                {{--<a href="{{ url('menu') }}" class="myCustomButtonWhite" style="margin-top: 20px">Realizar pedido</a>--}}
                <a href="{{ url('/menu') }}" style="text-decoration: none"><button type="button" class="btn btn-outline-light btn-lg btn-block">Realizar pedido</button></a>
            </div>



            <div class="gradient-diamond"></div>
        </div>


        <div id="sispuntos" class="txt-c mt40" style="padding: 0px 30px;">
            <h2>Sistema de Puntos</h2>
            <div class="row" style="margin-top:20px;">
                <div class="col-md-4">
                    <img src="{{url('/assets/img/score.png')}}">
                    <h4 class="b c-db mt-3"><b>¿Cómo consigo puntos?</b></h4>
                    <p>Participa en eventos que realizamos muy a menudo y que puedes consultar aquí en la web. O bien haz tus pedidos rápidamente mediante nuestra web, de este modo ahorrarás tiempo y a la vez ganarás puntos que después podrás canjear.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{url('/assets/img/fireworks.png')}}">
                    <h4 class="b c-db mt-3"><b>¿Qué son los puntos?</b></h4>
                    <p>Los puntos de recompensa equivalen a cualquier moneda con la que compras productos en nuestro local. Hazte con puntos fácilmente para poder canjearlos y disfrutar todavía más de tu experiencia con nosotros.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{url('/assets/img/change.png')}}">
                    <h4 class="b c-db mt-3"><b>¿Cómo canjeo los puntos?</b></h4>
                    <p id="eventsSection">Debes estar registrado para poder acumular puntos, y en el mismo <a href="{{url("/user-points")}}" style="color: black;"><b><em>panel de usuario</em></b></a> podrás encontrar la pestaña donde podrás generar un cupón canjeable en el local. Canjeando el código del cupón podrás obtener todas tus recompensas!</p>
                </div>
            </div>
        </div>

        <div  class="clear"></div>

        <hr class="custom">

        <div id="eventos" class="container">
            <h2 class="txt-c">Próximos Eventos</h2>
            @if(count($events) == 0)
                <div class="alert alert-secondary txt-c" role="alert">
                    ¡No hay eventos próximamente, sigue revisando que lanzaremos alguno en cualquier momento!
                </div>
            @else
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                <ol class="carousel-indicators">
                    @foreach($events as $key => $event)
                        @if($key == 0)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="active"></li>
                        @else
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"></li>
                        @endif
                    @endforeach
                </ol>

                <div class="carousel-inner" role="listbox">
                    @foreach($events as $key => $event)
                        @if($key == 0)
                            <div class="carousel-item active">
                                <img class="d-block" src="{{ $event->photo }}" alt="{{ $event->title }}" width="250px" height="600px">
                                <div class="carousel-caption d-none d-md-block">
                                    <h2 style="font-weight: bold; font-size: 50px">{{ $event->title }}</h2>
                                    <p style="font-weight: bold; font-size: 20px">{{ $event->description }}</p>

                                    <div class="cta">
                                        <div class="meta">
                                            <p style="color: black"><b>Desde: </b> {{ $event->start_date }}</p>
                                            <p style="color: black"><b>Hasta: </b> {{ $event->end_date }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="carousel-item">
                                <img class="d-block" src="{{ $event->photo }}" width="250px" height="600px">
                                <div class="carousel-caption d-none d-md-block">
                                    <h2 style="font-weight: bold; font-size: 50px">{{ $event->title }}</h2>
                                    <p style="font-weight: bold; font-size: 20px">{{ $event->description }}</p>

                                    <div class="cta">
                                        <div class="meta">
                                            <p><b>Desde: </b> {{ $event->start_date }}</p>
                                            <p><b>Hasta: </b> {{ $event->end_date }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
            @endif
        </div>

        <div class="clear"></div>

        <hr class="custom">

        <div class="bubble mybubblebgreservas">
            <h2 style="color: white;">Reserva tu mesa ahora</h2>

            <div class="container mt40 mb-5" style="color: white; text-align: center;">
                <p><b>Un nuevo y mejorado sistema de reservas que te permitirá visitarnos siempre sin ninguna sorpresa</b></p>
                <p><b>Informanos qué día y hora deseas reservar, y en cuestión de minutos obtendrás una respuesta... ¡Fácil y sencillo!</b></p>
                <p></p>
            </div>

            <a href="{{ url('/user-books') }}" style="text-decoration: none"><button type="button" class="btn btn-outline-light btn-lg btn-block">Realizar reserva</button></a>
        </div>
    </section>
@stop