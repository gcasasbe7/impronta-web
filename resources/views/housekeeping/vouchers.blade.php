@extends('housekeeping.housekeeping_layout')

@section('content')
    <div id="housekeepingvouchers" class="panel panel-default" style="padding: 20px;"
         xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
        <div class="row">
            <div class="container">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-size: 30px;">Código voucher:</h3>
                </div>
                <div class="panel-body">
                    <input class="form-control" type="text" v-model="voucherCode" placeholder="Introduce el código del cupón..." v-on:keyup.prevent="checkVoucher()">
                </div>
                <div id="voucherNotFound" class="alert alert-dark txt-c hide mt-2" role="alert">
                    <b>No se ha encontrado ningún cupón con el código @{{ voucherCode }}</b>
                </div>
                <div id="voucher_info" class="alert alert-warning hide txt-c mt-2" role="alert">
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <p><b>Foto del usuario:</b></p>
                                <img id="voucherInfo-userphoto" height="200px" width="280px">
                            </div>
                            <div class="col-md">
                                <span><b>Nombre: </b><p id="voucherInfo-username"></p></span>
                                <span><b>Teléfono: </b><p id="voucherInfo-userphone"></p></span>
                                <span><b>Email: </b><p id="voucherInfo-usermail"></p></span>
                                <span><b>Puntos actuales: </b><p id="voucherInfo-userpoints"></p></span>
                                <span><b>Puntos del cupón: </b><p id="voucherInfo-voucherpoints"></p></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="generateVoucher" type="button" v-on:click.prevent="validateVoucher()" class="btn btn-secondary btn-lg btn-block mt-2 hide">Canjear código</button>
                <div id="voucher_success" class="alert alert-success hide txt-c" role="alert">
                    Código voucher canjeado correctamente.
                </div>
                <div id="voucher_error" class="alert alert-danger hide txt-c" role="alert">
                    Código voucher caducado.
                </div>
            </div>
        </div>

    </div>
@stop
