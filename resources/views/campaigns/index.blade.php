@extends('layouts.main')

@section('content')
        <!--
    <div id="top_bar" xmlns:pointer="http://www.w3.org/1999/xhtml">
        <div class="md-top-bar">
            <div class="uk-width-large-8-10 uk-container-center">


                <ul class="top_bar_nav" id="snippets_grid_filter">
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
        </div>
    </div>
-->
    <!-- start campaigns content -->

    <div id="page_content">
        
        <div class="uk-grid" style="margin-top: 20px;">

            <div class="uk-width-large-8-10 uk-container-center">

                <div class="uk-button-dropdown" data-uk-dropdown>
                    <button class="md-btn">
                        Estado de campaña
                        <i class="material-icons"></i>
                    </button>
                    <div class="uk-dropdown uk-dropdown-small">
                        <ul class="uk-nav uk-nav-dropdown" id="campaign-filter">
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

                </div>


                <div class="uk-button-dropdown" data-uk-dropdown>
                    <button class="md-btn">
                        Ordenar por:
                        <i class="material-icons"></i>
                    </button>
                    <div class="uk-dropdown uk-dropdown-small">
                        <ul class="uk-nav uk-nav-dropdown" id="campaign-sort">
                            <li class="uk-active" data-uk-sort="">
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
                <!--
                <select name="status" id="c-status">
                    <option data-uk-filter="" value="">
                        Todas las campañas
                    </option>
                    <option data-uk-filter="campaign-active" value="campaign-active">
                        Activas
                    </option>
                    <option data-uk-filter="campaign-pending" value="pending">En espera</option>
                    <option data-uk-filter="campaign-rejected" value="rejected">Rechazadas</option>
                    <option data-uk-filter="campaign-ended" value="ended">Terminadas</option>
                    <option data-uk-filter="campaign-canceled" value="canceled">Canceladas</option>
                </select>

                <div id="name-select">

                </div>-->


            </div>
        </div>

        <div id="page_content_inner">

            <div class="uk-width-large-8-10 uk-container-center">
                <div id="snippets">
                    <div class="uk-grid uk-grid-small uk-grid-width-1 uk-grid-width-medium-1-1 uk-grid-width-large-1-1 uk-grid-width-xlarge-1-1 hierarchical_show" data-uk-grid="{ gutter: 16, controls: '#campaign-filter, #campaign-sort' }">

                        @foreach($campaigns as $campaign)

                            <div data-uk-filter="campaign-{{$campaign->status}}"
                                 data-name="{{$campaign->name}}"
                                 data-action="{{$campaign->action}}"
                                 data-company="{{$campaign->company}}"
                                 data-status="{{$campaign->status}}"
                                 style="cursor: pointer;" >
                                <?php
                                    $status_colors = array(
                                        'active'=>'minor',
                                        'pending'=>'minor',
                                        'rejected'=>'critical',
                                        'ended'=>'',
                                        'canceled'=>'blocker'
                                    );

                                    $status_icons = array(
                                        'active'=>'fast_forward',
                                        'pending'=>'schedule',
                                        'rejected'=>'report_problem',
                                        'ended'=>'alarm_on',
                                        'canceled'=>'not_interested'
                                    );

                                    $status_colors = array(
                                            'active'=>'uk-text-success',
                                            'pending'=>'uk-text-warning',
                                            'rejected'=>'uk-text-danger',
                                            'ended'=>'uk-text-primary',
                                            'canceled'=>'uk-text-danger'
                                    );

                                    $campaign_icons = array(
                                            'banner'=>'picture_in_picture',
                                            'streaming'=>'ondemand_video',
                                            'mailing_list'=>'mail',
                                            'captcha'=>'spellcheck',
                                            'survey'=>'assignment'
                                    );
                                ?>
                                        <!-- card classes: md-card md-card-hover md-card-overlay -->
                                <div class="scrum_task {!! $status_colors[$campaign->status] !!}" data-snippet-title="{{$campaign->name}}">
                                    <div class="md-card-content uk-grid">

                                        <div class="interaction-icon uk-width-1-10" style="text-align: center">
                                            <div data-uk-tooltip="{cls:'long-text'}" title="{{$campaign->action}}" style="margin-bottom: 10px">
                                                <i class="material-icons md-36"> {{$campaign_icons[$campaign->action]}}</i>

                                            </div>

                                            <div data-uk-tooltip="{cls:'long-text'}" title="{{$campaign->status}}">
                                                <i class="material-icons md-36 {!! $status_colors[$campaign->status]!!}">{{$status_icons[$campaign->status]}}</i>
                                            </div>


                                        </div>

                                        <div id="campagin-title" class="uk-width-3-10">
                                            <h2>{{$campaign->name}}</h2>
                                            <h4>{{$campaign->company}}</h4>
                                        </div>
                                        
                                        <div class="uk-width-2-10">

                                            <div class="uk-grid">
                                                <div class="uk-width-1-6" style="margin: 10px 0">
                                                    <i class="uk-icon-calendar"></i>
                                                </div>

                                                <div class="uk-width-5-6" style="margin: 10px 0">
                                                    <div class="uk-progress uk-progress-danger">
                                                        <div class="uk-progress-bar" style="width: 90%;">2 días restantes</div>
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

                                        <div class="uk-width-3-10" id="chart_{{$campaign->_id}}" style="margin-top: 15px">

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
                axis:
                {
                    y:
                    {
                        tick: {
                            count: 2,
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