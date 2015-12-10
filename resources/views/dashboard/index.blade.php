@extends('layouts.main')

@section('head_scripts')
    <style type="text/css">
        body {
            scrollbar-arrow-color: #000066;
            scrollbar-base-color: #000033;
            scrollbar-dark-shadow-color: #336699;
            scrollbar-track-color: #336699;
            scrollbar-face-color: #5e9ace;
            scrollbar-shadow-color: #DDDDDD;
            scrollbar-highlight-color: #CCCCCC;
        }

        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background-color: #eaeaea;
            border-left: 1px solid #ccc;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #ccc;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #aaa;
        }
        #minimenu .minimenu:first-child{margin-top: 2px}
        .minimenu{height:123px; box-sizing:border-box; line-height:115px; margin-top:15px}
        .minimenu div{height: 100%;}
        .minimenu div:first-child{text-align:center}
        .minimenu div i{font-size:80px; margin-top:23px;}
        .minimenu div:last-child{text-align: left}
        .minimenu h5{margin:30px 0px 0px 0px; }
        .minimenu span{margin:30px 0px 0px 0px; }

    </style>
@endsection

@section('content')

    <div id="page_content">
        <div id="page_content_inner">
            {{--<h3 class="heading_b uk-margin-bottom">Blank Page</h3>--}}
            <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                <div class="uk-width-large-1-4">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <img src="{!! URL::asset('images/Enera_logo_400x130.png') !!}">
                        </div>
                    </div>
                    <div class="md-card ">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-small-right"><span><i class="md-48 material-icons md-color-blue-600 uk-icon-large">phone_android</i></span></div>
                            <span class="uk-text-muted uk-text-small">Dispositivos </span>
                            <h2 class="uk-margin-remove"><span id="myTargetElement" class="countUpMe">0</span></h2>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-small-right"><span><i class="md-48 material-icons md-color-red-A700 uk-icon-large">pin_drop</i></span> </div>
                            <span class="uk-text-muted uk-text-small">Sitios </span>
                            <h2 class="uk-margin-remove"><span id="myTargetElement2" class="countUpMe">0</span></h2>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-small-right"><span><i class="md-48 material-icons md-color-deep-orange-500 uk-icon-large">insert_invitation</i></span></div>
                            <span class="uk-text-muted uk-text-small">Campañas </span>
                            <h2 class="uk-margin-remove"><span id="myTargetElement3" class="countUpMe">0</span></h2>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-3-4">
                    <div class="md-card" style="">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Noticias recientes facebook
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <div id="noticias" class="uk-width-1-1" style=" overflow-y: scroll;">
                                <div class="uk-width-medium-1-2 uk-float-left">
                                    <div class="uk-width-medium-1-1 uk-comment-body" style="height: 100px">
                                        <span> <i class="md-36 material-icons">chrome_reader_mode</i>El ‪#‎WiFi‬ también puede ser un medio publicitario, de hecho es uno de los medios
                                            publicitarios más efectivos actualmente en otros países.
                                            Enera Intelligence
                                            Contáctanos en:
                                            <a href="mailto:contacto@enera.mx">contacto@enera.mx</a>
                                        </span>
                                    </div>
                                    <div class="uk-width-medium-1-1 uk-float-right uk-comment-body ">
                                        <img src="{!! URL::asset('images/news_image.png') !!}" alt="">
                                    </div>
                                </div>
                                {{------------- divicion segunda colubna uk-panel-space---------------}}
                                <div class="uk-width-medium-1-2 uk-float-right">
                                    <div class="uk-width-medium-1-1  uk-comment-body" style="height: 100px"> {{-- uk-panel-box --}}
                                        <i class="md-36 material-icons">chrome_reader_mode</i>
                                    <span>‪#‎México‬ es líder regional en tráfico en internet móvil así como inversión
                                        publicitaria móvil. Enera Intelligence</span>
                                    </div>
                                    <div class="uk-width-medium-1-1 uk-float-right uk-comment-body">
                                        <img src="{!! URL::asset('images/news_image_2.jpg') !!}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-6-6">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <div class="uk-grid uk-grid-divider">
                                <div class="uk-width-2-3">
                                    <div id="chart"></div>
                                </div>
                                <div class="uk-width-1-3 ">
                                    <h2>Porcentajes de dispositivos</h2>
                                    <ul class="md-list md-list-addon">
                                        <li>
                                            <div class="md-list-addon-element">
                                                <img class="md-user-image md-list-addon-avatar dense-image dense-loading"
                                                     src="{{asset('images/icons/preview_01.jpg')}}" alt="">
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Android</span>
                                                <span class="uk-text-small uk-text-muted">{{$osStats['android']}} Android vistos en la Red Enera</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-addon-element">
                                                <img class="md-user-image md-list-addon-avatar dense-image dense-loading"
                                                     src="{{asset('images/icons/preview_04.jpg')}}" alt="">
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Iphone</span>
                                                <span class="uk-text-small uk-text-muted">{{$osStats['mac']}} Iphones vistos en la Red Enera</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-addon-element">
                                                <img class="md-user-image md-list-addon-avatar dense-image dense-loading"
                                                     src="{{asset('images/icons/preview_03.jpg')}}" alt="">
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Windows Phone</span>
                                                <span class="uk-text-small uk-text-muted">{{$osStats['windows']}} Windows Phones  vistos en la Red Enera</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-addon-element">
                                                <img class="md-user-image md-list-addon-avatar dense-image dense-loading"
                                                     src="{{asset('images/icons/preview_02.jpg')}}" alt="">
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Otros</span>
                                                <span class="uk-text-small uk-text-muted">{{$osStats['otro']}} Dipositivos vistos de otras marcas </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop

@section('scripts')
    {!! HTML::script('bower_components/countUp.js/countUp.js') !!}

    <script>
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '',
            suffix: ''
        };
        var demo = new CountUp("myTargetElement", 0,{{ $devices }} , 0, 2.5, options);
        demo.start();
        var demo = new CountUp("myTargetElement2", 0,{!! $sitios !!}, 0, 2.5, options);
        demo.start();
        var demo = new CountUp("myTargetElement3", 0, {{ $campañas }}, 0, 2.5, options);
        demo.start();

        var chart = c3.generate({
            data: {
                // iris data from R
                columns: [
                    @foreach($osStats as $k=>$os)
                    {!! '["'.$k.'",'.$os.' ],'  !!}
                    @endforeach
                ],
                type: 'pie',
            }
        });

    </script>
@stop