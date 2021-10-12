menuVue = new Vue({
    el: '#menuVue',
    created: function(){
        this.initializeProducts();
    },
    mounted: function(){
        this.setContent();
    },
    data: {
        products: [],
        pizzas: [],
        antipasto: [],
        ensaladas: [],
        bebidas: [],
        helados: [],
        comments: [],
        likes: [],
        dontlikes: [],
        dontlikesproducts: [],
        userpizzas: [],
        userfavs: [],
        user_id: 0,
        searcher: '',
        menuproducts: [],
        lastTab: "pizzas",
        community: []
    },
    methods: {
        initializeProducts: function() {
            var url = 'productsbytype';
            axios.get(url).then(response => {
                this.products = response.data.products;
                this.pizzas = response.data.pizzas;
                this.antipasto = response.data.antipasto;
                this.ensaladas = response.data.ensaladas;
                this.bebidas = response.data.bebidas;
                this.helados = response.data.helados;
                this.likes = response.data.likes;
                this.dontlikes = response.data.dontlikes;
                this.userpizzas = response.data.userpizzas;
                this.userfavs = response.data.userfavs;
                this.dontlikesproducts = response.data.dontlikesproducts;
                this.user_id = response.data.user_id;
                this.getContent(this.lastTab);
                this.community = response.data.community;
            }).catch(error => {
                toastr.error("Error obteniendo los productos de la carta", error);
            });
        },
        setContent: function(){
            $(document).ready(function(){
                menuVue.getContent(menuContent.content);
            });
        },
        getComments: function(product_id){
            var url = 'comments/' + product_id;
            axios.get(url).then(response => {
                this.comments = response.data;
        });
        },
        isLiked: function(product_id){
            var found = false;
            this.likes.forEach(function(entry) {
                if(product_id === entry.product_id){
                    found = true;
                }
            });
            return found;
        },
        isDontLiked: function(ingredient_id){
            var found = false;
            this.dontlikes.forEach(function(entry) {
                if(ingredient_id === entry.ingredient_id){
                    found = true;
                }
            });
            return found;
        },
        likeButton: function(product_id){
            if($('#btnLikes' + product_id).hasClass('hasLike')){
                $('#btnLikes' + product_id).removeClass('hasLike');
                $('#btnLikes' + product_id).removeClass('badge-success').addClass('badge-primary');
                $('#btnLikes' + product_id).text( Number($('#btnLikes' + product_id).text()) - 1 );
            }else{
                $('#btnLikes' + product_id).addClass('hasLike');
                $('#btnLikes' + product_id).removeClass('badge-primary').addClass('badge-success');
                $('#btnLikes' + product_id).text( Number($('#btnLikes' + product_id).text()) + 1 );
            }
        },
        addComment: function(product_id){
            var id = "txtarea" + product_id;
            var comment = document.getElementById(id).value;
            var url = 'addComment';
            axios.post(url, {
                'product_id' : product_id,
                'comment' : comment
            }).then(response => {
                this.initializeProducts();
                this.getContent(this.lastTab);
                var id = "txtarea" + product_id;
                var counter_id = "counter" + product_id;
                document.getElementById(id).value = "";
                document.getElementById(counter_id).innerHTML = 0;
                toastr.info('Comentario realizado', 'Información', {
                    positionClass: "toast-top-left"
                });
            }).catch(error => {
                toastr.error('Vuelve a intentarlo de nuevo más tarde.', 'Error al realizar comentario', {
                positionClass: "toast-top-left"
            });
            });
        },
        deleteComment: function(comment_id){
            var url = 'deleteComment';
            axios.post(url, {
                'comment_id' : comment_id,
            }).then(response => {
                this.initializeProducts();
                toastr.info('Comentario eliminado', 'Información', {
                    positionClass: "toast-top-left"
                });
            }).catch(error => {
                toastr.error('Vuelve a intentarlo de nuevo más tarde.', 'Error al eliminar comentario', {
                positionClass: "toast-top-left"
            });
        });
    },
        checkDelete: function(comment_id){
            if ($('#' + comment_id).hasClass("pointed")){
                $('#' + comment_id).removeClass("pointed");
                this.deleteComment(comment_id);
            }else{
                $('#' + comment_id).addClass("pointed");
            }
        },
        isProductDontLiked: function(product_id){
            var found = false;
            this.dontlikesproducts.forEach(function(entry) {
                if(product_id == entry){
                    found = true;
                }
            });
            return found;
        },
        test: function(product_id){
            var comment_id = "txtarea" + product_id;
            var counter_id = "counter" + product_id;
            var comment = document.getElementById(comment_id).value;
            document.getElementById(counter_id).innerHTML = comment.length;
        },
        getUserFavs: function(){
            var url = "getfavs"
            axios.get(url).then(response => {
                this.userfavs = response.data.favs;
            });
        },
        clearMenuActive: function(isAuth){
            $("#lblPizzas").removeClass("active");
            $("#lblAntipasto").removeClass("active");
            $("#lblBebidas").removeClass("active");
            $("#lblEnsaladas").removeClass("active");
            $("#lblHelados").removeClass("active");

            if(isAuth != 0){
                $("#lblUserFavs").removeClass("active");
                $("#lblUserPizzas").removeClass("active");
                $("#lblComunity").removeClass("active");
            }

        },
        getContent: function(content_id, isAuth){
            switch(content_id){
                case "pizzas":
                    this.clearMenuActive(isAuth);
                    $("#lblPizzas").addClass("active");
                    this.menuproducts = this.pizzas;
                    this.lastTab = "pizzas";
                    break;
                case "antipasto":
                    this.clearMenuActive(isAuth);
                    $("#lblAntipasto").addClass("active");
                    this.menuproducts = this.antipasto;
                    this.lastTab = "antipasto";
                    break;
                case "ensaladas":
                    this.clearMenuActive(isAuth);
                    $("#lblEnsaladas").addClass("active");
                    this.menuproducts = this.ensaladas;
                    this.lastTab = "ensaladas";
                    break;
                case "bebidas":
                    this.clearMenuActive(isAuth);
                    $("#lblBebidas").addClass("active");
                    this.menuproducts = this.bebidas;
                    this.lastTab = "bebidas";
                    break;
                case "helados":
                    this.clearMenuActive(isAuth);
                    $("#lblHelados").addClass("active");
                    this.menuproducts = this.helados;
                    this.lastTab = "helados";
                    break;
                case "mypizzas":
                    this.clearMenuActive(isAuth);
                    $("#lblUserPizzas").addClass("active");
                    this.menuproducts = this.userpizzas;
                    this.lastTab = "mypizzas";
                    break;
                case "myfavs":
                    this.getUserFavs();
                    this.clearMenuActive(isAuth);
                    $("#lblUserFavs").addClass("active");
                    this.menuproducts = this.userfavs;
                    this.lastTab = "myfavs";
                    break;
                case "community":
                    this.clearMenuActive(isAuth);
                    $("#lblComunity").addClass("active");
                    this.menuproducts = this.community;
                    this.lastTab = "community";
                    break;
                case "search":
                    this.clearMenuActive(isAuth);
                    if(this.searcher.length != 0){
                        this.menuproducts = [];
                        for(i=0; i< this.products.length; i++){
                            if(this.products[i].name.includes(this.capitalize(this.searcher))) {
                                this.menuproducts.push(this.products[i]);
                            }
                        }
                    }else{
                        this.getContent(this.lastTab)
                    }
                    break;
            }
        },
        capitalize: function(str){
            return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
        },
        alertLog: function(){
            toastr.info('Únete a nosotros para disfrutar de todas las funcionalidades', 'Información', {
                positionClass: "toast-top-left"
            });
        }
    }
});

