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
                                        <img style="background-image:none!important;margin:-96px 9px;background:transparent;border:none;"
                                             src="{!! URL::asset('images/icons/'. $cam['interaction']['name'].'2.svg') !!}"
                                             alt="producto"/>
                                    </div>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom">
                                    <span class="uk-text-truncate">{{ $data['name'] }} </span>
                                    <span class="sub-heading">{{ $data['interaction'] }}</span>
                                </h2>
                            </div>
                            <a data-uk-tooltip="{pos:'left'}" title="{!! $cam->status !!}"
                               class="md-fab md-fab-small md-fab-accent {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($cam->status) !!} ">
                                <i class="material-icons">{!! Publishers\Libraries\CampaignStyleHelper::getStatusIcon($cam->status) !!}</i>
                            </a>
                        </div>

                        <div class="uk-width-large-1-1 uk-margin-medium-top" style="display: inline-flex;">
                            <div class="uk-width-large-1-2 uk-margin-left ">
                                <select id="select-grafico" data-md-selectize>
                                    <option value="default">Seleciona un tipo de gráfica</option>
                                    <optgroup label="tipo">
                                        <option value="intPerDay">Interacciones por dia</option>
                                        <option value="genderAge">Generos y edades</option>
                                        <option value="so">sistemas operativos</option>
                                        <option value="intXHour">Interacciones por hora</option>
                                        <option value="a">Item A</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div id="wraper-print" class="uk-width-large-1-2 uk-margin-right">
                                <div id="print" class="uk-float-right" style="width: 50px;" data-uk-tooltip="{pos:'left'}" title="imprimir grafica">
                                    <i class="md-icon material-icons md-36 uk-float-right uk-margin-right" href="">print</i>
                                </div>
                            </div>
                        </div>

                        {{-- graficas --}}
                        <div  class="uk-width-large-1-1 uk-margin-top " style="height: 500px;">
                            <div id="grafica" style="width: 80%; margin: auto">
                                <div class="uk-margin-large-left">Grafica de {!! $data['graficname'] !!}</div>
                                <div id="{!! $data['type'] !!}" class="uk-width-large-1-1 uk-margin-right"></div>
                                {{--<div id="intPerHour" class="uk-width-large-1-1 uk-margin-right"></div>--}}
                                <div class="uk-width-large-1-2 uk-margin-left">

                                </div>
                                <div class="uk-width-1-1 uk-padding">
                                    <span class="uk-margin-large-left "> {{ $data['name'].'  2015/nov/18' }} </span>
                                </div>
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
        $(document).ready(function () {
            console.log("ready!");
//-----------------------------------------Imprimir reporte------------------------aclaracion---------------------
            $('#print').click(function () {
//                Popup($('#reporte').html());
                print($('#grafica').html());
            });

            function print(data) {
                $(data).printThis({
                    debug: false,              //* show the iframe for debugging
                    importCSS: true,           //!* import page CSS
                    printContainer: true,      //!* grab outer container as well as the contents of the selector
//                    loadCSS: "public/bower_components/kendo-ui-core/styles/kendo.common-material.min.css", //!* path to additional css file
//                    loadCSS: "public/bower_components/kendo-ui-core/styles/kendo.material.min.css", //!* path to additional css file
                    pageTitle: "Grafica",             //!* add title to print page
                    removeInline: false        //!* remove all inline styles from print elements
                });
            }
//                       funcion nativa
            function Popup(data) {
                var mywindow = window.open('', 'my div', 'height=600,width=800');
                mywindow.document.write('<html><head><title>my div</title>');
                /*optional stylesheet*/
                mywindow.document.write('<link rel="stylesheet" href="public/bower_components/kendo-ui-core/styles/kendo.common-material.min.css" type="text/css" />');
                mywindow.document.write('</head><body >');
                mywindow.document.write('prueba de impresion');
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
            var select = $("#select-grafico");
            $(select).change(function () {
                var tipo = select.val();
//                console.log("Handler for .change() called. " + tipo);
                var ruta = '{!! URL::route('analytics::single').'/'.$cam['_id'] !!}/'+tipo;
                console.log(ruta);
                window.location.href = ruta;
            });
//------------------------------------------Grafica---------------------------------------------
            var grafica = new graficas;
            var tipo = '{{$data['type']}}';
            var gra = '';
            switch (tipo) {
                case 'intPerDay':
                        console.log('inter per day');
                    var diasJson = '{!! isset($grafica['fecha']) ? json_encode($grafica['fecha']) : json_encode([0,0,0,0,0,0,0]) !!}';
                    var diasObj = JSON.parse(diasJson);
//                    console.log(diasObj);
                    var cntJson = '{!! isset($grafica['cnt']) ? json_encode($grafica['cnt']) : json_encode([0,10,0,10,0,0,0]) !!}';
                    var cntObj = JSON.parse(cntJson);
//                    console.log(cntObj);
                    gra = grafica.intPerDay(diasObj,cntObj);
                    break;
                case 'genderAge':
                    var menJson = '{!! isset($grafica['men']) ? json_encode($grafica['men']) : json_encode([0,0,0,0,0,0,0]) !!}';
                    var menObj = JSON.parse(menJson);
                    var womenJson = '{!! isset($grafica['women']) ? json_encode($grafica['women']) : json_encode([0,0,0,0,0,0,0]) !!}';
                    var womenObj = JSON.parse(womenJson);
                    gra = grafica.genderAge(menObj, womenObj);
                    break;
                case 'so':
                    console.log('so');
                    break;
                case 'intXHour':
                    console.log('intXHour');
                    var intLJson = '{!! json_encode($grafica) !!}';
                    var intLObj = JSON.parse(intLJson);
//                        console.log(intLObj);
                    gra = grafica.intPerHour(intLObj);
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