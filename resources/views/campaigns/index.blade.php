@extends('layouts.main')

@section('content')


    <div id="page_content">

        <div class="uk-grid" style="margin-top: 20px;">

            <div class="uk-width-8-10 uk-container-center">

                <h4 class="heading_a uk-align-left" style="inline-block">Campañas</h4>

                <div class="uk-grid uk-align-right">

                    <div class="uk-button-dropdown" style="margin-bottom:10px" data-uk-dropdown>
                        <button class="md-btn">
                            Filtrar campañas
                            <i class="material-icons"></i>
                        </button>
                        <div class="uk-dropdown uk-dropdown-width-2">
                            <div class="uk-grid uk-dropdown-grid">
                                <div class="uk-width-1-2">
                                    <ul class="uk-nav uk-nav-dropdown" id="campaign-filter">
                                        <li class="uk-nav-header">Status</li>
                                        <li class="uk-active" data-uk-filter="">
                                            <a href="#">Todas</a>
                                        </li>
                                        <li data-uk-filter="campaign-active">
                                            <a href="#">Activas</a>
                                        </li>
                                        <li data-uk-filter="campaign-pending">
                                            <a href="#">En espera</a>
                                        </li>
                                        <li data-uk-filter="campaign-rejected">
                                            <a href="#">Rechazadas</a>
                                        </li>
                                        <li data-uk-filter="campaign-ended">
                                            <a href="#">Terminadas</a>
                                        </li>
                                        <li data-uk-filter="campaign-canceled">
                                            <a href="#">Canceladas</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="uk-width-1-2">
                                    <ul class="uk-nav uk-nav-dropdown" id="action-filter">
                                        <li class="uk-nav-header">Interacción</li>
                                        <li data-uk-filter="action-banner">
                                            <a href="#">Banner</a>
                                        </li>

                                        <li data-uk-filter="action-mailing_list">
                                            <a href="#">Mailing list</a>
                                        </li>

                                        <li data-uk-filter="action-video">
                                            <a href="#">Video</a>
                                        </li>

                                        <li data-uk-filter="action-survey">
                                            <a href="#">Encuesta</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="uk-button-dropdown" data-uk-dropdown>
                        <button class="md-btn">
                            Ordenar por:
                            <i class="material-icons"></i>
                        </button>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav uk-nav-dropdown" id="campaign-sort">
                                <li class="uk-active" data-uk-sort="date">
                                    <a href="#">Fecha de creación</a>
                                </li>
                                <li data-uk-sort="name">
                                    <a href="#">Nombre</a>
                                </li>
                                <li data-uk-sort="company">
                                    <a href="#">Compañía</a>
                                </li>
                                <li data-uk-sort="action">
                                    <a href="#">Interacción</a>
                                </li>
                                <li data-uk-sort="status">
                                    <a href="#">Estado</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>


            </div>
        </div>


        <div id="page_content_inner">

            <div class="uk-width-large-8-10 uk-container-center">
                <div id="snippets">
                    <div class="uk-grid uk-grid-width-1-1 hierarchical_show"
                         data-uk-grid="{ gutter: 16, controls: '#campaign-filter, #action-filter, #campaign-sort' }">

                        @if(count($campaigns)<=0)
                            <div class="uk-grid">
                                <h4 class="heading_a" >No tienes campañas <br> <a href="#">Crea una campaña nueva</a></h4>
                            </div>
                        @endif

                        @foreach($campaigns as $campaign)

                            <div data-uk-filter="campaign-{{$campaign->status}}, action-{{$campaign->interaction['name']}}"
                                 data-name="{{$campaign->name}}"
                                 data-action="{{$campaign->interaction['name']}}"
                                 data-company="{{$campaign->company}}"
                                 data-status="{{$status_values[$campaign->status]}}"
                                 data-date="{{$campaign->created_at}}"
                                 style="cursor: pointer;">

                                <div class="scrum_task {!! $status_colors[$campaign->status] !!}"
                                     data-snippet-title="{{$campaign->name}}">
                                    <div class="md-card-content uk-grid">

                                        <div class="interaction-icon uk-width-large-1-10 uk-hidden-small">
                                            <div class="uk-vertical-align" style="height:80px"
                                                 data-uk-tooltip="{cls:'long-text'}"
                                                 title="{{$campaign->action}} - {{$campaign->status}}"
                                                 style="margin-bottom: 10px">
                                                <i class="uk-vertical-align-middle
                                                material-icons md-36
                                                {!! $status_colors[$campaign->status]!!}">
                                                    {{$campaign_icons[$campaign->interaction['name']]}}
                                                </i>

                                            </div>

                                        </div>

                                        <div id="campaign-title" class="uk-width-large-3-10 uk-grid-width-small-2-3">
                                            <h2>{{$campaign->name}}</h2>
                                            <h4>{{$campaign->company}}</h4>
                                        </div>

                                        <div class="uk-grid-width-2-10">

                                            <div class="uk-grid">
                                                <div class="uk-width-1-6" style="margin: 10px 0">
                                                    <i class="uk-icon-calendar"></i>
                                                </div>

                                                <div class="uk-width-5-6" style="margin: 10px 0">
                                                    <div class="uk-progress uk-progress-danger">
                                                        <div class="uk-progress-bar" style="width: 90%;">2 días
                                                            restantes
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="uk-width-1-6" style="margin: 10px 0">
                                                    <i class="uk-icon-money"></i>
                                                </div>

                                                <div class="uk-width-5-6" style="margin: 10px 0">
                                                    <div class="uk-progress uk-progress-warning">
                                                        <div class="uk-progress-bar" style="width: 40%;">$100</div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class=" uk-hidden-small uk-grid-width-3-10" id="chart_{{$campaign->_id}}"
                                             style="margin-top: 15px">

                                        </div>


                                    </div>

                                    <!--
                                    <div class="md-card-overlay-content">
                                        <div class="uk-clearfix md-card-overlay-header">
                                            <i class="md-icon md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                            <h4 style="text-align: right">Demográficos</h4>
                                        </div>

                                        <div class="md-card-overlay-content-inner">
                                            <p class="uk-margin-bottom truncate-text" style="height: 88px">
                                                Hombres - Mujeres
                                                <br>
                                                Menores de 30 años
                                                <br>
                                                etc...
                                            </p>
                                            <p><span class="uk-badge uk-badge-active">Campaña Activa</span></p>
                                        </div>
                                    </div>

                                    -->

                                </div>
                            </div>

                        @endforeach


                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- end campaigns content -->
@stop

@section('scripts')


    <script>
                @foreach($campaigns as $campaign)

                    var chart = c3.generate({
                    bindto: '#chart_{{$campaign->_id}}',
                    data: {
                        columns: [
                            ['data1', 30, 200, 100, 400, 150, 250],
                            ['data2', 130, 100, 140, 200, 150, 50]
                        ],
                        type: 'bar'
                    },
                    bar: {
                        width: {
                            ratio: 0.5 // this makes bar width 50% of length between ticks
                        }
                        // or
                        //width: 100 // this makes bar width 100px
                    },
                    axis: {
                        y: {
                            tick: {
                                count: 2
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });

        @endforeach

    </script>
@stop