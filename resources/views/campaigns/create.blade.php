@extends('layouts.main')

@section('content')
    <div id="page_content">
        <div id="page_content_inner">

            <h2 class="heading_b uk-margin-bottom">Nueva campaña</h2>

            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-7-10">
                    <div class="md-card uk-margin-large-bottom">
                        <div class="md-card-content">
                            <form class="uk-form-stacked" id="wizard_advanced_form">

                                <div id="wizard_advanced">

                                    @include('campaigns.create_wizard.step_1')

                                    @include('campaigns.create_wizard.step_2')

                                    @include('campaigns.create_wizard.step_3')

                                    @include('campaigns.create_wizard.step_4')

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-3-10 uk-hidden-small">
                    <div class="md-card preview-container">
                        <div class="md-card-content">

                            <!-- preview -->
                            <div class="uk-margin-medium-bottom">
                                <h3 class="heading_c uk-margin-bottom">Vista previa</h3>
                                <img class="uk-align-center" style="min-width:239px" src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

                                <div class="preview">
                                    <img style="max-width:207px; max-height:325px; position: absolute; top: 125px; margin: 0 50% 0; left: -103px;" src="http://placehold.it/207x325/444444?text=+" alt="vista previa">
                                    <div class="uk-text-center" style="padding: 10px 60px 0 60px;">
                                        Elige una interacción.
                                    </div>
                                </div>

                                <!-- banner preview -->
                                <div class="preview banner" style="display:none">
                                    <img class="banner-1 banner-2" style="max-width:200px; max-height:250px; position: absolute; top: 136px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Promociónate con un banner que será visto por los usuarios de redes Enera.
                                    </div>
                                </div>

                                <!-- banner_link preview -->
                                <div class="preview banner-link" style="display:none">
                                    <img class="banner-1 banner-2" style="max-width:200px; max-height:250px; position: absolute; top: 136px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Promociónate con un banner y recibe a los usuarios de redes Enera en tu sitio.
                                    </div>
                                </div>

                                <!-- mailing_list preview -->
                                <div class="preview mailing-list" style="display:none">
                                    <img class="banner-1 banner-2" style="max-width:200px; max-height:250px; position: absolute; top: 130px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 390px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Suscribirme</div>
                                    <a style="font-size:10px; pointer-events:none; width: 190px; position: absolute; top: 430px; margin: 0 50% 0; left: -95px;" href="">Deseo navegar en internet sin suscribirme</a>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Invita a los usuarios de redes Enera a unirse a una lista de correos para contactarlos aún terminada la campaña.
                                    </div>

                                </div>

                                <!-- captcha preview -->
                                <div class="preview captcha" style="display:none">
                                    <img class="banner-1 banner-2" style="max-width:200px; max-height:250px; position: absolute; top: 130px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+captcha" alt="Tu banner">
                                    <input style="pointer-events:none; width: 190px; position: absolute; top: 383px; margin: 0 50% 0; left: -95px;" class="uk-text-center" type="text" value="Mi producto">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Haz que los usuarios de redes Enera escriban una palabra relacionada con tu producto.
                                    </div>

                                </div>

                                <!-- survey preview -->
                                <div class="preview survey" style="display:none">
                                    <img class="banner-1 banner-2" style="max-width:200px; max-height:250px; position: absolute; top: 136px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Crea una encuesta que contestarán los usuarios de redes Enera.
                                    </div>
                                </div>

                                <!-- video preview -->
                                <div class="preview video" style="display:none">
                                    <img class="banner-1 banner-2" style="max-width:200px; max-height:250px; position: absolute; top: 136px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250/010101?text=+" alt="Tu video">
                                    <img style="position: absolute; top: 163px; margin: 0 50% 0; left: -100px;" src="{!! URL::asset('images/icons/video.svg') !!}" alt="">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Muestra un video que verán nuestros usuarios para acceder a las redes Enera.
                                    </div>
                                </div>


                            </div>
                            <!-- end preview -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@stop

@section('scripts')

    <script>
        // load parsley config (altair_admin_common.js)
        altair_forms.parsley_validation_config();
        // load extra validators
        altair_forms.parsley_extra_validators();

    </script>

    {!! HTML::script('bower_components/parsleyjs/dist/parsley.min.js') !!}
            <!-- jquery steps -->
    {!! HTML::script('assets/js/custom/wizard_steps.js') !!}
    <!--  forms wizard functions -->
    {!! HTML::script('assets/js/pages/forms_wizard.js') !!}
            <!-- slider script -->
    {!! HTML::script('bower_components/ionrangeslider/js/ion.rangeSlider.min.js') !!}


    <!-- animation library -->
    {!! HTML::script('assets/js/gsap/TweenLite.min.js') !!}
    {!! HTML::script('assets/js/gsap/plugins/CSSPlugin.min.js') !!}
    {!! HTML::script('assets/js/gsap/easing/EasePack.min.js') !!}

    {!! HTML::script('http://maps.google.com/maps/api/js?sensor=false') !!}

    <!-- enera custom scripts -->
    {!! HTML::script('assets/js/enera/create_campaign_helper.js') !!}
    {!! HTML::script('assets/js/enera/icon_animations.js') !!}


    <script>
        branchMap.base_url="{!! URL::to('/') !!}";
        branchMap.setBranches( '{!! json_encode($branches) !!}' );
    </script>

    {{--{!! HTML::script('assets/js/pages/forms_file_upload.js') !!}--}}


@stop