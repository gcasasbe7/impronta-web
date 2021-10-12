<div class="modal fade" id="popupDirection" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>¿Dónde te lo entregamos?</h4>
            </div>
            <div class="modal-body">
                <div class="form-check" v-if="userDirection.length != 0">
                    <input type="checkbox" class="form-check-input" id="checkboxUserDirection">
                    <label class="form-check-label" for="exampleCheck1">Enviar a mi dirección  <p class="text-muted">&emsp;@{{ userDirection }}</p></label>
                </div>
                <div class="alert alert-warning txt-c" role="alert" v-else>
                    <p><b>¡No tienes configurada ninguna dirección en tu usuario!</b></p>
                    <p>Puedes establecer tu dirección por defecto en la configuración de tu perfil</p>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxdirection">
                    <label class="form-check-label" for="exampleCheck1">Otra dirección</label>
                </div>
                <div id="inputDirectionDiv" class="hide">
                    <input type="text" class="form-control" id="inputDirection">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxLocalDirection">
                    <label class="form-check-label" for="exampleCheck1">Lo recojo en el local</label>
                </div>
            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closeModalDirection()">
                <input type="submit" class="btn btn-primary" value="Aceptar" v-on:click.prevent="createOrder()">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#checkboxdirection').change(function() {
            if(this.checked) {
                $('#inputDirectionDiv').removeClass("hide");
            }else{
                $('#inputDirectionDiv').addClass("hide");
            }
        });
    });
</script>
