@extends('layouts.main')

@section('content')

    <div id="top_bar">
        <div class="md-top-bar">
            <div class="uk-width-large-8-10 uk-container-center">
                <ul class="top_bar_nav" id="snippets_grid_filter">
                    <li class="uk-active" data-uk-filter="">
                        <a href="#">Todas</a>
                    </li>
                    <li data-uk-filter="campaign-active">
                        <a href="#">Activas</a>
                    </li>
                    <li data-uk-filter="campaign-paused">
                        <a href="#">Pausadas</a>
                    </li>
                    <li data-uk-filter="campaign-ended">
                        <a href="#">Terminadas</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- start campaigns content -->

    <div id="page_content">
        <div id="page_content_inner">

            <div class="uk-width-large-8-10 uk-container-center">
                <div id="snippets">
                    <div class="uk-grid uk-grid-small uk-grid-width-1 uk-grid-width-medium-1-1 uk-grid-width-large-1-1 uk-grid-width-xlarge-1-1 hierarchical_show" data-uk-grid="{ gutter: 16, controls: '#snippets_grid_filter' }">

                        @foreach($campaigns as $campaign)

                            <div data-uk-filter="campaign-{{$campaign->status}}">
                                <!-- minor critical blocker -->
                                <?
                                      $campaign_colors = array('active'=>'minor')
                                ?>

                                <div class="scrum_task {{$campaing_colors[$campaign->status]}}  md-card md-card-hover md-card-overlay" data-snippet-title="{{$campaign->name}}">
                                    <div class="md-card-content uk-grid">

                                        <div class="interaction-icon uk-width-1-10" data-uk-tooltip="{cls:'long-text'}" title="{{$campaign->action}}">

                                            <img src="http://placehold.it/75x100" alt="">
                                        </div>

                                        <div id="campagin-title" class="uk-width-2-10">
                                            <h2>{{$campaign->name}}</h2>
                                            <h4>Company</h4>
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

                                        <div class="uk-width-4-10" id="chart_{{$campaign->_id}}">

                                        </div>

                                        <div style="text-align: right" class="uk-width-1-10" data-uk-tooltip="{cls:'long-text'}" title="Campaña activa">
                                            status
                                            <br>
                                            <i class="material-icons md-36 uk-text-primary">play_circle_filled</i>
                                            {{-- icons
                                            <i class="material-icons md-36 uk-text-warning">pause_circle_filled</i>
                                            <i class="material-icons md-36 uk-text-danger">error</i>
                                            <i class="material-icons md-36 uk-text-success">assignment_turned_in</i>
                                            --}}

                                        </div>

                                    </div>

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
                }
            });

        @endforeach

    </script>
@stop