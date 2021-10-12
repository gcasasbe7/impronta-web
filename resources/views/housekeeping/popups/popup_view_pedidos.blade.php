<form method="POST" v-on:submit.prevent="updateOrder(fillOrder.id)" xmlns:v-on="http://www.w3.org/1999/xhtml">
    {{ csrf_field() }}
<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4><b>Ver pedido @{{ fillOrder.id }}</b></h4>
            </div>
            <div class="modal-body">
                <div v-for="(product,key) in finalOrderProducts">
                    <p :id="'configicon' + key" v-on:click.prevent="changeIngredientsState(key)" class="pointer">(x@{{ product.quantity }}) @{{ product.product.name }} <b>@{{ product.size }}</b><i :id="'icon' + key" class="fas fa-chevron-down ml-2"></i></p>
                    <div :id="'productIngredients' + key" class="hide">
                        <p v-for="ingredient in product.product.ingredients" class="ml-5">
                            <a class="myingredientstag pointer bless">@{{ ingredient.name }}</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input style="float: left;" type="button" class="btn btn-danger" value="Cerrar" v-on:click.prevent="closepopup('view')">
            </div>
        </div>
    </div>
</div>
</form>