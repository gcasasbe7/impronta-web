<form method="POST" v-on:submit.prevent="saveOrder()" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Crear pedido</h4>
            </div>
            <div class="modal-body">

                <label>ID Usuario</label>
                <input type="text" class="form-control" v-model="fillOrder.user_id"><br>

                <label>Fecha del pedido (YYYY-MM-DD HH:MM:SS)</label>
                <input type="text" class="form-control" v-model="fillOrder.orderDate"><br>

                <label>Estado del pedido</label>
                <input type="text" class="form-control" v-model="fillOrder.state"><br>

                <label>Dirección del pedido</label>
                <input type="text" class="form-control" v-model="fillOrder.direction"><br>


            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('create')">
                <input type="submit" class="btn btn-primary" value="Crear">
            </div>
        </div>
    </div>
</div>
</form>