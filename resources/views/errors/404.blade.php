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

    <title> 404 error</title>

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
        <div class="uk-width-8-10 uk-container-center">
            404!
        </div>
    </div>
    <div class="error_page_content">
        <div class="uk-width-8-10 uk-container-center">
            <p class="heading_b">Page not found</p>
            <p class="uk-text-large">
                The requested URL <span class="uk-text-muted">/some_url</span> was not found on this server.
            </p>
            <a href="#" onclick="history.go(-1);return false;">Go back to previous page</a>
        </div>
    </div>
    <div class="md-card-content">
        <img src="{!! URL::asset('images/Enera_logo_400x130.png') !!}">
    </div>

</body>
</html>