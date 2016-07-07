@extends('layout.main')

@section('title', 'Buscar')

@section('head_scripts')
    <style>
        li.nav {
            width: 100% !important;
        }
    </style>
@stop

@section('content')

    <div id="page_content">
        <div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">
            <div class="heading_actions" style="margin-right: 8%">
                <a href="javascript:void(0) " data-uk-tooltip="{pos:'bottom'}" title="Search"
                   data-uk-modal="{target:'#my-id'}"><i class="material-icons">&#xE8B6;</i></a>
                {{--<a href="#" data-uk-tooltip="{pos:'bottom'}" title="Print"><i class="md-icon material-icons">--}}
                        {{--&#xE8AD;</i></a>--}}
                <div data-uk-dropdown>
                    <i class="md-icon material-icons">&#xE5D4;</i>
                    <div class="uk-dropdown uk-dropdown-small">
                        <ul class="uk-nav">
                            <li><a href="#">Imprimir</a></li>
                            <li><a href="#">Other Action</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <h1 style="width: 80%;margin: auto;">Campañas</h1>
             <span style="margin-left: 10%;" class="uk-text-upper uk-text-small">Resultados de las busqueda </span>
        </div>
        <div id="page_content_inner">
            <div class="md-card-list-wrapper" id="mailbox">
                <div class="uk-width-large-8-10 uk-container-center">
                    <div class="md-card-list">
                        <ul class="hierarchical_slide">
                            <li>
                                <span class="md-card-list-item-date">Terminación</span>
                                <span class="md-card-list-item-date">Loaded</span>
                                <div class="md-card-list-item-avatar-wrapper">
                                    <img src="assets/img/avatars/avatar_08_tn@2x.png" style="background: none;"
                                         class="md-card-list-item-avatar dense-image dense-ready" alt="">
                                </div>
                                <div class="md-card-list-item-sender">
                                    <span>Nombre</span>
                                </div>
                                <div class="md-card-list-item-subject">
                                    <span>Días de interacción</span>
                                </div>
                            </li>
                        </ul>
                        <ul class=""
                            data-uk-grid="{controls: '#campaign-filter, #action-filter, #campaign-sort' }">
                            @foreach($campaigns as $campaign)
                                <li class="nav" style=" cursor: pointer; width: 100%; !important;"
                                    onclick="window.location.href='{!! route('campaigns::show', [$campaign->id]) !!}'"
                                    data-uk-filter="campaign-{!! $campaign->status !!}, action-{!! $campaign->interaction['name'] !!}"
                                    data-name="{!! $campaign->name !!}"
                                    data-action="{!! $campaign->interaction['name'] !!}"
                                    data-company="{!! $campaign->publishers_summary['client'] !!}"
                                    data-status="{!! CampaignStyle::getStatusValue( $campaign->status )  !!}"
                                    data-date="{!! $campaign->created_at !!}">
                                    <span class="md-card-list-item-date">{{date('Y-m-d',$campaign->filters['date']['end']->sec)}}</span>
                                    <span class="md-card-list-item-date"
                                          style="margin-right: 25px;">{{$campaign->logs()->where('interaction.loaded', 'exists', 'true')->count()}}</span>
                                    <div class="md-card-list-item-avatar-wrapper">
                                        <img src="{!! URL::asset('images/icons/'.CampaignStyle::getCampaignIcon( $campaign->interaction['name'] ) ) !!}2.svg"
                                             style="background: {!! CampaignStyle::getStatusColor($campaign->status) !!};border: solid 1px {!! CampaignStyle::getStatusColor($campaign->status) !!};"
                                             class="md-card-list-item-avatar dense-image dense-ready" alt="">
                                    </div>
                                    <div class="md-card-list-item-sender">
                                        <span>{{$campaign->name}}</span>
                                    </div>
                                    <div class="md-card-list-item-subject">
                                        <span>
                                            @if(isset($campaign->filters['week_days'] ))
                                                @foreach($campaign->filters['week_days'] as $dia)
                                                    <span class="uk-badge uk-badge-notification uk-badge-primary"
                                                          style="background:#2196f3 !important; margin-right:10px ">{{ substr(trans('days.'.$dia), 0, 1) }}</span>
                                                @endforeach
                                            @else
                                                no definido
                                            @endif</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- This is the modal -->
    <div id="my-id" class="uk-modal">
        <div class="uk-modal-dialog">
            <h3 class="uk-panel-title">Buscar...</h3>
            <form action="{!! route('campaigns::search::campaign') !!}" class="uk-form-stacked" method="post" id="form"
                  data-parsley-validate
                  enctype="multipart/form-data">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-2-3">
                        <div class="parsley-row">
                            <input type="text" name="search" required class="md-input"/>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-3" style="text-align: center;">
                        <div class="parsley-row">
                            <button type="submit" class="md-btn md-btn-primary">Buscar</button>
                        </div>
                    </div>
                </div>
                {{--<div class="uk-grid">--}}
                    {{--<div class="uk-width-1-1">--}}
                        {{--<button type="submit" class="md-btn md-btn-primary">Buscar</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    {!! HTML::script('bower_components/parsleyjs/dist/parsley.min.js') !!}
    {!! HTML::script('bower_components/parsleyjs/src/i18n/es.js') !!}
    {!! HTML::script('assets/js/pages/forms_validation.min.js') !!}
    <script>
        $("li.nav").css('width', '100%');
    </script>

@stop

