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

                            <!-- preview -->
                            <div class="uk-margin-medium-bottom">
                                <h3 class="heading_c uk-margin-bottom">Vista previa</h3>
                                <img class="uk-align-center" style="min-width:239px" src="{!! URL::asset('images/android_placeholder.png') !!}" alt="">

                                <div class="preview">
                                    <img class="banner-1" style="max-width:207px; max-height:325px; position: absolute; top: 125px; margin: 0 50% 0; left: -103px;" src="http://placehold.it/207x325/444444?text=+" alt="vista previa">
                                    <div class="uk-text-center" style="padding: 10px 60px 0 60px;">
                                        Elige una interacción.
                                    </div>
                                </div>

                                <!-- banner preview -->
                                <div class="preview banner" style="display:none">
                                    <img class="banner-1" style="max-width:200px; max-height:250px; position: absolute; top: 136px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Promociónate con un banner que será visto por los usuarios de redes Enera.
                                    </div>
                                </div>

                                <!-- banner_link preview -->
                                <div class="preview banner-link" style="display:none">
                                    <img class="banner-1" style="max-width:200px; max-height:250px; position: absolute; top: 136px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Promociónate con un banner y recibe a los usuarios de redes Enera en tu sitio.
                                    </div>
                                </div>

                                <!-- mailing_list preview -->
                                <div class="preview mailing-list" style="display:none">
                                    <img class="banner-1" style="max-width:200px; max-height:250px; position: absolute; top: 130px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 390px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Suscribirme</div>
                                    <a style="font-size:10px; pointer-events:none; width: 190px; position: absolute; top: 430px; margin: 0 50% 0; left: -95px;" href="">Deseo navegar en internet sin suscribirme</a>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Invita a los usuarios de redes Enera a unirse a una lista de correos para contactarlos aún terminada la campaña.
                                    </div>

                                </div>

                                <!-- captcha preview -->
                                <div class="preview captcha" style="display:none">
                                    <img class="banner-1" style="max-width:200px; max-height:250px; position: absolute; top: 130px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+captcha" alt="Tu banner">
                                    <input style="pointer-events:none; width: 190px; position: absolute; top: 383px; margin: 0 50% 0; left: -95px;" class="uk-text-center" type="text" value="Mi producto">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Haz que los usuarios de redes Enera escriban una palabra relacionada con tu producto.
                                    </div>

                                </div>

                                <!-- survey preview -->
                                <div class="preview survey" style="display:none">
                                    <img class="banner-1" style="max-width:200px; max-height:250px; position: absolute; top: 136px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250?text=Tu+banner" alt="Tu banner">
                                    <div style="pointer-events:none; width: 190px; position: absolute; top: 409px; margin: 0 50% 0; left: -95px;" class="md-btn md-btn-primary">Navegar en internet</div>

                                    <div class="uk-text-center" style="padding: 10px 10% 0 10%;">
                                        Crea una encuesta que contestarán los usuarios de redes Enera.
                                    </div>
                                </div>

                                <!-- video preview -->
                                <div class="preview video" style="display:none">
                                    <img class="banner-1" style="max-width:200px; max-height:250px; position: absolute; top: 136px; margin: 0 50% 0; left: -100px;" src="http://placehold.it/200x250/010101?text=+" alt="Tu video">
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


    {!! HTML::script('assets/js/gsap/TweenLite.min.js') !!}
    {!! HTML::script('assets/js/gsap/plugins/CSSPlugin.min.js') !!}
    {!! HTML::script('assets/js/gsap/easing/EasePack.min.js') !!}


    <script>
        altair_wizard.interaction = null;

        $(document).ready(function(){

            $(".button_next").addClass("disabled");
            $(".button_next").attr("aria-disabled","true");

            $(".interaction-btn").each(function()
            {
                //console.log($(this));
                $(this).click(function ()
                {
                    var btns = $(".interaction-btn");
                    btns.css("background-color", "#fff");
                    btns.css("color", "#737373");
                    /*
                    $(".interaction-btn").find("svg").css("stroke", "#737373");
                    $(".interaction-btn").find("svg").css("fill", "#737373");*/
                    var svgs = btns.find("svg");
                    TweenLite.to(svgs,.3,{stroke:"#737373", fill:"#737373", scale:1});


                    $(this).css("background-color", "#1e88e5");
                    $(this).css("color", "#fff");
                    var svg = $(this).find("svg");
                    TweenLite.killTweensOf(svg);
                    TweenLite.to(svg,.3,{stroke:"#fff", fill:"#fff", scale:1.1});

                    //banner
                    TweenLite.fromTo(svg.find("#line_banner1"),.7,{y:"-=40", alpha:0},{y:0, alpha:1});
                    TweenLite.fromTo(svg.find("#line_banner2"),.7,{y:"-=40", alpha:0},{y:0, alpha:1});

                    //banner link
                    TweenLite.fromTo(svg.find("#chain"),.7,{rotation:0, transformOrigin:"50% 50%"},{rotation:360});

                    //mailing list
                    TweenLite.fromTo(svg.find("#mail"),.5,{rotation:"-10", transformOrigin:"0% 100%"},{rotation:0, ease:Bounce.easeOut});
                    TweenLite.fromTo(svg.find("#mail_sheet"),.5,{scaleY:0, transformOrigin:"50% 100%"},{scaleY:1, delay:.3});
                    TweenLite.fromTo(svg.find("#mail_lines"),.5,{y:"+=30", alpha:0, transformOrigin:"50% 100%"},{y:0, alpha:1, delay:.3});


                    //captcha
                    TweenLite.fromTo(svg.find("#exe1"),.5,{scale:0, transformOrigin:"50% 50%"},{delay:.25, scale:1, ease:Elastic.easeOut});
                    TweenLite.fromTo(svg.find("#exe2"),.5,{scale:0, transformOrigin:"50% 50%"},{delay:.5, scale:1, ease:Elastic.easeOut});

                    //encuesta
                    for(var i = 1;i<=5;i++)
                    {
                        //s_line
                        TweenLite.fromTo(svg.find("#s_line"+i),.3,{scaleX:0 },{delay:.1*i, scaleX:1});
                    }

                    //video
                    TweenLite.fromTo(svg.find("#play_btn"),.3,{x:0, alpha:1, scale:1, transformOrigin:"50% 50%"},{x:"+50", alpha:0, scale:0, ease:Power2.easeIn});
                    TweenLite.fromTo(svg.find("#play_btn"),.3,{x:"-90", alpha:0, scale:0, transformOrigin:"50% 50%"},{delay:.51, x:0, alpha:1, scale:1, ease:Power2.easeOut});


                    var interaction = $(this).data("interaction");
                    altair_wizard.interaction = interaction;
//                    console.log(interaction);
                    $(".preview").css("display","none");
                    $(".step2-field").css("display","none");
                    $("."+interaction).css("display","block");

                    $(".button_next").removeClass("disabled");
                    $(".button_next").attr("aria-disabled","false");

                    //TweenLite.to(svg.find("path"), 1, {drawSVG:"20% 80%", ease:Power1.easeInOut});

                });
            });
        });


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