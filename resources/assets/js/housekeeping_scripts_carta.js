var vueInstance = new Vue({
    el: '#housekeepingproductos',
    created: function(){
        this.getProducts();
    },
    data: {
        searcher: '',
        allIngredients: [],
        products: [],
        showProducts: [],
        ingredients: [],
        fillProduct: {
            'id': '',
            'name': '',
            'type': 1,
            'isExhausted': '',
            'description' : '',
            'photo' : '',
            'price' : 0,
            'price_s' : '',
            'price_m' : '',
            'price_l' : '',
            'price_b' : '',
        },
    },
    methods: {
        getProducts: function() {
            var url = 'products';
            axios.get(url).then(response => {
                this.products = response.data;
                this.showProducts = response.data;
            }).catch(error => {
                toastr.error("No se han podido obtener los productos");
            });
        },
        editProduct: function(product){
            $("#theproductid").text(product.id);
            this.getIngredients(product.id);
            this.getAllIngredients();
            this.fillProduct.id = product.id;
            this.fillProduct.name = product.name;
            this.fillProduct.type = product.type;
            this.changedTypeEdit();
            this.fillProduct.isExhausted = product.isExhausted;
            $("#optionExhaust").val(product.isExhausted);
            this.fillProduct.description = product.description;
            this.fillProduct.photo = product.photo;
            this.fillProduct.price = product.price;
            this.fillProduct.price_s = product.price_s;
            this.fillProduct.price_m = product.price_m;
            this.fillProduct.price_l = product.price_l;
            this.fillProduct.price_b = product.price_b;

            $('#edit').modal({backdrop: 'static', keyboard: false});
        },
        updateProduct: function(product_id){
            var url = 'products/' + product_id;
            this.fillProduct.isExhausted = $("#optionExhaust").val()
            axios.put(url, this.fillProduct).then(response=> {
                this.getProducts();
                this.resetFillProduct();
                $('#edit').modal('hide');
                toastr.success("¡Producto editado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido editar el producto");
            });
        },
        deleteProduct: function(product) {
            var url = 'products/' + product.id;
            axios.delete(url).then(response => {
                this.getProducts();
                toastr.success("¡Producto eliminado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido eliminar el producto");
            });
        },
        createProduct: function() {
            this.getAllIngredients();
            this.ingredients = [];
            this.resetFillProduct();
            $('#create').modal({backdrop: 'static', keyboard: false});
            //this.initializeProduct();
        },
        saveProduct: function(){
            var url = 'products';
            axios.post(url, {
                'name' : this.fillProduct.name,
                'likes' : '0',
                'type' : $("#typeOptions").val(),
                'isExhausted' : 0,
                'description' : this.fillProduct.description,
                'photo' : this.fillProduct.photo,
                'price' : this.fillProduct.price,
                'price_s' : this.fillProduct.price_s,
                'price_m' : this.fillProduct.price_m,
                'price_l' : this.fillProduct.price_l,
                'price_b' : this.fillProduct.price_b,
                'user_id' : 1,
            }).then(response => {
                this.getProducts();
                this.resetFillProduct();
                $('#create').modal('hide');
                toastr.success("¡Producto añadido con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido añadir el producto");
            });
        },
        getAllIngredients: function(){
            var url = 'ingredients';
            axios.get(url).then(response => {
                this.allIngredients = response.data;
            }).catch(error => {
                toastr.error("No se han podido obtener los productos");
            });
        },
        getIngredients: function(product_id){
            var url = 'carta/' + product_id;
            axios.get(url).then(response => {
                this.ingredients = response.data;
            }).catch(error => {
                toastr.error("No se han podido obtener los ingredientes del producto");
            });
        },
        deleteIngredientFromProduct: function(ingredient_id, product_id){
            var url = 'carta/' + ingredient_id + '/' + product_id;
            axios.delete(url).then(response => {
                this.getIngredients(product_id);
                toastr.success("¡Ingrediente eliminado!");
            }).catch(error => {
                toastr.error("No se ha podido eliminar el ingrediente del producto");
            });
        },
        addIngredientToProductEditing: function(product_id){
            $ingredient_id = (document.getElementById("mySelectEdit").selectedIndex) + 1;
            var url = 'carta/' + $ingredient_name + '/' + product_id;
            axios.post(url).then(response => {
                this.getIngredients(product_id);
                toastr.success("¡Ingrediente añadido al producto con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido añadir el ingrediente al producto");
            });
        },
        closepopup: function(popup){
            popup == 'edit' ? $('#edit').modal('hide') : $('#create').modal('hide');
        },
        changedTypeCreate: function(){
            this.fillProduct.type = $("#typeOptions").val();
            if(this.fillProduct.type != 1){
                $("#pizzaPricesCreate").addClass("hide");
                $("#productPriceCreate").removeClass("hide");
            }else{
                $("#pizzaPricesCreate").removeClass("hide");
                $("#productPriceCreate").addClass("hide");
            }
        },
        changedTypeEdit: function(){
            if(this.fillProduct.type != 1){
                $("#pizzaPricesEdit").addClass("hide");
                $("#productPriceEdit").removeClass("hide");
            }else{
                $("#pizzaPricesEdit").removeClass("hide");
                $("#productPriceEdit").addClass("hide");
            }
        },
        resetFillProduct: function(){
            this.fillProduct = {'id': '','name': '','type': 1,'isExhausted': '','description' : '','photo':'','price':0,'price_s':'','price_m':'','price_l':'','price_b':''};
        },
        parseType: function(type_num){
            var strResult;
            switch(type_num){
                case 1:
                    strResult = "Pizza";
                    break;
                case 2:
                    strResult = "Antipasto";
                    break;
                case 3:
                    strResult = "Ensalada";
                    break;
                case 4:
                    strResult = "Bebida";
                    break;
                case 5:
                    strResult = "Helado";
                    break;
            }

            return strResult;
        },
        getContent: function(){
            if(this.searcher.length != 0){
                this.showProducts = [];
                for(i=0; i< this.products.length; i++){
                    if(this.products[i].name.includes(this.capitalize(this.searcher))) {
                        this.showProducts.push(this.products[i]);
                    }
                }
            }else{
                this.showProducts = this.products;
            }
        },
        capitalize: function(str){
            return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
        }
    }
});

