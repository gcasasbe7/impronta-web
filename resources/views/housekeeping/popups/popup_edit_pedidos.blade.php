<form method="POST" v-on:submit.prevent="updateOrder(fillOrder.id)" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Editar pedido</h4>
            </div>
            <div class="modal-body">
                <label>ID Usuario</label>
                <input class="form-control" v-model="fillOrder.user_id"><br>
                <label>Fecha y hora del pedido (YYYY-MM-DD HH:MM:SS)</label>
                <input class="form-control" v-model="fillOrder.orderDate"><br>
                <label>Estado del pedido</label>
                <select id="selectOrderState" class="form-control">
                    <option value="Enviado">Enviado</option>
                    <option value="Preparando">Preparando</option>
                    <option value="Listo">Listo</option>
                    <option value="En reparto">En reparto</option>
                </select><br>
                <label>Dirección del pedido</label>
                <input class="form-control" v-model="fillOrder.direction"><br>
            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('edit')">
                <input type="submit" class="btn btn-primary" value="Actualizar">
            </div>
        </div>
    </div>
</div>
</form>