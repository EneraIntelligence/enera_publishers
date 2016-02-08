@extends('layouts.main')
@section('title', ' - Analytics')
@section('head_scripts')
    {!! HTML::style(asset('assets/css/analytics.css')) !!}
@stop


@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-1">
                    <div class="md-card">
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
                                    <div id="circle">
                                        {{--<img style="background-image:none!important;margin:-96px 9px;"--}}
                                             {{--src="{!! URL::asset('images/icons/'.$interaction['name'].'.svg') !!}"--}}
                                             {{--alt="producto"/>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span
                                            class="uk-text-truncate"> </span><span
                                            class="sub-heading"></span>
                                </h2>
                            </div>
                            {{--<a class="md-fab md-fab-small md-fab-accent {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($status) !!}"
                               style="background: {!! Publishers\Libraries\CampaignStyleHelper::getStatusColor($status) !!}">  --}}{{-- href="page_user_edit.html" --}}{{--
                                <i class="material-icons">{!! Publishers\Libraries\CampaignStyleHelper::getStatusIcon($status) !!}</i>
                            </a>--}}
                        </div>
                        <div class="uk-grid uk-margin-medium-top uk-width-large-1-1 " data-uk-grid-margin>
                            <div id="chart1" class="uk-width-large-1-2">

                            </div>
                            <div class="uk-width-large-1-2">

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
    {!! HTML::style('css/show.css') !!}
    <script>

    </script>
@stop
