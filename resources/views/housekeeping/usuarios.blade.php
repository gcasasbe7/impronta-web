@extends('housekeeping.housekeeping_layout')

@section('content')
    <div id="housekeepingusers" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="panel panel-default" style="padding: 20px;">
            <div class="panel-heading">
                <h3 class="panel-title" style="font-size: 30px;">Gestión de usuarios</h3>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                    </div>
                    <input id="myInputSearchProduct" v-model="searcher" v-on:keyup="getContent()" type="text" class="form-control" placeholder="Busca cualquier usuario...">
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th><b>ID</b></th>
                        <th><b>Nombre</b></th>
                        <th><b>Dirección</b></th>
                        <th><b>Email</b></th>
                        <th><b>Teléfono</b></th>
                        <th><b>Puntos</b></th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in showUsers">
                        <td width="5px">@{{ user.id }}</td>
                        <td><img v-bind:src="user.photo" height="50px" width="50px" style="border-radius: 40%"> @{{ user.name }} @{{ user.surnames }}</td>
                        <td>@{{ user.direction }}</td>
                        <td>@{{ user.email }}</td>
                        <td>@{{ user.phone }}</td>
                        <td>@{{ user.points }}</td>


                        <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editUser(user)">Editar</a>
                        </td>
                        <td width="10px">
                            <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteUser(user)">Eliminar</a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                @include('housekeeping.popups.popup_edit_usuarios')
                @include('housekeeping.popups.popup_create_usuarios')
            </div>
        </div>
    </div>
@stop