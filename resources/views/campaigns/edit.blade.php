@extends('layouts.main')

@section('content')
    <div class="uk-width-large-1-1">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Markers
                </h3>
            </div>
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-1">
                        <div id="gmap_markers" class="gmap" style="width:100%;height:500px;"></div>
                    </div>
                </div>
            </div>
            <div id="map" style="width: 500px; height: 400px;">

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

            <!-- enera custom scripts -->
    {!! HTML::script('assets/js/enera/create_campaign_helper.js') !!}
    {!! HTML::script('assets/js/enera/icon_animations.js') !!}

            <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- page specific plugins -->
    <!-- maplace (google maps) -->
    {!! HTML::script('https://maps.googleapis.com/maps/api/js?sensor=true') !!}
    {{--{!! HTML::script('js/mapa.js') !!}--}}

    {!! HTML::script('bower_components/maplace.js/src/maplace-0.1.3.js') !!}

    <!--  google maps functions -->
    {!! HTML::script('assets/js/pages/plugins_google_maps.min.js') !!}

@stop