<form method="POST" v-on:submit.prevent="saveBook()" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Crear pedido</h4>
            </div>
            <div class="modal-body">

                <label>ID Usuario</label>
                <input type="text" class="form-control" v-model="fillBook.user_id"><br>

                <label>Número de personas</label>
                <input type="text" class="form-control" v-model="fillBook.numPeople"><br>

                <label>Fecha y hora deseada de la reserva (YYYY-MM-DD HH:MM:SS)</label>
                <input type="text" class="form-control" v-model="fillBook.bookDate"><br>

                <label>Fecha y hora en que se generó la reserva (YYYY-MM-DD HH:MM:SS)</label>
                <input type="text" class="form-control" v-model="fillBook.bookGenerate"><br>

            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('create')">
                <input type="submit" class="btn btn-primary" value="Crear">
            </div>
        </div>
    </div>
</div>
</form>