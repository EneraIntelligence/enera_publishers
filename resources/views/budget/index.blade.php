@extends('layouts.main_materialize')
@section('title', ' - Budget')
@section('head_scripts')

    {!! HTML::style(asset('assets/css/budget.css')) !!}
@endsection
@stop
@section('content')
    {{--<div id="page_content">--}}
    {{--<div id="page_content_inner" style="padding-bottom: 20px;">--}}
    {{--<div class="uk-grid">--}}
    {{--<div class="uk-width-medium-1-3 uk-visible-small">--}}
    {{--<div style="margin: 10px 0 20px 0;">--}}
    {{--<h4 class="heading_a uk-margin-bottom">Información de presupuestos</h4>--}}
    {{--<div class="md-card">--}}
    {{--<div class="md-card-content">--}}
    {{--<span class="uk-text-muted uk-text-small">Balance Actual</span>--}}
    {{--<h2 class="uk-margin-remove uk-text-center" id="myTargetElement1">23</h2>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="uk-width-medium-2-3">--}}
    {{--<h4 class="heading_a uk-margin-bottom">Información de Movimientos </h4>--}}
    {{--<div class="md-card uk-margin-medium-bottom">--}}
    {{--<div class="md-card-content">--}}
    {{--<div class="uk-overflow-container">--}}
    {{--<table class="uk-table uk-text-nowrap">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th></th>--}}
    {{--<th>ID</th>--}}
    {{--<th>Concepto</th>--}}
    {{--<th>Monto</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach($movements as $movement)--}}
    {{--<tr class="budget">--}}
    {{--<td class="mov" data-uk-tooltip="{cls:'long-text'}"--}}
    {{--title="Aumento de fondos">--}}
    {{--@if($movement->movement['type'] == 'income')--}}
    {{--<i class="material-icons md-36 uk-text-success">trending_up</i>--}}
    {{--@elseif($movement->movement['type'] == 'income')--}}
    {{--<i class="material-icons md-36 uk-text-danger">trending_down</i>--}}
    {{--@endif--}}
    {{-- <i class="material-icons md-36 uk-text-primary">remove</i> --}}
    {{--</td>--}}
    {{--<td class="mov">{{ $movement->id }}</td>--}}
    {{--<td class="mov">--}}
    {{--<div class="md-list-content">--}}
    {{--<span class="md-list-heading">{{ $movement->movement['concept'] }}</span>--}}
    {{--<span class="uk-text-small uk-text-muted uk-text-truncate">--}}
    {{--<a href="{{route('analytics::single', ['id' => '56393f9aa8268b300d479644'])}}">Campaña </a>--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--</td>--}}
    {{--<td class="mov">--}}
    {{--<b>$ {{ number_format($movement->amount,2,'.',',') }}</b>--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="uk-width-medium-1-3 uk-hidden-small" style="position: fixed;">--}}
    {{--<div id="marco_presupuesto" >--}}
    {{--<h4 class="heading_a uk-margin-bottom">Información de presupuestos</h4>--}}
    {{--<div class="md-card uk-overflow-container">--}}
    {{--<div class="md-card-content ">--}}
    {{--<span class="uk-text-small">Balance actual</span>--}}
    {{--<h2 class="uk-text-center" id="myTargetElement2" style="margin: 10px;">23</h2>--}}
    {{--<span class="uk-text-small border-bottom">Agregar fondos</span>--}}
    {{--<div class="uk-width-medium-1 uk-text-center">--}}
    {{--<a class="md-btn md-btn-primary" href="{{ route("budget::deposits")}}"--}}
    {{--style="margin: 10px;">Agregar fondos</a>--}}
    {{--</div>--}}
    {{--<span class=" uk-text-small">Fondos camapañas activas</span>--}}
    {{--<div class="uk-width-large-1 uk-width-medium-1 uk-grid-margin">--}}
    {{--<ul class="md-list md-list-addon">--}}
    {{--<li style="height: 55px">--}}
    {{--<div class="md-list-addon-element">--}}
    {{--<i class="md-list-addon-icon material-icons uk-text-primary">--}}
    {{--&#xE918;--}}
    {{--</i>--}}
    {{--</div>--}}
    {{--<div class="md-list-content">--}}
    {{--<span class="md-list-heading">Total Asignado</span>--}}
    {{--<span class="uk-text-small uk-text-muted">--}}
    {{--$ {{ number_format($campaigns->sum('balance.current'),2,'.',',') }}--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--@foreach($campaigns as $campaign)--}}
    {{--<li>--}}
    {{--<div class="md-list-addon-element">--}}
    {{--<i class="md-list-addon-icon material-icons uk-text-success"></i>--}}
    {{--</div>--}}
    {{--<div class="md-list-content">--}}
    {{--<span class="md-list-heading">{{ $campaign->name }}</span>--}}
    {{--<span class="uk-text-small uk-text-muted">--}}
    {{--$ {{ number_format($campaign->balance['current'],2,'.',',') }}--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    <div class="container" style="width: 85%;">
        <div class="row">
            <div class="col s12 l4 hide-on-large-only" >
                <h4 class="heading_a">Información de presupuestos</h4>
                <div class="col s12" style="padding: 0;">
                    <div class="toc-wrapper" >
                        <div class="card white table-of-contents">
                            <div class="card-content black-text" >
                                <span class="text-small">Balance actual</span>
                                <h2 class="center-align amount" id="myTargetElement1" style="margin: 10px;"></h2>
                                <div class="uk-width-medium-1 center-align">
                                    <a class="waves-effect waves-light btn blue" href="{{ route("budget::deposits")}}"
                                       style="margin: 10px;">Agregar fondos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 l8">
                <h4 class="heading_a">Información de Movimientos</h4>
                <div class="col s12" style="padding: 0;">
                    <div class="card white">
                        <div class="card-content black-text"style="overflow-x:scroll;">
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
                                                <i class="material-icons md-36 green-text text-darken-2">trending_up</i>
                                            @elseif($movement->movement['type'] == 'outcome')
                                                <i class="material-icons md-36 red-text text-darken-2">trending_down</i>
                                            @else
                                                <i class="material-icons md-36 blue-text text-darken-2">remove</i>
                                            @endif
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
            <div class="col s12 l4 hide-on-med-and-down" colspan="">
                <h4 class="heading_a">Información de presupuestos</h4>
                <div class="col s12" style="padding: 0;">
                    <div class="toc-wrapper" >
                        <div class="card white table-of-contents" style="min-width: 320px;">
                            <div class="card-content black-text" >
                                <span class="text-small">Balance actual</span>
                                <h2 class="center-align amount" id="myTargetElement2" style="margin: 10px;"></h2>
                                <div class="uk-width-medium-1 center-align">
                                    <a class="waves-effect waves-light btn blue" href="{{ route("budget::deposits")}}"
                                       style="margin: 10px;">Agregar fondos</a>
                                </div>
                                <span class=" uk-text-small">Fondos camapañas activas</span>
                                <table class="balance">
                                    <tbody>
                                    <tr>
                                        <td class="p25" height="20">
                                            <i class="md-list-addon-icon material-icons blue-text">
                                                &#xE918;
                                            </i>
                                        </td>
                                        <td class="p75" height="20">
                                            <span class="td-heading">Total Asignado</span>
                    <span class="text-small text-muted">
                    $ {{ number_format($campaigns->sum('balance.current'),2,'.',',') }}
                    </span>
                                        </td>
                                    </tr>
                                    @foreach($campaigns as $campaign)
                                        <tr>
                                            <td height="20">
                                                <i class="md-list-addon-icon material-icons uk-text-success"></i>
                                            </td>
                                            <td height="20">
                                                <span class="td-heading">{{ $campaign->name }}</span>
                    <span class="text-small text-muted">
                    $ {{ number_format($campaign->balance['current'],2,'.',',') }}
                    </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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

            var balance = {!! $admin->wallet->current !!};
            var demo1 = new CountUp("myTargetElement1", 0, balance, 2, 3.0, option);
            var demo2 = new CountUp("myTargetElement2", 0, balance, 2, 3.0, option);
            demo1.start();
            demo2.start();
        });


        $('.tabs-wrapper').pushpin({ Top: 0, Bottom: 60,  Offset: 400});
        setTimeout(function() {
            var tocWrapperHeight = 260; // Max height of ads.
            var tocHeight = $('.toc-wrapper .table-of-contents').length ? $('.toc-wrapper .table-of-contents').height() : 0;
            var socialHeight = 95; // Height of unloaded social media in footer.
            var footerOffset = $('body > footer').first().length ? $('body > footer').first().offset().top : 0;
            var bottomOffset = footerOffset - socialHeight - tocHeight - tocWrapperHeight;

            if ($('nav').length) {
                $('.toc-wrapper').pushpin({
                    top: 130,
                    bottom: bottomOffset
                });
            }
            else if ($('#index-banner').length) {
                $('.toc-wrapper').pushpin({
                    top: 130,
                    bottom: bottomOffset
                });
            }
            else {
                $('.toc-wrapper').pushpin({
                    top: 0,
                    bottom: bottomOffset
                });
            }
        }, 100);
    </script>
@stop
