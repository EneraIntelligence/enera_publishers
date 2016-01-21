<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    {{--<link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">--}}
    {{--<link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">--}}
    <link rel="icon" type="image/png" href="{!! URL::asset('images/favicon.png') !!}" sizes="32x32">

    <title>Enera - Permiso denegado</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    {{--<link rel="stylesheet" href="bower_components/uikit/css/uikit.almost-flat.min.css"/>--}}
    {!! HTML::style('bower_components/uikit/css/uikit.almost-flat.min.css') !!}

            <!-- altair admin error page -->
    {{--<link rel="stylesheet" href="assets/css/error_page.min.css" />--}}
    {!! HTML::style('assets/css/error_page.min.css') !!}

</head>
<body class="error_page">

<div class="error_page_header">
    <div class="uk-text-center">
        No tienes permiso para acceder a esta plataforma
    </div>
</div>

<p class="heading_b uk-text-center">Selecciona una plataforma:</p>


<div class="uk-grid">

        <div class="uk-width-1-3">
            <a href="http://publishers.enera-intelligence.mx">
                <img class="uk-align-center" src="{!! URL::asset('images/publisher.png') !!}" alt="">
            </a>
        </div>

        <div class="uk-width-1-3">
            <a href="http://networks.enera-intelligence.mx">
                <img class="uk-align-center" src="{!! URL::asset('images/logo-networks.png') !!}" alt="">
            </a>

        </div>

        <div class="uk-width-1-3">
            <a href="http://admins.enera-intelligence.mx">
                <img class="uk-align-center" src="{!! URL::asset('images/admins.png') !!}" alt="">
            </a>

        </div>

</div>

</body>
</html>