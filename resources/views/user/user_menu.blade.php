<div class="col-md-3 offset-md-1">
    <div class="card mb-4" style="width: 18rem;">
        <img id="userProfileImage" class="card-img-top mh-300" src="{{ Auth::user()->photo }}">
        <hr class="custom" style="margin: 20px 0px">
        <div class="card-body pb-0 pt-0">
            <div class="contenedor-menu">
                <ul class="menu contenedor2" style="margin-left: -20px">

                    <li><a id="home" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda far fa-user"></i>Mi perfil</a></li>

                    <li><a id="pedidos" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda fas fa-list-ul"></i>Mis pedidos</a></li>

                    <li><a id="reservas" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda fas fa-list-ul"></i>Mis reservas</a></li>

                    <li><a id="favoritos" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda far fa-heart"></i></i>Favoritos</a></li>

                    <li><a id="mispizzas" onclick="slideMove(this.id)" class="pointer"><img class="icono izquierda" src="{{ url('../resources/assets/img/pizzauser2.png') }}">Mis pizzas</a></li>

                    <li><a id="canjear" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda fas fa-exchange-alt"></i></i>Cupones</a></li>

                    <li id="config"><a id="config" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda fas fa-edit"></i>Configuración<i id="configicon" class="icono derecha fas fa-chevron-down"></i></a>

                        <ul class="contenedor2">

                            <li><a id="nomegusta" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda far fa-thumbs-down"></i>No me gusta</a></li>

                            <li><a id="cambiardireccion" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda fas fa-thumbtack"></i></i>Cambiar dirección de envío</a></li>

                            <li><a id="cambiaremail" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda fas fa-undo"></i></i>Cambiar correo electrónico</a></li>

                            <li><a id="cambiarimagen" onclick="slideMove(this.id)" class="pointer"><i class="icono izquierda fas fa-camera"></i></i></i>Cambiar foto de perfil</a></li>
                        </ul>

                    <li>
                        <form id="myform" action="{{route('logout')}}" method="POST">
                            {{ csrf_field() }}
                            <a href="javascript: submitform()"><i class="icono izquierda fas fa-sign-out-alt"></i>Cerrar sesión</a>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>