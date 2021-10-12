$(document).ready( function () {
    reset()
    switch (appSettings.page){
        case "home":
            $('#home-content').show();
            break;
        case "orders":
            $('#pedidos-content').show();
            break;
        case "books":
            $('#reservas-content').show();
            break;
        case "favs":
            $('#favoritos-content').show();
            break;
        case "pizzas":
            vue_user.imInDontLike = 0;
            $('#mispizzas-content').show();
            break;
        case "points":
            $('#canjear-content').show();
            break;
        case "dontlike":
            vue_user.imInDontLike = 1;
            $('#config').addClass('activado');
            $('#config').children('ul').slideDown();
            $('#nomegusta-content').show();
            break;
        case "changeemail":
            $('#config').addClass('activado');
            $('#config').children('ul').slideDown();
            $('#cambiaremail-content').show();
            break;

        case "changephoto":
            vue_user.refreshUserProfileImage();
            $('#config').addClass('activado');
            $('#config').children('ul').slideDown();
            $('#cambiarimagen-content').show();
            break;

        case "changedirection":
            $('#config').addClass('activado');
            $('#config').children('ul').slideDown();
            $('#cambiardireccion-content').show();
            break;

        case "config":
            $('#config').addClass('activado');
            $('#configicon').addClass('fa-chevron-up');
            $('#config').children('ul').slideDown();
            $('#config-content').show();
            break;
    };

    document.getElementById("config").addEventListener("click", switcher);

});


function slideMove(id) {
    reset()

    if(id == "nomegusta"){
        vue_user.imInDontLike = 1;
    }else{
        vue_user.imInDontLike = 0;
    }

    $('#' + id + '-content').css({
        'right': '-350px'

    }).show().animate({

        'right': '50px'

    }, 700, function () {

        $(this).animate({'right': '0'}, 100);
    });
}

function switcher(){
    if($('#config').hasClass('activado')){
        $('#configicon').removeClass('fa-chevron-up');
        $('#configicon').addClass('fa-chevron-down');
        $('#config').removeClass('activado');
        $('#config').children('ul').slideUp();
    }else{
        $('#configicon').removeClass('fa-chevron-down');
        $('#configicon').addClass('fa-chevron-up');
        $('#config').addClass('activado');
        $('#config').children('ul').slideDown();
    }
}
function submitform(){
    localStorage.clear();
    $('#myform').submit();
}

function loadImage(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah')
                .removeClass('hide')
                .attr('src', e.target.result)

            $('#submit').removeClass('hide');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function reset(){
    $('#home-content').removeClass('hide').hide();
    $('#pedidos-content').removeClass('hide').hide();
    $('#reservas-content').removeClass('hide').hide();
    $('#favoritos-content').removeClass('hide').hide();
    $('#mispizzas-content').removeClass('hide').hide();
    $('#canjear-content').removeClass('hide').hide();
    $('#nomegusta-content').removeClass('hide').hide();
    $('#cambiaremail-content').removeClass('hide').hide();
    $('#cambiarimagen-content').removeClass('hide').hide();
    $('#cambiardireccion-content').removeClass('hide').hide();
    $('#config-content').removeClass('hide').hide();
}