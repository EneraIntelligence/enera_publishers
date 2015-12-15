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
                <div class="uk-width-medium-1-3 uk-visible-small">
                    <div style="">
                        <h4 class="heading_a uk-margin-bottom">Información de presupuestos</h4>
                        <div class="md-card">
                            <div class="md-card-content">
                                <span class="uk-text-muted uk-text-small">Balance Actual</span>
                                <h2 class="uk-margin-remove uk-text-center" id="myTargetElement1">23</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-2-3">
                    <h4 class="heading_a uk-margin-bottom">Información de Movimientos </h4>
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
                <div class="uk-width-medium-1-3 uk-hidden-small" style="position: fixed;">
                    <div style="">
                        <h4 class="heading_a uk-margin-bottom">Información de presupuestos</h4>
                        <div class="md-card">
                            <div class="md-card-content">
                                <span class="uk-text-muted uk-text-small">Balance Actual</span>
                                <h2 class="uk-margin-remove uk-text-center" id="myTargetElement2">23</h2>
                                <span class="uk-text-muted uk-text-small">Agregar fondos</span>
                                <div class="uk-width-medium-1 uk-text-center">
                                    <a class="md-btn md-btn-primary" href="#">Paypal</a>
                                </div>
                                <span class="uk-text-muted uk-text-small">Fondos Camapañas Activas</span>
                                <div class="uk-width-large-1 uk-width-medium-1 uk-grid-margin">
                                    <ul class="md-list md-list-addon">
                                        <li>
                                            <div class="md-list-addon-element">
                                                <i class="md-list-addon-icon material-icons"></i>
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Heading</span>
                                                <span class="uk-text-small uk-text-muted">Beatae eos eos qui omnis ducimus at quia qui molestiae quaerat.</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-addon-element">
                                                <i class="md-list-addon-icon material-icons uk-text-success"></i>
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Heading</span>
                                                <span class="uk-text-small uk-text-muted">Dolore libero omnis et excepturi sit repellendus ex.</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-addon-element">
                                                <i class="md-list-addon-icon material-icons"></i>
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Heading</span>
                                                <span class="uk-text-small uk-text-muted">Eveniet et aperiam in eaque ut itaque cum.</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            var demo = new CountUp("myTargetElement2", 0, {{rand (  100 ,  10000 )}}, 2, 3.0, option);
            demo.start();

        })
    </script>
@stop
