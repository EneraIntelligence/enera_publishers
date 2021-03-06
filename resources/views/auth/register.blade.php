<!doctype html>
<!--[if lte IE 9]>
<html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    {{--<link rel="icon" type="image/png" href="{!! URL::asset('assets/img/favicon-16x16.png') !!}" sizes="16x16">--}}
    <link rel="icon" type="image/png" href="{!! URL::asset('images/favicon.png') !!}" sizes="32x32">

    <title>Enera Publishers</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
    <!-- uikit -->
    {!! HTML::style('bower_components/uikit/css/uikit.almost-flat.min.css') !!}

            <!-- altair admin login page -->
    {!! HTML::style('assets/css/login_page.min.css') !!}
    {!! HTML::style('assets/css/login_enera.css') !!}
    {!! HTML::style('assets/css/main.min.css') !!}
    <style>
        span {
            list-style: none;
        }

        ul {
            list-style: none;
        }
    </style>
</head>
<body class="login_page login_body">

<div class="uk-grid uk-container-center" id="login_card">
    <div class="uk-width-2-10" id="">
    </div>
    <div class="md-card-content large-padding" style="display: none" id="login_form">
        <div class="login_heading">
            <div style=display:inline-block;text-align:center;">
                <img src="images/publisher.png" alt="">
            </div>

            @if(session('data')=='active')
                <div class="uk-alert uk-alert-success" style="padding-right:10px">
                    <a href="#" class="uk-alert-close "></a>
                    Tu cuenta ha sido activada.
                </div>
            @elseif(session('data')=='invalido')
                <div class="uk-alert uk-alert-danger" style="padding-right:10px">
                    <span class="uk-margin">Codigo invalido.</span>
                </div>
            @endif
        </div>
        {!! Form::open(['route'=>'auth.login', 'class'=>'uk-form-stacked', 'id'=>'form_validation']) !!}
        @if( Session::has('error') )
            <div style="text-align: center; color: red; margin-bottom: 10px;">{!! session('error') !!}</div>
        @endif

        @foreach($errors->get('email') as $m)
            <div style="text-align: center; color: red;">{!! $m !!}</div>
        @endforeach

        @foreach($errors->get('password') as $m)
            <div style="text-align: center; color: red;">{!! $m !!}</div>
        @endforeach

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                <div class="parsley-row">
                    <label for="email">Email <span class="req"></span></label>
                    <input type="email" name="email" data-parsley-trigger="change" required class="md-input"/>
                    <div class="parsley-errors-list filled" id="parsley-id-6">
                        @foreach($errors->get('email') as $m)
                            <span class="parsley-type">{!! $m !!}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                <div class="parsley-row uk-margin-top">
                    <div class="md-input-wrapper">
                        <label for="login_password">Contraseña</label>
                        <input type="password" id="login_password" name="password" required
                               data-parsley-trigger="change" class="md-input"
                               data-parsley-minlength="8" data-parsley-minlength-message="minimo 8 caracteres"
                               data-parsley-maxlength="16" data-parsley-maxlength-message="maximo 16 caracteres"
                               data-parsley-validation-threshold="10" data-parsley-id="2"
                               data-parsley-required-message="No olvides tu contraseña"
                        />
                        <span class="md-input-bar"> </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin-medium-top">
            <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Entrar</button>
        </div>
        <div class="uk-margin-top">
            <a href="#" id="login_help_show" class="uk-float-right">Necesitas ayuda?</a>
                    <span class="icheck-inline">
                    <input type="checkbox" name="login_page_stay_signed" id="login_page_stay_signed" data-md-icheck/>
                    <label for="login_page_stay_signed" class="inline-label">Mantener sesión</label>
                </span>
        </div>

        {!! Form::close() !!}
    </div>
    <div class="md-card uk-width-4-10 uk-visible-large login_right_card uk-margin-remove uk-padding-remove uk-vertical-align">
        <div class="uk-vertical-align-bottom">
            <h2 style="text-align: justify; margin: 50px 35px;">
                "Llega a miles de personas mientras navegan por Internet en todo México”.
            </h2>
            <p style="text-align: left; margin: 50px 35px; line-height: 200%">
                <b>Enera Publishers</b> es una plataforma para que muestres anuncios, hagas encuestas e incrementes
                tráfico de
                usuarios. Cuando los usuarios se conecten en nuestros Hotspots ubicados en centros comerciales,
                restaurantes, hoteles y espacios públicos, verán tu anuncio antes de comenzar a usar el Internet.
            </p>
            <img class="img_login_right" src="images/publishers_register.png" alt="">
        </div>
    </div>

    <div class="md-card uk-width-large-3-10 uk-width-medium-6-10 uk-padding-remove uk-margin-remove" id="">
        <div class="md-card-content large-padding" id="register_form">
            <div class="login_heading">
                <div style="display:inline-block;text-align:center;">
                    <img src="images/publisher.png" alt="">
                </div>
            </div>
            <h5 style="text-align: center; color: deepskyblue">Crea tu cuenta y comienza a publicar anuncios hoy</h5>
            {!! Form::open(['route'=>'auth.signUp', 'class'=>'uk-form-stacked', 'id'=>'form_validation2']) !!}
            @if( Session::has('errors') )
                <div style="text-align: center; color: red;">hubo un {!! $registro = 'error'  !!} al registrarte
                    verifica los campos
                </div>
                @foreach($errors->get('registro') as $m)
                    <div style="text-align: center; color: red;">{!! $m !!}</div>
                @endforeach
            @endif
            <div class="uk-form-row {!!  $errors->get('nombre')? 'md-input-wrapper-danger md-input-focus':' ' !!}">
                <label for="register_name">Nombre </label>
                <input class="md-input" type="text" id="register_name" name="nombre"
                       required data-parsley-trigger="change"
                       data-parsley-required-message="nombre"
                       data-parsley-maxlength="16" data-parsley-maxlength-message="maximo 16 caracteres"
                       data-parsley-pattern="^([a-zA-Z ñáéíóú]{2,60})$"
                       data-parsley-pattern-message="solo acepta letras y espacios"
                />
                @foreach($errors->get('nombre') as $m)
                    <div style="text-align: center; color: red;">{!! $m !!}</div>
                @endforeach
                <span class="md-input-bar"> </span>
            </div>
            <div class="uk-form-row {!! $errors->get('apellido')? 'md-input-wrapper-danger md-input-focus':' ' !!}">
                <label for="register_apellido">Apellido </label>
                <input class="md-input" type="text" id="register_apellido" name="apellido"
                       required data-parsley-trigger="change"
                       data-parsley-maxlength="16" data-parsley-maxlength-message="maximo 16 caracteres"
                       data-parsley-required-message="apellido"
                       data-parsley-pattern="^([a-zA-Z ñáéíóú]{2,60})$"
                       data-parsley-pattern-message="solo acepta letras y espacios"
                />
                @foreach($errors->get('apellido') as $m)
                    <div style="text-align: center; color: red;">{{ $m }}</div>
                @endforeach
                <span class="md-input-bar"> </span>
            </div>
            <div class="uk-form-row {!!  $errors->get('email')? 'md-input-wrapper-danger md-input-focus':' ' !!}">
                <label for="register_email">E-mail </label>
                <input class="md-input" data-parsley-type="email" id="register_email" name="email" required
                       data-parsley-trigger="change" class="md-input"
                       data-parsley-type-message="ingresa un correo valido"
                       data-parsley-required-message="Ingresa tu correo"/>
                @foreach($errors->get('email') as $m)
                    <div style="text-align: center; color: red;">{!! $m !!}</div>
                    <span id="Rerror" class="md-input-bar"> </span>
                @endforeach
            </div>
            <div class="uk-form-row {!! $errors->get('password')? 'md-input-wrapper-danger md-input-focus':' ' !!}">
                <label for="register_password">Contraseña </label>
                <input class="md-input" type="password" id="register_password" name="password" required
                       data-parsley-trigger="change"
                       data-parsley-minlength="8" data-parsley-minlength-message="minimo 8 caracteres"
                       data-parsley-maxlength="16" data-parsley-maxlength-message="maximo 16 caracteres"
                       data-parsley-validation-threshold="10"
                       data-parsley-required-message="se requiere de una contraseña"
                       data-parsley-equalto="#register_password_repeat"
                       data-parsley-equalto-message="las contraseñas deben ser iguales"
                />
                @foreach($errors->get('password') as $m)
                    <div style="text-align: center; color: red;">{!! $m !!}</div>
                    <span id="Rerror" class="md-input-bar" style="background: red"> </span>
                @endforeach
            </div>
            <div class="uk-form-row {!! $errors->get('password')? 'md-input-wrapper-danger md-input-focus':' '!!}">
                <label for="register_password_repeat">Confirmar Contraseña</label>
                <input class="md-input" type="password" id="register_password_repeat" name="confirma_contraseña"
                       required data-parsley-trigger="change"
                       data-parsley-minlength="8" data-parsley-minlength-message="minimo 8 caracteres"
                       data-parsley-maxlength="16" data-parsley-maxlength-message="maximo 16 caracteres"
                       data-parsley-validation-threshold="10"
                       data-parsley-required-message="se requiere de una contraseña"
                       data-parsley-equalto="#register_password"
                       data-parsley-equalto-message="esta contraseña no coincide con la otra. Deben ser iguales"
                />
                @foreach($errors->get('password') as $m)
                    <div style="text-align: center; color: red;">{!! $m !!}</div>
                    <span class="md-input-bar"> </span>
                @endforeach
            </div>
            <div class="uk-form-row {!! $errors->get('cupon')? 'md-input-wrapper-danger md-input-focus':' '!!}">
                <label for="cupon">Cupón (Opcional)</label>
                <input class="md-input" type="text" id="cupon" name="cupon no valido"
                       data-parsley-type="alphanum" value="{!! Input::get('code') !!}"/>
                @foreach($errors->get('password') as $m)
                    <div style="text-align: center; color: red;">{!! $m !!}</div>
                    <span class="md-input-bar"> </span>
                @endforeach
            </div>
            <div class="uk-margin-medium-top">
                <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Registrarse</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div id="create" class="uk-margin-top uk-text-center">
    <a href="{!! URL::route('auth.index') !!}" class="white_link">Login</a>
