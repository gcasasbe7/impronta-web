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