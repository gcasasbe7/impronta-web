<form method="POST" v-on:submit.prevent="updateEvent(fillEvent.id)" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar evento</h4>
                </div>
                <div class="modal-body">
                    <label>Titulo</label>
                    <input type="text" class="form-control" v-model="fillEvent.title"><br>

                    <label>Descripción</label>
                    <input type="text" class="form-control" v-model="fillEvent.description"><br>

                    <label>Foto</label>
                    <input type="text" class="form-control" v-model="fillEvent.photo"><br>

                    <label>Fecha y hora de inicio</label>
                    <input type="text" class="form-control" v-model="fillEvent.start_date"><br>

                    <label>Fecha y hora de fin</label>
                    <input type="text" class="form-control" v-model="fillEvent.end_date"><br>

                </div>
                <div class="modal-footer">
                    <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('edit')">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>
            </div>
        </div>
    </div>
</form>