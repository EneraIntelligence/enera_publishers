@extends('layouts.main')
@section('title', ' - Crear Campaña')
@section('head_scripts')
    {!! HTML::style(asset('assets/css/campaign.css')) !!}
@endsection
@section('content')
    <div id="page_content">
        <div id="page_content_inner">



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
                <div class="uk-width-large-3-10 uk-hidden-small uk-hidden-medium">
                    <div class="md-card preview-container">
                        <div class="md-card-content">

                            <h2 class="heading_b uk-margin-bottom uk-text-truncate">
                                Nueva campaña
                                <span class="sub-heading">{!! $campaignName !!}</span>
                            </h2>

                            <!-- preview -->
                            <div class="uk-margin-medium-bottom">
                                <h3 class="heading_c uk-margin-bottom">Vista previa</h3>
                                <img class="uk-align-center vista"  src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

                                <div class="preview">
                                    <img class="img_preview"  id="interaccion" style="" src="http://placehold.it/207x325/444444?text=+" alt="vista previa">
                                    <div class="uk-text-center center-text">
                                        Elige una interacción.
                                    </div>
                                </div>

                                <!-- banner preview -->
                                <div class="preview banner none">
                                    <img class="banner-1 banner-2 view" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="" class="md-btn md-btn-primary boton">Navegar en internet</div>

                                    <div class="uk-text-center center-text">
                                        Promociónate con un banner que será visto por los usuarios de redes Enera.
                                    </div>
                                </div>

                                <!-- banner_link preview -->
                                <div class="preview banner-link none">
                                    <img class="banner-1 banner-2 view"  src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div  class="md-btn md-btn-primary boton">Navegar en internet</div>

                                    <div class="uk-text-center center-text">
                                        Promociónate con un banner y recibe a los usuarios de redes Enera en tu sitio.
                                    </div>
                                </div>

                                <!-- mailing_list preview -->
                                <div class="preview mailing-list none">
                                    <img class="banner-1 banner-2 view" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="top: 455px;" class="md-btn md-btn-primary boton">Suscribirme</div>
                                    <a id="Suscribirme"  href="">Deseo navegar en internet sin suscribirme</a>

                                    <div class="uk-text-center center-text" >
                                        Invita a los usuarios de redes Enera a unirse a una lista de correos para contactarlos aún terminada la campaña.
                                    </div>

                                </div>

                                <!-- captcha preview -->
                                <div class="preview captcha none">
                                    <img class="banner-1 banner-2 view-c"  src="http://placehold.it/200x250?text=Tu+captcha" alt="Tu banner">
                                    <input  class="uk-text-center boton" type="text" value="Mi producto">
                                    <div  class="md-btn md-btn-primary boton">Navegar en internet</div>

                                    <div class="uk-text-center center-text">
                                        Haz que los usuarios de redes Enera escriban una palabra relacionada con tu producto.
                                    </div>

                                </div>

                                <!-- survey preview -->
                                <div class="preview survey none">
                                    <img class="banner-1 banner-2 view"  src="http://placehold.it/200x150?text=Tu+banner" alt="Tu banner">
                                    <h3 class="uk-text-center center-text" style="top:325px; width:70%; position:absolute;">¿Pregunta 1?</h3>
                                    <div style="top:387px" class="md-btn md-btn-primary boton">A</div>
                                    <div class="uk-clearfix"></div>
                                    <div style="top:427px" class="md-btn md-btn-primary boton">B</div>
                                    <div class="uk-clearfix"></div>
                                    <div class="md-btn md-btn-primary boton">C</div>

                                    <div class="uk-text-center center-text">
                                        Crea una encuesta que contestarán los usuarios de redes Enera.
                                    </div>
                                </div>

                                <!-- video preview -->
                                <div class="preview video none">
                                    <img class="banner-1 banner-2 view"  src="http://placehold.it/200x250/010101?text=+" alt="Tu video">
                                    <img  id="video_id"  src="{!! URL::asset('images/icons/video.svg') !!}" alt="">
                                    <div  class="md-btn md-btn-primary boton">Navegar en internet</div>

                                    <div class="uk-text-center center-text">
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

        <!-- jquery steps -->
    {!! HTML::script('js/wizard_steps_custom.js') !!}
            <!--  forms wizard functions -->
    {!! HTML::script('js/form_wizard_custom.js') !!}
            <!-- slider script -->
    {!! HTML::script('bower_components/ionrangeslider/js/ion.rangeSlider.min.js') !!}

            <!-- enera custom scripts -->
    {!! HTML::script('js/create_campaign_utils.js') !!}

    <script>
        // load parsley config (altair_admin_common.js)
        altair_forms.parsley_validation_config();
        // load extra validators
        altair_forms.parsley_extra_validators();

        create_campaign_helper.url_validator();

    </script>

    {!! HTML::script('bower_components/parsleyjs/dist/parsley.min.js') !!}
    {!! HTML::script('bower_components/parsleyjs/src/i18n/es.js') !!}

    <!-- animation library -->
    {!! HTML::script('js/greensock/TweenLite.min.js') !!}
    {!! HTML::script('js/greensock/plugins/CSSPlugin.min.js') !!}
    {!! HTML::script('js/greensock/easing/EasePack.min.js') !!}

    {!! HTML::script('http://maps.google.com/maps/api/js') !!}
    {!! HTML::script('js/maps/markerclusterer_compiled.js') !!}
    {!! HTML::script('js/maps/keydragzoom.js') !!}
    {!! HTML::script('js/maps/infobox_packed.js') !!}

    {!! HTML::script('js/signals.min.js') !!}
    {!! HTML::script('js/marker_map.js') !!}
    {!! HTML::script('js/icon_animations.js') !!}

    <script>
        branchMap.base_url="{!! URL::to('/') !!}";
        branchMap.setBranches( '{!! json_encode($branches) !!}' );
    </script>

    {{--{!! HTML::script('assets/js/pages/forms_file_upload.js') !!}--}}


@stop