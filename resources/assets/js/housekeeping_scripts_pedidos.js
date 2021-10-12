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