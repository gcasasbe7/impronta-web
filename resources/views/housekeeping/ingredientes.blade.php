@extends('housekeeping.housekeeping_layout')

@section('content')
<div id="housekeepingingredients" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="panel panel-default" style="padding: 20px;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 30px;">Gestión de ingredientes</h3>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
                <input id="myInputSearchProduct" v-model="searcher" v-on:keyup="getContent()" type="text" class="form-control" placeholder="Busca cualquier ingrediente...">
            </div>
        </div>
        <div class="panel-body">
            <a href="#" class="btn btn-outline-dark btn-lg" style="float: right" v-on:click.prevent="createIngredient()">Añadir Ingrediente</a>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th><b>Nombre</b></th>
                        <th><b>Precio</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="ingredient in showIngredients">
                        <td>@{{ ingredient.name }}</td>
                        <td>@{{ ingredient.price }}</td>

                        <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editIngredient(ingredient)">Editar</a>
                        </td>
                        <td width="10px">
                            <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteIngredient(ingredient)">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            @include('housekeeping.popups.popup_edit_ingredientes')
            @include('housekeeping.popups.popup_create_ingredientes')

        </div>
    </div>
</div>
@stop