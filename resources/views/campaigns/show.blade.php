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
                                <div>
                                    <img style="background-image:none!important;" src="{!! URL::asset('images/icons/'.$interaction['name'].'.svg') !!}" alt="producto"/>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span
                                            class="uk-text-truncate">Campaña: {{ $name }} </span><span class="sub-heading">interaccion {{ $interaction['name'] }}</span>
                                </h2>

                                <div class="uk-width-medium-1-1">
                                    <div class="uk-progress">
                                        <div class="uk-progress-bar" style="width: 40%; background:{{$color}}";></div>
                                    </div>
                                </div>

                            </div>
                            <a class="md-fab md-fab-small md-fab-accent {{ $color }}" style="background: {{ $color }}">  {{-- href="page_user_edit.html" --}}
                                <i class="material-icons">{{ $icon }}</i>
                            </a>
                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-switcher uk-margin" data-uk-tab="{connect:'#user_profile_tabs_content'}">
                                <li>
                                    <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">Información</h4>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="">nombre</a></span>
                                                        <span class="uk-text-small uk-text-muted">{{$name}}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="">estado</a></span>
                                                        <span class="uk-text-small uk-text-muted">{{$status}}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">balance</a></span>
                                                        <span class="uk-text-small uk-text-muted">{{$balance['current']}}</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="">Tipo de interacon</a></span>
                                                        <span class="uk-text-small uk-text-muted">{{$interaction['name']}}</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">Filtros</h4>
                                            <ul class="md-list">
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Rango de Edad</a></span>
                                                        <span class="uk-text-small uk-text-muted">{{$filters['age'][0].' a '.$filters['age'][1]}} </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Generos</a></span>
                                                        <span class="uk-text-small uk-text-muted">{{$filters['gender'][0]}}, @if(isset($filters['gender'][1])){{$filters['gender'][1]}}  @endif</span>
                                                        {{--{{$filters['gender'][0].',  '.$filters['gender'][1]}}--}}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Horas</a></span>
                                                        <span class="uk-text-small uk-text-muted">@foreach($filters['day_hours'] as $hora) {{$hora}}, @endforeach</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#"> usuario unico </a></span>
                                                        <span class="uk-text-small uk-text-muted"> {{$filters['unique_user']}} </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div style="display: block">reportes</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')


    <script>


    </script>
@stop