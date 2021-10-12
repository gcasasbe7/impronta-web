<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-faded" style="background-color: white">
    <a class="navbar-brand monogly" href="{{ url('/') }}">Impronta</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/menu') }}">Carta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/ofertas') }}">Ofertas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/nosotros') }}">Nosotros</a>
            </li>
            @if(Auth::check())
                @if (Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" style="text-decoration: none;color: red;" href="{{ url('housekeeping/dashboard') }}">Housekeeping</a>
                    </li>
                @endif
            @endif

        </ul>
        <ul class="navbar-nav" style="margin-right: 5%;">
            @auth
                <li class="nav-item mr-3">
                    <a class="nav-link" href="{{ url('/myorder') }}"><span id="orderNotifications" class="badge badge-pill badge-danger">0</span> <i class="fas fa-shopping-cart"></i> Mi pedido</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item disabled txt-c" href="{{ url("/user") }}"><hr class="custom"></a>
                        <a class="dropdown-item disabled txt-c" href="{{ url("/user") }}"><img id="imgUserHeader" src="{{ Auth::user()->photo }}" class="resize displayed bub" alt=""></a>
                        <a class="dropdown-item disabled txt-c points" href="{{ url("/user") }}">{{ Auth::user()->points }} puntos</a>
                        <a class="dropdown-item disabled txt-c" href="{{ url("/user") }}"><hr class="custom"></a>
                        <a class="dropdown-item" href="{{ url('/user') }}"><i class="fas fa-angle-right"></i> Mi perfil</a>
                        <a class="dropdown-item" href="{{url('/user-orders')}}"><i class="fas fa-angle-right"></i> Mis pedidos</a>
                        <a class="dropdown-item" href="{{url('/user-books')}}"><i class="fas fa-angle-right"></i> Mis reservas</a>
                        <a class="dropdown-item" href="{{url('/user-points')}}"><i class="fas fa-angle-right"></i> Canjear puntos</a>
                        <a class="dropdown-item" href="{{url('/user-config')}}"><i class="fas fa-angle-right"></i> Configuración</a>
                        <form name="myform" action="{{route('logout')}}" method="POST">
                            {{ csrf_field() }}
                            <a class="dropdown-item txt-c" href="javascript: submitform()">Salir</a>
                        </form>

                    </div>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/loginregister') }}">Entra o regístrate</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<script type="text/javascript">
    function submitform() {   localStorage.clear();document.myform.submit() }
</script>