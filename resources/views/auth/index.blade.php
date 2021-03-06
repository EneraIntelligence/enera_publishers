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
    <div class="md-card uk-width-large-3-10 uk-width-medium-6-10 uk-padding-remove" id="">
        <div class="md-card-content large-padding" id="login_form">
            <div class="login_heading">
                <div style=display:inline-block;text-align:center;">
                    <img src="images/publisher.png" alt="">
                </div>
                {!! session('reset_msg2') !!}
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
            {!! Form::open(['route'=>'auth.login', 'class'=>'uk-form-stacked spinnerForm', 'id'=>'form_validation']) !!}
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
                <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">
                    Entrar
                </button>
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
        <div class="md-card-content large-padding uk-position-relative" id="login_help" style="display: none">
            <button type="button"
                    class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
            <h2 class="heading_b uk-text-success">No puedes iniciar sesión?</h2>

            <p>Aquí está la información para que usted vuelva a su cuenta tan pronto como sea posible.</p>

            <p>En primer lugar, trate con lo más sencillo: si usted recuerda su contraseña, pero no funciona, asegúrese
                de que Bloq Mayús está apagado y que su nombre de usuario está escrito correctamente, y vuelva a
                intentarlo.</p>

            <p>Si la contraseña sigue sin funcionar, es hora de <a href="#" id="password_reset_show">restablecer la
                    contraseña</a>.</p>
        </div>
        <div class="md-card-content large-padding" id="login_password_reset" style="display: none;height: 315px">
            <button type="button"
                    class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
            <h2 class="heading_a uk-margin-large-bottom" style="margin-bottom: 0px!important;">Restablecer la
                contraseña</h2>
            <div class="md-card-content large-padding" id="reset_msg" style="display: block">
                {!! session('reset_msg') !!} <strong></strong>
            </div>
            {!! Form::open(['route'=>'auth.restore', 'class'=>'uk-form-stacked', 'id'=>'restore']) !!}
            @if( Session::has('errors') )
                <div style="text-align: center; color: red;">
                    hubo un error al verificar el correo
                </div>
            @endif
            <div class="uk-form-row">
                <label for="reset_password_email">Email</label>
                <input class="md-input" type="text" id="reset_password_email" name="reset_password_email"/>
                @foreach($errors->get('reset_password_email') as $m)
                    <div style="text-align: center; color: red;">{!! $m !!}</div>
                @endforeach
            </div>
            <div class="uk-margin-medium-top">
                <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Restablecer</button>
            </div>
            {!! Form::close() !!}
        </div>
        {{--style="display: none;"--}}
        <div class="md-card-content large-padding" id="register_form" style="display: none;">

            <button type="button"
                    class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
            <div class="login_heading">
                <div style="display:inline-block;text-align:center;">
                    <img src="images/publisher.png" alt="">
                </div>
            </div>
            <h5 style="text-align: center; color: deepskyblue">Crea tu cuenta y comienza a publicar anuncios hoy. Recibe
                $500 para tu primer campaña</h5>
            {!! Form::open(['route'=>'auth.signUp', 'class'=>'uk-form-stacked', 'id'=>'form_validation2']) !!}
            @if( Session::has('errors') )
                <div style="text-align: center; color: red;">
                    hubo un error al registrarte verifica los campos
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
                />
                @foreach($errors->get('password') as $m)
                    <div style="text-align: center; color: red;">{!! $m !!}</div>
                    <span id="Rerror" class="md-input-bar" style="background: red"> </span>
                @endforeach
            </div>
            <div class="uk-form-row {!! $errors->get('cupon')? 'md-input-wrapper-danger md-input-focus':' '!!}">
                <label for="register_password_repeat">Cupón (Opcional)</label>
                <input class="md-input" type="password" id="register_password_repeat" name="confirma_contraseña"
                       data-parsley-type="alphanum"/>
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

    <div class="md-card uk-width-4-10 uk-visible-large login_right_card uk-margin-remove uk-padding-remove uk-vertical-align">
        <div class="uk-vertical-align-bottom">
            <img class="img_login_right" src="images/publisher_img.png" alt="">
        </div>
    </div>

</div>
<div id="create" class="uk-margin-top uk-text-center">
    <a href="{!! URL::route('auth.register') !!}" class="white_link">Crear Cuenta</a>
</div>


<div id="registro" class="md-card uk-width-1-1 uk-margin-top uk-navbar-center" style="display:none;">
    <div class="uk-panel-box">
        <div class="">
            <img class="uk-margin"
                 {{--src="http://2.bp.blogspot.com/-j-KIUPKyqqY/U9JXzPTmf3I/AAAAAAAAAIw/u6SSyqfPDhU/s1600/bienvenido1.png"--}}
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
{!! HTML::script('bower_components/parsleyjs/dist/parsley.min.js') !!}
{!! HTML::script('bower_components/parsleyjs/src/i18n/es.js') !!}
{!! HTML::script('assets/js/pages/forms_validation.min.js') !!}

<script>
    $(document).ready(function ()
    {
        var restore = {!! $errors->get('reset_password_email')!=null? true : 'null'  !!}
        //        console.log(restore);
        if (restore)
        {
//            console.log('true');
            $("#login_password_reset").show();
            $("#login_form").hide();
            $("#create").hide();
        }

        var reset_f = '{!! session('reset_msg') !!}';
        if (reset_f)
        {
//            console.log('true');
            $("#login_password_reset").show();
            $("#login_form").hide();
            $("#create").hide();
        }

    });

    //        llamada al parsley
    $('#form_validation2').parsley();
</script>


{!! HTML::script('js/spinnerbuttons/spin.min.js') !!}
{!! HTML::script('js/spinnerbuttons/spinnerButton.js') !!}


</body>
</html>