@extends('housekeeping.housekeeping_layout')

@section('content')
<div id="housekeepingpedidos" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="panel panel-default" style="padding: 20px;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 30px;">Gestión de pedidos</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>nº</th>
                        <th><b>Fecha</b></th>
                        <th><b>Usuario</b></th>
                        <th><b>Dirección</b></th>
                        <th><b>Precio total</b></th>
                        <th><b>Puntos recompensa</b></th>
                        <th><b>Estado</b></th>
                        <th><b>Pagado</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders">
                        <td width="10px">@{{ order.id }}</td>
                        <td>@{{ customFormatDate(order.orderDate) }}</td>
                        <td>@{{ order.user.name }} @{{ order.user.surnames }}</td>
                        <td>@{{ order.direction }}</td>
                        <td>@{{ order.total_price }} €</td>
                        <td>@{{ order.reward_points }}</td>
                        <td v-if="order.state == 'Enviado'">
                            <select :id="'orderState' + order.id" class="form-control" v-on:change="updateOrderState(order)">
                                <option value="Enviado" selected>Enviado</option>
                                <option value="Preparando">Preparando</option>
                                <option value="Listo">Listo</option>
                                <option value="En reparto">En reparto</option>
                            </select>
                        </td>
                        <td v-if="order.state == 'Preparando'">
                            <select :id="'orderState' + order.id" class="form-control" v-on:change="updateOrderState(order)">
                                <option value="Enviado">Enviado</option>
                                <option value="Preparando" selected>Preparando</option>
                                <option value="Listo">Listo</option>
                                <option value="En reparto">En reparto</option>
                            </select>
                        </td>
                        <td v-if="order.state == 'Listo'">
                            <select :id="'orderState' + order.id" class="form-control" v-on:change="updateOrderState(order)">
                                <option value="Enviado">Enviado</option>
                                <option value="Preparando">Preparando</option>
                                <option value="Listo" selected>Listo</option>
                                <option value="En reparto">En reparto</option>
                            </select>
                        </td>

                        <td v-if="order.state == 'En reparto'">
                            <select :id="'orderState' + order.id" class="form-control" v-on:change="updateOrderState(order)">
                                <option value="Enviado">Enviado</option>
                                <option value="Preparando">Preparando</option>
                                <option value="Listo">Listo</option>
                                <option value="En reparto" selected>En reparto</option>
                            </select>
                        </td>

                        <td>
                            <button v-if="order.is_payed == 0" id="btnPayment" type="button" class="btn btn-dark" v-on:click.prevent="transferPoints(order)">No pagado</button>
                            <div v-else class="alert alert-success txt-c" role="alert">
                                <b>Pagado</b>
                            </div>
                        </td>

                        <td width="10px">
                            <a href="#" class="btn btn-success btn-sm" v-on:click.prevent="viewOrder(order)">Ver</a>
                        </td>
                        <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editOrder(order)">Editar</a>
                        </td>
                        <td width="10px">
                            <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteOrder(order)">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            @include('housekeeping.popups.popup_view_pedidos')
            @include('housekeeping.popups.popup_edit_pedidos')
            @include('housekeeping.popups.popup_create_pedidos')
        </div>
    </div>
</div>
@stop