</div>

<div id="registro" class="md-card uk-width-1-1 uk-margin-top uk-navbar-center" style="display:none;">
    <div class="uk-panel-box">
        <div class="">
            <img class="uk-margin"
                 src="{!! URL::asset('images/confirmRegister.png') !!}"
                 alt="">
        </div>
        <div>
            <h1 class="uk-text-center"> Bienvenido </h1>
            <h3>En breve recibiras un email para completar el proceso de registro</h3>
            <h3><a href="{!! route('auth.login') !!}">Ir a Login</a></h3>
        </div>
    </div>
</div>

<!-- common functions -->
{!! HTML::script('assets/js/common.min.js') !!}
        <!-- altair core functions -->
{!! HTML::script('assets/js/altair_admin_common.min.js') !!}

<script>
    // load parsley config (altair_admin_common.js)
    altair_forms.parsley_validation_config();
</script>
<!-- altair login page functions -->
{!! HTML::script('assets/js/pages/login.min.js') !!}
{!! HTML::script('bower_components/parsleyjs/dist/parsley.js') !!}
{!! HTML::script('bower_components/parsleyjs/src/i18n/es.js') !!}
{!! HTML::script('assets/js/pages/forms_validation.js') !!}

<script>
    //        llamada al parsley
    $('#form_validation2').parsley();
    var registro = '{!!  session('success') !!}';
    console.log(registro);
    if (registro) {
        console.log('true');
        $("#registro").show();
        $("#login_card").hide();
        $("#create").hide();
    } else {
        console.log('no hay nada');
    }
</script>


</body>
</html>