var ingredients = [];
var pizzaIngredients = [];

function getIngredients(){
    var url = 'getingredientsnames';
    axios.get(url).then(response => {
        var temp = [];
    temp = response.data.ingredients;
    for(i = 0; i < temp.length ; i++){
        ingredients.push(temp[i].name);
    }
}).catch(error => {
        toastr.error("Error obteniendo ingredientes");
});
}

function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    addIngredient(this.getElementsByTagName("input")[0].value)
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    function addIngredient(name) {
        document.getElementById("myInputCreatePizza").value = "";
        var product_id = document.getElementById("theproductid").innerHTML;

        var url = 'carta/' + name + '/' + product_id;

        axios.post(url).then(response => {
            vueInstance.getIngredients(product_id);
            toastr.success("¡Ingrediente añadido al producto con éxito!");
        }).catch(error => {
            toastr.error("No se ha podido añadir el ingrediente al producto");
        });
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}
function getEventTarget(e) {
    e = e || window.event;
    return e.target || e.srcElement;
}

$(document).ready(function(){
    document.getElementById("myInputCreatePizza").value = "";
    getIngredients();
    autocomplete(document.getElementById("myInputCreatePizza"), ingredients);

    var ul = document.getElementById('pizzaIngredients');
    ul.onclick = function(event) {
        var target = getEventTarget(event);
        var ingredient = target.innerHTML;
        var ul = document.getElementById("pizzaIngredients");
        var li = document.getElementById("ing" + ingredient);

        ul.removeChild(li);
    };
});
