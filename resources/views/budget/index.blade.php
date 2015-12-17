@extends('layouts.main')
@section('title', ' - Budget')
@section('head_scripts')
    <style>
        .mov {
            vertical-align: middle !important;
        }

        .budget:hover {
            background-color: #e3f2fd;
        }

        .border-bottom {
            margin-bottom: 10px;
        }
    </style>
@stop
@section('content')
    <div id="page_content">
        <div id="page_content_inner" style="padding-bottom: 20px;">
            <div class="uk-grid">
                <div class="uk-width-medium-1-3 uk-visible-small">
                    <div style="margin: 10px 0 20px 0;">
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
                                        <th></th>
                                        <th>ID</th>
                                        <th>Concepto</th>
                                        <th>Monto</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($movements as $movement)
                                        <tr class="budget">
                                            <td class="mov" data-uk-tooltip="{cls:'long-text'}"
                                                title="Aumento de fondos">
                                                @if($movement->movement['type'] == 'income')
                                                    <i class="material-icons md-36 uk-text-success">trending_up</i>
                                                @elseif($movement->movement['type'] == 'income')
                                                    <i class="material-icons md-36 uk-text-danger">trending_down</i>
                                                @endif
                                                {{-- <i class="material-icons md-36 uk-text-primary">remove</i> --}}
                                            </td>
                                            <td class="mov">{{ $movement->id }}</td>
                                            <td class="mov">
                                                <div class="md-list-content">
                                                    <span class="md-list-heading">{{ $movement->movement['concept'] }}</span>
                                                    <span class="uk-text-small uk-text-muted uk-text-truncate">
                                                        <a href="{{route('analytics::single', ['id' => '56393f9aa8268b300d479644'])}}">Campaña </a>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="mov">
                                                <b>$ {{ number_format($movement->amount,2,'.',',') }}</b>
                                            </td>
                                        </tr>
                                    @endforeach
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
                                <span class="uk-text-small">Balance actual</span>
                                <h2 class="uk-text-center" id="myTargetElement2" style="margin: 10px;">23</h2>
                                <span class="uk-text-small border-bottom">Agregar fondos</span>
                                <div class="uk-width-medium-1 uk-text-center">
                                    <a class="md-btn md-btn-primary" href="#" style="margin: 10px;">Paypal</a>
                                </div>
                                <span class=" uk-text-small">Fondos camapañas activas</span>
                                <div class="uk-width-large-1 uk-width-medium-1 uk-grid-margin">
                                    <ul class="md-list md-list-addon">
                                        <li>
                                            <div class="md-list-addon-element">
                                                <i class="md-list-addon-icon material-icons"></i>
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Total Asignado</span>
                                                <span class="uk-text-small uk-text-muted">$ {{  }}</span>
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

            var balance = {{ $admin->balance['current'] }};
            var demo1 = new CountUp("myTargetElement1", 0, balance, 2, 3.0, option);
            var demo2 = new CountUp("myTargetElement2", 0, balance, 2, 3.0, option);
            demo1.start();
            demo2.start();
        })
    </script>
@stop
