@extends('housekeeping.housekeeping_layout')

@section('content')
<div id="housekeepingproductos" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="panel panel-default" style="padding: 20px;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 30px;">Gestión de productos</h3>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
                <input id="myInputSearchProduct" v-model="searcher" v-on:keyup="getContent()" type="text" class="form-control" placeholder="Busca cualquier producto...">
            </div>
        </div>
        <div class="panel-body">
            <a href="#" class="btn btn-outline-dark btn-lg" style="float: right" v-on:click.prevent="createProduct()">Añadir Producto</a>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th><b>Nombre</b></th>
                    <th><b>Foto</b></th>
                    <th><b>Likes</b></th>
                    <th><b>Tipo</b></th>
                    <th><b>Disponible</b></th>
                    <th><b>Descripción</b></th>
                    <th><b>Precio</b></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in showProducts">
                    <td width="200px">@{{ product.name }}</td>
                    <td width="200px">
                        <img v-if="product.photo" v-bind:src="product.photo" height="150px" width="200px">
                        <div v-else class="alert alert-dark txt-c" role="alert">
                            <b>Sin foto</b>
                        </div>
                    </td>
                    <td width="10px">@{{ product.likes }}</td>
                    <td width="10px">@{{ parseType(product.type) }}</td>
                    <td width="50px">
                        <img v-if="product.isExhausted" src="{{asset('../resources/assets/img/errorcross.png')}}" alt="">
                        <img v-else src="{{asset('../resources/assets/img/success.png')}}" alt="">
                    </td>
                    <td width="300px">@{{ product.description }}</td>
                    <td width="50px">
                        <span v-if="product.type == 1"> - </span>
                        <span v-else>@{{ product.price }}</span>
                    </td>

                    <td width="10px">
                        <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editProduct(product)">Editar</a>
                    </td>
                    <td width="10px">
                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteProduct(product)">Eliminar</a>
                    </td>
                </tr>
                </tbody>
            </table>
            @include('housekeeping.popups.popup_edit_productos')
            @include('housekeeping.popups.popup_create_productos')
        </div>
    </div>
</div>
@stop