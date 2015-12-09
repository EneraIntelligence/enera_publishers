
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
                                             src="{!! URL::asset('images/icons/'. $data['interaction']['name'].'.svg') !!}"
                                             alt="producto"/>
                                    </div>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom">
                                    <span class="uk-text-truncate">{{ $data['name'] }} </span>
                                    <span class="sub-heading">{{ $data['interaction']['name'] }}</span>
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
                            <div class="uk-margin-large-left">Grafica de {!! $data['type'] !!}</div>
                            <div id="{!! $data['type'] !!}" class="uk-width-large-1-1 uk-margin-right">

                            </div>
                            <div class="uk-width-large-1-2 uk-margin-left">

                            </div>
                            <div class="uk-width-1-1 uk-padding">
                                <span class="uk-margin-large-left "> {{ $data['name'].'  2015/nov/18' }} </span>
                            </div>
                        </div>
                            <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stop

    @section('scripts')

            <!-- slider script -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    {!! HTML::script('bower_components/ionrangeslider/js/ion.rangeSlider.min.js') !!}
    {!! HTML::script('bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') !!}
    {!! HTML::script('js/circle-progress.js') !!}
    {!! HTML::script('js/ajax/graficas.js') !!}
    {!! HTML::script('js/printThis.js') !!}
    <script>
        $( document ).ready(function() {
            console.log( "ready!" );
//-----------------------------------------Imprimir reporte------------------------aclaracion---------------------
            $('#print').click(function() {
                Popup($('#reporte').html());
//                print($('#reporte'));
            });



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

//----------------------------Codigo para la animación del circulo---------------------------------------------
            $('#circle').circleProgress({ //se pasa como parametro el id o elemento que se va animar
                value: {!! $data['porcentaje'] !!}, //lo que se va a llenar con el color
                size: 98,   //tamaño del circulo
                startAngle: -300, //de donde va a empezar la animacion
                reverse: true, //empieza la animacion al contrario
                thickness: 8,  //el grosor la linea
                fill: {color: "{!! Publishers\Libraries\CampaignStyleHelper::getStatusColor('active') !!}"} //el color de la linea
            }).on('circle-animation-progress', function (event, progress) {
                $(this).find('strong').html(parseInt(100 * progress) + '<i>%</i>');
            }); //fin del codigo de animacion de circulo

            //-------------------------------- TIPO de grafica --------------------------------------
            var select= $( "#select-grafico" );
            $(select).change(function() {
                var tipo = select.val();
                console.log( "Handler for .change() called. "+tipo );
                window.location.href = 'http://localhost:8000/analytics/5638f436a8268b300d479642/'+tipo;
            });
//------------------------------------------Grafica---------------------------------------------
            var grafica = new graficas;
            var tipo = '{{$data['type']}}';

            switch ( tipo ) {
                case 'intPerDay':
                    var gra= grafica.intPerDay(5,4,5,1,2);
                    break;
                case 'genderAge':
                    var gra= grafica.genderAge({!! json_encode($data['grafica']) !!});
                    break;
                case 'so':
                    var gra= grafica.so({!! json_encode($data['grafica']) !!});
                    break;
            }
        }); // ----------------------------- termina document ready -----------------

//         ----------------------------- alertas  -----------------
        var active = '{{session('data')}}';
        if (active == 'active') {
            UIkit.notify("<i class='uk-icon-check'></i>  Tu perfil ha sido modificado con exito", {status: 'success'}, {timeout: 5});
        }
    </script>
@stop

@stop