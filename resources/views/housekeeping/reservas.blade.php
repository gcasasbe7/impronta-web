@extends('housekeeping.housekeeping_layout')

@section('content')
<div id="housekeepingreservas" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="panel panel-default" style="padding: 20px;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 30px;">Gestión de reservas</h3>
        </div>
        <div class="panel-body">
            <a href="#" class="btn btn-outline-dark btn-lg" style="float: right" v-on:click.prevent="createBook()">Añadir Reserva</a>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>nº</th>
                    <th><b>Usuario</b></th>
                    <th><b>Num. Personas</b></th>
                    <th><b>Fecha reserva</b></th>
                    <th><b>Estado</b></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="book in books">
                    <td>@{{ book.id }}</td>
                    <td>@{{ book.user.name }} @{{ book.user.surnames }}</td>
                    <td>@{{ book.numPeople }}</td>
                    <td>@{{ customFormatDate(book.bookDate) }}</td>
                    <td v-if="book.state == 'Pendiente de confirmación'">
                        <select :id="'bookState' + book.id" class="form-control" v-on:change="updateBookState(book)">
                            <option value="Pendiente de confirmación" selected>Pendiente de confirmación</option>
                            <option value="Confirmada">Confirmada</option>
                            <option value="Rechazada">Rechazada</option>
                        </select>
                    </td>
                    <td v-if="book.state == 'Confirmada'">
                        <select :id="'bookState' + book.id" class="form-control" v-on:change="updateBookState(book)">
                            <option value="Pendiente de confirmación">Pendiente de confirmación</option>
                            <option value="Confirmada" selected>Confirmada</option>
                            <option value="Rechazada">Rechazada</option>
                        </select>
                    </td>
                    <td v-if="book.state == 'Rechazada'">
                        <select :id="'bookState' + book.id" class="form-control" v-on:change="updateBookState(book)">
                            <option value="Pendiente de confirmación">Pendiente de confirmación</option>
                            <option value="Confirmada">Confirmada</option>
                            <option value="Rechazada" selected>Rechazada</option>
                        </select>
                    </td>

                    <td width="10px">
                        <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editBook(book)">Editar</a>
                    </td>
                    <td width="10px">
                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteBook(book)">Eliminar</a>
                    </td>
                </tr>
                </tbody>
            </table>
            @include('housekeeping.popups.popup_edit_reservas')
            @include('user.popups.popup_create_book')
        </div>
    </div>
</div>
@stop