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