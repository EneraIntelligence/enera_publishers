@extends('layouts.main')

@section('head_scripts')
    <style type="text/css">
        body{
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

    </style>
@endsection

@section('content')
    <div id="fb-root"></div>

    <div id="page_content">
        <div id="page_content_inner">
            {{--<h3 class="heading_b uk-margin-bottom">Blank Page</h3>--}}
            <div class="uk-grid" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
                <div class="uk-width-medium-2-6">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <img src="{!! URL::asset('images/Enera_logo_400x130.png') !!}">
                        </div>
                    </div>
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <h3 class="uk-text-center">Total de dipositivos vistos en la red de enera </h3>
                            <h1 class="jumbo uk-text-center" id="myTargetElement">0</h1>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-4-6">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <div style="padding:20px; height:500px; overflow-y: scroll;">
                                <h4>El ‪#‎WiFi‬ también puede ser un medio publicitario, de hecho es uno de los medios publicitarios más efectivos actualmente en otros países.
                                    Enera Intelligence
                                    Contáctanos en:
                                    <a href="mailto:contacto@enera.mx">contacto@enera.mx</a>
                                </h4>
                                <img src="{!! URL::asset('images/news_image.png') !!}" alt="">

                                <hr>

                                <h4>‪#‎México‬ es líder regional en tráfico en internet móvil así como inversión publicitaria móvil. Enera Intelligence</h4>
                                <img src="{!! URL::asset('images/news_image_2.jpg') !!}" alt="">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-6-6">
                    <div class="md-card" style="">
                        <div class="md-card-content">
                            <div id="chart"></div>
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
            useEasing : true,
            useGrouping : true,
            separator : ',',
            decimal : '.',
            prefix : '',
            suffix : ''
        };
        var demo = new CountUp("myTargetElement", 0, {{ $logs->count() }}, 0, 2.5, options);
        demo.start();


        var chart = c3.generate({
            data: {
                // iris data from R
                columns: [
                    @foreach($osStats as $k=>$os)
                    {!! '["'.$k.'",'.$os.' ],'  !!}
                    @endforeach
                ],
                type : 'pie',
            }
        });

    </script>
@stop