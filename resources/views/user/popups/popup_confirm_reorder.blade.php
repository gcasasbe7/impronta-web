<form method="POST" v-on:submit.prevent="repeatOrder()" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
    <div class="modal fade" id="confirmReorder">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>¿Deseas repetir el pedido @{{ orderToRepeat.id }}?</h4>
                </div>
                <div class="modal-body">

                    <div class="txt-c">
                        <div class="row">
                            <div class="col-md">
                                <b>Contiene:</b>
                                <div v-for="product in orderToRepeat.orderproducts">
                                    <p>(x@{{ product.quantity }}) @{{ product.product_name }} @{{ product.size }}</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <p><b>Total: </b>@{{ orderToRepeat.total_price }} €</p>
                                <p><b>Puntos recibidos: </b>@{{ orderToRepeat.reward_points }}</p>
                            </div>
                        </div>

                        <div id="sameDirection" class="mt-3">
                            <p><b>Dirección de envío: </b>@{{ orderToRepeat.direction }}</p>
                            <button type="button" class="btn btn-warning" v-on:click.prevent="showDirectionInfo()" style="color: white">Cambiar dirección</button>
                        </div>

                        <div id="directionInfo" class="hide">
                            <div class="form-check" v-if="userDirection.length != 0">
                                <input type="checkbox" class="form-check-input" id="checkboxUserDirection">
                                <label class="form-check-label" for="exampleCheck1">Enviar a mi dirección  <p class="text-muted">&emsp;@{{ userDirection }}</p></label>
                            </div>
                            <div class="alert alert-warning txt-c" role="alert" v-else>
                                <p><b>¡No tienes configurada ninguna dirección en tu usuario!</b></p>
                                <p>Puedes establecer tu dirección por defecto en la configuración de tu perfil</p>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkboxLocalDirection">
                                <label class="form-check-label">Lo recojo en el local</label>
                            </div>
                            <div id="inputDirectionDiv">
                                <input type="text" class="form-control" id="inputDirection" placeholder="Nueva dirección de envío">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closeModalConfirmReorder()">
                    <input type="submit" class="btn btn-primary" value="Repetir pedido">
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#checkboxLocalDirection').change(function() {
            if(this.checked) {
                $('#inputDirectionDiv').addClass("hide");
            }else{
                $('#inputDirectionDiv').removeClass("hide");
            }
        });
    });
</script>