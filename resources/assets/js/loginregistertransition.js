function slideMove(id) {
	$('#register-card').removeClass('hide').hide();
	$('#login-card').hide();

	if(id == "login"){
		$('#head-register').removeClass('active');
		$('#head-login').addClass('active');

        $('#register-card').hide();
        $('#reset-card').hide();
	}else if(id == "register"){
        $('#head-register').addClass('active');
        $('#head-login').removeClass('active');

        $('#login-card').hide();
        $('#reset-card').hide();
    }else{
        $('#reset-card').removeClass('hide');
        $('#login-card').hide();
        $('#register-card').hide();
	}

	$("#"+id+'-card').fadeIn();
}