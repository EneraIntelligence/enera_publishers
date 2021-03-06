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


            <!-- uikit -->
    {!! HTML::style('bower_components/kendo-ui-core/styles/kendo.common-material.min.css') !!}
    {!! HTML::style('bower_components/kendo-ui-core/styles/kendo.material.min.css') !!}
    {!! HTML::style('bower_components/uikit/css/uikit.almost-flat.min.css') !!}

            <!-- flag icons -->
    {!! HTML::style('assets/icons/flags/flags.min.css') !!}

            <!-- altair admin -->
    {!! HTML::style('assets/css/main.min.css') !!}

            <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
    {!! HTML::script('bower_components/matchMedia/matchMedia.js') !!}
    {!! HTML::script('bower_components/matchMedia/matchMedia.addListener.js') !!}
    <![endif]-->

    <!-- c3 charts -->
    {!! HTML::style('bower_components/c3js-chart/c3.min.css') !!}


</head>
<body class="sidebar_main_swipe">
<!-- Create campaign button -->
@if(!isset($noCreateBtn))

    <div class="md-fab-wrapper .user_heading .md-fab">
        <a class="md-fab md-fab-danger" href="#" id="note_add" onclick="new_campaign.prompt()">
            <i class="material-icons"></i>
        </a>
    </div>

    @endif


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
                    <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                        <a href="#" class="top_menu_toggle">
                            <i class="material-icons md-24">&#xE8F0;</i> <span class="uk-hidden-small">Publishers</span>
                        </a>

                        <div class="uk-dropdown uk-dropdown-width-3">
                            <div class="uk-grid uk-dropdown-grid" data-uk-grid-margin>
                                <div class="uk-width-2-3">
                                    <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-top uk-margin-bottom uk-text-center"
                                         data-uk-grid-margin>
                                        <a href="{!! route('campaigns::index') !!}">
                                            {{--<i class="material-icons md-36">&#xE158;</i>--}}
                                            <i class="material-icons md-36 md-color-light-blue-A700">event</i>
                                            <span class="uk-text-muted uk-display-block">Campañas</span>
                                        </a>
                                        {{--<a href="{!! route('reports::index') !!}">--}}
                                        <a href="#">
                                            {{--<i class="material-icons md-36 md-color-red-600">&#xE0B9;</i>--}}
                                            <i class="material-icons md-36 md-color-light-blue-A700">assessment</i>
                                            <span class="uk-text-muted uk-display-block">Reportes</span>
                                        </a>
                                        <a href="{!! route('budget::index') !!}">
                                            {{--<i class="material-icons md-36">&#xE53E;</i>--}}
                                            <i class="material-icons md-36 md-color-light-blue-A700">attach_money</i>
                                            <span class="uk-text-muted uk-display-block">Presupuesto</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="uk-width-1-3 uk-hidden-small">
                                    <ul class="uk-nav uk-nav-dropdown uk-panel">
                                        <li class="uk-nav-header">Recientes</li>
                                        @foreach($user->route as $preview)
                                            <?php $last = explode('/', $preview) ?>
                                            <li><a href="{!! route($last[1]) !!}">{{$last[0]}}</a></li>
                                        @endforeach
                                        {{--<li><a href="#">Buttons</a></li>--}}
                                        {{--<li><a href="#">Notifications</a></li>--}}
                                        {{--<li><a href="#">Sortable</a></li>--}}
                                        {{--<li><a href="#">Tabs</a></li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="main_search_btn" class="user_action_icon"><i
                                        class="material-icons md-20 md-light">&#xE8B6;</i></a></li>
                        <li data-uk-dropdown="{mode:'click'}">
                            <a href="#" class="user_action_icon"><i class="material-icons md-20 md-light">
                                    &#xE7F4;</i><span
                                        class="uk-badge">99</span></a>

                            <div class="uk-dropdown uk-dropdown-xlarge uk-dropdown-flip">
                                <div class="md-card-content">
                                    <ul class="uk-tab uk-tab-grid"
                                        data-uk-tab="{connect:'#header_alerts',animation:'slide-horizontal'}">
                                        <li class="uk-width-1-2 uk-active"><a href="#"
                                                                              class="js-uk-prevent uk-text-small">Mensajes
                                                (12)</a></li>
                                        <li class="uk-width-1-2"><a href="#" class="js-uk-prevent uk-text-small">Alertas
                                                (4)</a></li>
                                    </ul>
                                    <ul id="header_alerts" class="uk-switcher uk-margin">
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-cyan">se</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                    <span class="md-list-heading"><a href="pages_mailbox.html">Nobis
                                                            ipsum.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Ratione dolore nisi ut quis expedita fugiat dolor porro.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar"
                                                             src="assets/img/avatars/avatar_07_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                    <span class="md-list-heading"><a href="pages_mailbox.html">Quia
                                                            praesentium.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Aliquid harum mollitia in repudiandae officiis assumenda rem.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <span class="md-user-letters md-bg-light-green">tg</span>
                                                    </div>
                                                    <div class="md-list-content">
                                                    <span class="md-list-heading"><a href="pages_mailbox.html">Et
                                                            accusamus.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Enim ex ipsam odio id.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar"
                                                             src="assets/img/avatars/avatar_02_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                    <span class="md-list-heading"><a href="pages_mailbox.html">Voluptas
                                                            dignissimos.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Ut rerum fugit doloribus blanditiis culpa impedit facilis voluptatem sed est eius.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <img class="md-user-image md-list-addon-avatar"
                                                             src="assets/img/avatars/avatar_09_tn.png" alt=""/>
                                                    </div>
                                                    <div class="md-list-content">
                                                    <span class="md-list-heading"><a href="pages_mailbox.html">Inventore
                                                            fuga molestias.</a></span>
                                                        <span class="uk-text-small uk-text-muted">Sit libero officia nulla saepe sed incidunt alias est earum aperiam.</span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="uk-text-center uk-margin-top uk-margin-small-bottom">
                                                <a href="page_mailbox.html"
                                                   class="md-btn md-btn-flat md-btn-flat-primary js-uk-prevent">Show
                                                    All</a>
                                            </div>
                                        </li>
                                        <li>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-warning">
                                                            &#xE8B2;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Quas itaque quas.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Asperiores odio impedit eius voluptatem est.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-success">
                                                            &#xE88F;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Tenetur non blanditiis.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Tempora explicabo consequatur dignissimos pariatur.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-danger">
                                                            &#xE001;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Omnis sapiente.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Ut voluptatem dolorem corporis adipisci similique minima.</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons uk-text-primary">
                                                            &#xE8FD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">Modi et asperiores.</span>
                                                        <span class="uk-text-small uk-text-muted uk-text-truncate">Corporis qui aut maiores eveniet ipsum officia blanditiis.</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li data-uk-dropdown="{mode:'click'}">
                            <a href="#" class="user_action_image">
                                {{--<img class="md-user-image" src="{!!URL::asset('images/avatar/'. $user->image )  !!}" alt="{{$user->name['first']}}"style="border-radius: 50%; height: 35px; width: 35px;"/>--}}
                                <i class="material-icons md-36" style="color: white;">account_circle</i>
                            </a>

                            <div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="{!! url('profile') !!}">Mi cuenta</a></li>
                                    <li><a href="#">Ajustes</a></li>
                                    <li><a href="{!! URL::route('auth.logout') !!}">Salir</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
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

    @yield('content')


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


    {!! HTML::script('bower_components/d3/d3.min.js') !!}
    {!! HTML::script('bower_components/c3js-chart/c3.min.js') !!}


    {!! HTML::script('js/ajax/new_campaign.js') !!}
    {!! HTML::script('bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.min.js') !!}
    {!! HTML::script('assets/js/pages/kendoui.min.js') !!}

    <script>
        new_campaign.base_url = "{!! URL::to('/') !!}";
        $(function () {
            $("body").on("click", ".uk-button[data-message]", function () {
                UIkit.notify($(this).data());
            });
        });
    </script>

    @yield('scripts')

</body>
</html>