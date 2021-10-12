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