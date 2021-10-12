@extends('main_layout')

@section('content')
    <section class="mycontainer headerbackground mt-5">
        <div class="title clear">
            <div class="txt-c">
                <div class="g8 g-center txt-c">
                    <h1 class="customTitle">Carta9</h1>
                    <!-- <h3 class="c-wh mb0 subtitle">¡Bienvenido a nuestra página web, descubre todas nuestras novedades!</h3>-->
                </div>
            </div>
            <div class="gradient-diamond"></div>
        </div>
    </section>
    <div id="menuVue" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="container mt-3">
            @if(!\Illuminate\Support\Facades\Auth::check())
                <div class="row">
                    <div class="col-md-9 offset-md-2" style="overflow-x: auto">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label id="lblPizzas" class="btn btn-secondary btn-lg active" v-on:click="getContent('pizzas',0)">
                                <input type="radio" name="options"  autocomplete="off"><img src="{{url('/assets/img/pizzaw.png')}}"> Pizzas
                            </label>
                            <label id="lblAntipasto" class="btn btn-secondary btn-lg" v-on:click="getContent('antipasto',0)">
                                <input type="radio" name="options" autocomplete="off"><img src="{{url('/assets/img/appetizer.png')}}"> Antipasto
                            </label>
                            <label id="lblEnsaladas" class="btn btn-secondary btn-lg" v-on:click="getContent('ensaladas',0)">
                                <input type="radio" name="options"   autocomplete="off"><img src="{{url('/assets/img/salad.png')}}"> Ensaladas
                            </label>
                            <label id="lblBebidas" class="btn btn-secondary btn-lg" v-on:click="getContent('bebidas',0)">
                                <input type="radio" name="options"  autocomplete="off"><img src="{{url('/assets/img/lemonade.png')}}"> Bebidas
                            </label>
                            <label id="lblHelados" class="btn btn-secondary btn-lg" v-on:click="getContent('helados',0)">
                                <input type="radio" name="options"  autocomplete="off"><img src="{{url('/assets/img/icecream-cone.png')}}"> Helados
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-9 offset-md-3" style="overflow-x: auto;padding-left: 50px;">
                        <div class="btn-group btn-group-toggle">
                            <label id="lblUserPizzas" class="btn btn-secondary btn-lg active" v-on:click.prevent="alertLog()">
                                <input type="radio" name="options"  autocomplete="off"><img src="{{url('/assets/img/customer.png')}}"> Mis pizzas
                            </label>
                            <label id="lblUserFavs" class="btn btn-secondary btn-lg active" v-on:click.prevent="alertLog()">
                                <input type="radio" name="options" autocomplete="off"><img src="{{url('/assets/img/myfavs.png')}}"> Mis favoritos
                            </label>
                            <label id="lblComunity" class="btn btn-secondary btn-lg active" v-on:click.prevent="alertLog()">
                                <input type="radio" name="options" autocomplete="off"><img src="{{url('/assets/img/group.png')}}"> Comunidad
                            </label>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-9 offset-md-2" style="overflow-x: auto">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label id="lblPizzas" class="btn btn-secondary btn-lg active" v-on:click="getContent('pizzas',1)">
                                <input type="radio" name="options"  autocomplete="off"><img src="{{url('/assets/img/pizzaw.png')}}"> Pizzas
                            </label>
                            <label id="lblAntipasto" class="btn btn-secondary btn-lg" v-on:click="getContent('antipasto',1)">
                                <input type="radio" name="options" autocomplete="off"><img src="{{url('/assets/img/appetizer.png')}}"> Antipasto
                            </label>
                            <label id="lblEnsaladas" class="btn btn-secondary btn-lg" v-on:click="getContent('ensaladas',1)">
                                <input type="radio" name="options"   autocomplete="off"><img src="{{url('/assets/img/salad.png')}}"> Ensaladas
                            </label>
                            <label id="lblBebidas" class="btn btn-secondary btn-lg" v-on:click="getContent('bebidas',1)">
                                <input type="radio" name="options"  autocomplete="off"><img src="{{url('/assets/img/lemonade.png')}}"> Bebidas
                            </label>
                            <label id="lblHelados" class="btn btn-secondary btn-lg" v-on:click="getContent('helados',1)">
                                <input type="radio" name="options"  autocomplete="off"><img src="{{url('/assets/img/icecream-cone.png')}}"> Helados
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-9 offset-md-3" style="overflow-x: auto;padding-left: 50px;">
                        <div class="btn-group btn-group-toggle">
                            <label id="lblUserPizzas" class="btn btn-secondary btn-lg" v-on:click="getContent('mypizzas')">
                                <input type="radio" name="options"  autFocomplete="off"><img src="{{url('/assets/img/customer.png')}}"> Mis pizzas
                            </label>
                            <label id="lblUserFavs" class="btn btn-secondary btn-lg" v-on:click="getContent('myfavs')">
                                <input type="radio" name="options" autocomplete="off"><img src="{{url('/assets/img/myfavs.png')}}"> Mis favoritos
                            </label>
                            <label id="lblComunity" class="btn btn-secondary btn-lg" v-on:click="getContent('community')">
                                <input type="radio" name="options" autocomplete="off"><img src="{{url('/assets/img/group.png')}}"> Comunidad
                            </label>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mt-4">
                <div class="col-md-1 offset-md-3">
                    <span><b>Buscador: </b></span>
                </div>
                <div class="col-md-5">
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-search"></i></div>
                        </div>
                        <input id="myInputSearchProduct" v-model="searcher" v-on:keyup="getContent('search')" type="text" class="form-control" placeholder="Busca cualquier producto...">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <div v-if="menuproducts.length == 0" class="alert alert-danger txt-c" role="alert">
                <strong>No se han encontrado resultados en la búsqueda.</strong>
            </div>
            <div class="card" v-for="(product,key) in menuproducts" :key="product">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link righte mycardtitle" data-toggle="collapse" aria-expanded="true" :data-target="'#collapsepizza' + key">
                            @auth
                                <div class="row">
                                    <div class="col">
                                        <i v-if="isProductDontLiked(product.id)" class="fas fa-exclamation-triangle"></i>
                                        @{{ product.name }}
                                    </div>
                                    <div class="col">
                                        <span v-if="product.isExhausted == 1" style="color: red;"><i class="fas fa-exclamation-triangle"></i>(Producto agotado)</span>
                                    </div>
                                </div>
                            @endauth
                            @guest
                                <div class="row">
                                    <div class="col">
                                        @{{ product.name }}
                                    </div>
                                    <div class="col">
                                        <span v-if="product.isExhausted == 1" style="color: red;"><i class="fas fa-exclamation-triangle"></i>(Producto agotado)</span>
                                    </div>
                                </div>
                            @endguest
                        </button>
                    </h5>
                </div>

                <div :id="'collapsepizza' + key" class="collapse show" data-parent="#accordion">
                    <div class="card-body p30">
                        <div class="row">
                            <div class="col-md-5 offset-md-1">
                                <div class="card">
                                    <img class="card-img-top" v-bind:src="product.photo" height="auto">
                                    <div class="card-body">
                                        <h3 class="card-title">@{{ product.name }}</h3>
                                        <h4>@{{ product.description }}</h4>
                                        <p v-if="product.user_id != 1">
                                            <img src="{{ url('/assets/img/chef.png') }}">
                                            <small>Pizza creada por @{{ product.user.name }} @{{ product.user.surnames }}</small>
                                        </p>

                                        @auth
                                            <div v-if="isProductDontLiked(product.id)" class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <h6 class="card-subtitle mb-2 text-muted txt-c"><strong>Contiene ingredientes que has indicado como negativos</strong></h6>
                                            </div>

                                            <div v-for="ingredient in product.ingredients">
                                                <a class="myingredientstag pointer bless"><i v-if="isDontLiked(ingredient.id)" class="fas fa-exclamation-triangle"></i>@{{ ingredient.name }}</a>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <button v-if="product.isExhausted == 0" type="button" class="btn btn-outline-success" style="float: right;" v-on:click="mainOrder.showPopUpAddPizza(product)"><i class="far fa-plus-square"></i> Añadir al pedido</button>
                                                </div>

                                                <div class="col-sm-2">
                                                    <a :id="'btnLikes' + product.id" onclick="likeButton(this.id)" class="pointer hasLike" v-if="isLiked(product.id)">
                                                    <span :id="'spanLikes' + product.id" class="badge badge-success like">
                                                        <i id="iconoLikes" class="far fa-thumbs-up fa-lg"></i>
                                                        <span :id="'numLikes' + product.id">@{{ product.likes }}</span>
                                                    </span>
                                                    </a>
                                                    <a :id="'btnLikes' + product.id" onclick="likeButton(this.id)" class="pointer" v-else>
                                                    <span :id="'spanLikes' + product.id" class="badge badge-primary like">
                                                        <i id="iconoLikes" class="far fa-thumbs-up fa-lg"></i>
                                                        <span :id="'numLikes' + product.id">@{{ product.likes }}</span>
                                                    </span>
                                                    </a>
                                                </div>
                                            </div>

                                        @endauth
                                        @guest
                                            <div v-for="ingredient in product.ingredients">
                                                <a class="myingredientstag pointer bless">@{{ ingredient.name }}</a>
                                            </div>
                                            <a href="{{ url('/loginregister') }}" style="float:right;" class="pointer" data-tooltip="Inicia sesión para indicar que te gusta" data-tooltip-position="bottom"><span class="badge badge-primary like"><i class="far fa-thumbs-up"></i> @{{ product.likes }} </span></a>
                                        @endguest
                                    </div>

                                    <div class="card-footer text-muted">
                                        <div class="row" v-if="product.type == 1">
                                            <div class="col-sm txt-c">
                                                <p><b>Pequeña</b></p>
                                                <p>@{{ product.price_s }} €</p>
                                            </div>
                                            <div class="col-sm txt-c">
                                                <p><b>Mediana</b></p>
                                                <p>@{{ product.price_m }} €</p>
                                            </div>
                                            <div class="col-sm txt-c">
                                                <p><b>Grande</b></p>
                                                <p>@{{ product.price_l }} €</p>
                                            </div>
                                            <div class="col-sm txt-c" data-tooltip="¡Nuestra irresistible masa crujiente!" data-tooltip-position="bottom">
                                                <p><b>Brusquetta</b></p>
                                                <p>@{{ product.price_b }} €</p>
                                            </div>
                                        </div>
                                        <div class="row" v-else>
                                            <div class="col-sm txt-c">
                                                <p class="text-muted" style="font-size: 20px">@{{ product.price }} €</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 offset-md-1">
                                <ul style="padding: 0">
                                    <span v-if="product.comments.length == 0">
                                        <div class="alert alert-info alert-dismissible fade show txt-c">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            Este producto todavía no tiene comentarios... <strong>¡Se el primero!</strong>
                                        </div>
                                    </span>
                                    <li class="speech-bubble" style="display: block; margin: 10px 0px" v-for="comment in product.comments">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <img v-bind:src="comment.user_photo" style="border-radius: 50%" width="40px" height="40px">
                                            </div>
                                            <div class="col-sm lh40 ml-2">
                                                <span class="bold">@{{ comment.user_name }}</span>: @{{ comment.comment }}
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                                        <a class="pointer ml-2" v-on:click="checkDelete(comment.id)"><i :id="comment.id" class="fas fa-times"></i></a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                @auth
                                    <div class="row">
                                        <div class="container">
                                            <div class="form-group">
                                                <label for="comment">Comentario: <small>(<span :id="'counter' + product.id">0</span>/120 caracteres)</small></label>
                                                <textarea :id="'txtarea' + product.id" class="form-control" rows="5" maxlength="120" v-on:keyup="test(product.id)" placeholder="Déjanos tu comentario..."></textarea>
                                                <button v-on:click="addComment(product.id)" type="button" class="btn btn-outline-secondary mt-2">Comentar</button>
                                            </div>
                                        </div>
                                    </div>
                                @endauth
                                @guest
                                    <a href="{{ url('loginregister') }}" style="text-decoration: none"><div class="alert alert-warning txt-c" role="alert">
                                            <b>Inicia sesión para dejar tus comentarios</b>
                                        </div></a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partial.popup_addProductToOrder')
        </div>
    </div>
    <script>
        var menuContent = {content :"{{$content}}"};
    </script>
    <script src= "{{ url('../resources/assets/js/commentsbuilder.js') }} "></script>
    <script src= "{{ url('../resources/assets/js/menutransition.js') }} "></script>
@stop
