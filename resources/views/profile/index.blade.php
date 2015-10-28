@extends('layouts.main')

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
                                <img src="assets/img/avatars/avatar_11.png" alt="user avatar"/>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span
                                            class="uk-text-truncate">{!! $user->name !!}</span><span
                                            class="sub-heading">{!! $user->roles !!}</span>
                                </h2>
                                <ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a">{{$active}} <span class="sub-heading">Activas</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">{{$closed}} <span
                                                    class="sub-heading">Terminadas</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">{{$canceled}} <span class="sub-heading">Canceladas</span>
                                        </h4>
                                    </li>
                                </ul>
                            </div>
                            <a class="md-fab md-fab-small md-fab-accent" href="{!! url('profile/edit ') !!}">
                                <i class="material-icons">&#xE150;</i>
                            </a>
                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab"
                                data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}"
                                data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#">Cuenta</a></li>
                                {{--<li><a href="#">Graficas</a></li>--}}
                                <li><a href="#">Campañas</a></li>
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                    <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom"
                                         data-uk-grid-margin>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">Información</h4>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$user->email}}</span>
                                                        <span class="uk-text-small uk-text-muted">Correo</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$user->facebook}}</span>
                                                        <span class="uk-text-small uk-text-muted">Facebook</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{!! $user->linkedin !!}</span>
                                                        <span class="uk-text-small uk-text-muted">LinkedIn</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">&nbsp;</h4>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$user->phone}}</span>
                                                        <span class="uk-text-small uk-text-muted">Telefono</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{{$user->twitter}}</span>
                                                        <span class="uk-text-small uk-text-muted">Twitter</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-google-plus"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">{!! $user->googleplus !!}</span>
                                                        <span class="uk-text-small uk-text-muted">Google+</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </li>
                                <li>
                                    @if($all->count() <= 0)
                                        <div class="uk-alert uk-alert-danger" data-uk-alert="">
                                            {{--<a href="#" class="uk-alert-close uk-close"></a>--}}
                                            De momento no tienes ninguna campaña para mostrar, oprime el boton de crear para comenzar
                                        </div>

                                    @else
                                        <ul class="md-list">
                                            @foreach($all as $campaign)
                                                <li>
                                                    <div class="md-list-content">
                                                    <span class="md-list-heading"><a
                                                                href="#">{!! $campaign->name !!}</a></span>

                                                        <div class="uk-margin-small-top">
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE192;</i> <span
                                                            class="uk-text-muted uk-text-small">{!! Date('Y-m-d',strtotime($campaign->created_at)) !!}</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE0B9;</i> <span
                                                            class="uk-text-muted uk-text-small">{{$campaign->status}}</span>
                                                </span>
                                                <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE417;</i> <span
                                                            class="uk-text-muted uk-text-small">{{ $campaign->logs->count() }}</span>
                                                </span>
                                                        <span class="uk-margin-right">
                                                   <i class="material-icons">&#xE8D3;</i> <span
                                                                    class="uk-text-muted uk-text-small">{{ $campaign->administrator->name }}</span>
                                                </span>
                                                        <span class="uk-margin-right">
                                                    <i class="material-icons">&#xE865;</i> <span
                                                                    class="uk-text-muted uk-text-small">{{ $campaign->action }}</span>
                                                </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach

                                                <div class="uk-grid uk-grid-small">
                                                    <div class="uk-width-medium-1-6">
                                                        <a class="md-btn md-btn-flat md-btn-flat-primary" href="{!! url('campaigns/index') !!}">Ver graficas</a>
                                                    </div>
                                                    <div class="uk-width-medium-1-6">
                                                        <a class="md-btn md-btn-flat md-btn-flat-primary" href="{!! url('profile/charts ') !!}">Ver graficas</a>
                                                    </div>
                                                </div>

                                        </ul>

                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>

        var chart1 = c3.generate({
            bindto: '#chart1',
            data: {
                columns: [
                    ['data1', 30],
                    ['data2', 120],
                    ['data3', 300],
                    ['data4', 50]
                ],
                type: 'donut'
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78', '#2ca02c', '#98df8a', '#d62728', '#ff9896', '#9467bd', '#c5b0d5', '#8c564b', '#c49c94', '#e377c2', '#f7b6d2', '#7f7f7f', '#c7c7c7', '#bcbd22', '#dbdb8d', '#17becf', '#9edae5']
            },
            donut: {
                title: "Iris Petal Width"
            }
        });
    </script>
@stop