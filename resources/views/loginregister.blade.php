@extends('main_layout')

@section('content')
    <div class="woodbg" style="padding: 150px;">
        <div class="container">
            <div class="row">
                <div class="card" style="margin: 0 auto; min-width: 400px">
                    <div class="card-header" style="padding: 0px;">
                        <ul class="nav nav-tabs">
                            <li id="head-login" class="nav-item active">
                                <a id="login" href="javascript:" onclick="slideMove(this.id)" class="nav-link" href="#" style="padding: 20px; color: black">INICIAR SESIÓN</a>
                            </li>
                            <li id="head-register" class="nav-item">
                                <a id="register" href="javascript:" onclick="slideMove(this.id)" class="nav-link" href="#" style="padding: 20px;color: black">SOY NUEVO</a>
                            </li>
                        </ul>
                    </div>

                    @include('partial.flash')

                    @if(session('user_id'))
                        <div id="reseting-password-card" style="width: 800px; padding: 15px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" method="POST" action="{{ route('password.newdata') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name" class="control-label">Introduce tu nueva contraseña:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="new-password" name="new-password" type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label">Repite tu nueva contraseña:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="new-password-repeat" name="new-password-repeat" type="password" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group hide">
                                            <div class="col">
                                                <input id="user-id" name="user-id" value="{{ session('user_id') }}" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Cambiar contraseña
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="login-card" style="padding: 15px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="control-label">Correo electrónico:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="email-login" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                     </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="control-label">Contraseña:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="password-login" type="password" class="form-control" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> ¡Recuérdame!
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Iniciar Sesión
                                            </button>

                                            <a id="reset" class="btn btn-link" href="javascript:" onclick="slideMove(this.id)">
                                                Has olvidado tu contraseña?
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="register-card" class="hide" style="padding: 15px;">
                            <div class="row">
                                <div class="container">
                                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name" class="control-label">Nombre:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="name" type="text" class="form-control" name="name" pattern="^[A-Z]{1}[a-z]*" value="{{ old('name') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="surnames" class="control-label">Apellidos:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="surnames" type="text" class="form-control" name="surnames" pattern="([a-zA-Z\-]+){3,}\s+([a-zA-Z\-]+){3,}" value="{{ old('surnames') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="control-label">Correo electrónico:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label">Número de teléfono:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="phone" class="form-control" type="phone" name="phone" pattern="^[6|7|9][0-9]{8}$" value="{{ old('phone') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="control-label">Contraseña:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="password" type="password" class="form-control" name="password" >
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="password-confirm" class="control-label">Confirmar contraseña:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="recievePromotions"> ¡Avisarme de nuevas promociones y eventos!
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Registrar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="reset-card" class="hide" style="padding: 15px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" method="POST" action="{{ route('password.reset') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name" class="control-label">Correo electrónico:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="email-reset" name="email-reset" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Enviar correo de recuperación
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('../resources/assets/js/loginregistertransition.js') }}"></script>


    <style>

        .form-group {
            padding: 0 10px!important;
        }
    </style>

    <script>
        var windowSize = $(window).height();
        var divHeight = $(".woodbg").height();

        $(document).ready(function(){


            //$(".myfooter").addClass('absolute-test');
            $(".woodbg").css({
                //'height': (windowSize - 70) + 'px'
                'padding-top': parseFloat((windowSize / 4)),
                'padding-bottom': parseFloat(windowSize - divHeight)
            });

        });

    </script>

@stop
