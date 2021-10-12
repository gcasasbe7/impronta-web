<div class="modal fade" id="popupConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>¿Estás eguro?</h4>
            </div>
            <div class="modal-body txt-c">
                <p>¿Deseas confirmar y enviar el pedido? <p>¡<b>Atento</b>... Ya no podrás modificarlo!</p><p><b>Precio total: @{{ orderPrice }} €</b></p></p>
            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closeModalConfirmation()">
                <input type="submit" class="btn btn-primary" value="Aceptar" v-on:click.prevent="confirmDirection()">
            </div>
        </div>
    </div>
</div>
