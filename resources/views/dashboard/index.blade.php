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
        .minimenu{height:123px; box-sizing:border-box; line-height:115px;}
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
                        <div class="md-card-content" style="max-height: 400px">
                            <div class="minimenu">
                                <div class="uk-width-medium-1-3 uk-float-left"><i class="material-icons">phone_android</i></div>
                                <div class="uk-width-medium-2-3 uk-float-right">
                                    <h5 class="uk-text-left"> Dipositivos </h5>
                                    <h5 class="uk-text-left" id="myTargetElement">0</h5>
                                </div>
                            </div>
                            <div class="minimenu">
                                <div class="uk-width-medium-1-3 uk-float-left"><i class="material-icons" >pin_drop</i></div>
                                <div class="uk-width-medium-2-3 uk-float-right">
                                    <h5 class="uk-text-left"> Sitios </h5>
                                    <h5 class="uk-text-left" id="myTargetElement2">0</h5>
                                </div>
                            </div>
                            <div class="minimenu">
                                <div class="uk-width-medium-1-3 uk-float-left" ><i class="material-icons">insert_invitation</i></div>
                                <div class="uk-width-medium-2-3 uk-float-right" >
                                    <h5 class="uk-text-left"> Campañas </h5>
                                    <h5 class="uk-text-left" id="myTargetElement3">0</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-3-4">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <div style="padding:20px; height:500px; overflow-y: scroll;">
                                <h4>El ‪#‎WiFi‬ también puede ser un medio publicitario, de hecho es uno de los medios
                                    publicitarios más efectivos actualmente en otros países.
                                    Enera Intelligence
                                    Contáctanos en:
                                    <a href="mailto:contacto@enera.mx">contacto@enera.mx</a>
                                </h4>
                                <img src="{!! URL::asset('images/news_image.png') !!}" alt="">

                                <hr>

                                <h4>‪#‎México‬ es líder regional en tráfico en internet móvil así como inversión
                                    publicitaria móvil. Enera Intelligence</h4>
                                <img src="{!! URL::asset('images/news_image_2.jpg') !!}" alt="">

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
                                    <ul class="uk-list uk-list-line">
                                        <li><p>Iphones - {{$osStats['mac']}}
                                                ({{ round(($osStats['mac'] * 100) / $total , 1)}} %) </p></li>
                                        <li><p>Android
                                                - {{$osStats['android']}}
                                                ({{round($osStats['android'] * 100 / $total, 1)}} %)
                                            </p></li>
                                        <li><p>Windos
                                                - {{$osStats['windows']}}
                                                ({{ round($osStats['windows'] * 100 / $total, 1)}} %)
                                            </p></li>
                                        <li><p>Otros
                                                - {{$osStats['otro']}} ({{round($osStats['otro'] * 100 / $total, 1 )}}
                                                %)
                                            </p></li>

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
        var demo = new CountUp("myTargetElement", 0, {{ $logs->count() }}, 0, 2.5, options);
        demo.start();
        var demo = new CountUp("myTargetElement2", 0, 120, 0, 2.5, options);
        demo.start();
        var demo = new CountUp("myTargetElement3", 0, 120, 0, 2.5, options);
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