<div class="modal fade" id="createPizza" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Crear pizza</h4>
            </div>
            <div class="modal-body">

                <label>Nombre</label>
                <input id="inpNamePizza" type="text" class="form-control" v-model="fillProduct.name"><br>

                <label>Descripción</label>
                <input id="inpDescPizza"class="form-control" v-model="fillProduct.description"><br>

                <label>Ingredientes: </label>
                <div class="autocomplete">
                    <input id="myInputCreatePizza" class="form-control" type="text" placeholder="Ingrediente...">
                </div>
                <p><small>Para eliminar un ingrediente, haz click sobre el</small></p>
                <ul id="pizzaIngredients" class="mt-4" style="list-style: none"></ul>

                <div class="row txt-c">
                    <div class="col-sm">
                        <p><b>Pequeña</b></p>
                        <p><span id="little_price">0.00</span> €</p>
                    </div>
                    <div class="col-sm">
                        <p><b>Mediana</b></p>
                        <p><span id="medium_price">0.00</span> €</p>
                    </div>
                    <div class="col-sm">
                        <p><b>Grande</b></p>
                        <p><span id="big_price">0.00</span> €</p>
                    </div>
                    <div class="col-sm">
                        <p><b>Brusquetta</b></p>
                        <p><span id="brusquetta_price">0.00</span> €</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                                <input id="isPublic" type="checkbox" name="isPublic" checked> Permitir que todos los usuarios puedan ver mi pizza
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closeModalPizza()">
                <button id="btnCreatePizza" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </div>
</div>
