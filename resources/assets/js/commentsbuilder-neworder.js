var sendOrderVue = new Vue({
    el: '#menuVue',
    created: function(){
        this.initializeValues();
        this.getRecommendations();
    },
    data: {
        userDirection: "",
        orderPrice: 0,
        rewardPoints: 0,
        localRecommends: [],
        userRecommends: [],
    },
    methods: {
        initializeValues: function(){
            var myOrder = localStorage['myOrder'] ? JSON.parse(localStorage['myOrder']) : [];
            this.orderPrice = 0
            for(i = 0; i < myOrder.length; i++){
                this.orderPrice += myOrder[i].finalPrice;
            }
            this.orderPrice = Math.round(this.orderPrice * 100) / 100;
            this.rewardPoints = parseInt(this.orderPrice * 1.2);
            $("#totalPrice").html(this.orderPrice);
            $("#rewPoints").html(this.rewardPoints);
            this.getUserDirection();
            this.getRecommendations();
        },
        getRecommendations: function(){
            var url = "getrecommendations";
            axios.get(url).then(response => {
                this.localRecommends = response.data.local;
            }).catch(error => {
                toastr.error("Error obteniendo recomendaciones del local");
            });

            var url = "getuserrecommendations"
            axios.post(url, {
                'orderproducts' : mainOrder.myOrder,
            }).then(response => {
                this.userRecommends = response.data.user;
            })
        },
        getUserDirection: function(){
            var url = "getuserdirection";
            axios.get(url).then(response => {
                this.userDirection = response.data.direction;
            }).catch(error => {
                toastr.error("Error obteniendo dirección de usuario");
            });
        },
        showmodalConfirmation: function(){
            if(mainOrder.myOrder.length == 0){
                toastr.error("¡El pedido está vacío!");
            }else{
                $('#popupConfirmation').modal({backdrop: 'static', keyboard: false});
            }
        },
        closeModalConfirmation: function(){
            $('#popupConfirmation').modal('hide');
        },
        closeModalDirection: function(){
            $('#popupDirection').modal('hide');
        },
        confirmDirection: function() {
            this.closeModalConfirmation();
            $('#popupDirection').modal({backdrop: 'static', keyboard: false});
        },
        deleteProductFromOrder: function(obj){
            mainOrder.deleteProductFromOrder(obj);
            this.initializeValues();
        },
        editProductFromOrder: function(obj){
            mainOrder.showPopUpEditPizza(obj);
            this.initializeValues();
        },
        createOrder: function(){
            cbUserDirection = $("#checkboxUserDirection").prop("checked");
            cbOtherDirection = $("#checkboxdirection").prop("checked");
            cbLocalDirection = $("#checkboxLocalDirection").prop("checked");
            inputOtherDirection = $("#inputDirection").val();

            if(cbUserDirection && cbOtherDirection || cbUserDirection && cbLocalDirection || cbOtherDirection && cbLocalDirection){
                toastr.error("Selecciona una sola dirección");
            }else if(!cbUserDirection && !cbOtherDirection && !cbLocalDirection){
                toastr.error("Selecciona una dirección");
            }else if(cbOtherDirection && inputOtherDirection.length == 0){
                toastr.error("Introduce una dirección");
            }else{
                if(cbLocalDirection){
                    this.userDirection = "Recogida en local";
                }else{
                    this.userDirection = cbUserDirection ? this.userDirection : inputOtherDirection
                }
                var url = "neworder";
                axios.post(url, {
                    'orderproducts' : mainOrder.myOrder,
                    'direction' : this.userDirection,
                    'order_price': this.orderPrice,
                    'reward_points': this.rewardPoints
                    }).then(response => {
                        newOrder();
                        this.closeModalDirection();
                        localStorage.clear();
                        mainOrder.refreshNotificationsBadge();
                        this.initializeValues();
                        toastr.info("<div><a href='http://localhost/impronta/public/user-orders'>Tu pedido ha sido realizado. Haz click aquí para consultar el estado.</a></div>", 'Información', {
                            positionClass: "toast-top-left",
                            timeOut: 0
                        });

                    }).catch(error => {
                        toastr.error('Vuelve a intentarlo de nuevo más tarde.', 'Error al realizar el pedido')
                    });
            }
        },
        showPopUpAddPizza: function (value) {
            switch(value){
                case 1:
                    mainOrder.actualProduct = this.localRecommends[0];
                    break;
                case 2:
                    mainOrder.actualProduct = this.localRecommends[1];
                    break;
                case 3:
                    mainOrder.actualProduct = this.localRecommends[2];
                    break;
            }
            $('#popupAddPizzaToOrder').modal({backdrop: 'static', keyboard: false});
        },
        calculatePrice(price,quantity){
            return (price * quantity).toFixed(2);
        }
    }
});

