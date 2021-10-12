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

new Vue({
    el: '#housekeepingeventos',
    created: function(){
        this.getEvents();
    },
    data: {
        events: [],
        fillEvent: {'id': '','title': '','description': '','photo': '','start_date': '', 'end_date' : ''},
        fillPromotion: {'title': '','body': ''},
    },
    methods: {
        getEvents: function() {
            var url = 'events';
            axios.get(url).then(response => {
                this.events = response.data;
            }).catch(error => {
                toastr.error("No se han podido obtener los eventos");
            });
        },
        editEvent: function(event){
            this.fillEvent.id = event.id;
            this.fillEvent.title = event.title;
            this.fillEvent.description = event.description;
            this.fillEvent.photo = event.photo;
            this.fillEvent.start_date = event.start_date;
            this.fillEvent.end_date = event.end_date;

            $('#edit').modal({backdrop: 'static', keyboard: false});
        },
        updateEvent: function(event_id){
            var url = 'events/' + event_id;
            axios.put(url, this.fillEvent).then(response=> {
                this.getEvents();
                this.fillEvent = {'id': '','title': '','description': '','photo': '','start_date': '', 'end_date' : ''};
                $('#edit').modal('hide');
                toastr.success("¡Evento editado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido editar el evento");
            });
        },
        deleteEvent: function(event) {
            var url = 'events/' + event.id;
            axios.delete(url).then(response => {
                this.getEvents();
                toastr.success("¡Evento eliminado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido eliminar el evento");
            });
        },
        createEvent: function() {
            this.fillEvent = {'id': '','title': '','description': '','photo': '','start_date': '', 'end_date' : ''};
            $('#create').modal({backdrop: 'static', keyboard: false});
        },
        saveEvent: function(){
            var url = 'generateevent';
            axios.post(url, {
                'title' : this.fillEvent.title,
                'description' : this.fillEvent.description,
                'photo' : this.fillEvent.photo,
                'start_date' : $("#datepickerStart").val(),
                'start_hour' : $("#horaInicio").val(),
                'end_date' : $("#datepickerEnd").val(),
                'end_hour' : $("#horaFin").val(),
            }).then(response => {
                this.getEvents();
                this.fillEvent = {'id': '','title': '','description': '','photo': '','start_date': '', 'end_date' : ''};
                $('#create').modal('hide');
                toastr.success("¡Evento añadido con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido añadir el evento");
            });
        },
        closepopup: function(popup){
            popup == 'edit' ? $('#edit').modal('hide') : $('#create').modal('hide');
        },
        closepopupPromotion: function(popup){
            $('#createPromotion').modal('hide');
        },
        customFormatDate: function(eventDate){
            parts = eventDate.split(" ");
            date = parts[0].split("-");
            hour = parts[1].split(":");

            return date[2] + "/" + date[1] + "/" + date[0] + " a las " + hour[0] + ":" + hour[1]
        },
        createPromotion: function(){
            $('#createPromotion').modal({backdrop: 'static', keyboard: false});
        },
        sendPromotion: function(){
            if(this.checkNewPromotionInputs()){
                this.closepopupPromotion();
                var url = 'generatepromotion';
                axios.post(url, {
                    'title' : this.fillPromotion.title,
                    'date' : $("#datepicker").val(),
                    'body' : this.fillPromotion.body,
                }).then(response => {
                    this.fillPromotion = {'title': '','body': ''};
                    $("#datepicker").val("")
                    toastr.success("¡Promoción lanzada!");
            }).catch(error => {
                toastr.error("No se ha podido lanzar la promoción");
            });
            }else{
                toastr.error("Llena todos los campos");
            }
        },
        checkNewPromotionInputs: function(){
            if(this.fillPromotion.title.length == 0 || $("#datepicker").val().length == 0 || this.fillPromotion.body.length == 0 ){
                return false;
            }
            return true;
        }
    }
});
new Vue({
    el: '#housekeepingingredients',
    created: function(){
        this.getIngredients();
    },
    data: {
        searcher: '',
        ingredients: [],
        showIngredients: [],
        fillIngredient: {'id':'','name': '', 'price': ''},
    },
    methods: {
        getIngredients: function() {
            var url = 'ingredients';
            axios.get(url).then(response => {
                this.ingredients = response.data;
                this.showIngredients = response.data;
            }).catch(error => {
                toastr.error("No se han podido obtener los ingredientes");
            });
        },
        editIngredient: function(ingredient){
            this.fillIngredient.id = ingredient.id;
            this.fillIngredient.name = ingredient.name;
            this.fillIngredient.price = ingredient.price;

            $('#edit').modal({backdrop: 'static', keyboard: false});
        },
        updateIngredient: function(ingredient_id){
            var url = 'ingredients/' + ingredient_id;
            axios.put(url, this.fillIngredient).then(response=> {
                this.getIngredients();
                this.fillIngredient = {'id':'','name': '', 'price':''};
                $('#edit').modal('hide');
                toastr.success("¡Ingrediente editado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido editar el ingrediente");
            });
        },
        deleteIngredient: function(ingredient) {
            var url = 'ingredients/' + ingredient.id;
            axios.delete(url).then(response => {
                this.getIngredients();
                toastr.success("¡Ingrediente eliminado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido eliminar el ingrediente");
            });
        },
        createIngredient: function() {
            this.fillIngredient = {'id':'','name': '', 'price':''};
            $('#create').modal({backdrop: 'static', keyboard: false});
        },
        saveIngredient: function(){
            var url = 'ingredients';
            axios.post(url, {
                'name' : this.fillIngredient.name,
                'price' : this.fillIngredient.price,
            }).then(response => {
                this.getIngredients();
                this.fillIngredient = {'id':'','name': '', 'price':''};
                $('#create').modal('hide');
                toastr.success("¡Ingrediente añadido con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido añadir el ingrediente");
            });
        },
        closepopup: function(popup){
            popup == 'edit' ? $('#edit').modal('hide') : $('#create').modal('hide');
        },
        getContent: function(){
            if(this.searcher.length != 0){
                this.showIngredients = [];
                for(i=0; i< this.ingredients.length; i++){
                    //alert(this.ingredients[i].name + " includes " + this.searcher);
                    if(this.ingredients[i].name.includes(this.searcher)) {
                        this.showIngredients.push(this.ingredients[i]);
                    }
                }
            }else{
                this.showIngredients = this.ingredients;
            }
        },
        capitalize: function(str){
            return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
        }
    }
});
new Vue({
    el: '#housekeepingpedidos',
    created: function(){
        this.getOrders();
    },
    data: {
        orders: [],
        fillOrder: {'id': '','user_id': '','orderDate': '','state': '','direction': '', 'is_payed': ''},
        orderProducts: [],
        orderProductsInfo: [],
        finalOrderProducts: []
    },
    methods: {
        getOrders: function() {
            var url = 'orders';
            axios.get(url).then(response => {
                this.orders = response.data;
            }).catch(error => {
                toastr.error("No se han podido obtener los pedidos");
            });
        },
        viewOrder: function(order){
            this.fillOrder.id = order.id;
            this.fillOrder.user_id = order.user_id;
            this.fillOrder.orderDate = order.orderDate;
            this.fillOrder.state = order.state;
            this.fillOrder.direction = order.direction;

            $("#selectOrderState").val(this.fillOrder.state);

            this.getOrderContent(order);

        },
        editOrder: function(order){
            this.fillOrder.id = order.id;
            this.fillOrder.user_id = order.user_id;
            this.fillOrder.orderDate = order.orderDate;
            this.fillOrder.state = order.state;
            this.fillOrder.direction = order.direction;

            $("#selectOrderState").val(this.fillOrder.state);

            $('#edit').modal({backdrop: 'static', keyboard: false});
        },
        updateOrder: function(order_id){
            var url = 'orders/' + order_id;
            this.fillOrder.state = $("#selectOrderState").val();
            axios.put(url, this.fillOrder).then(response=> {
                this.getOrders();
                orderResponse(this.fillOrder.user_id,order_id,this.fillOrder.state);
                this.fillOrder = {'id': '','user_id': '','orderDate': '','state': '','direction': ''};
                $('#edit').modal('hide');
                toastr.success("¡Pedido editado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido editar el pedido");
            });
        },
        deleteOrder: function(order) {
            var url = 'orders/' + order.id;
            axios.delete(url).then(response => {
                this.getOrders();
                toastr.success("¡Pedido eliminado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido eliminar el pedido");
            });
        },
        createOrder: function() {
            var d = new Date();
            var curr_date = d.getFullYear() + "-" + (((d.getMonth()+1) < 10 ? '0':'') + (d.getMonth()+1)) + "-" + ((d.getDate() < 10 ? '0':'') + d.getDate()) + " " + d.getHours() + ":" + ((d.getMinutes() < 10 ? '0':'') + d.getMinutes()) + ":" + ((d.getSeconds() < 10 ? '0':'') + d.getSeconds());
            this.fillOrder = {'id': '','user_id': '','orderDate': curr_date,'state': '','direction': ''};
            $('#create').modal({backdrop: 'static', keyboard: false});
        },
        saveOrder: function(){
            var url = 'orders';
            axios.post(url, {
                'user_id' : this.fillOrder.user_id,
                'orderDate' : this.fillOrder.orderDate,
                'state' : this.fillOrder.state,
                'direction' : this.fillOrder.direction,
            }).then(response => {
                this.getOrders();
                this.fillOrder = {'id': '','user_id': '','orderDate': '','state': '','direction': ''};
                $('#create').modal('hide');
                toastr.success("¡Pedido añadido con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido añadir el pedido");
            });

        },
        closepopup: function(popup){
            popup == 'edit' ? $('#edit').modal('hide') : $('#create').modal('hide');
            $('#view').modal('hide');
        },
        getOrderContent: function(order){
            this.finalOrderProducts = []
            var url = 'getOrderProductsById';
            axios.post(url, {
                'order_id' : order.id,
            }).then(response => {
                this.orderProducts = response.data.products
                this.orderProductsInfo = response.data.orderproducts

                for(i = 0; i < response.data.products[0]['products'].length; i++){
                    product = {}
                    product['quantity'] = response.data.orderproducts[0]['orderproducts'][i]['quantity']
                    product['size'] = response.data.orderproducts[0]['orderproducts'][i]['size']
                    product['product'] = response.data.products[0]['products'][i];

                    this.finalOrderProducts.push(product)
                }

            $('#view').modal({backdrop: 'static', keyboard: false});

            }).catch(error => {
                toastr.error("Error obteniendo los productos del pedido");
            });
        },
        changeIngredientsState: function(id){
            if($("#productIngredients" + id).hasClass("hide")){
                $("#productIngredients" + id).removeClass("hide")
                $("#icon" + id).removeClass("fa-chevron-down").addClass("fa-chevron-up")
            }else{
                $("#productIngredients" + id).addClass("hide")
                $("#icon" + id).removeClass("fa-chevron-up").addClass("fa-chevron-down")
            }
        },
        updateOrderState: function(order){
            var url = 'updateOrderState/' + order.id;
            var state = $("#orderState" + order.id).val()
            axios.put(url, {
                'state' : state
            }).then(response=> {
                this.getOrders();
                orderResponse(order.user_id,order.id,state);
                toastr.success("¡Estado actualizado!");
            }).catch(error => {
                    toastr.error("No se ha podido actualizar el estado");
            });
        },
        customFormatDate: function(orderDate){
            parts = orderDate.split(" ");
            date = parts[0].split("-");
            hour = parts[1].split(":");

            return date[2] + "/" + date[1] + "/" + date[0] + " a las " + hour[0] + ":" + hour[1]
        },
        transferPoints: function(order){
            var url = 'transferPoints'
            axios.post(url, {
                'user_id' : order.user_id,
                'order_id' : order.id,
                'points' : order.reward_points,
            }).then(response=> {
                this.getOrders();
                toastr.success("¡Pedido pagado y puntos entregados!");
            }).catch(error => {
                toastr.error("No se han podido entregar los puntos al usuario");
            });
        }
    }
});
new Vue({
    el: '#housekeepingreservas',
    created: function(){
        this.getBooks();
    },
    data: {
        books: [],
        fillBook: {'id': '','user_id': '','numPeople': '','bookDate': '','state': ''},
        hour: "00",
        minutes: "00",
    },
    methods: {
        getBooks: function() {
            var url = 'books';
            axios.get(url).then(response => {
                this.books = response.data;
            }).catch(error => {
                toastr.error("No se han podido obtener las reservas");
            });
        },
        editBook: function(book){
            this.fillBook.id = book.id;
            this.fillBook.user_id = book.user_id;
            this.fillBook.numPeople = book.numPeople;
            this.fillBook.bookDate = book.bookDate;
            this.fillBook.state = book.state;
            $("#selectBookState").val(this.fillBook.state);

            $('#edit').modal({backdrop: 'static', keyboard: false});
        },
        updateBook: function(book_id){
            var url = 'books/' + book_id;
            this.fillBook.state = $("#selectBookState").val();
            axios.put(url, this.fillBook).then(response=> {
                this.getBooks();
                 bookResponse(this.fillBook.user_id, this.fillBook.bookDate, this.fillBook.state);
                $('#edit').modal('hide');
                toastr.success("¡Reserva editada con éxito!");
                this.fillBook =  {'id': '','user_id': '','numPeople': '','bookDate': '','state': ''}
        }).catch(error => {
                toastr.error("No se ha podido editar la reserva");
            });
        },
        deleteBook: function(book) {
            var url = 'books/' + book.id;
            axios.delete(url).then(response => {
                this.getBooks();
                toastr.success("¡Reserva eliminada con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido eliminar la reserva");
            });
        },
        createBook: function() {
            this.fillBook =  {'id': '','user_id': '','numPeople': '','bookDate': '','state': ''};
            $('#createBook').modal({backdrop: 'static', keyboard: false});
        },
        saveBook: function(){
            var url = 'books';
            axios.post(url, {
                'user_id' : this.fillBook.user_id,
                'numPeople' : this.fillBook.numPeople,
                'bookDate' : this.fillBook.bookDate,
                'state' : 'Aceptada',
            }).then(response => {
                this.getBooks();
                this.fillBook = {'id': '','user_id': '','numPeople': '','bookDate': '','state': ''};
                $('#createBook').modal('hide');
                toastr.success("¡Reserva añadida con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido añadir la reserva");
            });
        },
        closepopup: function(popup){
            popup == 'edit' ? $('#edit').modal('hide') : $('#createBook').modal('hide');
        },
        closeModalBook: function(){
            $('#createBook').modal('hide');
        },
        updateBookState: function(book){
            var url = 'updateBookState/' + book.id;
            var state = $("#bookState" + book.id).val()
            axios.put(url, {
                'state' : state
            }).then(response=> {
                this.getBooks();
                bookResponse(book.user_id, book.bookDate, state);
                toastr.success("¡Estado actualizado!");
            }).catch(error => {
                toastr.error("No se ha podido actualizar el estado");
            });
        },
        customFormatDate: function(bookDate){
            parts = bookDate.split(" ");
            date = parts[0].split("-");
            hour = parts[1].split(":");

            return date[2] + "/" + date[1] + "/" + date[0] + " a las " + hour[0] + ":" + hour[1]
        },
        generateBook: function(){
            var hours = $("#hourpicker").val();
            var minutes = $("#minutespicker").val();
            var finalHour = this.hour + ":" + this.minutes;
            var nump = $("#numPersons").val();
            var date = $("#datepicker").val();

            if(this.checkBookInputs(date,nump)){
                var url = 'generatebook';
                axios.post(url, {
                    'date' : date,
                    'hour' : finalHour,
                    'numPersons' : nump,
                    'admin' : true
                }).then(response => {
                    if(response.data.result){
                    $("#hourpicker").val("");
                    $("#numPersons").val("");
                    $("#datepicker").val("");
                    $('#createBook').modal('hide');
                    this.getBooks();
                    toastr.success("Reserva realizada con éxito");
                }else{
                    toastr.error("Introduce una fecha posterior a la actual");
                }
            }).catch(error => {
                    toastr.error("Error al realizar la reserva. Intentalo de nuevo más tarde");
            });
            }else{
                toastr.error("Revisa los datos introducidos");
            }
        },
        checkBookInputs: function(date,nump){
            if(date.length==0 || nump.length==0){
                return false;
            }else{
                return true;
            }
        },showHour: function(){
            var hour = $("#hourpicker").val();
            if(hour < 10 && hour.length != 0){
                this.hour = "0" + hour
            }else if(hour > 23){
                this.hour = "00"
            }else if(hour.length == 0){
                this.hour = "00"
            }else{
                this.hour = hour
            }
        },
        showMinute: function(){
            var minutes = $("#minutespicker").val();
            if(minutes < 10 && minutes.length != 0){
                this.minutes = "0" + minutes
            }else if(minutes > 59){
                this.minutes = "00"
            }else if(minutes.length == 0){
                this.minutes = "00"
            }else{
                this.minutes = minutes
            }
        }
    }
});
new Vue({
    el: '#housekeepingvouchers',
    created: function(){
        this.getVouchers();
    },
    data: {
        allVouchers: [],
        voucherCode: ''
    },
    methods: {
        getVouchers: function(){
            var url = 'getVouchers'
            axios.get(url).then(response => {
                this.allVouchers = response.data;
            }).catch(error => {
                toastr.error("No se han podido obtener los códigos");
            });
        },
        validateVoucher: function(){
            if(this.voucherCode.length == 6){
                $("#voucher_success").addClass("hide");
                $("#voucher_error").addClass("hide");
                var url = 'validateVoucher';
                axios.post(url, {
                    'code' : this.voucherCode,
                }).then(response => {
                    this.showResults(response);
                }).catch(error => {
                    toastr.error("No se ha encontrado el código en el sistema");
                });
            }else{
                toastr.error("Introduce un código de 6 dígitos");
            }

        },
        showResults: function(response){
            var result = response.data.result;
            if(result){
                $("#voucher_success").removeClass("hide");
            }else{
                $("#voucher_error").removeClass("hide");
            }
        },
        checkVoucher: function(){
            var found = false;
            for(i = 0; i < this.allVouchers.length; i++){
                if(this.allVouchers[i].code == this.voucherCode){
                    found = true;
                    $("#voucherInfo-username").text(this.allVouchers[i].user.name + " " + this.allVouchers[i].user.surnames)
                    $("#voucherInfo-usermail").text(this.allVouchers[i].user.email)
                    $("#voucherInfo-userphone").text(this.allVouchers[i].user.phone)
                    $("#voucherInfo-userphoto").attr("src",this.allVouchers[i].user.photo)
                    $("#voucherInfo-userpoints").text(this.allVouchers[i].user.points)
                    $("#voucherInfo-voucherpoints").text(this.allVouchers[i].points)

                }
            }

            if(found){
                $("#voucher_info").removeClass("hide");
                $("#generateVoucher").removeClass("hide");
                $("#voucherNotFound").addClass("hide");
            }else{
                $("#voucherNotFound").removeClass("hide");
                $("#voucher_info").addClass("hide");
                $("#generateVoucher").addClass("hide");
                $("#voucher_success").addClass("hide");
                $("#voucher_error").addClass("hide");
            }
        }
    }
});
new Vue({
    el: '#housekeepingusers',
    created: function(){
        this.getUsers();
    },
    data: {
        searcher: '',
        users: [],
        showUsers: [],
        fillUser: {'id': '','name': '','email':'','surnames': '','direction': '','photo': '','isAdmin':'', 'points':'', 'phone':''},
    },
    methods: {
        getUsers: function() {
            var url = 'users';
            axios.get(url).then(response => {
                this.users = response.data;
                this.showUsers = response.data;
            }).catch(error => {
                toastr.error("No se han podido obtener los usuarios");
            });
        },
        editUser: function(user){
            this.fillUser.id = user.id;
            this.fillUser.name = user.name;
            this.fillUser.email = user.email;
            this.fillUser.surnames = user.surnames;
            this.fillUser.direction = user.direction;
            this.fillUser.photo = user.photo;
            this.fillUser.isAdmin = user.isAdmin;
            this.fillUser.points = user.points;
            this.fillUser.phone = user.phone;

            $('#edit').modal({backdrop: 'static', keyboard: false});
        },
        updateUser: function(user_id){
            var url = 'users/' + user_id;

            axios.put(url, this.fillUser).then(response=> {
                this.getUsers();
                this.fillUser = {'id': '','name': '','email':'','surnames': '','direction': '','photo': '','isAdmin':'', 'points':'','phone':''};
                $('#edit').modal('hide');
                toastr.success("¡Usuario editado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido editar el usuario");
            });
        },
        deleteUser: function(user) {
            var url = 'users/' + user.id;
            axios.delete(url).then(response => {
                this.getUsers();
                toastr.success("¡Usuario eliminado con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido eliminar el usuario");
            });
        },
        createUser: function() {
            this.fillUser = {'id': '','name': '','email':'','surnames': '','direction': '','photo': '','isAdmin':'', 'points':''};
            $('#create').modal({backdrop: 'static', keyboard: false});
        },
        saveUser: function(){
            var url = 'users';
            axios.post(url, {
                'name' : this.fillUser.name,
                'email' : this.fillUser.email,
                'surnames' : this.fillUser.surnames,
                'direction' : this.fillUser.direction,
                'photo' : this.fillUser.photo,
                'isAdmin' : 0,
                'points' : this.fillUser.points,
            }).then(response => {
                this.getUsers();
                this.fillUser = {'id': '','name': '','email':'','surnames': '','direction': '','photo': '','isAdmin':'', 'points':''};
                $('#create').modal('hide');
                toastr.success("¡Usuario añadido con éxito!");
            }).catch(error => {
                toastr.error("No se ha podido añadir el usuario");
            });
        },
        closepopup: function(popup){
            popup == 'edit' ? $('#edit').modal('hide') : $('#create').modal('hide');
        },
        getContent: function(){
            if(this.searcher.length != 0){
                this.showUsers = [];
                for(i=0; i< this.users.length; i++){
                    if(this.users[i].name.includes(this.capitalize(this.searcher))) {
                        this.showUsers.push(this.users[i]);
                    }
                }
            }else{
                this.showUsers = this.users;
            }
        },
        capitalize: function(str){
            return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
        }
    }
});
//# sourceMappingURL=michelscripts_housekeeping.js.map
