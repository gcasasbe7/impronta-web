<form method="POST" v-on:submit.prevent="sendPromotion()" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="modal fade" id="createPromotion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Lanzar promoción</h4>
            </div>
            <div class="modal-body">

                <label>Titulo de la promoción</label>
                <input type="text" class="form-control" v-model="fillPromotion.title"><br>

                <label>Fecha de la promoción</label>
                <input id="datepicker" type="text" class="form-control datepicker"><br>

                <label>Descripción de la promoción</label>
                <textarea class="form-control" name="descPromo" id="descPromo" rows="10" v-model="fillPromotion.body"></textarea><br>


            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopupPromotion()">
                <input type="submit" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </div>
</div>
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