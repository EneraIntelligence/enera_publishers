@extends('layouts.main')
@section('title', ' - Budget')
@section('head_scripts')
    <style>
        .mov {
            vertical-align: middle !important;
        }

        .budget:hover {
            background-color: #D8D8D8;
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
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                            <span class="uk-text-muted uk-text-medium">Balance</span>
                            <h2 class="uk-margin-remove uk-text-center" id="myTargetElement1">0</h2>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="md-card">
                        <div class="md-card-content">

                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div style="">
                        <div class="md-card">
                            <div class="md-card-content">
                                <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                                <span class="uk-text-muted uk-text-small">Visitors (last 7d)</span>
                                <h2 class="uk-margin-remove"><span class="countUpMe">0</span></h2>
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
                                        <th>Balance</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td>Icono</td>
                                        <td>ID</td>
                                        <td>Movimiento</td>
                                        <td>Concepto</td>
                                        <td>Balance</td>
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
                                        <td class="mov" id="myTargetElement2">0</td>
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
                                        <td class="mov" id="myTargetElement3">0</td>
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
                                        <td class="mov" id="myTargetElement4">0</td>
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
                    @foreach($ids as $id)
            var demo = new CountUp("myTargetElement{{$id}}", 0, {{rand (  100 ,  10000 )}}, 2, 3.0, option);
            demo.start();
            @endforeach
        })

    </script>
@stop
