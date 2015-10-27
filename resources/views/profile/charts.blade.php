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
                                <img src="assets/img/avatars/avatar_11.png" alt="user avatar"/>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span
                                            class="uk-text-truncate">{!! $user->name !!}</span><span class="sub-heading">{!! $user->id !!}</span>
                                </h2>
                                <ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a">{!! $campaign !!} <span class="sub-heading">Campañas</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">{!! $closed !!} <span class="sub-heading">Terminadas</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">{!! $canceled !!} <span class="sub-heading">Canceladas</span></h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="md-card" style=" margin: 0;">
                        <div class="uk-grid" style=" background: white; margin: 0; padding: 10px" >
                            <div class="uk-width-1-2">
                                <h2>Datos Generales</h2>

                                <div id="chart1"></div>
                            </div>
                            <div class="uk-width-1-2">
                                <h2>Campañas Termiandas</h2>

                                <div id="chart2"></div>
                            </div>
                            <div class="uk-width-1-2">
                                <h2>Caapañas Canceladas</h2>

                                <div id="chart3"></div>
                            </div>
                            <div class="uk-width-1-2">
                                <h2>Camapañas Pendientes</h2>

                                <div id="chart4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-1">
                    <div class="md-card md-card-content md-card-hover">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>

        var chart1 = c3.generate({
            bindto: '#chart1',
            data: {
                columns: [
                    ['data1', 30],
                    ['data2', 120],
                    ['data3', 300],
                    ['data4', 50]
                ],
                type : 'donut'
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            donut: {
                title: "Iris Petal Width"
            }
        });

        var chart2 = c3.generate({
            bindto: '#chart2',
            data: {
                columns: [
                    ['data1', 30, 200, 100, 400, 150, 250],
                    ['data2', 50, 20, 10, 40, 15, 25]
                ],
                axes: {
                    data1: 'y',
                    data2: 'y2'
                }
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                },
                y2: {
                    padding: {top: 100, bottom: 100},
                    show: true
                }
            }
        });
        var chart3 = c3.generate({
            bindto: '#chart3',
            data: {
                columns: [
                    ['data1', 30, 200, 100, 400, 150, 250],
                    ['data2', 50, 20, 10, 40, 15, 25]
                ],
                axes: {
                    data1: 'y',
                    data2: 'y2'
                }
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                },
                y2: {
                    padding: {top: 100, bottom: 100},
                    show: true
                }
            }
        });

        var chart4 = c3.generate({
            bindto: '#chart4',
            data: {
                columns: [
                    ['data1', 30, 200, 100, 400, 150, 250],
                    ['data2', 50, 20, 10, 40, 15, 25]
                ],
                axes: {
                    data1: 'y',
                    data2: 'y2'
                }
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                },
                y2: {
                    padding: {top: 100, bottom: 100},
                    show: true
                }
            }
        });

    </script>
@stop