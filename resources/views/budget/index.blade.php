@extends('layouts.main')
@section('title', ' - Budget')
@section('head_scripts')
    <style>
        .mov {
            vertical-align: middle !important;
        }

        .budget:hover {
            background-color: #90caf9;
        }
    </style>
@stop
@section('content')
    <div id="page_content">
        <div id="page_content_inner" style="padding-bottom: 20px;">
            <div class="uk-grid">
                <div class="uk-width-medium-1-3">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span
                                        class="peity_visitors peity_data" style="display: none;">5,3,9,6,5,9,7</span>
                                <svg class="peity" height="28" width="48">
                                    <rect fill="#d84315" x="1.3714285714285717" y="12.444444444444443"
                                          width="4.114285714285715" height="15.555555555555557"></rect>
                                    <rect fill="#d84315" x="8.228571428571428" y="18.666666666666668"
                                          width="4.114285714285716" height="9.333333333333332"></rect>
                                    <rect fill="#d84315" x="15.085714285714287" y="0" width="4.1142857142857086"
                                          height="28"></rect>
                                    <rect fill="#d84315" x="21.942857142857147" y="9.333333333333336"
                                          width="4.114285714285707" height="18.666666666666664"></rect>
                                    <rect fill="#d84315" x="28.800000000000004" y="12.444444444444443"
                                          width="4.114285714285707" height="15.555555555555557"></rect>
                                    <rect fill="#d84315" x="35.65714285714286" y="0" width="4.114285714285707"
                                          height="28"></rect>
                                    <rect fill="#d84315" x="42.51428571428572" y="6.222222222222221"
                                          width="4.114285714285707" height="21.77777777777778"></rect>
                                </svg>
                            </div>
                            <span class="uk-text-muted uk-text-small">Balance</span>
                            <h2 class="" id="myTargetElement1" style="margin: 0;">2,638</h2>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><span
                                        class="peity_orders peity_data" style="display: none;">64/100</span>
                                <svg class="peity" height="24" width="24">
                                    <path d="M 12 0 A 12 12 0 1 1 2.7538410866905263 19.649087876984275 L 7.376920543345263 15.824543938492138 A 6 6 0 1 0 12 6"
                                          fill="#8bc34a"></path>
                                    <path d="M 2.7538410866905263 19.649087876984275 A 12 12 0 0 1 11.999999999999998 0 L 11.999999999999998 6 A 6 6 0 0 0 7.376920543345263 15.824543938492138"
                                          fill="#eee"></path>
                                </svg>
                            </div>
                            <span class="uk-text-muted uk-text-small">---</span>
                            <h2 class="" id="myTargetElement1" style="margin: 0;">2,638</h2>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div style="">
                        <div class="md-card">
                            <div class="md-card-content">
                                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span
                                            class="peity_live peity_data" style="display: none;">4,6,9,4,10,4,8,4,5,2,4,3,1,5,8,4,0,9,4,6</span>
                                    <svg class="peity" height="28" width="64">
                                        <polygon fill="#efebe9"
                                                 points="0 27.5 0 16.7 3.3684210526315788 11.3 6.7368421052631575 3.1999999999999993 10.105263157894736 16.7 13.473684210526315 0.5 16.842105263157894 16.7 20.210526315789473 5.899999999999999 23.57894736842105 16.7 26.94736842105263 14 30.31578947368421 22.1 33.68421052631579 16.7 37.05263157894737 19.4 40.421052631578945 24.8 43.78947368421052 14 47.1578947368421 5.899999999999999 50.526315789473685 16.7 53.89473684210526 27.5 57.263157894736835 3.1999999999999993 60.63157894736842 16.7 64 11.3 64 27.5"></polygon>
                                        <polyline fill="none"
                                                  points="0 16.7 3.3684210526315788 11.3 6.7368421052631575 3.1999999999999993 10.105263157894736 16.7 13.473684210526315 0.5 16.842105263157894 16.7 20.210526315789473 5.899999999999999 23.57894736842105 16.7 26.94736842105263 14 30.31578947368421 22.1 33.68421052631579 16.7 37.05263157894737 19.4 40.421052631578945 24.8 43.78947368421052 14 47.1578947368421 5.899999999999999 50.526315789473685 16.7 53.89473684210526 27.5 57.263157894736835 3.1999999999999993 60.63157894736842 16.7 64 11.3"
                                                  stroke="#5d4037" stroke-width="1" stroke-linecap="square"></polyline>
                                    </svg>
                                </div>
                                <span class="uk-text-muted uk-text-small">Visitors (live)</span>
                                <h2 class="uk-margin-remove" id="peity_live_text">23</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="page_content_inner" style="padding-bottom: 20px;">
            <div class="uk-grid">
                <div class="uk-width-medium-1">
                    <h4 class="heading_a uk-margin-bottom">Responsive Table</h4>
                    <div class="md-card uk-margin-medium-bottom">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Icono</th>
                                        <th>ID</th>
                                        <th>Movimiento</th>
                                        <th>Concepto</th>
                                        <th>Monto</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td>Icono</td>
                                        <td>ID</td>
                                        <td>Movimiento</td>
                                        <td>Concepto</td>
                                        <td>Monto</td>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <tr class="budget">
                                        <td class="mov">
                                            <i class="material-icons md-36 uk-text-success">trending_up</i>
                                        </td>
                                        <td class="mov">#345q345</td>
                                        <td class="mov">123568</td>
                                        <td class="mov">
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Consequatur nobis sint.</span>
                                                <span class="uk-text-small uk-text-muted uk-text-truncate"><a
                                                            href="{{route('analytics::single', ['id' => '56393f9aa8268b300d479644'])}}">Campaña </a></span>
                                            </div>
                                        </td>
                                        <td class="mov" id="">0</td>
                                    </tr>
                                    <tr class="budget">
                                        <td class="mov">
                                            <i class="material-icons md-36 uk-text-primary">remove</i>
                                        </td>
                                        <td class="mov">#345q345</td>
                                        <td class="mov">123568</td>
                                        <td class="mov">
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Consequatur nobis sint.</span>
                                                <span class="uk-text-small uk-text-muted uk-text-truncate"><a
                                                            href="{{route('budget::invoices', ['id' => '56393f9aa8268b300d479644'])}}">Invoice
                                                        # 56393f9aa8268b300d479644</a></span>
                                            </div>
                                        </td>
                                        <td class="mov" id="">0</td>
                                    </tr>
                                    <tr class="budget">
                                        <td class="mov">
                                            <i class="material-icons md-36 uk-text-danger">trending_down</i>
                                        </td>
                                        <td class="mov">#345q345</td>
                                        <td class="mov">123568</td>
                                        <td class="mov">
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Consequatur nobis sint.</span>
                                                <span class="uk-text-small uk-text-muted uk-text-truncate">Qui quis minima dignissimos ab.</span>
                                            </div>
                                        </td>
                                        <td class="mov" id="">0</td>
                                    </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php $ids = [1, 2, 3, 4, 5]?>

@stop

@section('scripts')
    {!! HTML::script('bower_components/countUp.js/countUp.js') !!}
    <script>
        $(document).ready(function () {
            var option = {
                useEasing: false,
                useGrouping: true,
                separator: ',',
                decimal: '.',
                prefix: '$  ',
                suffix: ' MXN'
            };

            var demo = new CountUp("myTargetElement1", 0, {{rand (  100 ,  10000 )}}, 2, 3.0, option);
            demo.start();

        })

    </script>
@stop
