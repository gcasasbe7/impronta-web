var mainOrder = new Vue({
    el: '#mainOrder',
    mounted: function(){
        this.getOrderDataFromCache();
    },
    data: {
        actualProduct: '',
        myOrder: [],
        productOrderId: 0,
        edited: {'id': '', 'name': '', 'quantity': '', 'size': '', 'type': ''},
    },
    methods: {
        getOrderDataFromCache: function(){
            this.refreshNotificationsBadge();
            this.productOrderId = localStorage['productOrderId'] ? localStorage['productOrderId'] : 0;
        },
        refreshNotificationsBadge: function(){
            this.myOrder = localStorage['myOrder'] ? JSON.parse(localStorage['myOrder']) : [];
            if(this.myOrder.length == 0){
                $(document).ready(function(){
                    $("#orderNotifications").addClass("hide");
                });
            }else{
                var notif = 0;
                for(i = 0; i < this.myOrder.length; i++){
                    notif += parseInt(this.myOrder[i].quantity);
                }
                $(document).ready(function(){
                    $("#orderNotifications").removeClass("hide").html(notif);
                });
            }
        },
        showPopUpAddPizza: function (product) {
            this.actualProduct = product;
            $('#popupAddPizzaToOrder').modal({backdrop: 'static', keyboard: false});
        },
        showPopUpEditPizza: function (object) {
            this.actualProduct = object.product;
            this.edited.id = object.id;
            this.edited.name = this.actualProduct.name;
            this.edited.quantity = object.quantity;
            this.edited.size = object.size;
            this.edited.type = this.actualProduct.type;
            $('#popupEditProductOrder').modal({backdrop: 'static', keyboard: false});
        },
        closePopupAddPizza: function () {
            $('#popupAddPizzaToOrder').modal('hide');
        },
        closePopupEditPizza: function () {
            $('#popupEditProductOrder').modal('hide');
        },
        addProductToOrder: function () {
            var quantity = document.getElementById("inpQuantity").value;
            if(quantity < 1){
                toastr.error("Introduce una cantidad valida");
            }else{
                var price = this.actualProduct.price;
                var obj = {};
                obj['id'] = this.productOrderId;
                this.productOrderId++;
                localStorage['productOrderId'] = this.productOrderId;
                obj['quantity'] = quantity;

                if(this.actualProduct.type == 1){
                    var size = document.getElementById("pizzaToAddSize").value;
                    switch (size) {
                        case "pequeña":
                            price = this.actualProduct.price_s;
                            break;
                        case "mediana":
                            price = this.actualProduct.price_m;
                            break;
                        case "grande":
                            price = this.actualProduct.price_l;
                            break;
                        case "brusquetta":
                            price = this.actualProduct.price_b;
                            break;
                    }
                    obj['size'] = size;
                }

                var finalPrice = quantity * price;
                obj['finalPrice'] = finalPrice;


                obj['product'] = this.actualProduct;

                this.myOrder.push(obj);

                document.getElementById("inpQuantity").value = "";
                this.closePopupAddPizza();

                localStorage['myOrder'] = JSON.stringify(this.myOrder);

                this.refreshNotificationsBadge();

                toastr.info('Producto añadido al pedido', 'Información', {
                    positionClass: "toast-top-left"
                });

                sendOrderVue.initializeValues();
            }
        },
        deleteProductFromOrder: function(obj){
            var removeIndex = this.myOrder.map(function(item) { return item.id; }).indexOf(obj.id);
            this.myOrder.splice(removeIndex, 1);
            localStorage['myOrder'] = JSON.stringify(this.myOrder);

            this.refreshNotificationsBadge();

            toastr.info('Producto eliminado del pedido', 'Información', {
                positionClass: "toast-top-left"
            });
        },
        editProductOrder: function(){
            var idx = this.myOrder.map(function(item) { return item.id; }).indexOf(this.edited.id);
            this.myOrder[idx].quantity = this.edited.quantity;
            if(this.edited.type == 1){
                this.edited.size = $("#pizzaToEditSize").val();
                this.myOrder[idx].size = this.edited.size;
            }

            if(this.edited.size != null){
                switch(this.edited.size){
                    case "pequeña":
                        this.myOrder[idx].finalPrice = this.actualProduct.price_s * this.edited.quantity;
                        break;
                     case "mediana":
                        this.myOrder[idx].finalPrice = this.actualProduct.price_m * this.edited.quantity;
                        break;
                     case "grande":
                        this.myOrder[idx].finalPrice = this.actualProduct.price_l * this.edited.quantity;
                        break;
                     case "brusquetta":
                        this.myOrder[idx].finalPrice = this.actualProduct.price_b * this.edited.quantity;
                        break;
                }
            }else{
                this.myOrder[idx].finalPrice = this.actualProduct.price * this.edited.quantity;
            }

            localStorage['myOrder'] = JSON.stringify(this.myOrder);

            this.refreshNotificationsBadge();

            sendOrderVue.initializeValues();

            this.closePopupEditPizza();

            toastr.info('Producto editado', 'Información', {
                positionClass: "toast-top-left"
            });

        }
    }
});

