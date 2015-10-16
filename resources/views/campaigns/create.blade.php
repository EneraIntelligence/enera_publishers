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
                                <li class="uk-active"><a href="#">Campaña</a></li>
                                {{--<li><a href="#">Graficas</a></li>
                                <li><a href="#">Campañas</a></li>--}}
                            </ul>

                            {!! Form::open(['url'=>'campaigns', 'files'=>'true']) !!}
                                <div class="md-card-content">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div id="ladoIzquierdo" class="uk-width-medium-1-2">
                                            <div class="uk-width-medium-1-1">
                                                <div class="parsley-row">
                                                    <label for="fullname">Nombre<span class="req">*</span></label>
                                                    <input type="text" name="fullname" required class="md-input" />
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row uk-margin-top">
                                                        <label for="val_birth">Fecha de inicio<span class="req">*</span></label>
                                                        <input type="text" name="val_birth" id="val_birth" required class="md-input" data-parsley-americandate data-parsley-americandate-message="This value should be a valid date (MM.DD.YYYY)" data-uk-datepicker="{format:'MM.DD.YYYY'}" />
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <div class="parsley-row uk-margin-top">
                                                        <label for="val_birth">Fecha de fin<span class="req">*</span></label>
                                                        <input type="text" name="val_birth" id="val_birth" required class="md-input" data-parsley-americandate data-parsley-americandate-message="This value should be a valid date (MM.DD.YYYY)" data-uk-datepicker="{format:'MM.DD.YYYY'}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="ladoDerecho" class="uk-width-1-2">
                                            <div class="uk-grid">
                                                <div class="uk-width-1-3">
                                                    <div id="file_upload-drop" class="uk-file-upload">
                                                        <p class="uk-text">Drop file to upload</p>
                                                        <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                                        <a class="uk-form-file md-btn">choose file
                                                            {!! Form::file('image')!!}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-3">
                                                    <div id="file_upload-drop" class="uk-file-upload">
                                                        <p class="uk-text">Drop file to upload</p>
                                                        <p class="uk-text-muted uk-text-small uk-margin-small-bottom">or</p>
                                                        <a class="uk-form-file md-btn">choose file<input id="file_upload-select" type="file"></a>
                                                    </div>
                                                </div>

                                                <div id="file_upload-progressbar" class="uk-progress uk-hidden">
                                                    <div class="uk-progress-bar" style="width:0">0%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md-card">
                                        <div class="md-card-content">
                                            <h3 class="heading_a">Masked inputs</h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4">
                                                    <label for="masked_date">Date</label>
                                                    <input class="md-input masked_input" id="masked_date" type="text" data-inputmask="'alias': 'mm/dd/yyyy'" data-inputmask-showmaskonhover="false" />
                                                </div>
                                                <div class="uk-width-medium-1-4">
                                                    <label for="masked_phone">Phone</label>
                                                    <input class="md-input masked_input" id="masked_phone" type="text" data-inputmask="'mask': '999 - 999 999 999'" data-inputmask-showmaskonhover="false" />
                                                </div>
                                                <div class="uk-width-medium-1-4">
                                                    <label for="masked_currency">Currency</label>
                                                    <input class="md-input masked_input" id="masked_currency" type="text" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" data-inputmask-showmaskonhover="false" />
                                                </div>
                                                <div class="uk-width-medium-1-4">
                                                    <label for="masked_email">Email</label>
                                                    <input class="md-input masked_input" id="masked_email" type="text" data-inputmask="'alias': 'email'" data-inputmask-showmaskonhover="false" />
                                                </div>
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
        <!-- inputmask-->
    {!! HTML::script('bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.min.js') !!}
            <!-- ionrangeslider -->
    {!! HTML::script('bower_components/ionrangeslider/js/ion.rangeSlider.min.js') !!}
    <!--  forms advanced functions -->
    {!! HTML::script('assets/js/pages/forms_advanced.js') !!}

    <script>
        $(function() {
            var $switcher = $('#style_switcher'),
                    $switcher_toggle = $('#style_switcher_toggle'),
                    $theme_switcher = $('#theme_switcher'),
                    $mini_sidebar_toggle = $('#style_sidebar_mini');

            $switcher_toggle.click(function(e) {
                e.preventDefault();
                $switcher.toggleClass('switcher_active');
            });

            $theme_switcher.children('li').click(function(e) {
                e.preventDefault();
                var $this = $(this),
                        this_theme = $this.attr('data-app-theme');

                $theme_switcher.children('li').removeClass('active_theme');
                $(this).addClass('active_theme');
                $('body')
                        .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g')
                        .addClass(this_theme);

                if(this_theme == '') {
                    localStorage.removeItem('altair_theme');
                } else {
                    localStorage.setItem("altair_theme", this_theme);
                }

            });

            // change input's state to checked if mini sidebar is active
            if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $('body').hasClass('sidebar_mini')) {
                $mini_sidebar_toggle.iCheck('check');
            }

            // toggle mini sidebar
            $mini_sidebar_toggle
                    .on('ifChecked', function(event){
                        $switcher.removeClass('switcher_active');
                        localStorage.setItem("altair_sidebar_mini", '1');
                        location.reload(true);
                    })
                    .on('ifUnchecked', function(event){
                        $switcher.removeClass('switcher_active');
                        localStorage.removeItem('altair_sidebar_mini');
                        location.reload(true);
                    });

            // hide style switcher
            $document.on('click keyup', function(e) {
                if( $switcher.hasClass('switcher_active') ) {
                    if (
                            ( !$(e.target).closest($switcher).length )
                            || ( e.keyCode == 27 )
                    ) {
                        $switcher.removeClass('switcher_active');
                    }
                }
            });

            if(localStorage.getItem("altair_theme") !== null) {
                $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
            }
        });
    </script>
@stop