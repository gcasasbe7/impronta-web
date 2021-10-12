<form method="POST" v-on:submit.prevent="saveProduct()" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Crear producto</h4>
            </div>
            <div class="modal-body">

                <label>Nombre</label>
                <input type="text" class="form-control" v-model="fillProduct.name"><br>

                <label>Tipo de producto</label>
                <select @change="changedTypeCreate()" id="typeOptions" class="form-control">
                    <option value="1">1 - Pizza / Brusquetta</option>
                    <option value="2">2 - Antipasto</option>
                    <option value="3">3 - Ensaladas</option>
                    <option value="4">4 - Bebidas</option>
                    <option value="5">5 - Helados</option>
                </select><br>

                <div id="pizzaPricesCreate">
                    <label>Precio tamaño pequeño</label>
                    <input class="form-control" v-model="fillProduct.price_s"><br>

                    <label>Precio tamaño mediano</label>
                    <input class="form-control" v-model="fillProduct.price_m"><br>

                    <label>Precio tamaño grande</label>
                    <input class="form-control" v-model="fillProduct.price_l"><br>

                    <label>Precio tamaño brusquetta</label>
                    <input class="form-control" v-model="fillProduct.price_b"><br>
                </div>


                <label>Descripción</label>
                <input class="form-control" v-model="fillProduct.description"><br>

                <label>Foto</label>
                <input class="form-control" v-model="fillProduct.photo"><br>

                <div id="productPriceCreate" class="hide">
                    <label>Precio</label>
                    <input class="form-control" v-model="fillProduct.price"><br>
                </div>



            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cancelar" v-on:click.prevent="closepopup('create')">
                <input type="submit" class="btn btn-primary" value="Crear">
            </div>
        </div>
    </div>
</div>
</form>