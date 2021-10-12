<form method="POST" v-on:submit.prevent="saveIngredient()" xmlns:v-on="http://www.w3.org/1999/xhtml">
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Crear ingrediente</h4>
            </div>
            <div class="modal-body">

                <label>Nombre</label>
                <input type="text" class="form-control" v-model="fillIngredient.name"><br>

                <label>Precio</label>
                <input type="number" step=".01" class="form-control" v-model="fillIngredient.price"><br>

            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('create')">
                <input type="submit" class="btn btn-primary" value="Crear">
            </div>
        </div>
    </div>
</div>
</form>