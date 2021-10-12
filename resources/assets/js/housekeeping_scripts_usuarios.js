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