@extends('layouts.main_materialize')
@section('title', ' Campañas')
@section('head_scripts')
    {!! HTML::style(asset('assets/css/campaign.css')) !!}
@endsection
@section('content')
    <div class="container">
        <div class="col 12 margin-breadcrumb hide-on-small-only">
            <div class="col s6">
                <a href="{{route('home')}}" class="breadcrumb">Home</a>
                <a href="javascript:void(0)" class="breadcrumb">Campañas</a>
            </div>
        </div>

        <div class="col 12">
            <h5 class="hide-on-med-and-up">Campañas</h5>
            @if(count($campaigns) <= 0)
                <div class="card white">
                    <div class="card-content black-text center-align">
                        <img src="{!! URL::asset('images/icons/banner_new.svg') !!}" alt="">

                        <h4 class="heading_a"><br>
                            <span></span>
                        </h4>

                        <a class="md-btn md-btn-primary" href="#" onclick="new_campaign.prompt()">
                            ¡Crea tu primer campaña!
                        </a>
                    </div>
                </div>
            @else
                <div class="row">

                    @foreach($campaigns as $campaign)


                        <div class="col s12 m6 l4">

                            <div class="card">
                                <div style="margin-left:87px;">
                                    <img class="thumb" src="{{"https://s3-us-west-1.amazonaws.com/enera-publishers/items/". ($campaign->interaction['name'] != 'survey' ? $campaign->content['images']['large'] : $campaign->content['images']['survey'])}}">
                                    <strong>{{$campaign->name}} <br> </strong>
                            <span>
                            Vistos: 100 <br>
                            Interacciones:12
                            </span>
                                </div>
                                <div class="divider"></div>
                                <div class="card-footer">
                            <span class="grey-text bottom-left" style="margin-left:87px;">
                            {{ trans( "campaigns.interaction.".$campaign->interaction['name'] ) }}
                            </span>
                                    <a class="bottom-right" style="margin-right:10px;"
                                       href="{{route('campaigns::show', ['id' => $campaign->id])}}">
                                        Detalles
                                    </a>
                                </div>
                            </div> <!-- end card -->
                        </div> <!-- end col s12 -->
                    @endforeach
                </div><!-- end row -->
            @endif
        </div>
    </div>
@stop

@section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
        var error = '{{session('data')}}';
        if (error == 'NoMail') {
            UIkit.notify("<i class='material-icons uk-icon-large'> &#xE002; </i> &nbsp;&nbsp;No puedes mandar correos de la subcamapaña dado que la campaña no tiene correos asignados <span style='float:right'><i class='material-icons uk-icon-large'> clear </i></span>", {
                timeout: 0,
                status: 'danger'
            });
        }
        var send = '{{session('data')}}';
        if (error == 'errorCamp') {
            UIkit.notify(" &nbsp;&nbsp;la campaña no existe o no es tuya <span style='float:right'><i class='material-icons uk-icon-large'> clear </i></span>", {
                timeout: 0,
                status: 'danger'
            });
        }

        var send = '{{session('data')}}';
        if (send == 'send') {
            UIkit.notify("<i class='material-icons uk-icon-large'> &#xE877; </i> &nbsp;&nbsp;Tus correos se han enviado <span style='float:right'><i class='material-icons uk-icon-large'> clear </i></span>", {
                timeout: 0,
                status: 'success'
            });
        }
        <!--     codigo de la grafica   -->
                @foreach($campaigns as $campaign => $valor)

        var dia1 = 0;
        var dia2 = 0;
        var dia3 = 0;
        var dia4 = 0;
        var dia5 = 0;
        var dia6 = 0;
        var dia7 = 0;
        var chart = c3.generate({
            bindto: '#chart_{!! $valor->_id !!}',
            data: {
                x: 'x',
                columns: [
                        {{--['x','{!! $grafica[$campaign]['dia1']['fecha'] !!}','{!! $grafica[$campaign]['dia2']['fecha'] !!}','{!!$grafica[$campaign]['dia3']['fecha'] !!}','{!! $grafica[$campaign]['dia4']['fecha'] !!}','{!!$grafica[$campaign]['dia5']['fecha']!!}','{!!$grafica[$campaign]['dia6']['fecha']!!}','{!!$grafica[$campaign]['dia7']['fecha']!!}'],--}}
                    ['x', '0', '0', '0', '0', '0', '0', '0'],
                    //                            ['interacciones por dia '],
                    ['interacciones', dia1, dia2, dia3, dia4, dia5, dia6, dia7]
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
                },
                x: {
                    type: 'timeseries',
                    tick: {
                        format: '%d'
                        //                                format: '%Y-%m-%d'
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