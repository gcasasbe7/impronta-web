@extends('main_layout')
@section('content')
    <section class="mycontainer headerbackground mt-5">
        <div class="title clear">
            <div class="txt-c">
                <div class="g8 g-center txt-c">
                    <h1 class="customTitle">{{ \Illuminate\Support\Facades\Auth::user()->name }}9</h1>
                    <!-- <h3 class="c-wh mb0 subtitle">¡Bienvenido a nuestra página web, descubre todas nuestras novedades!</h3>-->
                </div>
            </div>
            <div class="gradient-diamond"></div>
        </div>
    </section>
    <div id="vue-user" class="row m-0 mt-3" xmlns:v-on="http://www.w3.org/1999/xhtml"
         xmlns:v-bind="http://www.w3.org/1999/xhtml">

        @include("user.user_menu")

        <div class="col-md-8">
            <div id="home-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Mi perfil</h3>
                </div>
                <div class="card-body">
                    <div class="container txt-c">
                        <p>{{ \Illuminate\Support\Facades\Auth::user()->name }}, actualmente tienes:</p><h2>{{ \Illuminate\Support\Facades\Auth::user()->points }}</h2><p>puntos</p>
                        <p class="mt-4"><h4 style="font-size: 25px; font-weight: bold">¿Qué puedo hacer en mi panel de usuario?</h4></p>
                        <div class="row">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Tus pedidos y reservas</b>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>¡Gestiona todos tus pedidos y reservas desde tu panel de usuario!</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Tus platos favoritos</b>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>¡Guarda tus platos favoritos de nuestra carta para acceder más rapido a ellos!</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Tus pizzas</b>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>¡Inventa tus pizzas, guárdalas en tu panel de usuario, y pídelas cuando quieras! ¡Fácil y rápido!</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div><div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Canjea tus puntos</b>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>¡Canjea tus puntos desde tu panel de usuario para realizar pagos en nuestro local!</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div><div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Dínos qué no te gusta</b>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>¡Indícanos que ingredientes no te gustan, para avisarte y tenerlo en cuenta en futuras ocasiones!</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="pedidos-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Mis pedidos</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <a href="{{ url('/menu') }}" style="text-decoration: none"><button type="button" class="btn btn-primary btn-lg btn-block">Realizar nuevo pedido</button></a>
                        <div class="row mt-4" style="margin: 0;">
                            <div class="card" style="width: 18rem; margin: 20px 10px" v-for="order in myOrders">
                                <div class="card-body">
                                    <h5 class="card-title txt-c" style="font-size: 35px"><b>Pedido nº @{{ order.id }}</b></h5>
                                    <h5 class="card-subtitle"><small><b>Realizado el @{{ customFormatDate(order.orderDate) }}</b></small></h5><br>
                                    <p><b>Dirección de envío: </b>@{{ order.direction }}</p>
                                    <div class="row">
                                        <div class="col-md offset-md-2">
                                            <button :id="'btnShowContent' + order.id" type="button" class="btn btn-primary" v-on:click.prevent="showContent(order.id)">Ver contenido</button>
                                        </div>
                                    </div>

                                    <div :id="'ordercontent' + order.id" class="hide mt-4 mb-4" style="padding: 20px 10px; background-color: #CEE3F6; border-radius: 15px">
                                        <div v-for="product in order.orderproducts">
                                            <p>(x@{{ product.quantity }}) @{{ product.product_name }} @{{ product.size }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md offset-md-3">
                                            <div v-if="order.state == 'Listo'" v-on:click="deleteOrder(order)" data-tooltip="Eliminar pedido" data-tooltip-position="bottom" class="btn btn-danger mt-1" style="width: 40px;height: 40px"><i class="fas fa-trash-alt"></i></div>
                                            <a v-else href="{{ url('nosotros') }}" data-tooltip="Contáctanos por teléfono para eliminar un pedido no terminado" data-tooltip-position="bottom"><div class="btn btn-danger" style="background-color:  #681200;border-color:  #681200 "><i class="fas fa-trash-alt"></i></div></a>
                                            <div v-if="order.state == 'Listo'" v-on:click="confirmRepeatOrder(order)" data-tooltip="Repetir el pedido" data-tooltip-position="bottom" class="btn btn-warning mt-1" style="background-color: orange;color: white;width: 40px;height: 40px"><i class="fas fa-redo"></i></div>
                                            <div v-else data-tooltip="No puedes repetir un pedido que no ha terminado" data-tooltip-position="bottom" class="btn btn-secondary" style="background-color: grey;color: white; width: 40px;height: 40px"><i class="fas fa-redo"></i></div>
                                        </div>
                                    </div>

                                    <div class="txt-c">
                                        <br>
                                        <p><b>Total: </b>@{{ order.total_price }} €</p>
                                        <p><b>Puntos recibidos: </b>@{{ order.reward_points }}</p>
                                    </div>

                                </div>
                                <div class="card-footer text-muted txt-c">
                                    <p><a href="{{ url('nosotros') }}" data-tooltip="Enviado, Preparando, Listo o En reparto" data-tooltip-position="bottom"><i class="fas fa-question"></i></a></p>
                                    <p v-if="order.state == 'Enviado' "style="color: grey;font-size: 20px"><b>@{{ order.state }}</b></p>
                                    <p v-if="order.state == 'Preparando' "style="color: blue;font-size: 20px"><b>@{{ order.state }}</b></p>
                                    <p v-if="order.state == 'Listo' "style="color: green;font-size: 20px"><b>@{{ order.state }}</b></p>
                                    <p v-if="order.state == 'En reparto' "style="color: green;font-size: 20px"><b>@{{ order.state }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div v-if="myOrders.length == 0" class="alert alert-primary txt-c" role="alert">
                            <b>Todavía no has realizado ningún pedido</b>
                        </div>
                    </div>
                </div>
            </div>

            <div id="reservas-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Mis reservas</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <button type="button" v-on:click.prevent="showModalBook()" class="btn btn-primary btn-lg btn-block">Realizar nueva petición de reserva</button>
                        <div class="row mt-4" style="margin: 0;">
                            <div class="card" style="width: 18rem; margin: 20px 10px" v-for="book in myBooks">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 25px"><b>Reserva día @{{ customFormatDate(book.bookDate) }}</b></h5>
                                    <p>@{{ book.numPeople }} personas</p>
                                    <div style="float:right;">
                                        <a href="{{ url('nosotros') }}" data-tooltip="Contáctanos por teléfono para eliminar una reserva" data-tooltip-position="bottom"><div class="btn btn-danger"><i class="fas fa-trash-alt"></i></div></a>
                                    </div>
                                </div>
                                <div class="card-footer text-muted txt-c">
                                    <p v-if="book.state == 'Pendiente de confirmación' "style="color: orange;font-size: 20px"><b>@{{ book.state }}</b></p>
                                    <p v-if="book.state == 'Confirmada' "style="color: green; font-size: 20px"><b>@{{ book.state }}</b></p>
                                    <p v-if="book.state == 'Rechazada' "style="color: red; font-size: 20px"><b>@{{ book.state }}</b></p>
                                </div>
                            </div>
                        </div><div v-if="myBooks.length == 0" class="alert alert-primary txt-c" role="alert">
                            <b>No tienes reservas pendientes</b>
                        </div>

                    </div>
                </div>
            </div>

            <div id="favoritos-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Mis favoritos</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div v-if="myFavs.length == 0" class="alert alert-primary txt-c" role="alert">
                            <b>¡Vaya! Todavía no tienes ningún producto favorito... ¿Por qué no hechas un vistazo a nuestra <a href="{{ url('/menu') }}" class="alert-link">carta</a>?</b>
                        </div>
                        <div class="row mt-4" style="margin: 0;">
                            <div class="card" style="width: 18rem; margin: 20px 10px" v-for="fav in myFavs">
                                <img class="card-img-top" v-bind:src="fav.photo">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 25px"><b>@{{ fav.name }}</b></h5>
                                    <h4 class="card-title">@{{ fav.description }}</h4>
                                    <div class="card-text" v-for="ingredient in fav.ingredients">
                                        <a class="myingredientstag pointer bless">@{{ ingredient.name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mispizzas-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Mis pizzas</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <button type="button" v-on:click.prevent="showModalPizza()" class="btn btn-primary btn-lg btn-block">¡Crear mi propia pizza!</button>
                        <div v-if="myPizzas.length == 0" class="alert alert-primary txt-c mt-2" role="alert">
                            <b>¿Todavía no tienes tu pizza? ¡Abre tu imaginación y crea una obra de arte!</b>
                        </div>
                        <div class="row mt-4" style="margin: 0;">
                            <div class="card" style="width: 18rem; margin: 20px 10px" v-for="pizza in myPizzas">
                                <img class="card-img-top" v-bind:src="pizza.photo" v-bind:alt="pizza.name">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 25px"><b>@{{ pizza.name }}</b></h5>
                                    <h4 class="card-title">@{{ pizza.description }}</h4>
                                    <div class="card-text" v-for="ingredient in pizza.ingredients">
                                        <a class="myingredientstag pointer bless">@{{ ingredient.name }}</a>
                                    </div>

                                    <div style="float:right;">
                                        <div v-on:click="deleteMyPizza(pizza.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></div>
                                    </div>
                                </div>
                                <div class="card-footer text-muted txt-c">
                                    <p v-if="pizza.isPublic == 1"><b>Pizza pública</b></p>
                                    <p v-else><b>Pizza privada</b></p>
                                    <div class="row">
                                        <div class="col-sm txt-c">
                                            <p><b>Pequeña</b></p>
                                            <p>@{{ pizza.price_s }} €</p>
                                        </div>
                                        <div class="col-sm txt-c">
                                            <p><b>Mediana</b></p>
                                            <p>@{{ pizza.price_m }} €</p>
                                        </div>
                                        <div class="col-sm txt-c">
                                            <p><b>Grande</b></p>
                                            <p>@{{ pizza.price_l }} €</p>
                                        </div>
                                        <div class="col-sm txt-c" data-tooltip="¡Nuestra irresistible masa crujiente!" data-tooltip-position="bottom">
                                            <p><b>Brusquetta</b></p>
                                            <p>@{{ pizza.price_b }} €</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="canjear-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Generar cupón</h3>
                </div>
                <div class="card-body">
                    <div class="container txt-c">
                        <p>{{ \Illuminate\Support\Facades\Auth::user()->name }}, actualmente tienes:</p><h2 id="userPoints">@{{ user_points }}</h2><p>puntos.</p>
                        <div class="myslidecontainer">
                            <input type="range" min="1" max="{{ \Illuminate\Support\Facades\Auth::user()->points }}" value="0" class="myslider" id="myRange">
                            <div class="mt-4">Puntos a usar en el cupón:  <input type="text" id="demo" class="myform-control" v-on:keyup="refreshValueEuros()"><span style="font-size: 25px"><b>(<span id="pointsInEuros">0</span> €)</b></span></div>
                            <button id="generateVoucher" type="button" v-on:click.prevent="generateVoucher()" class="btn btn-primary btn-lg btn-block mt-4">¡Generar cupón!</button>
                            <div id="responseVoucher" class="alert alert-primary hide mt-3" role="alert"><p>El código del cupón es: <span id="voucherCode" style="font-weight: bold"></span></p>
                                <p><b>¡No te olvides de canjearlo, el cupón expira en 10 días!</b></p>
                                <button v-on:click.prevent="newVoucher()" type="button" class="btn btn-outline-primary">Generar un nuevo cupón</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container txt-c mt-4">
                            <h3>Listado de cupones disponibles</h3>
                            <div v-if="myVouchers.length == 0" class="alert alert-primary" role="alert">
                                <b>Todavía no has generado ningún cupón</b>
                            </div>
                            <div class="row">
                                <div v-for="cupon in myVouchers" class="col-sm mt-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-header"><b>Cupón de @{{ cupon.points }} puntos (@{{ pointsToEuros(cupon.points) }} €)</b></h5>
                                            <p class="card-text mt-4">El cupón caduca el <b>@{{ customFormatDate(cupon.dead_date) }}</b></p>
                                            <p class="card-text" style="color: red">¡Te quedan <b style="font-size: 30px">@{{ diffInDays(cupon.dead_date) }} </b>días!</p>
                                            <div class="alert alert-info" role="alert" style="border-style: dashed; border-width: 6px; border-color: #1AAE88">
                                                @{{ cupon.code }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="config-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Configuración de mi cuenta</h3>
                </div>
                <div class="card-body">
                    <div class="container txt-c">
                        <p class="mt-4"><h4 style="font-size: 25px; font-weight: bold">¿Qué puedo configurar en mi perfil?</h4></p>
                        <div class="row">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Tu dirección</b>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>¡Indicanos tu dirección para una mayor comodidad en todos tus envíos!</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Correo electrónico</b>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>¡Actualiza tu dirección de correo electrónico si la cambias!</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Tu foto de perfil</b>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>¡Cambia tu foto de perfil de usuario cuando quieras... Así te verán todos!</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Dínos qué no te gusta</b>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>¡Indícanos que ingredientes no te gustan, para avisarte y tenerlo en cuenta en futuras ocasiones!</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="nomegusta-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>No me gusta</h3>
                </div>
                <div class="container txt-c">
                    <p class="mt-4"><h4>{{ \Illuminate\Support\Facades\Auth::user()->name }}, ¿<b>eres alérgico</b>, o simplemente <b>detestas</b> algún ingrediente?</h4></p>
                    <p>Indícanos en esta sección cuáles son aquellos ingredientes que no te gustan o no toleras, de éste modo podremos avisarte en la carta de qué productos contienen o no estos ingredientes que has marcado como negativos.</p>
                    <div class="row">
                        <div class="col-sm">
                            <i class="fas fa-search"style="font-size: 80px"></i>
                            <p><b>Busca ingredientes</b></p>
                            <p>Encontrarás TODOS los ingredientes que usamos para elaborar nuestros platos</p>
                        </div>
                        <div class="col-sm">
                            <i class="fas fa-times" style="font-size: 80px"></i>
                            <p><b>Elimina ingredientes</b></p>
                            <p>Si quieres eliminar algun ingrediente, simplemente haz click sobre él</p>
                        </div>
                    </div>

                    <div class="autocomplete">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                            </div>
                            <input id="inpSearchIngredient" type="text" class="form-control" placeholder="Ingrediente...">
                        </div>
                    </div>
                    <br>
                    <a v-for="ingredient in myDontLikeIngredients" class="myingredientstag pointer mt-3" v-on:click.prevent="deleteIngredient(ingredient)">@{{ ingredient.name }}</a>
                </div>
            </div>

            <div id="cambiardireccion-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Cambiar dirección de envío</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <p>{{ \Illuminate\Support\Facades\Auth::user()->name }}, configura aquí tu dirección para hacer tus pedidos de una manera mucho más cómoda.</p>
                            <div class="alert alert-warning txt-c" role="alert" v-if="userDirection.length == 0">
                                <p><b>Todavía no tienes configurada ninguna dirección de envío... ¿¡A qué esperas!? </b></p>
                            </div>
                            <div class="alert alert-primary txt-c" role="alert" v-else>
                                <p><b>Tu dirección de envío es: </b>@{{ userDirection }}</p>
                            </div>
                            <div class="row">
                                <div class="input-group col-md">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-map-marker"></i></div>
                                    </div>
                                    <input id="newDirection" class="form-control" placeholder="Nueva dirección de envío">
                                </div>
                                <div class="col-md">
                                    <button v-on:click="changeUserDirection()" class="btn btn-outline-secondary btn-lg mt-2">Cambiar dirección de envío</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="cambiaremail-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Cambiar correo electrónico</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            @include('partial.flash')
                            @if(session('user_id'))
                                <form class="form-horizontal" method="POST" action="{{ route('email.newdata') }}">
                                    {{ csrf_field() }}
                                    <label>Por favor, introduce tu nueva dirección de correo electrónico:</label><br>
                                    <small>Esta será tu nueva dirección de correo electrónico.</small>
                                    <div class="input-group mb-2 col-md-7" style="padding: 0">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-at"></i></div>
                                        </div>
                                        <input id="newEmail" name="new-email" type="email" class="form-control" placeholder="Nuevo correo electrónico">
                                    </div>

                                    <label>Por favor, repite tu nueva dirección de correo electrónico:</label><br>
                                    <div class="input-group mb-2 col-md-7" style="padding: 0">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-at"></i></div>
                                        </div>
                                        <input id="newEmailRepeat" name="new-email-repeat" type="email" class="form-control" placeholder="Nuevo correo electrónico">
                                    </div>
                                    <div class="form-group hide">
                                        <div class="col-md-6">
                                            <input id="user-id" name="user-id" value="{{ session('user_id') }}" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-secondary btn-lg mt-2">Cambiar correo electrónico</button>
                                </form>
                            @else
                                <form class="form-horizontal" method="POST" action="{{ route('email.reset') }}">
                                    {{ csrf_field() }}
                                    <label>Por favor, introduce tu dirección de correo electrónico actual:</label><br>
                                    <small>Te enviaremos un correo a esta dirección para confirmar el cambio</small>
                                    <div class="input-group mb-2 col-md-7" style="padding: 0">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-at"></i></div>
                                        </div>
                                        <input id="oldEmail" name="email-reset" type="email" class="form-control" placeholder="Correo electrónico actual">
                                    </div>

                                    <button type="submit" class="btn btn-outline-secondary btn-lg mt-2">Enviar correo electrónico</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div id="cambiarimagen-content" class="card hide appcontent">
                <div class="card-header">
                    <h3>Cambiar foto de perfil</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm txt-c">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 80px"></i>
                            <p><b>Sube la imagen desde tu dispositivo</b></p>
                            @include("partial.flash")
                            <p>¡Selecciona una de tus mejores fotos para mostrarte bien al resto de la comunidad!</p>
                        </div>
                        <div class="col-sm txt-c">
                            <i class="fas fa-question" style="font-size: 80px"></i>
                            <p><b>¿Quién podrá ver mi imagen de perfil?</b></p>
                            <p>Tu imagen la podrá ver toda la comunidad al realizar comentarios o publicar tus propias pizzas</p>
                        </div>
                        <div class="col-md-8 offset-md-4 mt-4">
                            <form action="{{ url('uploadimage') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" name="file" id="file" onchange="loadImage(this)">
                                <div class="row">
                                    <div class="container">
                                        <div class="col-md-4 offset-md-1">
                                            <img id="blah" class="card-img-top mh-300 hide mt-3" />
                                            <button type="submit" id="submit" class="btn btn-outline-secondary btn-lg mt-2 hide">Cambiar foto de perfil</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('user.popups.popup_create_pizza')
        @include('user.popups.popup_create_book')
        @include('user.popups.popup_confirm_reorder')
    </div>
    <script>
        var appSettings = {page :"{{$page}}"};
    </script>
    <script src="{{ url('../resources/assets/js/vue-user.js') }}"></script>
    <script src="{{ url('../resources/assets/js/usermenu.js') }}"></script>
    <script src="{{ url('../resources/assets/js/seekbar.js') }}"></script>
@stop


