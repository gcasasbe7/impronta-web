<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand monogly" href="{{ url('/housekeeping/dashboard') }}">Housekeeping</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/housekeeping/pedidos') }}">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/housekeeping/reservas') }}">Reservas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/housekeeping/carta') }}">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/housekeeping/eventos') }}">Eventos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/housekeeping/usuarios') }}">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/housekeeping/ingredientes') }}">Ingredientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/housekeeping/vouchers') }}">Vouchers</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/') }}"><button type="button" class="btn btn-outline-danger">Salir</button></a>
            </li>
        </ul>
    </div>
</nav>