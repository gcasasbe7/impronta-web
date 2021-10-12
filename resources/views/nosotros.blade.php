@extends('main_layout')

@section('content')
    <section class="mycontainer headerbackground mt-5">
        <div class="title clear">
            <div class="txt-c">
                <div class="g8 g-center txt-c">
                    <h1 class="customTitle">Nosotros9</h1>
                </div>
            </div>
            <div class="gradient-diamond"></div>
        </div>

        <div class="clear"></div>


        <div class="txt-c mt40">
            <div class="row" style="margin-top:20px;">
                <div class="col-md-6">
                    <img src="{{url('/assets/img/italy.png')}}">
                    <h3 class="b c-db mt-3">¿Quienes somos?</h3>
                    <p style="padding: 10px;">Somos una familia italiana apasionada por el mundo de la restauración y la comida originaria de nuestro país. Nuestro mayor deseo es traer el toque italiano a nuestros platos, todo
                    globalizado en un ambiente familiar y muy agradable. Años de experiencia nos caracterizan, y la habilidad con las masas y el horno de piedra dan resultado a fantásticas pizzas que
                    queremos que pruebes. Y como decimos nosotros... <i>"A tavola, è ora di mangiare".</i></p>
                </div>

                <div class="col-md-6">
                    <img src="{{url('/assets/img/map-location.png')}}">
                    <h3 class="b c-db mt-3">¿Donde nos puedes encontrar?</h3>
                    <p><b>Provincia: </b>Barcelona</p>
                    <p><b>Ciudad: </b>Sant Andreu de Llavaneres</p>
                    <p><b>Calle: </b>C/Pintors Masriera nº2</p>
                    <small>¡Podrás encontrar párking fácilmente en los alrededores!</small>
                </div>
            </div>

            <hr class="custom">

            <div class="row" style="margin-top:20px;">
                <div class="col-md-6">
                    <img src="{{url('/assets/img/email.png')}}">
                    <h3 class="b c-db mt-3">Contacto directo</h3>
                    <div class="row mt-3">
                        <div class="col-sm">
                            <img src="{{url('/assets/img/telephone.png')}}">
                            <p><b>Teléfono</b></p>
                            <p>93 174 78 76</p>
                        </div>
                        <div class="col-sm">
                            <img src="{{url('/assets/img/at.png')}}">
                            <p><b>Correo electrónico</b></p>
                            <p>improntabar@gmail.com</p>
                        </div>
                        <div class="col-sm">
                            <img src="{{url('/assets/img/social-media.png')}}">
                            <p><b>Redes sociales</b></p>
                            <p>@improntapizza</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <img src="{{url('/assets/img/map-places.png')}}">
                    <h3 class="b c-db mt-3">Zonas de reparto</h3>
                    <p class="mt-4">Sant Andreu de Llavaneres</p>
                    <p>Sant Vicenç de Montalt</p>
                    <p>Caldes d'Estrach</p>
                </div>
            </div>
        </div>

        <div class="clear"></div>




    </section>


@stop