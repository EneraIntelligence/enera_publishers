@extends('layouts.main_materialize')
@section('title', ' - Crear Campaña')
@section('head_scripts')

    {!! HTML::style('css/nouislider.css') !!}
    {!! HTML::style('css/cropper.min.css') !!}

    {!! HTML::style('assets/css/campaign_wizard.css') !!}

@stop

@section('content')

    <div class="main-container">

        <div class="row">

            <div class="col s12">
                <h2 style="color: #424242 !important"> {{ Input::get("name")  }} </h2>
            </div>

            <!-- wizard container -->
            <div class="container col s12 m12 l8">
                <div class="card wizard-card">

                    <!-- wizard content -->
                    <div id="wizard-content" class="card-content overflow-hidden">
                        <div id="step_1" class="step">@include('campaigns/create_wizard/step_1')</div>
                        <div id="step_2" class="step">@include('campaigns/create_wizard/step_2')</div>
                        <div id="step_3" class="step">@include('campaigns/create_wizard/step_3')</div>
                        <div id="step_4" class="step">@include('campaigns/create_wizard/step_4', ['branches' => $branches])</div>
                        <div id="step_5" class="step">@include('campaigns/create_wizard/step_5')</div>
                    </div>


                    <!-- next / prev buttons -->
                    <div class="wizard-nav card-image">
                        <a id="prev-btn" class="waves-effect waves-light btn nav-btn cyan darken-2">
                            <i class="material-icons">navigate_before</i></a><a id="next-btn" class="waves-effect waves-light btn nav-btn cyan">
                            <i class="material-icons">navigate_next</i>
                        </a>
                    </div>

                </div>

            </div>

            <!-- preview container -->
            <div class="container col l4 hide-on-med-and-down">
                <div class="card-panel">
                    <span class="card-title">Preview</span>
                    <div style="position: relative; width: 250px; margin: 0 auto;">
                        <div class="preview" style="text-align: center;">
                            <img src="{{asset('images/android_placeholder.png')}}" alt="">
                        </div>
                        <div class="preview data-field" id="mydiv" style="overflow: scroll;">

                        </div>
                        <div class="preview data-field data-banner_link preview-overflow" id="mydiv">
                            @if(view()->exists('campaign.partials.preview_banner_link'))
                                @include('campaign.partials.preview_banner_link')
                            @endif
                        </div>
                        <div class="preview data-field data-like preview-overflow" id="mydiv">
                            @if(view()->exists('campaign.partials.preview_like'))
                                @include('campaign.partials.preview_like')
                            @endif
                        </div>
                        <div class="preview data-field data-mailing_list preview-overflow" id="mydiv">
                            @if(view()->exists('campaign.partials.preview_mailing_list'))
                                @include('campaign.partials.preview_mailing_list')
                            @endif
                        </div>
                        <div class="preview data-field data-captcha preview-overflow" id="mydiv">
                            @if(view()->exists('campaign.partials.preview_captcha'))
                                @include('campaign.partials.preview_captcha')
                            @endif
                        </div>
                        <div class="preview data-field data-survey preview-overflow" id="mydiv">
                            @if(view()->exists('campaign.partials.preview_captcha'))
                                @include('campaign.partials.preview_survey')
                            @endif
                        </div>
                        <div class="preview data-field data-video preview-overflow" id="mydiv">
                            @if(view()->exists('campaign.partials.preview_video'))
                                @include('campaign.partials.preview_video')
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Modal summary -->
        <div id="modal-summary" class="modal">
            <div class="modal-content">
                <div id="modal-summary-content">

                </div>
            </div>
        </div>

    </div>


@stop


@section('scripts')

    {!! HTML::script('js/greensock/plugins/ScrollToPlugin.min.js') !!}
    {!! HTML::script('js/events/EventDispatcher.js') !!}
    {!! HTML::script('js/events/WizardEvents.js') !!}
    {!! HTML::script('js/campaign_wizard/WizardSteps.js') !!}
    {!! HTML::script('js/campaign_wizard/WizardSetup.js') !!}

    {!! HTML::script('js/nouislider.js') !!}
    {!! HTML::script('js/cropper.min.js') !!}
    {!! HTML::script('js/jquery-validation/dist/jquery.validate.min.js') !!}
    {!! HTML::script('js/jquery-validation/dist/localization/messages_es.min.js') !!}

    <!-- wysiwyg -->
    {!! HTML::script('js/tinymce/tinymce.min.js') !!}

{{--    {!! HTML::script('assets/js/campaign_wizard/wizard.js') !!}--}}


    <script>

        let wizardSetup = new WizardSetup($("#next-btn"),$("#prev-btn"));


        $(document).ready(function () {

            wizardSetup.onDocumentReady();


        });

        $(window).load(function () {
            wizardSetup.onLoad();

        });

        $( window ).resize(function() {
            wizardSetup.onResize();
        });

    </script>


@stop
