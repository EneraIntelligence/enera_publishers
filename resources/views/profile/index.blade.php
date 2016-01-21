@extends('layouts.main')
@section('title', ' - Perfil')
@section('head_scripts')
    {!! HTML::style(asset('assets/css/profile.css')) !!}
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
                                    <img  id="img"
                                         src="https://s3-us-west-1.amazonaws.com/enera-publishers/avatars/{!! isset($user->image) ? $user->image : 'user.png'!!}" alt="User avatar"/>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span
                                            class="uk-text-truncate">{!! $user->name['first'] . " " . $user->name['last'] !!}</span><span
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
                            <div class="uk-grid uk-grid-collapse">
                                <div class="uk-width-small-1-2">
                                    <h3>
                                        Informacíon
                                    </h3>
                                    <ul class="md-list md-list-addon">
                                        <li>
                                            <div class="md-list-addon-element">
                                                <i class="uk-icon-at uk-icon-medium"></i>
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
                                                <span class="md-list-heading">{{$user->socialnetwork['facebook']}}</span>
                                                <span class="uk-text-small uk-text-muted">Facebook</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-addon-element">
                                                <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">{!! $user->socialnetwork['linkedin'] !!}</span>
                                                <span class="uk-text-small uk-text-muted">LinkedIn</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-addon-element">
                                                <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">{{$user->phones['number']}}</span>
                                                <span class="uk-text-small uk-text-muted">Telefono {{$user->phones['type']}}</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-addon-element">
                                                <i class="md-list-addon-icon uk-icon-twitter"></i>
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">{{$user->socialnetwork['twitter']}}</span>
                                                <span class="uk-text-small uk-text-muted">Twitter</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-addon-element">
                                                <i class="md-list-addon-icon uk-icon-google-plus"></i>
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">{!! $user->socialnetwork['googleplus'] !!}</span>
                                                <span class="uk-text-small uk-text-muted">Google+</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <div id="chart1" style="margin: 75px 0 15px 0;"></div>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <h3>
                                        Campañas
                                    </h3>
                                    @if($all->count() < 1)

                                        <div class="uk-alert uk-alert-danger" data-uk-alert="">
                                            De momento no tienes ninguna campaña para mostrar, oprime el boton de crear
                                            para comenzar
                                        </div>

                                    @else
                                        <ul class="md-list">
                                            @foreach($all as $campaign)
                                                <hr>
                                                <li>
                                                    <div class="md-list-content">
                                    <span class="md-list-heading"><a
                                                href="{!! url('campaigns/view/'. $campaign->_id) !!}">{!! $campaign->name !!}</a></span>

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
                                                class="uk-text-muted uk-text-small">{{ $campaign->administrator->name['first'] . ' ' . $campaign->administrator->name['last']}}</span>
                                    </span>
                                    <span class="uk-margin-right">
                                    <i class="material-icons">&#xE865;</i> <span
                                                class="uk-text-muted uk-text-small">{{ $campaign->interaction['name'] }}</span>
                                    </span>
                                                        </div>
                                                    </div>
                                                </li>
                                        </ul>
                                        @endforeach
                                        <hr>
                                    @endif
                                </div>
                                <div class="uk-width-small-1-2">
                                    <div id="chart2" style="margin: 75px 0 15px 0;"></div>
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
    <script>

        var active = '{{session('data')}}';
        if(active=='active')
        {
            UIkit.notify("<i class='uk-icon-check'></i>  Tu perfil ha sido modificado con exito", {status:'success'},{timeout: 5});
        }

        var active = '{{session('pass')}}';
        if(active=='active')
        {
            UIkit.notify("<i class='uk-icon-check'></i>  Tu contraseña ha sido modificado con exito", {status:'success'},{timeout: 5});
        }

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
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78']
            },
            donut: {
                title: "nombre"
            }
        });

        var chart2 = c3.generate({
            bindto: '#chart2',
            data: {
                columns: [
                    ['data1', 30, 200, 100, 400, 150, 250, 200, 100, 400, 150, 250, 30, 200, 100, 400, 150],
                    ['data2', 50, 20, 10, 40, 15, 25, 200, 30, 200, 100, 400, 150, 100, 400, 150, 250],
                    ['data3', 50, 20, 150, 40, 15, 250, 20, 30, 200, 100, 40, 150, 100, 400, 150, 250]
                ],
                axes: {
                    data1: 'y',
                    data2: 'y2',
                    data3: 'y'
                }
            },
            color: {
                pattern: ['red', '#aec7e8', '#ff7f0e', '#ffbb78']
            },
            axis: {
                y: {
                    padding: {top: 200, bottom: 0}
                },
                y2: {
                    padding: {top: 100, bottom: 100},
                    show: true
                }
            }
        });

        $("#phone_number").kendoMaskedTextBox({
            mask: "(99) 0000-0000"
        });
    </script>
@stop