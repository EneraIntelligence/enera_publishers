
@extends('layouts.main')

@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-1">
                    <div id="reporte" class="md-card ">
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
                                <h2 class="heading_b uk-margin-bottom">
                                    <span class="uk-text-truncate">{{ $name }} </span>
                                    <span class="sub-heading">{{ $interaction['name'] }}</span>
                                </h2>
                            </div>
                            <a class="md-fab md-fab-small md-fab-accent {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor('active') !!}"  {{-- $status--}}
                               style="background: {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor('active') !!}">  {{-- href="page_user_edit.html" --}}
                                <i class="material-icons">{!! Publishers\Libraries\CampaignStyleHelper::getStatusIcon('active') !!}</i>
                            </a>
                        </div>

                            <div class="uk-width-large-1-1 uk-margin-medium-top" style="display: inline-flex;" >
                                <div class="uk-width-large-1-2 uk-margin-left ">
                                    <select id="select-grafico" data-md-selectize>
                                        <option value="default">Seleciona un tipo de gráfica</option>
                                        <optgroup label="tipo">
                                            <option value="intPerDay">Interacciones por dia</option>
                                            <option value="genderAge">Generos y edades</option>
                                            <option value="so">sistemas operativos</option>
                                            <option value="a">Item A</option>
                                            <option value="b">Item B</option>
                                            <option value="c">Item C</option>
                                            <option value="d">Item D</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div id="print" class="uk-width-large-1-2 uk-margin-right">
                                    <i class="md-icon material-icons md-36 uk-float-right uk-margin-right" href="">print</i>
                                </div>
                            </div>

                        {{-- graficas --}}
                        <div id="grafica" class="uk-width-large-1-1 uk-margin-top ">
                            <div id="{{ $type }}" class="uk-width-large-1-1 uk-margin-right">

                            </div>
                            <div class="uk-width-large-1-2 uk-margin-left">

                            </div>
                            <div class="uk-width-1-1 uk-padding">
                                <span class="uk-margin-large-left "> {{ $name.'  2015/nov/18' }} </span>
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
    {!! HTML::script('js/printThis.js') !!}
    <script>
        $( document ).ready(function() {
            console.log( "ready!" );

            $('#print').click(function() {
                Popup($('#reporte').html());
//                print($('#reporte'));
            });

/*            function print(data){
                $(data).printThis({
                    debug: false,              //!* show the iframe for debugging
                    importCSS: true,           //!* import page CSS
                    printContainer: true,      //!* grab outer container as well as the contents of the selector
                    loadCSS: "public/bower_components/kendo-ui-core/styles/kendo.common-material.min.css", //!* path to additional css file
                    loadCSS: "public/bower_components/kendo-ui-core/styles/kendo.material.min.css", //!* path to additional css file
                    pageTitle: "Grafica",             //!* add title to print page
                    removeInline: false        //!* remove all inline styles from print elements
                });
            }*/

//                       funcion nativa
                    function Popup(data)
                    {
                        var mywindow = window.open('', 'my div', 'height=600,width=800');
                        mywindow.document.write('<html><head><title>my div</title>');
                        /*optional stylesheet*/
                        mywindow.document.write('<link rel="stylesheet" href="public/bower_components/kendo-ui-core/styles/kendo.common-material.min.css" type="text/css" />');
                        mywindow.document.write('</head><body >');
                        mywindow.document.write(data);
                        mywindow.document.write('</body></html>');

                        mywindow.document.close(); // necessary for IE >= 10
                        mywindow.focus(); // necessary for IE >= 10

                        mywindow.print();
                        mywindow.close();

                        return true;
                    }

            /***  codigo para la animación del circulo    ***/
            $('#circle').circleProgress({ //se pasa como parametro el id o elemento que se va animar
                value: {{$cam->porcentaje}}, //lo que se va a llenar con el color
                size: 98,   //tamaño del circulo
                startAngle: -300, //de donde va a empezar la animacion
                reverse: true, //empieza la animacion al contrario
                thickness: 8,  //el grosor la linea
                fill: {color: "{!! Publishers\Libraries\CampaignStyleHelper::getStatusColor('active') !!}"} //el color de la linea
            }).on('circle-animation-progress', function (event, progress) {
                $(this).find('strong').html(parseInt(100 * progress) + '<i>%</i>');
            }); //fin del codigo de animacion de circulo

            var select= $( "#select-grafico" );
            $(select).change(function() {
                var tipo = select.val();
//                console.log( "Handler for .change() called. "+tipo );
                window.location.href = 'http://localhost:8000/analytics/5638f436a8268b300d479642/'+tipo;
            });

        });
        var active = '{{session('data')}}';
        if (active == 'active') {
            UIkit.notify("<i class='uk-icon-check'></i>  Tu perfil ha sido modificado con exito", {status: 'success'}, {timeout: 5});
        }



        var active = '{{session('data')}}';
        if (active == 'active') {
            UIkit.notify("<i class='uk-icon-check'></i>  Tu perfil ha sido modificado con exito", {status: 'success'}, {timeout: 5});
        }

        var chart1 = c3.generate({
            bindto: '#chart1',
            data: {
                columns: [
                    ['Welcome', 300, 249, 400, 190, 200, 500, 450],
                    ['Joined', 250, 100, 389, 120, 100, 500, 450],
                    ['Requested', 200, 100, 300, 100, 450, 450, 420],
                    ['Loaded', 120, 100, 250, 80, 400, 450, 410],
                    ['Completed', 25, 90, 200, 60, 312, 400, 402]
                ],
                types: {
                    Welcome: 'area-spline',
                    Joined: 'area-spline',
                    Requested: 'area-spline',
                    Loaded: 'area-spline',
                    Completed: 'area-spline'
                    // 'line', 'spline', 'step', 'area', 'area-step' are also available to stack
                },
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#fff000']
            },
            donut: {
                title: "nombre"
            }
        });


        //        Interacciones Por Genero
        /*var chart = c3.generate({
         data: {
         xs: {
         'hombres': 'h',
         'mujeres': 'm',
         },
         columns: [
         ['hombres','5','10','15'],
         ['mujeres','3','10','15'],
         ['h', 10, 30, 15, 50, 70, 100],
         ['m', 30, 50, 15, 100, 120],
         ]
         },
         axis: {
         x: {
         label: 'Sepal.Width',
         tick: {
         fit: false
         }
         },
         y: {
         label: 'Petal.Width'
         }
         }
         });*/

        var chart2 = c3.generate({
            bindto: '#genderAge',
            data: {
                columns: [
                    ['Mujeres', 30, 200, 100, 400, 150, 250],
                    ['Hombres', -130, -100, -140, -200, -150, 50]
                ],
                groups: [
                    ['Mujeres', 'Hombres']
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
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78']
            },
            axis: {
                y: {
                    padding: {top: 10, bottom: 10}
                },
                rotated: true
            }
        });


        //        Interacciones por modelos
        var chart3 = c3.generate({
            bindto: '#chart3',
            data: {
                columns: [
                    ['Android', 30, 200, 200, 400, 150, 250],
                    ['Blackberry', 130, 100, 100, 200, 150, 50],
                    ['IOS', 230, 200, 200, 300, 250, 250],
                    ['Windows Phone', 230, 200, 200, 300, 250, 250],
                    ['other', 230, 200, 200, 300, 250, 250]
                ],
                type: 'bar',
                groups: [
                    ['Android', 'Blackberry', 'IOS', 'Windows Phone', 'other']
                ]
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                }
            }
        });

        //        Visitantes por edades
        var chart4 = c3.generate({
            bindto: '#chart4',
            data: {
                columns: [
                    ['<13-19', 130],
                    ['20-41', 12],
                    ['41-60', 1],
                    ['60+', 10]
                ],
                type: 'pie'
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

@stop