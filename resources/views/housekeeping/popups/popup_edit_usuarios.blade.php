<form method="POST" v-on:submit.prevent="updateUser(fillUser.id)" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Editar usuario</h4>
            </div>
            <div class="modal-body">

                <label>Nombre</label>
                <input type="text" class="form-control" v-model="fillUser.name"><br>

                <label>Apellidos</label>
                <input type="text" class="form-control" v-model="fillUser.surnames"><br>

                <label>Correo electrónico</label>
                <input type="text" class="form-control" v-model="fillUser.email"><br>

                <label>Dirección</label>
                <input type="text" class="form-control" v-model="fillUser.direction"><br>

                <label>Teléfono</label>
                <input type="text" class="form-control" v-model="fillUser.phone"><br>

                <label>Foto</label>
                <input type="text" class="form-control" v-model="fillUser.photo"><br>

                <label>Puntos</label>
                <input type="text" class="form-control" v-model="fillUser.points"><br>

            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('edit')">
                <input type="submit" class="btn btn-primary" value="Actualizar">
            </div>
        </div>
    </div>
</div>
</form>