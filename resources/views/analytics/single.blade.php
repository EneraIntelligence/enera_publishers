@extends('layouts.main')

@section('content')

    <div id="page_content">
        <div id="page_content_inner" style="padding-bottom: 25px;">
                <div class="uk-grid uk-grid-small">
                    <div class="uk-width-small-1 uk-width-medium-1-2 md-chart">
                        <h2>Datos Generales</h2>
                        <div class="md-card md-card-hover md-chart-card">


                            <div id="chart1"></div>
                        </div>
                    </div>
                    <div class="uk-width-small-1 uk-width-medium-1-2 md-chart">
                        <h2>Campañas Termiandas</h2>
                        <div class="md-card md-card-hover md-chart-card">


                            <div id="chart2"></div>
                        </div>
                    </div>
                    <div class="uk-width-small-1 uk-width-medium-1-2 md-chart">
                        <h2>Capañas Canceladas</h2>
                        <div class="md-card md-card-hover md-chart-card">


                            <div id="chart3"></div>
                        </div>
                    </div>
                    <div class="uk-width-small-1 uk-width-medium-1-2 md-chart">
                        <h2>Camapañas Pendientes</h2>
                        <div class="md-card md-card-hover md-chart-card">


                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@stop


@section('scripts')
    <script>

        var active = '{{session('data')}}';
        if(active=='active')
        {
            UIkit.notify("<i class='uk-icon-check'></i>  Tu perfil ha sido modificado con exito", {status:'success'},{timeout: 5});
        }

        var chart1 = c3.generate({
            bindto: '#chart1',
            data: {
                columns: [
                    ['data1', 30],
                    ['data2', 120],
                    ['data3', 300],
                    ['data4', 50]
                ],
                type: 'donut'
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78']
            },
            donut: {
                title: "nombre"
            }
        });

        var chart2 = c3.generate({
            bindto: '#chart2',
            data: {
                columns: [
                    ['data1', 30, 200, 100, 400, 150, 250, 200, 100, 400, 150, 250, 30, 200, 100, 400, 150],
                    ['data2', 50, 20, 10, 40, 15, 25, 200, 30, 200, 100, 400, 150, 100, 400, 150, 250],
                    ['data3', 50, 20, 150, 40, 15, 250, 20, 30, 200, 100, 40, 150, 100, 400, 150, 250]
                ],
                axes: {
                    data1: 'y',
                    data2: 'y2',
                    data3: 'y'
                }
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78']
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