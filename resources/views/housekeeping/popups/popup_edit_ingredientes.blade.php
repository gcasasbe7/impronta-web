<form method="POST" v-on:submit.prevent="updateIngredient(fillIngredient.id)" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Editar usuario</h4>
            </div>
            <div class="modal-body">

                <label>Nombre</label>
                <input type="text" class="form-control" v-model="fillIngredient.name"><br>

                <label>Precio</label>
                <input type="number" step=".01" class="form-control" v-model="fillIngredient.price"><br>

            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('edit')">
                <input type="submit" class="btn btn-primary" value="Actualizar">
            </div>
        </div>
    </div>
</div>
</form>