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

<div id="reset_pass" class="md-card uk-width-1-1 uk-margin-top uk-navbar-center" style="display:block;">
    <div class="uk-panel-box" style="padding: 20px 50px;">
        <div class="">
            <img class="uk-margin" src="{!! URL::asset('images/publisher.png') !!}" alt="">
        </div>
        <div>
            <h4 class="uk-text-center"> Recuperacion de contraseña </h4>
        </div>
        @if(session('cc')!=null)
            <div style="background-color: #7cb342; color: white">
                {{--{!! session('cc') !!}--}}
                se ha cambiado la contraseña
            </div>
        @endif
        {!! Form::open(['route'=>'auth.newpass', 'class'=>'uk-form-stacked', 'id'=>'form_validation']) !!}
        <div>
            <input name="u" type="hidden" value="{!! session('data.id') !!}">
        </div>
        <div>
            <input name="t" type="hidden" value="{!! session('data.token') !!}">
        </div>
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
                <div class="uk-form-row {!! $errors->get('password')? 'md-input-wrapper-danger md-input-focus':' ' !!}">
                    <label for="register_password">Contraseña </label>
                    <input class="md-input" type="password" id="register_password" name="password"
                           required data-parsley-trigger="change"
                           data-parsley-minlength="8" data-parsley-minlength-message="minimo 8 caracteres"
                           data-parsley-maxlength="16" data-parsley-maxlength-message="maximo 16 caracteres"
                           data-parsley-validation-threshold="10"
                           data-parsley-required-message="se requiere de una contraseña"
                           data-parsley-equalto="#register_password_repeat"
                           data-parsley-equalto-message="las contraseñas deben ser iguales"
                    />
                    @foreach($errors->get('reset_password') as $m)
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
                           data-parsley-required-message="confirma la contraseña"
                           data-parsley-equalto="#register_password"
                           data-parsley-equalto-message="esta contraseña no coincide con la otra. Deben ser iguales"
                    />
                    @foreach($errors->get('reset_password_repeat') as $m)
                        <div style="text-align: center; color: red;">{!! $m !!}</div>
                        <span class="md-input-bar"> </span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="uk-margin-medium-top">
            <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Cambiar contraseña</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

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


</body>
