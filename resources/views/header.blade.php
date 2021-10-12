<header>
    <div class="headermenu">
        <div class="headercontenedor">
            <a class="headerlogo" href="{{ url('/') }}">L'impronta</a>
            <nav>
                <ul>
                    @if(Auth::check())
                        @if (Auth::user()->isAdmin())
                            <li><a style="text-decoration: none;color: red;" href="{{ url('housekeeping/dashboard') }}">Housekeeping</a></li>
                        @endif
                    @endif
                    <li><a style="text-decoration: none" href="{{url('menu')}}">Carta</a></li>
                    <li><a style="text-decoration: none" href="#">Eventos</a></li>
                    <li><a style="text-decoration: none" href="#">Nosotros</a></li>
                    @guest
                        <li class="my-ml"><a style="text-decoration: none" href="{{ url('loginregister') }}">Entra o regístrate</a></li>
                        @else
                                <li style="list-style: none; text-decoration: none;" class="dropdown">
                                    <a style="text-decoration: none" id="login" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }} <span id="caret" class="caret"></span>
                                    </a>
                                </li>

                                <div class="arrow-up"></div>
                                <div class="login-form" style="z-index: 1">
                                    <div>
                                        <a href="{{ url('user') }}"><img style="border-radius: 50%;border: 2px black solid; height: 105px;width: 100px" src="{{ Auth::user()->photo }}" alt=""></a>
                                        <p id="myPoints"><b>{{ Auth::user()->name }}</b></p>
                                        <p id="myPoints">{{ Auth::user()->points }} puntos</p>
                                        <hr class="custom">
                                        <p><a href="#">MIS RESERVAS</a></p>
                                        <p><a href="#">MIS PEDIDOS</a></p>
                                        <p><a href="#">MIS FAVORITOS</a></p>
                                        <p><a href="#">CONFIGURACIÓN</a></p>
                                        <form action="{{route('logout')}}" method="POST">
                                            {{ csrf_field() }}
                                            <div>
                                                <button type="submit" class="btn btn-primary">SALIR</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                    @endguest
                </ul>
            </nav>
        </div>
    </div>
</header>


