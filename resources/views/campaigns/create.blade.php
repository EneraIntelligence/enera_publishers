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
                <div class="uk-width-large-3-10">
                    <div class="md-card">
                        <div class="md-card-content">

                            <div class="uk-margin-medium-bottom">
                                <h3 class="heading_c uk-margin-bottom">Vista previa</h3>

                                <img class="uk-align-center" src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

                                <div class="banner" style="display:none">
                                    <img class="banner-1" style="max-width:200px; max-height:250px; position: absolute; top: 136px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>
                                </div>

                                <div class="mailing-list">
                                    <img class="banner-1" style="max-width:200px; max-height:250px; position: absolute; top: 130px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 390px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Suscribirme</div>
                                    <a style="font-size:10px; pointer-events:none; width: 190px; position: absolute; top: 430px; margin: 0 50% 0; left: -95px;" href="">Deseo navegar en internet sin suscribirme</a>

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

    <script>
        $(document).ready()
        {

        }


        function showPreview(event, id)
        {
            var input = event.target;

            var reader = new FileReader();
            reader.onload = function(){
                var dataURL = reader.result;
                var output = $(id);//'.banner-android');

                output.each(function()
                {
                    $(this).attr("src", dataURL);
                });
            };
            reader.readAsDataURL(input.files[0]);
            //console.log("changed");

        }
    </script>

    {{--{!! HTML::script('assets/js/pages/forms_file_upload.js') !!}--}}

@stop