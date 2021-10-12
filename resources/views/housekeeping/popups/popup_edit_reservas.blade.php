<form method="POST" v-on:submit.prevent="updateBook(fillBook.id)" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar reserva</h4>
                </div>
                <div class="modal-body">
                    <label>Número de personas</label>
                    <input class="form-control" v-model="fillBook.numPeople"><br>

                    <label>Fecha y hora de reserva</label>
                    <input class="form-control" v-model="fillBook.bookDate"><br>

                    <label>Estado de la reserva</label>
                    <select id="selectBookState" class="form-control">
                        <option value="Pendiente de confirmación">Pendiente de confirmación</option>
                        <option value="Confirmada">Confirmada</option>
                        <option value="Rechazada">Rechazada</option>
                    </select>
                    <br>

                </div>
                <div class="modal-footer">
                    <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('edit')">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>
            </div>
        </div>
    </div>
</form>