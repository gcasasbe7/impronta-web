<form method="POST" v-on:submit.prevent="saveEvent()" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Crear evento</h4>
            </div>
            <div class="modal-body">

                <label>Titulo</label>
                <input type="text" class="form-control" v-model="fillEvent.title"><br>

                <label>Descripción</label>
                <input type="text" class="form-control" v-model="fillEvent.description"><br>

                <label>Foto</label>
                <input type="text" class="form-control" v-model="fillEvent.photo"><br>

                <div class="row">
                    <div class="col-md-7">
                        <label>Fecha inicio</label>
                        <input id="datepickerStart" type="text" class="form-control datepicker">
                    </div>
                    <div class="col-md-4">
                        <label>Hora inicio</label>
                        <input id="horaInicio" type="text" class="form-control" placeholder="HH:MM">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-7">
                        <label>Fecha fin</label>
                        <input id="datepickerEnd" type="text" class="form-control datepicker">
                    </div>
                    <div class="col-md-4">
                        <label>Hora fin</label>
                        <input id="horaFin" type="text" class="form-control" placeholder="HH:MM">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('create')">
                <input type="submit" class="btn btn-primary" value="Crear">
            </div>
        </div>
    </div>
</div>
    <script>
        $( function() {
            $( "#datepickerStart" ).datepicker({
                dateFormat: "dd/mm/yy",
                dayNames: ["Domingo", "Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"],
                dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                monthNamesMin: ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]
            });
            $( "#datepickerEnd" ).datepicker({
                dateFormat: "dd/mm/yy",
                dayNames: ["Domingo", "Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"],
                dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                monthNamesMin: ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]
            });
        } );
    </script>
</form>