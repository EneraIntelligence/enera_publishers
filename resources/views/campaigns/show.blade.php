@extends('layouts.main')
@section('head_scripts')
        <!-- c3.js (charts) -->
    {!! HTML::style('bower_components/c3js-chart/c3.min.css') !!}

    <style>
        li p {
            font: 400 14px/18px Roboto, sans-serif;
            color: #000000;
            margin-bottom: 0;
        }
        .p {
            list-style: none;
        }
    </style>
@endsection

@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-1">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_menu" data-uk-dropdown>
                                <i class="md-icon material-icons md-icon-light">&#xE5D4;</i>
                                {{--<div class="uk-dropdown uk-dropdown-flip uk-dropdown-small">
                                    <ul class="uk-nav">
                                        <li><a href="#">Action 1</a></li>
                                        <li><a href="#">Action 2</a></li>
                                    </ul>
                                </div>--}}
                            </div>
                            <div class="user_heading_avatar">
                                <div>
                                    <div id="circle" style="max-width:98px;max-height:98px;margin:auto;">
                                        <img class="svg" style="background-image:none!important;margin:-96px 9px;background:transparent;border:none;"
                                             src="{!! URL::asset('images/icons/'.
                                                                CampaignStyle::getCampaignIcon( $cam->interaction['name']
                                                             ) ) !!}2.svg"
                                             alt="producto"/>
                                    </div>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span
                                            class="uk-text-truncate">{{ $cam->name }} </span><span
                                            class="sub-heading">{{ (str_replace("_", " ",$cam->interaction['name'])) }}</span>
                                </h2>
                            </div>
                            <a data-uk-tooltip="{pos:'left'}" title="{!! $cam->status !!}"
                               class="md-fab md-fab-small md-fab-accent {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($cam->status) !!} ">
                                {{--style="background: {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($cam->status) !!}">  --}}{{-- href="page_user_edit.html" --}}
                                <i class="material-icons">{!! Publishers\Libraries\CampaignStyleHelper::getStatusIcon($cam->status) !!}</i>
                            </a>
                        </div>
                        <div class="md-card-content">
                            <div class="user_content">
                                <div class="uk-grid uk-margin-medium-top uk-width-large-1-1 " data-uk-grid-margin>
                                    <div class="uk-width-large-1-2">
                                        <div class="uk-grid">
                                            <div class="uk-width-large-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom">Información</h4>
                                                <ul class="md-list md-list-addon ul">
                                                    <li>
                                                        <div class="md-list-addon-element">
                                                            <i class="md-list-addon-icon uk-icon-archive"></i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Nombre</span>
                                                            <span class="uk-text-small uk-text-muted">{{ $cam->name }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element azul">
                                                            <i class="md-list-addon-icon uk-icon-dashboard"></i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Estado</span>
                                                            <span class="uk-text-small uk-text-muted">{{ $cam->status }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element azul">
                                                            <i class="md-list-addon-icon uk-icon-money"></i>
                                                        </div>
                                                        <div class="md-list-content azul">
                                                            <span class="md-list-heading">Balance</span>
                                                            <span class="uk-text-small uk-text-muted">$ {{number_format($cam->balance['current'],2)}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element azul">
                                                            <i class="md-list-addon-icon uk-icon-check-square-o"></i>
                                                        </div>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Interacción</span>
                                                            <span class="uk-text-small uk-text-muted">{{$cam->interaction['name']}}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-addon-element azul">
                                                            <i class="md-list-addon-icon uk-icon-road"></i>
                                                        </div>
                                                        <div class="md-list-content ">
                                                            <span class="md-list-heading azul">Lugares</span>
                                                            @if($lugares!='global')
                                                                {{--                                                                {!! var_dump($cam->branches) !!}--}}
                                                                @foreach($lugares as $lugar)
                                                                    <span> {!! $lugar !!} , </span>
                                                                @endforeach
                                                            @else
                                                                <span> Global</span>
                                                            @endif
                                                            <span class="uk-text-small uk-text-muted">{{--{{$branches[0]}}--}}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="uk-width-large-1-2">
                                                <h4 class="heading_c uk-margin-small-bottom">Filtros</h4>
                                                <ul class="md-list ul">
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Fecha de la interaccion</span>
                                                            <span class="uk-text-small uk-text-muted">inicia : &nbsp;&nbsp;&nbsp;&nbsp;{{ date('Y-m-d', $cam->filters['date']['start']->sec) }} </span>
                                                            <span class="uk-text-small uk-text-muted">finaliza : &nbsp;{{ date('Y-m-d', $cam->filters['date']['end']->sec) }} </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Rango de Edad</span>
                                                            {{--<span class="uk-text-small uk-text-muted">{{  $cam->filters['age'][0].' a '.$cam->filters['age'][1]}} </span>--}}
                                                            <span class="uk-text-small uk-text-muted">{{ isset($cam->filters['age'][0])? $cam->filters['age'][0].' a '.$cam->filters['age'][1] :'no definido' }} </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Generos</span>
                                                                    <span class="uk-text-small uk-text-muted">
                                                                        {{--{{ trans_choice('gender.'.$cam->filters['gender'][0],1) }}--}}
                                                                        {{ isset($filters['gender'][1]) ? trans_choice('gender.'.$cam->filters['gender'][0],1):'ambos' }}
                                                                        , {{ isset($filters['gender'][2]) ? trans_choice('gender.'.$cam->filters['gender'][1],1):' ' }}
                                                                    </span>
                                                            {{--{{$filters['gender'][0].',  '.$filters['gender'][1]}}--}}
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Dias</span>
                                                            <span class="uk-text-small uk-text-muted">
                                                                @if(isset($cam->filters['week_days'] ))
                                                                    @foreach($cam->filters['week_days'] as $dia)
                                                                        {{ trans('days.'.$dia) }},
                                                                    @endforeach
                                                                @else
                                                                    no definido
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Horario</span>
                                                            <span class="uk-text-small uk-text-muted">
                                                                @if(isset($cam->filters['day_hours']))
                                                                    {{ $cam->filters['day_hours'][0].':00' }}
                                                                    a {{ $cam->filters['day_hours'][count($cam->filters['day_hours'])-1].':00' }}
                                                                @else
                                                                    no se definio horario
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                    {{-- esta parte usao if para saber que es lo que se va a mostrar --}}
                                                    <li>
                                                        <div class="md-list-content azul">
                                                            <span class="md-list-heading">Usuario unico </span>
                                                            <span class="uk-text-small uk-text-muted">{{ isset($cam->filters['unique_user'])?$cam->filters['unique_user']==true?'SI':'no':'NO' }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content azul">
                                                            <span class="md-list-heading">Usuarios unicos por dia </span>
                                                            <span class="uk-text-small uk-text-muted">{{ isset($cam->filters['unique_user_per_day'])? $cam->filters['unique_user_per_day'] :0 }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content azul">
                                                            <span class="md-list-heading">Meta de interacciones </span>
                                                            <span class="uk-text-small uk-text-muted">{{ isset($cam->filters['max_interactions'])?$cam->filters['max_interactions']==false?'no':$cam->filters['max_interactions']:'no definido' }}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="md-list-content uk-width-large-1-1">

                                            @if(view()->exists('campaigns.partials.preview_'.$cam->interaction['name']))
                                                @include('campaigns.partials.preview_'.$cam->interaction['name'])
                                            @endif

                                        </div>

                                    </div>

                                    <div class="uk-width-large-1-2">
                                        <div class="">
                                            <div class="uk-grid uk-margin-medium-top">
                                                <div class="uk-width-medium-1">
                                                    <div class="md-card-content ">
                                                        <div class="uk-grid">
                                                            <div class="uk-width-1-3 uk-padding-remove">
                                                                <div class="uk-grid">
                                                                    <div class="uk-width-2-3 ">
                                                                        <h2 class="jumbo uk-text-center" id="vistos"
                                                                            style="width: 100%">
                                                                            0</h2>
                                                                    </div>
                                                                    <div class="uk-width-1-3 uk-padding-remove">
                                                                        <i class="uk-icon-eye uk-icon-medium uk-text-center"
                                                                           data-uk-tooltip="{pos:'top'}"
                                                                           title="Visto"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="uk-width-1-3 uk-padding-remove">
                                                                <div class="uk-grid">
                                                                    <div class="uk-width-2-3 ">
                                                                        <h2 class="jumbo uk-text-center"
                                                                            style="width: 100%"
                                                                            id="completados">0</h2>
                                                                    </div>
                                                                    <div class="uk-width-1-3 uk-padding-remove">
                                                                        <i class="material-icons md-36 "
                                                                           data-uk-tooltip="{pos:'top'}"
                                                                           title="Completado" >done</i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="uk-width-1-3 uk-padding-remove">
                                                                <div class="uk-grid">
                                                                    <div class="uk-width-2-3 ">
                                                                        <h2 class="jumbo uk-text-center" id="usuarios"
                                                                            style="width: 100%">
                                                                            0</h2>
                                                                    </div>
                                                                    <div class="uk-width-1-3">
                                                                        <i class="uk-icon-user uk-icon-medium "
                                                                           data-uk-tooltip="{pos:'top'}"
                                                                           title="Usuario"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-grid uk-margin-medium-top">
                                            <div class="uk-width-medium-1">
                                                <div class="md-card">
                                                    <div id="graficas" class="md-card-content">
                                                        <h3 class="heading_a uk-margin-bottom">Analiticos</h3>
                                                        <div id='intXHour'
                                                             class="uk-width-large-1-1 uk-margin-right"></div>
                                                        <h3 class="md-hr" style="margin: 10px;"></h3>
                                                        <div id='genderAge' class="uk-width-large-1-1 uk-panel-teaser"
                                                             style="height: 350px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-grid uk-margin-medium-top" data="uk-grid-margin">
                                            <div class="uk-width-1-1">
                                                <div class="uk-width-medium-1-6">
                                                    <a class="md-btn md-btn-primary"
                                                       href="{{route('analytics::single', ['id' => $cam->_id])}}">
                                                        <span class="uk-display-block">Reportes</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
            <!-- slider script -->
    {!! HTML::script('js/preview_helper.js') !!}

    {!! HTML::script('bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') !!}
    {!! HTML::script('bower_components/ionrangeslider/js/ion.rangeSlider.min.js') !!}
    {!! HTML::script('bower_components/countUp.js/countUp.js') !!}
    {!! HTML::script('js/circle-progress.js') !!}
    {!! HTML::style('css/show.css') !!}
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
        $('#circle').circleProgress({
            value: {{$porcentaje}}, //lo que se va a llenar con el color
            size: 98,   //tamaño del circulo
            startAngle: -300, //de donde va a empezar la animacion
            reverse: true, //empieza la animacion al contrario
            thickness: 8,  //el grosor la linea
            fill: {color: "{!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($cam->status) !!}"} //el color de la linea
        }).on('circle-animation-progress', function (event, progress) {
            $(this).find('strong').html(parseInt(100 * progress) + '<i>%</i>');
        });

        //-------------------------------------- animación de los numeros  ---------------------------------------------
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '',
            suffix: ''
        };
        var vistos = new CountUp("vistos", 0, {!! $cam->logs()->where('interaction.loaded','exists',true)->count() !!}, 0, 5.0, options);
        vistos.start();
        var completados = new CountUp("completados", 0, {!! $cam->logs()->where('interaction.completed','exists',true)->count() !!}, 0, 5.0, options);
        completados.start();
        var users = new CountUp("usuarios", 0, {!! $unique_users !!} , 0, 5.0, options);
        users.start();
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

    </script>

@stop