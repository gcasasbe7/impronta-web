@extends('housekeeping.housekeeping_layout')

@section('content')
    <div class="panel panel-default" style="padding: 20px;">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 30px;">Dashboard</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md">
                    <div class="card txt-c">
                        <h5 class="card-header"><b>Estadísticas de pedidos esta semana</b><br><i class="fas fa-chart-line"></i></h5>
                        <div class="card-body">
                            <img src="{{ url('/assets/img/pedidos_semana.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card txt-c">
                        <h5 class="card-header"><b>Estadísticas de reservas esta semana</b><br><i class="fas fa-chart-line"></i></h5>
                        <div class="card-body">
                            <img src="{{ url('/assets/img/reservas_semana.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md">
                    <div class="card txt-c">
                        <h5 class="card-header"><b>Top 5 productos más vendidos</b><br><i class="fas fa-smile"></i></h5>
                        <div class="card-body">
                            <span><b>1- </b> Pizza Michel Angelo</span><br>
                            <span><b>2- </b> Patatas Gorgonzola</span><br>
                            <span><b>3- </b> Pizza Vivaldi</span><br>
                            <span><b>4- </b> Escalopa de pollo</span><br>
                            <span><b>5- </b> Pizza Antonello</span>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card txt-c">
                        <h5 class="card-header"><b>Top 5 productos menos vendidos</b><br><i class="fas fa-frown"></i></h5>
                        <div class="card-body">
                            <span><b>1- </b> Pizza Tiziano</span><br>
                            <span><b>2- </b> Croquetas de jamón</span><br>
                            <span><b>3- </b> Pizza Americo</span><br>
                            <span><b>4- </b> Pizza Romeo</span><br>
                            <span><b>5- </b> Pizza Poseidon</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop