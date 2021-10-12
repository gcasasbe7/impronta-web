<form method="POST" v-on:submit.prevent="generateBook()" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{ csrf_field() }}
    <div class="modal fade" id="createBook">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Realizar petición de reserva</h4>
                </div>
                <div class="modal-body">

                    <label>Día de la reserva</label>
                    <input id="datepicker" type="text" class="form-control" readonly="readonly"><br>

                    <label>Hora de la reserva</label>
                    <div class="row">
                        <div class="col-md-3">
                            <input id="hourpicker" class="form-control" placeholder="Horas" type="number" max="23" min="00" v-on:change="showHour()" v-on:keyup="showHour()">
                        </div>
                        <div class="col-sm-1">
                            <span>:</span>
                        </div>
                        <div class="col-md-3">
                            <input id="minutespicker" class="form-control" placeholder="Min" type="number" max="59" min="00" v-on:change="showMinute()" v-on:keyup="showMinute()">
                        </div>
                        <div class="col-md-2">
                            <div class="alert alert-info" role="alert" style="padding: 0;">
                                <span style="font-size: 20px"><b>@{{ hour }}:@{{ minutes }}</b></span>
                            </div>
                        </div>
                    </div>

                    <label>Número de personas</label>
                    <input id="numPersons" class="form-control" type="number" min="1"><br>

                </div>
                <div class="modal-footer">
                    <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closeModalBook()">
                    <input type="submit" class="btn btn-primary" value="Crear">
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
                dateFormat: "dd/mm/yy",
                dayNames: ["Domingo", "Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"],
                dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                monthNamesMin: ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]
            });
        } );
    </script>
</form>
