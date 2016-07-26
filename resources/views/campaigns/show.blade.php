@extends('layouts.main_materialize')
@section('head_scripts')
        <!-- c3.js (charts) -->
{!! HTML::style('bower_components/c3js-chart/c3.min.css') !!}
{!! HTML::style(asset('assets/css/campaign.css')) !!}
{!! HTML::style('css/show.css') !!}

@stop

@section('content')
    <?php $size = sizeof($cam->filters['day_hours']) ?>
    <div class="container main-container">
        <div class="row">
            <div class="col 12 margin-breadcrumb hide-on-small-only">
                <a href="{{route('home')}}" class="breadcrumb">Home</a>
                <a href="{{route('campaigns::index')}}" class="breadcrumb">Campañas</a>
                <a href="javascript:void(0)" class="breadcrumb">{{$cam->name}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col m12 no-padding">
                <div class="col s12 m6 l4">
                    <div class="card">
                        <div class="card-content">
                            <ul>
                                <span class="card-title">Información</span>
                                <li data-icon="keyboard_arrow_right">Status: <span
                                            class="light-text">{{$cam->status}}</span></li>
                                <hr>
                                <li data-icon="keyboard_arrow_right">
                                    Administrador: <span
                                            class="light-text">{{$cam->administrator->name['first']. ' '. $cam->administrator->name['last']}}</span>
                                </li>
                                <hr>
                                <li data-icon="keyboard_arrow_right">Interacción: <span
                                            class="light-text">{{$cam->interaction['name']}}</span></li>
                                <hr>
                                <li data-icon="keyboard_arrow_right">Fitros:
                                    <ul>
                                        <li data-icon="remove" style="margin-left: 25px;">
                                            Edad: <span
                                                    class="light-text">{{ 'De '.$cam->filters['age'][0] . ' - Hasta '.$cam->filters['age'][1]. ' años'}}</span>
                                        </li>
                                        <li data-icon="remove" style="margin-left: 25px;">
                                            Genero: <span
                                                    class="light-text">{{(!isset($cam->filters['gender']) ? 'No definidos' : (count($cam->filters['gender']) == 1) ? $cam->filters['gender'][0] : 'Ambos')}}</span>
                                        </li>
                                        <li data-icon="remove" style="margin-left: 25px;">
                                            Días:@if(isset($cam->filters['week_days'] ))
                                                @foreach($cam->filters['week_days'] as $dia)
                                                    <span class="light-text">{{ trans('days.'.$dia) }},</span>
                                                @endforeach
                                            @else
                                                <span class="light-text">no definido</span>
                                            @endif</li>
                                        <li data-icon="remove" style="margin-left: 25px;">
                                            Horario: <span
                                                    class="light-text">{{'De las '. $cam->filters['day_hours'][0] . ' - hasta las'.$cam->filters['day_hours'][$size - 1] .' horas'}}</span>
                                        </li>
                                        </li>
                                        <li data-icon="remove" style="margin-left: 25px;">
                                            <span class="light-text">{{'Inicia: '. date('Y-m-d',$cam->filters['date']['start']->sec)}}</span>
                                        </li>
                                        </li>
                                        <li data-icon="remove" style="margin-left: 25px;">
                                            <span class="light-text">{{'Finaliza: '. date('Y-m-d',$cam->filters['date']['end']->sec)}}</span>
                                        </li>
                                    </ul>
                                </li>
                                <hr>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Elemento de campaña</span>
                            @if(view()->exists('campaigns.partials.content'))
                                @include('campaigns.partials.content', ['type' => $cam->interaction['name']])
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l4">
                    <div class="card" style="min-height: 300px;">
                        <div class="card-content">
                            <span class="card-title">Grafícas</span>
                            <div id="genderAge" class="md-card-content"></div>
                        </div>
                    </div>
                    <div class="card" style="min-height: 300px;">
                        <div class="card-content">
                            <span class="card-title">Grafícas</span>
                            <div id="so" class="md-card-content"></div>
                        </div>
                    </div>
                </div>
                <div class="col s12 l4">
                    <div class="card" style="min-height: 614px;">
                        <div class="card-content">
                            <span class="card-title">Contenido</span>
                            <div style="position: relative; width: 250px; margin: 0 auto;">
                                <div class="preview" style="text-align: center;">
                                    <img src="{{asset('images/iphone_placeholder.png')}}" alt="">
                                </div>
                                <div class="preview-content grey lighten-3" id="mydiv" style="overflow: hidden;">
                                    @if(view()->exists('campaigns.partials.preview_'.$cam->interaction['name']))
                                        @include('campaigns.partials.preview_'.$cam->interaction['name'], ['fb_id' => 10206656662069174, 'cam' => $cam])
                                    @endif
                                </div>
                            </div>
                        </div>
                        <span class="light-text" style="padding: 10px;font-size: 12px;">*Vista previa puede variar de la reailidad</span>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @stop

    @section('scripts')
            <!-- slider script -->

    {!! HTML::script('bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') !!}
    {!! HTML::script('bower_components/ionrangeslider/js/ion.rangeSlider.min.js') !!}

            <!-- links para que funcione la grafica demografica  -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- page specific plugins -->
    <!-- d3 -->
    {{--<script src="bower_components/d3/d3.min.js"></script>--}}
    {!! HTML::script('bower_components/d3/d3.min.js') !!}
            <!-- metrics graphics (charts) -->
    {{--<script src="bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>--}}
            <!-- c3.js (charts) -->
    {!! HTML::script('bower_components/c3js-chart/c3.min.js') !!}
            <!-- chartist -->
    {{--<script src="bower_components/chartist/dist/chartist.min.js"></script>--}}

            <!--  charts functions -->
    {{--<script src="assets/js/pages/plugins_charts.min.js"></script>--}}

    {!! HTML::script('js/ajax/graficas.js') !!}

    <script>
        //-------------------------------------- animacion del circulo  ---------------------------------------------

        //------------------------------------------Grafica---------------------------------------------
        var grafica = new graficas;
        var menJson = '{!! json_encode($men) !!}';
        var menObj = JSON.parse(menJson);
        var womenJson = '{!! json_encode($women) !!}';
        var womenObj = JSON.parse(womenJson);

        var intLJson = '{!! json_encode($IntHours) !!}';
        var intLObj = JSON.parse(intLJson);
        //        console.log(intLObj);

        var gra = grafica.genderAge(menObj, womenObj);
        var graf = grafica.intPerHour(intLObj);

        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();

        $('.right-corner').click(function () {
            $('.modal').closeModal();
        });

    </script>


@stop