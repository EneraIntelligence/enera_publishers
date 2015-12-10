@extends('layouts.main')
@section('head_scripts')
    <style>
        .ul{
            font:bold 18px times;
        }

        li p {
            font: 400 14px/18px Roboto,sans-serif;
            color:#000000;
            margin-bottom: 0;
        }

        .p{
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

                                <div class="uk-dropdown uk-dropdown-flip uk-dropdown-small">
                                    <ul class="uk-nav">
                                        <li><a href="#">Action 1</a></li>
                                        <li><a href="#">Action 2</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user_heading_avatar">
                                <div>
                                    <div id="circle" style="max-width:98px;max-height:98px;margin:auto;">
                                        <img style="background-image:none!important;margin:-96px 9px;"
                                             src="{!! URL::asset('images/icons/'.$cam->interaction['name'].'.svg') !!}"
                                             alt="producto"/>
                                    </div>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span
                                            class="uk-text-truncate">{{ $cam->name }} </span><span
                                            class="sub-heading">{{ $cam->interaction['name'] }}</span>
                                </h2>
                            </div>
                            <a class="md-fab md-fab-small md-fab-accent {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($cam->status) !!}"
                               style="background: {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($cam->status) !!}">  {{-- href="page_user_edit.html" --}}
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
                                                            <span class="uk-text-small uk-text-muted">$ {{$cam->balance['current']}}</span>
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
                                                        <div class="md-list-content azul">
                                                            <span class="md-list-heading">Lugares</span>
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
                                                            <span class="uk-text-small uk-text-muted">{{$cam->filters['age'][0].' a '.$cam->filters['age'][1]}} </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Generos</span>
                                                                    <span class="uk-text-small uk-text-muted">
                                                                        {{ trans_choice('gender.'.$cam->filters['gender'][0],1) }}
                                                                        , {{ isset($filters['gender'][1]) ? trans_choice('gender.'.$cam->filters['gender'][1],1):'' }}
                                                                    </span>
                                                            {{--{{$filters['gender'][0].',  '.$filters['gender'][1]}}--}}
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Dias</span>
                                                                    <span class="uk-text-small uk-text-muted">
                                                                        @foreach($cam->filters['week_days'] as $dia)
                                                                            {{ trans('days.'.$dia) }},
                                                                        @endforeach
                                                                    </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="md-list-content">
                                                            <span class="md-list-heading azul">Horario</span>
                                                                    <span class="uk-text-small uk-text-muted">
                                                                        {{ $cam->filters['day_hours'][0].':00' }}
                                                                        a {{ $cam->filters['day_hours'][count($cam->filters['day_hours'])-1].':00' }}
                                                                    </span>
                                                        </div>
                                                    </li>
                                                    {{-- esta parte usao if para saber que es lo que se va a mostrar --}}
                                                    <li>
                                                        <div class="md-list-content azul">
                                                            <span class="md-list-heading">Usuario unico </span>
                                                            <span class="uk-text-small uk-text-muted">{{ $cam->filters['unique_user']?'SI':'NO' }}</span>
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
                                                            <span class="uk-text-small uk-text-muted">{{ $cam->filters['max_interactions'] }}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="md-list-content uk-width-large-1-1">
                                            <h3 class="heading_c uk-margin-small-bottom">Elementos de la campaña</h3>
                                            @if($cam->interaction['name'] == 'banner'|| $cam->interaction['name'] ==  'banner_link')
                                                <div class="md-list-heading uk-width-large-1-2"
                                                     style="color: #1e88e5;float: left">
                                                    Imagen chica :
                                                    <a id="link" class=""
                                                       data-uk-modal="{target:'#modal_lightbox-1'}">{!! $cam->content['image'] !!}</a>
                                                    <div class="uk-modal" id="modal_lightbox-1">
                                                        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                                            <button type="button"
                                                                    class="uk-modal-close uk-close uk-close-alt"></button>
                                                            <img src="{!! URL::asset('images/600x602.jpg') !!}" alt=""/>
                                                            <div class="uk-modal-caption">Lorem</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="md-list-content uk-width-large-1-2"
                                                     style=" color: #1e88e5;float: right;">
                                                    Imagen grande :
                                                    <a id="link" class=""
                                                       data-uk-modal="{target:'#modal_lightbox-2'}">
                                                        {!! $cam->content['image'] !!}</a>
                                                    <div class="uk-modal" id="modal_lightbox-2">
                                                        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                                            <button type="button"
                                                                    class="uk-modal-close uk-close uk-close-alt"></button>
                                                            <img src="{!! URL::asset('images/600x602.jpg') !!}" alt=""/>
                                                            <div class="uk-modal-caption">Lorem</div>
                                                        </div>
                                                    </div>
                                                    {{--<span class="uk-text-small uk-text-muted"><img class="uk-width-large-2-6" src="{!! URL::asset('images/'.$content['imageng']) !!}" alt=""></span>--}}
                                                </div>
                                                <h3 class="md-hr" style="margin-bottom: 10px;"></h3>
                                                <div class="md-list-content uk-width-large-1-2"
                                                     style=" color: #1e88e5;">
                                                    Link a redireccionar :
                                                    <a id="link" class="" href="http://{{ $cam->content['link'] }}"
                                                       target="_blank">{!! $cam->content['link'] !!}</a>
                                                </div>
                                            @endif
                                            @if($cam->interaction['name'] == 'captcha')
                                                <div class="md-list-heading uk-width-large-1-2"
                                                     style="color: #1e88e5;float: left">
                                                    Imagen Captcha :
                                                    <a id="link" class=""
                                                       data-uk-modal="{target:'#captcha-image'}">
                                                        {!! $cam->content['cover_path'] !!}</a>
                                                    <div class="uk-modal" id="captcha-image">
                                                        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                                            <button type="button"
                                                                    class="uk-modal-close uk-close uk-close-alt"></button>
                                                            <img src="{!! URL::asset('images/'.$cam->content['cover_path']) !!}"
                                                                 alt="{{$cam->content['cover_path']}}"/>
                                                            <div class="uk-modal-caption">Lorem</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="md-list-heading uk-width-large-1-2"
                                                     style="color: #1e88e5;float: left">
                                                    Texto Captcha :
                                                    <a id="link" class="">
                                                        {!! $cam->content['captcha'] !!}</a>
                                                </div>
                                            @endif
                                            @if($cam->interaction['name'] == 'mailing_list')
                                                <div class="md-list-heading uk-width-large-1-2"
                                                     style="color: #1e88e5;float: left">
                                                    Imagen Maling List :
                                                    <a id="link" class=""
                                                       data-uk-modal="{target:'#mailing-image'}">
                                                        {!! $cam->content['image'] !!}</a>
                                                    <div class="uk-modal" id="mailing-image">
                                                        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                                            <button type="button"
                                                                    class="uk-modal-close uk-close uk-close-alt"></button>
                                                            <img src="{!! URL::asset('images/'.$cam->content['image']) !!}"
                                                                 alt="{{$cam->content['cover_path']}}"/>
                                                            <div class="uk-modal-caption">Lorem</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- create mailing campaign button start -->
                                                <div class="uk-grid uk-margin-medium-top" data="uk-grid-margin">
                                                    <div class="uk-width-1-1">
                                                        <div class="uk-width-medium-1-1">
                                                            <a class="md-btn md-btn-primary"
                                                               onclick="new_campaign.promptMailingCampaign('{{$cam->_id}}')"
                                                                <span class="uk-display-block">Crear campaña de mailing</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- create mailing campaign button end -->

                                            @endif
                                            @if($cam->interaction['name'] == 'survey')
                                                <div class="md-list-heading uk-width-large-1"
                                                     style="color: #1e88e5;float: left">
                                                    Imagen Encuesta :
                                                    <a id="link" class=""
                                                       data-uk-modal="{target:'#survey-image'}">
                                                        {!! $cam->content['image'] !!}</a>
                                                    <div class="uk-modal" id="survey-image">
                                                        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                                            <button type="button"
                                                                    class="uk-modal-close uk-close uk-close-alt"></button>
                                                            <img src="{!! URL::asset('images/'.$cam->content['image']) !!}"
                                                                 alt="{{$cam->content['cover_path']}}"/>
                                                            <div class="uk-modal-caption">Lorem</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="md-list-content uk-width-large-1"
                                                     style=" color: #1e88e5;">
                                                    @foreach($cam->content['survey'] as $key => $con)
                                                        <span>Pregunta {!! $key[1] !!} : &nbsp;{!! $con['question'] !!}</span>
                                                        <br>
                                                        @foreach($con['answers'] as $key => $a)
                                                            <ul>
                                                                <li class="p"> <p>Respuesta {!! $key[1] !!}: {!! $a !!}</p>
                                                            </ul>
                                                        @endforeach
                                                    @endforeach

                                                </div>
                                            @endif
                                            @if($cam->interaction['name'] == 'video')
                                                <div class="md-list-heading uk-width-large-1-2"
                                                     style="color: #1e88e5;float: left">
                                                    Video :
                                                    <a id="link" class=""
                                                       data-uk-modal="{target:'#video'}">
                                                        {!! $cam->content['video'] !!}</a>
                                                    <div class="uk-modal" id="video">
                                                        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                                            <button type="button"
                                                                    class="uk-modal-close uk-close uk-close-alt"></button>
                                                            <video width="600" height="300" controls>
                                                                <source src="{!! URL::asset('videos/'.$cam->content['video']) !!}"
                                                                        type="video/mp4">
                                                                Your browser does not support HTML5 video.
                                                            </video>
                                                            {{--<div class="uk-modal-caption">Lorem</div>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-width-large-1-2">
                                        <div class="md-card">
                                            <div class="md-card-content">
                                                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span
                                                            class="peity_visitors peity_data" style="display: none;">5,3,9,6,5,9,7</span>
                                                    <svg class="peity" height="28" width="48">
                                                        <rect fill="#d84315" x="1.3714285714285717"
                                                              y="12.444444444444443" width="4.114285714285715"
                                                              height="15.555555555555557"></rect>
                                                        <rect fill="#d84315" x="8.228571428571428"
                                                              y="18.666666666666668" width="4.114285714285716"
                                                              height="9.333333333333332"></rect>
                                                        <rect fill="#d84315" x="15.085714285714287" y="0"
                                                              width="4.1142857142857086" height="28"></rect>
                                                        <rect fill="#d84315" x="21.942857142857147"
                                                              y="9.333333333333336" width="4.114285714285707"
                                                              height="18.666666666666664"></rect>
                                                        <rect fill="#d84315" x="28.800000000000004"
                                                              y="12.444444444444443" width="4.114285714285707"
                                                              height="15.555555555555557"></rect>
                                                        <rect fill="#d84315" x="35.65714285714286" y="0"
                                                              width="4.114285714285707" height="28"></rect>
                                                        <rect fill="#d84315" x="42.51428571428572" y="6.222222222222221"
                                                              width="4.114285714285707"
                                                              height="21.77777777777778"></rect>
                                                    </svg>
                                                </div>
                                                {{--<span class="uk-text-muted uk-text-small">Interacciones</span>--}}
                                                <h3 class="heading_a uk-margin-bottom">Interacciones</h3>
                                                <h1 class="jumbo uk-text-center" id="myTargetElement">0</h1>
                                            </div>
                                        </div>
                                        <div class="md-card">
                                            <div id="graficas" class="md-card-content">
                                                <h3 class="heading_a uk-margin-bottom">Analiticos</h3>
                                                <div id='genderAge' class="uk-width-large-1-1 uk-panel-teaser" style="height: 350px"></div>
                                                <h3 class="md-hr" style="margin: 10px;"></h3>
                                                <div id='gender' class="uk-width-large-1-1 uk-margin-right"></div>
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
    {!! HTML::script('bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') !!}
    {!! HTML::script('bower_components/ionrangeslider/js/ion.rangeSlider.min.js') !!}
    {!! HTML::script('bower_components/countUp.js/countUp.js') !!}
    {!! HTML::script('js/circle-progress.js') !!}
    {!! HTML::style('css/show.css') !!}
            <!-- links para que funcione la grafica demografica  -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    {!! HTML::script('js/ajax/graficas.js') !!}
    <script>
//-------------------------------------- animacion del circulo  ---------------------------------------------
        $('#circle').circleProgress({
            value: {{$cam->porcentaje}}, //lo que se va a llenar con el color
            size: 98,   //tamaño del circulo
            startAngle: -300, //de donde va a empezar la animacion
            reverse: true, //empieza la animacion al contrario
            thickness: 8,  //el grosor la linea
            fill: {color: "{!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($cam->status) !!}"} //el color de la linea
        }).on('circle-animation-progress', function (event, progress) {
            $(this).find('strong').html(parseInt(100 * progress) + '<i>%</i>');
        });


        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '',
            suffix: ''
        };
        var demo = new CountUp("myTargetElement", 0, {{$cam->logs->count()}}, 0, 5.0, options);
        demo.start();

        var chart = c3.generate({
            bindto: '#gender',
            data: {
                columns: [
                    ['Mujeres', 15],
                    ['Hombres', 25]
                ],
                type: 'bar'
            },
            bar: {
                width: {
                    ratio: 0.5 // this makes bar width 50% of length between ticks
                }
                // or
                //width: 100 // this makes bar width 100px
            }
        });
//------------------------------------------Grafica---------------------------------------------
var grafica = new graficas;
{{--var gra= grafica.genderAge({!! json_encode($data['grafica']) !!});--}}
var gra= grafica.genderAge();
//var gra2= grafica.gender();

    </script>
    <!-- enera custom scripts -->
    {{--{!! HTML::script('assets/js/enera/create_campaign_helper.js') !!}--}}

@stop