@extends('layouts.main')

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
                                             src="{!! URL::asset('images/icons/'.$interaction['name'].'.svg') !!}"
                                             alt="producto"/>
                                    </div>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span
                                            class="uk-text-truncate">{{ $name }} </span><span
                                            class="sub-heading">{{ $interaction['name'] }}</span>
                                </h2>
                            </div>
                            <a class="md-fab md-fab-small md-fab-accent {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($status) !!}"
                               style="background: {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($status) !!}">  {{-- href="page_user_edit.html" --}}
                                <i class="material-icons">{!! Publishers\Libraries\CampaignStyleHelper::getStatusIcon($status) !!}</i>
                            </a>
                        </div>
                        <div class="md-card-content">
                            <div class="user_content">
                                <ul id="user_profile_tabs" class="uk-switcher uk-margin"
                                    data-uk-tab="{connect:'#user_profile_tabs_content'}">
                                    <li>
                                        <div class="uk-grid uk-margin-medium-top uk-width-large-1-1 "
                                             data-uk-grid-margin>
                                            <div class="uk-width-large-1-2">
                                                <div class="uk-grid">
                                                    <div class="uk-width-large-1-2">
                                                        <h4 class="heading_c uk-margin-small-bottom">Información</h4>
                                                        <ul class="md-list md-list-addon">
                                                            <li>
                                                                <div class="md-list-addon-element">
                                                                    <i class="md-list-addon-icon uk-icon-archive"></i>
                                                                </div>
                                                                <div class="md-list-content">
                                                                    <span class="md-list-heading azul">Nombre Campaña</span>
                                                                    <span class="uk-text-small uk-text-muted">{{ $name }}</span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="md-list-addon-element azul">
                                                                    <i class="md-list-addon-icon uk-icon-dashboard"></i>
                                                                </div>
                                                                <div class="md-list-content">
                                                                    <span class="md-list-heading azul">Estado</span>
                                                                    <span class="uk-text-small uk-text-muted">{{ $status }}</span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="md-list-addon-element azul">
                                                                    <i class="md-list-addon-icon uk-icon-money"></i>
                                                                </div>
                                                                <div class="md-list-content azul">
                                                                    <span class="md-list-heading">Balance</span>
                                                                    <span class="uk-text-small uk-text-muted">{{--{{$balance['current']}}--}}</span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="md-list-addon-element azul">
                                                                    <i class="md-list-addon-icon uk-icon-check-square-o"></i>
                                                                </div>
                                                                <div class="md-list-content">
                                                                    <span class="md-list-heading azul">Tipo de interacon</span>
                                                                    <span class="uk-text-small uk-text-muted">{{$interaction['name']}}</span>
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
                                                        <ul class="md-list">
                                                            <li>
                                                                <div class="md-list-content">
                                                                    <span class="md-list-heading azul">Fecha de la interaccion</span>
                                                                    <span class="uk-text-small uk-text-muted">inicia : &nbsp;&nbsp;&nbsp;&nbsp;{{ date('Y-m-d', $filters['date']['start']->sec) }} </span>
                                                                    <span class="uk-text-small uk-text-muted">finaliza : &nbsp;{{ date('Y-m-d', $filters['date']['end']->sec) }} </span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="md-list-content">
                                                                    <span class="md-list-heading azul">Rango de Edad</span>
                                                                    <span class="uk-text-small uk-text-muted">{{$filters['age'][0].' a '.$filters['age'][1]}} </span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="md-list-content">
                                                                    <span class="md-list-heading azul">Generos</span>
                                                                    <span class="uk-text-small uk-text-muted">{{ trans_choice('gender.'.$filters['gender'][0],1) }}
                                                                        , @if(isset($filters['gender'][1])){{ trans_choice('gender.'.$filters['gender'][1],1) }}  @endif</span>
                                                                    {{--{{$filters['gender'][0].',  '.$filters['gender'][1]}}--}}
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="md-list-content">
                                                                    <span class="md-list-heading azul">Dias</span>
                                                                    <span class="uk-text-small uk-text-muted">
                                                                        @foreach($filters['week_days'] as $dia)
                                                                            {{ trans('days.'.$dia) }},
                                                                        @endforeach
                                                                    </span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="md-list-content">
                                                                    <span class="md-list-heading azul">Horario</span>
                                                                    <span class="uk-text-small uk-text-muted">de {{--{{ $filters['day_hours'] }}--}}
                                                                        horas</span>
                                                                </div>
                                                            </li>
                                                            {{-- esta parte usao if para saber que es lo que se va a mostrar --}}
                                                            <li>
                                                                <div class="md-list-content azul">
                                                                    <span class="md-list-heading"> usuario unico </span>
                                                                    <span class="uk-text-small uk-text-muted">{{ $filters['unique_user']?'SI':'NO' }}</span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="md-list-content azul">
                                                                    <span class="md-list-heading"> usuarios unicos por dia </span>
                                                                    <span class="uk-text-small uk-text-muted">{{ isset($filters['unique_user_per_day'])? $filters['unique_user_per_day'] :0 }}</span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="md-list-content azul">
                                                                    <span class="md-list-heading"> meta de interacciones </span>
                                                                    <span class="uk-text-small uk-text-muted">{{ $filters['max_interactions'] }}</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-width-large-1-2">
                                                <div class="md-card">
                                                    <div class="md-card-content">
                                                        <h3 class="heading_a uk-margin-bottom">Statistics</h3>

                                                        <div id="ct-chart" class="chartist"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                                <ul class="md-list md-list-addon">
                                    <hr class="md-hr">
                                    <div class="uk-width-large-1-1">
                                        <h4 class="heading_c uk-margin-small-bottom">Elementos de la campaña</h4>
                                        <ul class="md-list">
                                            @if($interaction['name'] == 'banner')


                                            @endif
                                            <li>
                                                <div class="uk-grid ">
                                                    <div class="md-list-content uk-width-large-1-3">
                                                        <span class="md-list-heading"><a href="">imagen</a></span>
                                                        <span class="uk-text-small uk-text-muted"><img
                                                                    class="uk-width-small-2-6" src="{{--{{ $img }}--}}"
                                                                    alt=""></span>
                                                    </div>
                                                    <div class="md-list-content uk-width-large-1-3">
                                                        <span class="md-list-heading"><a href="">imagen</a></span>
                                                        {{--<span class="uk-text-small uk-text-muted"><img class="uk-width-large-2-6" src="{!! URL::asset('images/'.$content['imageng']) !!}" alt=""></span>--}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="md-list-content uk-width-large-1-2">
                                                    <span class="md-list-heading"><a href="">Link a
                                                            redireccionar</a></span>
                                                    <span class="uk-text-small uk-text-muted"> {{--{{ $content['link'] }}--}}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </ul>
                                <ul class="md-list md-list-addon">
                                    <hr class="md-hr">
                                    <div class="uk-grid uk-margin-medium-top" data="uk-grid-margin">
                                        <div class="uk-width-1-1">
                                            <h4 class="heading_c uk-margin-small-bottom">Reportes</h4>

                                            <div class="uk-width-medium-1-6">
                                                <a class="md-btn md-btn-primary"
                                                   href="http://localhost:8000/analytics/single">
                                                    <span class="uk-display-block">Reportes</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
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
    {!! HTML::script('bower_components/ionrangeslider/js/ion.rangeSlider.min.js') !!}
    {!! HTML::script('bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') !!}
    {!! HTML::script('js/circle-progress.js') !!}
    {!! HTML::style('css/show.css') !!}
    <script>
        var active = '{{session('data')}}';
        if (active == 'active') {
            UIkit.notify("<i class='uk-icon-check'></i>  Tu perfil ha sido modificado con exito", {status: 'success'}, {timeout: 5});
        }
        //        $("#age_slider").ionRangeSlider();
        //        $("#ionslider_3").ionRangeSlider();
        $('#circle').circleProgress({
            value: 10{{--{{$porcentaje}}--}}, //lo que se va a llenar con el color
            size: 98,   //tamaño del circulo
            startAngle: -300, //de donde va a empezar la animacion
            reverse: true, //empieza la animacion al contrario
            thickness: 8,  //el grosor la linea
            fill: {color: "{!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($status) !!}"} //el color de la linea
        }).on('circle-animation-progress', function (event, progress) {
            $(this).find('strong').html(parseInt(100 * progress) + '<i>%</i>');
        });
    </script>
    <!-- enera custom scripts -->
    {{--{!! HTML::script('assets/js/enera/create_campaign_helper.js') !!}--}}

@stop