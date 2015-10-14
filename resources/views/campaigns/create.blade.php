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
                                {{--<img src="assets/img/avatars/avatar_11.png" alt="user avatar"/>--}}
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom">
                                    <span class="uk-text-truncate">Crear Nueva Campaña</span>
                                    {{--<span class="sub-heading">Land acquisition specialist</span>--}}
                                </h2>
                                {{--<ul class="user_stats">
                                    <li>
                                        <h4 class="heading_a">2391 <span class="sub-heading">Posts</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">120 <span class="sub-heading">Photos</span></h4>
                                    </li>
                                    <li>
                                        <h4 class="heading_a">284 <span class="sub-heading">Following</span></h4>
                                    </li>
                                </ul>--}}
                            </div>

                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab"
                                data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}"
                                data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#">Cuenta</a></li>
                                {{--<li><a href="#">Graficas</a></li>
                                <li><a href="#">Campañas</a></li>--}}
                            </ul>

                            {!! Form::open(['url'=>'campaigns', 'files'=>'true']) !!}

                                <div class="md-card-content">
                                    <h3 class="heading_a">
                                        Upload Component
                                        <span class="sub-heading">Allow users to upload files through a file input form element or a placeholder area.</span>
                                    </h3>
                                    <div class="uk-grid">
                                        <div class="uk-width-1-1">
                                            <div id="file_upload-drop" class="uk-file-upload">
                                                <p class="uk-text">Drop file to upload</p>
                                                <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                                <a class="uk-form-file md-btn">choose file
                                                    {!! Form::file('image')!!}
                                                </a>
                                            </div>
                                            <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                                <div class="uk-progress-bar" style="width:0">0%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {!! Form::submit('Crear', ['class' => 'md-btn']) !!}


                            {!! Form::close() !!}


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