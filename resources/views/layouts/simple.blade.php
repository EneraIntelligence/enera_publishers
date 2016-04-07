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

    {{--<link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">--}}
    <link rel="icon" type="image/png" href="{!! URL::asset('images/favicon.png') !!}" sizes="32x32">
    <title>Enera Publishers @yield('title')</title>
    @yield('head_scripts')

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- uikit -->
    {!! HTML::style('bower_components/kendo-ui/styles/kendo.common-material.min.css') !!}
    {!! HTML::style('bower_components/kendo-ui/styles/kendo.material.min.css') !!}
    {!! HTML::style('bower_components/uikit/css/uikit.almost-flat.min.css') !!}
            <!-- flag icons -->
    {!! HTML::style('assets/icons/flags/flags.min.css') !!}
            <!-- altair admin -->
    {!! HTML::style('assets/css/main.min.css') !!}
    {{--loader--}}
    {!! HTML::style('assets/css/loader.css') !!}
            <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    {!! HTML::script('bower_components/matchMedia/matchMedia.js') !!}
    {!! HTML::script('bower_components/matchMedia/matchMedia.addListener.js') !!}
    <![endif]-->
    <!-- c3 charts -->
    {!! HTML::style('bower_components/c3js-chart/c3.min.css') !!}
    @yield('style')
    <style>
        .uk-dropdown .uk-dropdown-width-3 .uk-dropdown-active .uk-dropdown-shown .uk-dropdown-bottom {
            top: 100px;
            min-width: 600px;
            left: 0px;
        }
    </style>

</head>
<body class="sidebar_main_swipe">

<div id="loader" class="fullscreenTop"
     style="position: fixed;
           left: 0px; right: 0px;
           top: 0px; bottom: 0px;
           background-color: white;
           z-index: 99;">

    <div style="position: relative; width: 100%; height: 100%;">
        <div id="inner_loader"
             style="position: absolute;  top: 50%;
                 left: 50%;  transform: translate(-50%, -50%);">

            <div class="cssload-loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>

        </div>
    </div>
</div>


            <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                <!-- main sidebar switch -->
                {{--OLD ID sidebar_main_toggle--}}
                <a href="{{ route("home") }}" id="" class="sSwitch sSwitch_left ">
                    <img src="{!! URL::asset('images/icons/Logo Enera Blanco-01.png') !!}" alt="Enera"
                         style="top: -10px; left: 15px; position: relative;">
                </a>
                <!-- secondary sidebar switch -->
                {{--<a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">--}}
                {{--<span class="sSwitchIcon"></span>--}}
                {{--</a>--}}

                <div id="menu_top" class="uk-float-left ">
                    <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}"
                         style="position: fixed; top: 13px; margin-left: 10px;">
                        <a href="{{ route("home") }}" class="top_menu_toggle" style="color: #FFFFff;">
                            <img src="{!! URL::asset('images/icons/icon_publisher.png') !!}" alt="Enera"
                                 style="top: -0px; left: 0; position: relative;"> <span class="uk-hidden-small"
                                                                                        style="top: 2px; position: relative;">Publishers</span>
                        </a>


                    </div>
                </div>




            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>

            <form class="uk-form">
                <input type="text" class="header_main_search_input"/>
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i>
                </button>
            </form>
        </div>
    </header><!-- main header end -->

    <img style="display:none" src="{!! URL::asset('assets/img/spinners/spinner.gif') !!}" alt="">


    @yield('content')

    @if(!isset($hideTermsFooter) || !$hideTermsFooter)
    <footer class="uk-text-center">
        <a href="{!! URL::route('terms') !!}" target="_blank">Términos y condiciones</a>
    </footer>
    @endif

            <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function () {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    {!! HTML::script('assets/js/common.min.js') !!}
            <!-- uikit functions -->
    {!! HTML::script('assets/js/uikit_custom.js') !!}
            <!-- kendo functions -->
    {!! HTML::script('assets/js/kendoui_custom.min.js') !!}
            <!-- altair common functions/helpers -->
    {!! HTML::script('assets/js/altair_admin_common.min.js') !!}

    {!! HTML::script('bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.min.js') !!}
    {!! HTML::script('assets/js/pages/kendoui.min.js') !!}

            <!-- animation library -->
    {!! HTML::script('js/greensock/TweenLite.min.js') !!}
    {!! HTML::script('js/greensock/plugins/CSSPlugin.min.js') !!}
    {!! HTML::script('js/greensock/easing/EasePack.min.js') !!}


    <script>
        $(function () {
            // enable hires images
            altair_helpers.retina_images();
            // fastClick (touch devices)
            if (Modernizr.touch) {
                FastClick.attach(document.body);
            }
        });

    </script>

    <script>
        /*$(function () {
         $switcher_toggle.click(function (e) {
         e.preventDefault();
         $switcher.toggleClass('switcher_active');
         });

         $theme_switcher.children('li').click(function (e) {
         e.preventDefault();
         var $this = $(this),
         this_theme = $this.attr('data-app-theme');

         $theme_switcher.children('li').removeClass('active_theme');
         $(this).addClass('active_theme');
         $('body')
         .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g')
         .addClass(this_theme);

         if (this_theme == '') {
         localStorage.removeItem('altair_theme');
         } else {
         localStorage.setItem("altair_theme", this_theme);
         }

         });

         // hide style switcher
         $document.on('click keyup', function (e) {
         if ($switcher.hasClass('switcher_active')) {
         if (
         ( !$(e.target).closest($switcher).length )
         || ( e.keyCode == 27 )
         ) {
         $switcher.removeClass('switcher_active');
         }
         }
         });

         if (localStorage.getItem("altair_theme") !== null) {
         $theme_switcher.children('li[data-app-theme=' + localStorage.getItem("altair_theme") + ']').click();
         }
         });*/
    </script>

    <script>

        window.onload = function () {
            //remove loader
            TweenLite.to("#loader", .3, {
                "autoAlpha": 0, onComplete: function () {
                    $("#loader").css("display", "none");
                }
            });
        }
    </script>

    @yield('scripts')

    <script>
        $(document).ready(function () {
            var notification = '{!! session('n_type') !!}';
            if (notification) {
                //<i class="material-icons uk-icon-large">' + msg_session.status == 'danger' ? "&#xE002;" : "&#xE877;" + '</i>
                UIkit.notify('&nbsp;&nbsp;{{ session('n_msg') }}<span style="float:right"><i class="material-icons uk-icon-large">clear</i></span>', {
                    timeout: {!! Session::has('n_timeout')?session('n_timeout'):0 !!},
                    status: '{!! session('n_type') !!}'
                });
            }
        });
    </script>

</body>
</html>