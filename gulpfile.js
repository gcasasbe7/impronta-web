var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.styles([
        'resources/assets/css/bootstrap-v4.min.css',
        'resources/assets/css/fontawesome.css',
        'resources/assets/css/mycss.css',
        'resources/assets/css/toastr.min.css'], 'public/css/michelstyles.css');
});

elixir(function(mix) {
    mix.scripts([
        'resources/assets/js/jquery.min.js',
        'resources/assets/js/popper.min.js',
        'resources/assets/js/jquery-ui.js',
        'resources/assets/js/bootstrap-v4.min.js',
        'resources/assets/js/fontawesome.js',
        'resources/assets/js/toastr.min.js',
        'resources/assets/js/vue2.5.min.js',
        'resources/assets/js/axios.min.js'], 'public/js/michelscripts_base.js');
});

elixir(function(mix) {
    mix.scripts([
        'resources/assets/js/housekeeping_scripts_carta.js',
        'resources/assets/js/housekeeping_scripts_eventos.js',
        'resources/assets/js/housekeeping_scripts_ingredientes.js',
        'resources/assets/js/housekeeping_scripts_pedidos.js',
        'resources/assets/js/housekeeping_scripts_reservas.js',
        'resources/assets/js/housekeeping_scripts_vouchers.js',
        'resources/assets/js/housekeeping_scripts_usuarios.js'], 'public/js/michelscripts_housekeeping.js');
});