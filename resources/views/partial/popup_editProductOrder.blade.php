<div class="modal fade" id="popupEditProductOrder" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Edita @{{ mainOrder.edited.name }} de tu pedido</h4>
            </div>
            <div class="modal-body txt-c">
                <div v-if="mainOrder.edited.type == 1">
                    <p>Por favor, indicanos la cantidad y el tamaño de la pizza</p>
                    <div class="row">
                        <div class="col-md-4">
                            <input id="inpQuantity" type="number" class="form-control" placeholder="Cantidad" min="1" v-model="mainOrder.edited.quantity">
                        </div>
                        <div class="col-md-8">
                            <select v-if="mainOrder.edited.size == 'pequeña'" id="pizzaToEditSize" class="form-control">
                                <option selected value="pequeña">Pequeña</option>
                                <option value="mediana">Mediana</option>
                                <option value="grande">Grande</option>
                                <option value="brusquetta">Brusquetta</option>
                            </select>
                            <select v-if="mainOrder.edited.size == 'mediana'" id="pizzaToEditSize" class="form-control">
                                <option value="pequeña">Pequeña</option>
                                <option selected value="mediana">Mediana</option>
                                <option value="grande">Grande</option>
                                <option value="brusquetta">Brusquetta</option>
                            </select>
                            <select v-if="mainOrder.edited.size == 'grande'" id="pizzaToEditSize" class="form-control">
                                <option value="pequeña">Pequeña</option>
                                <option value="mediana">Mediana</option>
                                <option selected value="grande">Grande</option>
                                <option value="brusquetta">Brusquetta</option>
                            </select>
                            <select v-if="mainOrder.edited.size == 'brusquetta'" id="pizzaToEditSize" class="form-control">
                                <option value="pequeña">Pequeña</option>
                                <option value="mediana">Mediana</option>
                                <option value="grande">Grande</option>
                                <option selected value="brusquetta">Brusquetta</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <p>Por favor, indicanos la cantidad del producto</p>
                    <div class="row">
                        <div class="col-md">
                            <input id="inpQuantity" type="number" class="form-control" placeholder="Cantidad" min="1" v-model="mainOrder.edited.quantity">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="mainOrder.closePopupEditPizza()">
                <input type="submit" class="btn btn-primary" value="Añadir" v-on:click.prevent="mainOrder.editProductOrder()">
            </div>
        </div>
    </div>
</div>
