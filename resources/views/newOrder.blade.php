@extends('main_layout')

@section('content')
    <section class="mycontainer headerbackground mt-5">
        <div class="title clear">
            <div class="txt-c">
                <div class="g8 g-center txt-c">
                    <h1 class="customTitle">L'impronta pizza9</h1>
                    <!-- <h3 class="c-wh mb0 subtitle">¡Bienvenido a nuestra página web, descubre todas nuestras novedades!</h3>-->
                </div>
            </div>
            <div class="gradient-diamond"></div>
        </div>
    </section>
    <div id="menuVue" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 txt-c mt-4">
                    <a href="{{url("/menu")}}"><button type="button" class="btn btn-success" style="color: white"><i class="fas fa-angle-double-left"></i> Volver a la carta</button></a>
                </div>
            </div>
        </div>

        <div class="row mt-4 mb-4" style="margin: 0; padding: 0px 40px">

            <div id ="sidebar" class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b>Contenido del pedido</b>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-secondary txt-c" role="alert" v-if="mainOrder.myOrder.length == 0">
                            <p><b>¡Todavía no tienes productos!</b></p>
                            <p>¡<a href="{{ url('/menu') }}" class="alert-link">Échale un ojo a la carta</a> y completa tu pedido!</p>
                        </div>
                        <div class="container">
                            <div v-for="object in mainOrder.myOrder">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img width="150" height="95" :src="object.product.photo">
                                    </div>
                                    <div class="col-md-6 offset-1">
                                        <p v-if="object.product.type == 1"><b style="font-size: 25px">x@{{ object.quantity }}</b> @{{ object.product.name }} @{{ object.size }}</p>
                                        <p v-else><b style="font-size: 25px">x@{{ object.quantity }}</b>  @{{ object.product.name }}</p>
                                        <small v-if="object.product.type == 1 && object.size == 'pequeña'">&emsp;&emsp;@{{ calculatePrice(object.product.price_s, object.quantity) }} €</small>
                                        <small v-if="object.product.type == 1 && object.size == 'mediana'">&emsp;&emsp;@{{ calculatePrice(object.product.price_m, object.quantity) }} €</small>
                                        <small v-if="object.product.type == 1 && object.size == 'grande'">&emsp;&emsp;@{{ calculatePrice(object.product.price_l, object.quantity) }} €</small>
                                        <small v-if="object.product.type == 1 && object.size == 'brusquetta'">&emsp;&emsp;@{{ calculatePrice(object.product.price_b, object.quantity) }} €</small>
                                        <small v-if="object.product.type != 1">&emsp;&emsp;@{{ calculatePrice(object.product.price,object.quantity) }} €</small>
                                    </div>
                                    <div class="col-md-1">
                                        <div v-on:click="deleteProductFromOrder(object)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></div>
                                    </div>
                                    <div class="col-md-1">
                                        <div v-on:click="editProductFromOrder(object)" class="btn btn-warning"><i class="fas fa-pencil-alt" style="color: white"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="txt-c mt-3"><b>Total: </b><span id="totalPrice">0</span> €</p>
                        <button type="button" class="btn btn-outline-success btn-lg btn-block" v-on:click.prevent="showmodalConfirmation()">Finalizar pedido</button>
                    </div>
                    <div class="card-footer text-muted txt-c">
                        ¡Con este pedido conseguirás <span id="rewPoints" style="font-weight: bold">0</span> puntos!
                        <p style="margin: 0; padding: 0"><i class="fas fa-star"></i></p>
                    </div>
                </div>

                <div class="alert alert-success alert-dismissible fade show mt-3 txt-c" role="alert">
                    <strong>¿Te gustaría añadir o quitar algún ingrediente de nuestras pizzas?</strong>
                    <p>¡No hay problema! <a target="_blank" href="{{ url('/user-pizzas') }}" class="alert-link">Crea tu pizza</a> con los ingredientes que más te apetezcan.</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>



            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <b>Recomendado para tí</b>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-secondary txt-c" role="alert" v-if="userRecommends.length == 0">
                            <p style="margin:0"><b>¡Todavía no sabemos qué recomendarte!</b></p>
                            <p style="margin: 0; padding: 0"><i class="fas fa-star"></i></p>
                            <small><i>¡Poco a poco nos iremos conociendo {{\Illuminate\Support\Facades\Auth::user()->name}}!</i></small>
                            <br>
                            <small><i>Nos basamos en experiencias de otros usuarios y en tus gustos para realizar una recomendación</i></small>
                        </div>
                        <div class="row">
                            <div class="col-sm" v-for="product in userRecommends">
                                <div class="card border-success mb-2" style="max-width: 18rem;">
                                    <div class="card-header txt-c"><b>@{{ product.name }}</b></div>
                                    <img class="card-img-top" :src="product.photo" width="150" height="150">
                                    <div class="card-body text-success txt-c">
                                        <p class="card-text" style="color: black;">@{{ product.description }}</p>
                                        <button type="button" class="btn btn-outline-success" v-on:click="mainOrder.showPopUpAddPizza(product)"><i class="far fa-plus-square"></i> Añadir al pedido</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <b>Recomendaciones del local</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <div class="card border-success mb-2" style="max-width: 18rem;">
                                    <div class="card-header txt-c"><b>Pizza Michel Angelo</b></div>
                                    <img class="card-img-top" src="https://okdiario.com/recetas/img/2017/04/21/pizza-carbonara.jpg" width="150" height="150">
                                    <div class="card-body text-success txt-c">
                                        <p class="card-text" style="color: black;">Inmersate en una explosión de sabores en cada mordisco de esta deliciosa pizza</p>
                                        <button type="button" class="btn btn-outline-success" v-on:click="showPopUpAddPizza(1)"><i class="far fa-plus-square"></i> Añadir al pedido</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card border-success mb-2" style="max-width: 18rem;">
                                    <div class="card-header txt-c"><b>Pizza Tiziano</b></div>
                                    <img class="card-img-top" src="http://johnvenaproduce.com/OCM/blogimages/pizzza.jpg" width="150" height="150">
                                    <div class="card-body text-success txt-c">
                                        <p class="card-text" style="color: black;">Extremadamente sabrosa y con todo tipo de verduras para seguir manteniendo la linea</p>
                                        <button type="button" class="btn btn-outline-success" v-on:click="showPopUpAddPizza(2)"><i class="far fa-plus-square"></i> Añadir al pedido</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card border-success mb-2" style="max-width: 18rem;">
                                    <div class="card-header txt-c"><b>Pizza Rafaello</b></div>
                                    <img class="card-img-top" src="https://i.pinimg.com/originals/85/7a/60/857a602a0c188d8f85cb94ea8b00ba40.jpg" width="150" height="150">
                                    <div class="card-body text-success txt-c">
                                        <p class="card-text" style="color: black;">No tiene desperdicio... ¡Para los amantes del picante y de las buenas pizzas!</p>
                                        <button type="button" class="btn btn-outline-success" v-on:click="showPopUpAddPizza(3)"><i class="far fa-plus-square"></i> Añadir al pedido</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partial.popup_confirmation')
        @include('partial.popup_direction')
        @include('partial.popup_addProductToOrder')
        @include('partial.popup_editProductOrder')
    </div>

    <script src= "{{ url('../resources/assets/js/commentsbuilder-neworder.js') }} "></script>
    <script src= "{{ url('../resources/assets/js/menutransition.js') }} "></script>
@stop
