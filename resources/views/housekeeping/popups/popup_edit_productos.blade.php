<form method="POST" v-on:submit.prevent="updateProduct(fillProduct.id)" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar producto</h4>
                    <span id="theproductid" class="hide"></span>
                </div>
                <div class="modal-body">
                    <label>Nombre</label>
                    <input class="form-control" v-model="fillProduct.name"><br>

                    <div id="pizzaPricesEdit">
                        <label>Precio tamaño pequeño</label>
                        <input class="form-control" v-model="fillProduct.price_s"><br>

                        <label>Precio tamaño mediano</label>
                        <input class="form-control" v-model="fillProduct.price_m"><br>

                        <label>Precio tamaño grande</label>
                        <input class="form-control" v-model="fillProduct.price_l"><br>

                        <label>Precio tamaño brusquetta</label>
                        <input class="form-control" v-model="fillProduct.price_b"><br>
                    </div>

                    <div id="productPriceEdit" class="hide">
                        <label>Precio</label>
                        <input class="form-control" v-model="fillProduct.price"><br>
                    </div>

                    <label>Descripción</label>
                    <input class="form-control" v-model="fillProduct.description"><br>

                    <label>Foto</label>
                    <input class="form-control" v-model="fillProduct.photo"><br>

                    <label>Disponibilidad</label>
                    <select id="optionExhaust" class="form-control">
                        <option value="1">Agotado</option>
                        <option value="0">Disponible</option>
                    </select><br>

                    <label>Ingredientes: </label>
                    <div class="autocomplete">
                        <input id="myInputCreatePizza" class="form-control" type="text" placeholder="Ingrediente...">
                    </div>
                    <p><small>Para eliminar un ingrediente, haz click sobre el</small></p>
                    <a v-for="ingredient in ingredients" class="myingredientstag pointer" v-on:click.prevent="deleteIngredientFromProduct(ingredient.id,fillProduct.id)">@{{ ingredient.name }}</a>


                </div>
                <div class="modal-footer">
                    <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('edit')">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>

            </div>
        </div>
    </div>
</form>