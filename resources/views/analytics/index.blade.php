@extends('layouts.main')

@section('content')

    <div id="chart"></div>

@stop

@section('scripts')


    <script>
        var categoriesArr = ['13-17 años', '18-25 años', '26-29 años', '30-39 años', '40-49 años', '> 50 años'];

        var chart = c3.generate({
            data: {
                columns: [
                    ['hombres', -30, -200, -100, -400, -150, -250],
                    ['mujeres', 30, 200, 100, 100, 150, 250],
                ],
                type:'bar',
                labels:{
                    format: function (v,id,i,j) {

                        return categoriesArr[i];

                        /*
                         if(j==0)
                         return categoriesArr[i]+" ("+Math.abs(v)+")";

                         return "("+Math.abs(v)+") "+categoriesArr[i];*/
                    },
                },

                groups: [ ['hombres','mujeres'] ]
            },
            color: {
                pattern: ['#5294C2', '#fc92cc']
            },
            axis: {
                rotated: true,
                y:{
                    tick: {
                        format: function (y) { return Math.abs(y) }
                    },
                    center: 0
                },
                x:{
                    show:false,
                    type: 'category',
                    categories: categoriesArr,
                }
            }
        });

        chart.ygrids([
            {value: 0},
        ]);

    </script>

@stop