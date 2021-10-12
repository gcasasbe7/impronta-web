var vue_user = new Vue({
    el: '#vue-user',
    created: function(){
        this.initializeMyPizzas();
        this.initializeIngredients();
        this.initializeMyFavs();
        this.initializeMyBooks();
        this.initializeMyOrders();
        this.initializeMyDontLikeIngredients();
        this.initializeMyVouchers();
        this.getUserDirection();
    },
    data: {
        myPizzas: [],
        myFavs: [],
        myBooks: [],
        myOrders: [],
        myDontLikeIngredients: [],
        myVouchers: [],
        fillProduct: {
            'id': '',
            'name': '',
            'likes': '',
            'averageRate': '',
            'type': '',
            'price': '',
            'isExhausted': '',
            'isOffered': '',
            'description' : '',
            'photo' : '',
            'user_id': ''
        },
        allIngredients: [],
        pizzaIngredients: [],
        user_points: 0,
        hour: "00",
        minutes: "00",
        orderToRepeat: {},
        userDirection: '',
        little_price: 0,
        medium_price: 0,
        big_price: 0,
        brusquetta_price: 0,
        imInDontLike: 0,
    },
    methods: {
        initializeMyPizzas: function() {
            var url = 'getuserpizzas';
            axios.get(url).then(response => {
                this.myPizzas = response.data.userpizzas;
            }).catch(error => {
                toastr.error("Error obteniendo mis pizzas");
            });
        },
        getUserDirection: function(){
            var url = "getuserdirection";
            axios.get(url).then(response => {
                this.userDirection = response.data.direction;
        }).catch(error => {
                toastr.error("Error obteniendo dirección de usuario");
        });
        },
        initializeIngredients: function() {
            var url = 'getingredientsnames';
            axios.get(url).then(response => {
                this.allIngredients = response.data.ingredients;
            }).catch(error => {
                    toastr.error("Error obteniendo ingredientes");
            });
        },
        initializeMyDontLikeIngredients: function() {
            var url = 'getdontlikeingredients';
            axios.get(url).then(response => {
                this.myDontLikeIngredients = response.data.ingredients;
            }).catch(error => {
                toastr.error("Error obteniendo ingredientes marcados como negativos");
            });
        },
        initializeMyFavs: function() {
            var url = 'getfavs';
            axios.get(url).then(response => {
                this.myFavs = response.data.favs;
                this.user_points = response.data.points;
            }).catch(error => {
                toastr.error("Error obteniendo mis productos favoritos");
            });
        },initializeMyBooks: function() {
            var url = 'getbooks';
            axios.get(url).then(response => {
                this.myBooks = response.data.books;
        }).catch(error => {
                toastr.error("Error obteniendo mis reservas");
            });
        },initializeMyOrders: function() {
            var url = 'getorders';
            axios.get(url).then(response => {
                this.myOrders = response.data.orders;
            }).catch(error => {
                toastr.error("Error obteniendo mis pedidos" + error);
            });
        },
        initializeMyVouchers: function() {
            var url = 'getvouchers';
            axios.get(url).then(response => {
                this.myVouchers = response.data.vouchers;
            }).catch(error => {
                toastr.error("Error obteniendo mis cupones" + error);
            });
        },
        showModalPizza: function(){
            this.fillProduct.name = '';
            this.fillProduct.description = '';
            $("#pizzaIngredients").empty();
            document.getElementById("little_price").innerHTML = "0.00";
            document.getElementById("medium_price").innerHTML = "0.00";
            document.getElementById("big_price").innerHTML = "0.00";
            document.getElementById("brusquetta_price").innerHTML = "0.00";
            $('#createPizza').modal({backdrop: 'static', keyboard: false});
        },
        closeModalPizza: function(){
            $('#createPizza').modal('hide');
        },
        closeModalConfirmReorder: function(){
            $('#confirmReorder').modal('hide');
            $("#directionInfo").addClass("hide");
            $("#sameDirection").removeClass("hide");
        },
        showModalBook: function(){
            this.fillProduct.name = '';
            this.fillProduct.description = '';
            $('#createBook').modal({backdrop: 'static', keyboard: false});
        },
        closeModalBook: function(){
            $('#createBook').modal('hide');
        },
        createMyPizza: function(){
            if(this.fillProduct.name == "" || this.fillProduct.description == ""){
                toastr.error("Introduce todos los datos necesarios");
            }else{
                var lis = document.getElementById("pizzaIngredients").getElementsByTagName("li");
                for(i = 0; i < lis.length ; i++){
                    this.pizzaIngredients.push(lis[i].innerHTML);
                }

                var url = 'createmypizza';
                axios.post(url, {
                    'name' : this.fillProduct.name,
                    'description' : this.fillProduct.description,
                    'ingredients' : this.pizzaIngredients,
                    'isPublic' : $("#isPublic").prop("checked"),
                    'price_s' : this.little_price,
                    'price_m' : this.medium_price,
                    'price_l' : this.big_price,
                    'price_b' : this.brusquetta_price,
                }).then(response => {
                    this.initializeMyPizzas();
                    this.fillProduct = {'name': '','description' : ''};
                    $('#createPizza').modal('hide');
                }).catch(error => {
                    toastr.error("Error al crear la pizza");
                });
            }
        },
        deleteMyPizza: function(id){
            var url = 'products/' + id;
            axios.delete(url).then(response => {
                this.initializeMyPizzas();
                toastr.info('Pizza eliminada', 'Información', {
                    positionClass: "toast-top-left"
                });
            }).catch(error => {
                toastr.error("No se ha podido eliminar la pizza. Intentalo de nuevo más tarde.");
            });
        },
        generateVoucher: function(){
            var exchange_points = document.getElementById("demo").value;

            if(exchange_points <= this.user_points && exchange_points != 0){
                var url = 'generateVoucher';
                axios.post(url,{
                    'points' : exchange_points,
                }).then(response => {
                    this.initializeMyVouchers();
                    document.getElementById("voucherCode").innerHTML = response.data.voucherCode;
                    document.getElementById("responseVoucher").classList.remove("hide");
                    document.getElementById("generateVoucher").classList.add("hide");
                }).catch(error => {
                    toastr.error("Error al crear la pizza");
                });
            }else{
                toastr.error("Introduce una cantidad de puntos correcta");
            }
        },
        newVoucher: function() {
            document.getElementById("responseVoucher").classList.add("hide");
            document.getElementById("generateVoucher").classList.remove("hide");
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
                    'admin' : false
                }).then(response => {
                    if(response.data.result){
                        $("#hourpicker").val("");
                        $("#numPersons").val("");
                        $("#datepicker").val("");
                        $('#createBook').modal('hide');
                        this.initializeMyBooks();
                        newBook()
                        toastr.info('Recibirás respuesta a tu petición en unos instantes', 'Petición de reserva realizada', {
                            positionClass: "toast-top-left"
                        });
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
        },
        showContent: function(order_id){
            if($("#ordercontent" + order_id).hasClass("hide")){
                $("#ordercontent" + order_id).removeClass("hide")
                $("#btnShowContent" + order_id).html("Cerrar contenido");
            }else{
                $("#ordercontent" + order_id).addClass("hide")
                $("#btnShowContent" + order_id).html("Ver contenido");
            }
        },
        customFormatDate: function(bookDate){
            parts = bookDate.split(" ");
            date = parts[0].split("-");
            hour = parts[1].split(":");

            return date[2] + "/" + date[1] + "/" + date[0] + " a las " + hour[0] + ":" + hour[1]
        },
        diffInDays: function(date1){
            var date1 = new Date(date1);
            var date2 = new Date();
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            return Math.ceil(timeDiff / (1000 * 3600 * 24));
        },
        showHour: function(){
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
        },
        confirmRepeatOrder: function(order){
            this.orderToRepeat = order;
            $('#confirmReorder').modal({backdrop: 'static', keyboard: false});
        },
        repeatOrder: function(){
            cbUserDirection = $("#checkboxUserDirection").prop("checked");
            cbLocalDirection = $("#checkboxLocalDirection").prop("checked");
            inputOtherDirection = $("#inputDirection").val();

            if(cbUserDirection && cbLocalDirection){
                toastr.error("Selecciona una sola dirección");
            }else if($("#sameDirection").hasClass("hide") && !cbUserDirection && !cbLocalDirection && inputOtherDirection.length == 0){
                toastr.error("Introduce una dirección");
            }else{
                if(cbLocalDirection){
                    this.userDirection = "Recogida en local";
                }else if (!$("#sameDirection").hasClass("hide") && !cbUserDirection && !cbLocalDirection){
                    this.userDirection = this.orderToRepeat.direction
                }else{
                    this.userDirection = inputOtherDirection;
                }
                var url = "repeatorder"
                axios.post(url, {
                    'orderproducts' : this.orderToRepeat.orderproducts,
                    'direction' : this.userDirection,
                    'order_price': this.orderToRepeat.total_price,
                    'reward_points': this.orderToRepeat.reward_points
                }).then(response => {
                    newOrder()
                    this.closeModalConfirmReorder();
                    localStorage.clear();
                    mainOrder.refreshNotificationsBadge();
                    this.initializeMyOrders();
                toastr.info("<div><a href='http://localhost/impronta/public/user-orders'>Tu pedido ha sido realizado. Haz click aquí para consultar el estado.</a></div>", 'Información', {
                    positionClass: "toast-top-left",
                    timeOut: 0
                });

            }).catch(error => {toastr.error('Vuelve a intentarlo de nuevo más tarde.', 'Error al realizar el pedido');
            });
            }
        },
        showDirectionInfo: function(){
            $("#directionInfo").removeClass("hide");
            $("#sameDirection").addClass("hide");

        },
        deleteOrder: function(order) {
            var url = 'orders/' + order.id;
            axios.delete(url).then(response => {
                this.initializeMyOrders();
            toastr.info("Pedido eliminado", 'Información', {
                positionClass: "toast-top-left"
            });
        }).catch(error => {
                toastr.error("No se ha podido eliminar el pedido");
        });
        },
        deleteIngredient: function(ingredient){
            var url = "deleteuserdontlike/" + ingredient.id;
            axios.post(url).then(response => {
                this.initializeMyDontLikeIngredients();
            toastr.info('Ingrediente desmarcado como negativo', 'Información', {
                positionClass: "toast-top-left"
            });
            }).catch(error => {
                    toastr.error("No se ha podido eliminar el ingrediente", error);
            });
        },
        refreshUserProfileImage: function(){
            var url = "getuserimage";
            axios.get(url).then(response => {
                $("#userProfileImage").attr("src",response.data.image);
                $("#imgUserHeader").attr("src",response.data.image);
            }).catch(error => {
                toastr.error("Error obteniendo imagen de perfil");
            });
        },
        changeUserDirection: function(){
            var newDirection = $("#newDirection").val();
            if(newDirection.length == 0){
                toastr.error("Introduce una dirección");
            }else{
                var url = "changeuserdirection";
                axios.post(url, {
                    'direction' : newDirection,
                }).then(response => {
                    this.getUserDirection();
                    $("#newDirection").val("")
                toastr.info("Dirección de envío actualizada", 'Información', {
                    positionClass: "toast-top-left",
                });
                }).catch(error => {
                    toastr.error('Vuelve a intentarlo de nuevo más tarde.', 'Error al actualizar la dirección de envío');
                });
            }
        },
        pointsToEuros: function(points){
            return points/10;
        },
        refreshValueEuros: function(){
            var input = document.getElementById("demo");
            var euros = document.getElementById("pointsInEuros");
            if(input.value.length > 0 ){
                euros.innerHTML = input.value / 10;
            }else{
                euros.innerHTML = 0;
            }

        }
    }
});

var ingredients = [];
var ingredientsObjects = [];
var glob_little_price = 6.50;
var glob_medium_price = 12.00;
var glob_big_price = 16.50;
var glob_brusquetta_price = 6.00;


function getIngredients(){
    var url = 'getingredientsnames';
    axios.get(url).then(response => {
        var temp = [];
        temp = response.data.ingredients;
        for(i = 0; i < temp.length ; i++){
            ingredientsObjects.push(temp[i]);
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
                    if(vue_user.imInDontLike){
                        addIngredient(this.getElementsByTagName("input")[0].value)
                    }else{
                        addPizzaIngredient(this.getElementsByTagName("input")[0].value)
                    }
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
        document.getElementById("inpSearchIngredient").value = "";

        var url = 'userdontlike/' + name;

        axios.post(url).then(response => {
            vue_user.initializeMyDontLikeIngredients();
            toastr.info('Nuevo ingrediente marcado como negativo', 'Información', {
                positionClass: "toast-top-left"
            });
    }).catch(error => {
            toastr.error("Ha sucedido un error, intentalo de nuevo más tarde");
    });
    }

    function addPizzaIngredient(name) {
        document.getElementById("myInputCreatePizza").value = "";
        var ul = document.getElementById("pizzaIngredients");
        var li = document.createElement("li");
        li.setAttribute("id", "ing" + name);
        li.setAttribute("class", "myingredientstag pointer");
        li.appendChild(document.createTextNode(name));
        ul.appendChild(li);
        AddAndRefreshPizzaPrices(name);
    }
    // var ul = document.getElementById("pizzaIngredients");
    // if(ul.children.length == 0){
    //
    // }
    function AddAndRefreshPizzaPrices(name){
        var ingredientPrice = getIngredientPrice(name);
        glob_little_price = Math.round((glob_little_price + ingredientPrice) * 100) / 100;
        glob_medium_price = Math.round((glob_medium_price + ingredientPrice) * 100) / 100;
        glob_big_price = Math.round((glob_big_price + ingredientPrice) * 100) / 100;
        glob_brusquetta_price = Math.round((glob_brusquetta_price + ingredientPrice) * 100) / 100;

        document.getElementById("little_price").innerHTML = glob_little_price;
        document.getElementById("medium_price").innerHTML = glob_medium_price;
        document.getElementById("big_price").innerHTML = glob_big_price;
        document.getElementById("brusquetta_price").innerHTML = glob_brusquetta_price;
    }

    function getIngredientPrice(name){
        for(i = 0; i < ingredientsObjects.length; i++){
            if(ingredientsObjects[i].name == name){
                return ingredientsObjects[i].price;
            }
        }
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

var ul = document.getElementById('pizzaIngredients');
ul.onclick = function(event) {
    //declaració
    function getIngredientPrice(name){
        for(i = 0; i < ingredientsObjects.length; i++){
            if(ingredientsObjects[i].name == name){
                return ingredientsObjects[i].price;
            }
        }
    }
    //Inici
    var target = getEventTarget(event);
    var ingredient = target.innerHTML;
    var ul = document.getElementById("pizzaIngredients");
    var li = document.getElementById("ing" + ingredient);
    ul.removeChild(li);

    if(ul.children.length == 0){
        glob_little_price = 6.50;
        glob_medium_price = 12.00;
        glob_big_price = 16.50;
        glob_brusquetta_price = 6.00;

        document.getElementById("little_price").innerHTML = "0.00";
        document.getElementById("medium_price").innerHTML = "0.00";
        document.getElementById("big_price").innerHTML = "0.00";
        document.getElementById("brusquetta_price").innerHTML = "0.00";
    }else{
        var ingredientPrice = getIngredientPrice(ingredient);
        glob_little_price = Math.round((glob_little_price - ingredientPrice) * 100) / 100;
        glob_medium_price = Math.round((glob_medium_price - ingredientPrice) * 100) / 100;
        glob_big_price = Math.round((glob_big_price - ingredientPrice) * 100) / 100;
        glob_brusquetta_price = Math.round((glob_brusquetta_price - ingredientPrice) * 100) / 100;

        document.getElementById("little_price").innerHTML = glob_little_price;
        document.getElementById("medium_price").innerHTML = glob_medium_price;
        document.getElementById("big_price").innerHTML = glob_big_price;
        document.getElementById("brusquetta_price").innerHTML = glob_brusquetta_price;
    }
};

var btnCreatePizza = document.getElementById("btnCreatePizza");
btnCreatePizza.onclick = function(){
    vue_user.little_price = glob_little_price;
    vue_user.medium_price = glob_medium_price;
    vue_user.big_price = glob_big_price;
    vue_user.brusquetta_price = glob_brusquetta_price;
    vue_user.createMyPizza();
}

$(document).ready(function(){
    document.getElementById("inpSearchIngredient").value = "";
    document.getElementById("myInputCreatePizza").value = "";
    getIngredients();
    autocomplete(document.getElementById("inpSearchIngredient"), ingredients);
    autocomplete(document.getElementById("myInputCreatePizza"), ingredients);
});

