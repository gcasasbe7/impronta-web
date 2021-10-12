@extends('housekeeping.housekeeping_layout')

@section('content')
<div id="housekeepingeventos" xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="panel panel-default" style="padding: 20px;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 30px;">Gestión de eventos</h3>
        </div>
        <div class="panel-body">
            <a href="#" class="btn btn-outline-dark btn-lg" style="float: right" v-on:click.prevent="createEvent()">Crear Evento</a>
            <a href="#" class="btn btn-outline-dark btn-lg" style="float: right; margin-right: 15px;" v-on:click.prevent="createPromotion()">Lanzar Promoción</a>
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th><b>Titulo</b></th>
                    <th><b>Descripción</b></th>
                    <th><b>Fecha inicio</b></th>
                    <th><b>Fecha fin</b></th>
                    <th><b>Foto evento</b></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="event in events">
                    <td>@{{ event.title }}</td>
                    <td>@{{ event.description }}</td>
                    <td>@{{ customFormatDate(event.start_date) }}</td>
                    <td>@{{ customFormatDate(event.end_date) }}</td>
                    <td><img v-bind:src="event.photo" height="50px" width="80px"></td>

                    <td width="10px">
                        <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editEvent(event)">Editar</a>
                    </td>
                    <td width="10px">
                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteEvent(event)">Eliminar</a>
                    </td>
                </tr>
                </tbody>
            </table>
            @include('housekeeping.popups.popup_edit_eventos')
            @include('housekeeping.popups.popup_create_eventos')
            @include('housekeeping.popups.popup_create_promotion')
        </div>
    </div>
</div>
@stop