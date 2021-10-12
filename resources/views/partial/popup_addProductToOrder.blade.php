<div class="modal fade" id="popupAddPizzaToOrder" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>¡Añáde @{{ mainOrder.actualProduct.name }} al pedido!</h4>
            </div>
            <div class="modal-body txt-c">
                <div v-if="mainOrder.actualProduct.type == 1">
                    <p>Por favor, indicanos la cantidad y el tamaño de la pizza que deseas añadir a tu pedido</p>
                    <div class="row">
                        <div class="col-md-4">
                            <input id="inpQuantity" type="number" class="form-control" placeholder="Cantidad" min="1">
                        </div>
                        <div class="col-md-8">
                            <select id="pizzaToAddSize" class="form-control">
                                <option value="pequeña">Pequeña</option>
                                <option value="mediana">Mediana</option>
                                <option value="grande">Grande</option>
                                <option value="brusquetta">Brusquetta</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <p>Por favor, indicanos la cantidad del producto que deseas añadir a tu pedido.</p>
                    <div class="row">
                        <div class="col-md">
                            <input id="inpQuantity" type="number" class="form-control" placeholder="Cantidad" min="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="mainOrder.closePopupAddPizza()">
                <input type="submit" class="btn btn-primary" value="Añadir" v-on:click.prevent="mainOrder.addProductToOrder()">
            </div>
        </div>
    </div>
</div>
