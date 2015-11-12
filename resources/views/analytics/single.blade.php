@extends('layouts.main')

@section('content')
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-small-1-2">
            <h3>Generos</h3>
            <div id="chart1">
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

        $("#phone_number").kendoMaskedTextBox({
            mask: "(99) 0000-0000"
        });
    </script>
@stop