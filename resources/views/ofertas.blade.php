@extends('main_layout')

@section('content')
    <section class="mycontainer headerbackground mt-5">
        <div class="title clear">
            <div class="txt-c">
                <div class="g8 g-center txt-c">
                    <h1 class="customTitle">Ofertas9</h1>
                </div>
            </div>
            <div class="gradient-diamond"></div>
        </div>

        <div class="clear"></div>


        <div class="txt-c mt40" style="padding: 0px 15px">
            <h2>¡Tú eliges tu oferta!</h2>
            <div class="row" style="margin-top:20px;">
                <div class="col-md-6">
                    <img src="{{url('/assets/img/pcmobile.png')}}">
                    <h3 class="b c-db mt-3">¡Quiero conseguir puntos!</h3>
                    <p><b>Mediante el uso de nuestra web</b> conseguirás puntos al realizar pedidos, asistir a eventos y muchas otras formas. Mediante este modo <b>no podrás aprovechar nuestras promociones,</b> pero como ya sabes, los puntos que ganes podrán ser canjeados posteriormente por cualquier producto de nuestra carta.</p>
                </div>

                <div class="col-md-6">
                    <img src="{{url('/assets/img/tag.png')}}">
                    <h3 class="b c-db mt-3">¡Quiero aprovechar las ofertas!</h3>
                    <p><b>Llámanos o ven a visitarnos</b> para disfrutar de todos los descuentos y ofertas que te ofrecemos a continuación. Mediante este modo <b>no vas a recibir puntos de recompensa,</b> pero no te pierdas las super promociones que te ofrecemos.</p>
                </div>
            </div>
        </div>

        <div class="clear"></div>

        <hr class="custom">

        <div class="bubble mybubblebgofertas">
            <h2 style="color: white;"><b>OFERTAS EN EL LOCAL</b></h2>

            <div class="container mt40" style="color: white; text-align: center;">
                <div class="row">
                    <div class="col-md-4" style="border-style: solid; border-radius: 10%;">
                        <div class="container">
                            <div class="row offset-4">
                                <h2>2X1</h2>
                            </div>
                            <div class="row">
                                <h3>EN TODAS LAS MEDIDAS Y PIZZAS</h3>
                            </div>
                            <div class="row offset-4">
                                <h2>3x2</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="border-style: solid; border-radius: 10%">
                        <h3>PIDE Y RECOJE TU PIZZA POR:</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>12 € FAMILIAR</h3>
                            </div>
                            <div class="col-sm-6">
                                <h3>8 € MEDIANA</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm offset-sm-1">
                                <h3>PEQUÑA 5 €</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="border-style: solid; border-radius: 10%">
                        <h3>LUNES DIA DEL CLIENTE</h3>
                            <h3>FAMILIAR 9 €</h3>
                            <h3>MEDIANA 6 €</h3>
                            <h3>PEQUEÑA 3,50 €</h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="bubble mybubblebgofertas">
            <h2 style="color: white;"><b>OFERTAS A DOMICILIO</b></h2>

            <div class="container mt40" style="color: white; text-align: center;">
                <div class="row">
                    <div class="col-md" style="border-style: solid; border-radius: 10%;">
                        <h3>PIDE UNA FAMILIAR Y TE REGALAMOS</h3>
                        <div class="row">
                            <div class="col-sm">
                                <h3>1 MEDIANA O </h3>
                            </div>
                            <div class="col-sm">
                                <h3>4 REFRESCOS</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md" style="border-style: solid; border-radius: 10%;">
                        <h3>PIDE UNA MEDIANA Y TE REGALAMOS</h3>
                        <div class="row">
                            <div class="col-sm">
                                <h3>1 PEQUEÑA O </h3>
                            </div>
                            <div class="col-sm">
                                <h3>2 REFRESCOS</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md" style="border-style: solid; border-radius: 10%;">
                        <h3>PIDE UNA FAMILIAR Y LA SEGUNDA</h3>
                        <h3><b>TE SALE POR 4 €</b></h3>
                    </div>
                    <div class="col-md" style="border-style: solid; border-radius: 10%;">
                        <h3>PIDE UNA MEDIANA Y LA SEGUNDA</h3>
                        <h3><b>TE SALE POR 3 €</b></h3>
                    </div>
                    <div class="col-md" style="border-style: solid; border-radius: 10%;">
                        <h3>PIDE UNA PEQUEÑA Y TE REGALAMOS</h3>
                        <h3><b>1 REFRESCO</b></h3>
                    </div>
                    <div class="col-md" style="border-style: solid; border-radius: 10%;">
                        <h2>3X2</h2>
                        <h3>EN TODAS LAS PIZZAS MEDIANAS</h3>
                        <h3>Y FAMILIARES</h3>
                    </div>
                    <div class="col-md" style="border-style: solid; border-radius: 10%;">
                        <h2>MENÚ OFERTA</h2>
                        <h3>PIZZA PEQUEÑA</h3>
                        <h3>PATATAS AL GUSTO</h3>
                        <h3>REFRESCO</h3>
                        <h2>12 €</h2>
                    </div>
                </div>
            </div>
        </div>

    </section>


@stop