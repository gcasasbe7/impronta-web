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