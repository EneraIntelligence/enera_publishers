$(function() {
    "use strict";

    // page onload functions
    create_campaign_helper.init();
    survey.init();
    time_sliders.setup();
    preview.init();
    branchMap.setup();

});

/*
Utilities that work at the start of the create campaign wizard
 */
create_campaign_helper =
{
    interaction: null,
    init: function()
    {
        //disable button until campaign is selected
        var btnNext = $(".button_next");
        btnNext.addClass("disabled");
        btnNext.attr("aria-disabled","true");

        //set preview when uploading a banner
        $("#image_small").change(function(){
            create_campaign_helper.showPreview(event,'.banner-1', 600,602)
        });

        $("#image_large").change(function(){
            create_campaign_helper.showPreview(event,'.banner-2', 684, 864)
        });

        //startup sliders
        $('[data-ion-slider]').ionRangeSlider();

        $(".num_step").kendoNumericTextBox({
            format: "#",
            min: 0,
        });
    },
    setInteraction: function(interactionId)
    {
        create_campaign_helper.interaction = interactionId;

        //show only the fields that the campaign needs
        $(".preview").css("display","none");
        $(".step2-field").css("display","none");
        $("."+interactionId).css("display","block");

        //enable button
        var btnNext = $(".button_next");
        btnNext.removeClass("disabled");
        btnNext.attr("aria-disabled","false");
    },
    showPreview: function(event, previewId, width, height)
    {
        var input = event.target;

        //check for image size
        var _URL = window.URL || window.webkitURL;
        image = new Image();
        image.onload = function()
        {
            var errorDiv = $(previewId+"-errors");

            if(this.width==width && this.height==height)
            {
                //image size ok!
                errorDiv.html('');

                //load image on input field
                var reader = new FileReader();
                reader.onload = function(){
                    var dataURL = reader.result;
                    var output = $(previewId);

                    //change every instance where the image should go
                    output.each(function()
                    {
                        $(this).attr("src", dataURL);
                    });
                };
                reader.readAsDataURL(input.files[0]);

            }
            else
            {
                //image size is different than expected
                input.value="";
                errorDiv.html('<span class="parsley-required uk-text-center md-input-danger">' +
                    'El tamaño de la imagen debe ser de <br>'+width+' pixeles de ancho por '+height+' pixeles de alto.' +
                    '</span>');

            }
        };
        image.src = _URL.createObjectURL(input.files[0]);

    }
}


/*
Utilities that work when the user chooses a survey
 */
survey=
{
    currentQuestion: 5,
    questionTemplate: null,
    init: function()
    {
        addQuestionBtn = $("#add_question");
        removeQuestionBtn = $("#remove_question");

        addQuestionBtn.click(function()
        {
            survey.showQuestion();
            $window.resize();

        });

        removeQuestionBtn.click(function()
        {
            survey.hideQuestion();
            $window.resize();

        });

        survey.questionTemplate = $(".question").first().clone();

        for(var i=2; i<=5;i++)
        {
            //survey.addQuestion();
            survey.hideQuestion();
        }
    },

    addQuestion: function()
    {
        //no more than 5 questions
        if(survey.currentQuestion>=5)
            return;

        removeQuestionBtn = $("#remove_question");
        removeQuestionBtn.removeClass("disabled");

        survey.currentQuestion++;

        questionContainer = $(".questionContainer");


        newQuestion = survey.questionTemplate.clone();
        questionHtml = newQuestion.html();

        //replacing identifiers
        questionHtml = questionHtml.replace(/q1/g,"q"+survey.currentQuestion);
        questionHtml = questionHtml.replace("Pregunta 1","Pregunta "+survey.currentQuestion);

        newQuestion.html(questionHtml);

        newQuestion.appendTo(questionContainer);

        if(survey.currentQuestion==5)
        {
            addQuestionBtn = $("#add_question");
            addQuestionBtn.addClass("disabled");
        }

        $window.resize();
    },

    showQuestion: function()
    {
        //no more than 5 questions
        if(survey.currentQuestion>=5)
            return;


        var removeQuestionBtn = $("#remove_question");
        removeQuestionBtn.removeClass("disabled");

        var question = $(".question").eq(survey.currentQuestion);
        question.css('display','block');

        survey.currentQuestion++;

        if(survey.currentQuestion==5)
        {
            var addQuestionBtn = $("#add_question");
            addQuestionBtn.addClass("disabled");
        }


        $window.resize();
    },

    hideQuestion: function()
    {
        if(survey.currentQuestion<=1)
            return;

        var addQuestionBtn = $("#add_question");
        addQuestionBtn.removeClass("disabled");

        survey.currentQuestion--;

        var question = $(".question").eq(survey.currentQuestion);
        question.css('display','none');

        if(survey.currentQuestion==1)
        {
            var removeQuestionBtn = $("#remove_question");
            removeQuestionBtn.addClass("disabled");
        }

        $window.resize();
    }
}

/*
Setup of the sliders that determine the time that the campaign will show
 */
time_sliders=
{
    setup: function()
    {
        $("#time_1_slider").ionRangeSlider({
            type: "double",
            min:0,
            max:24,
            min_interval:3,
            postfix:":00",
            from_min:5,
            from:5,
            to:24,
            step:1,
            force_edges: true,
            onChange: function(data)
            {
                //second time slider
                /*
                var slider2 = $("#time_2_slider").data("ionRangeSlider");
                slider2.update({
                    from_min: data.to,
                    to_min: data.to,
                });
                */
            }
        });
    }
}

/*
Setup of the preview div of the create campaign view
 */
preview =
{
    init:function()
    {
        var prevContainer = $(".preview-container");
        $(window).scroll(function() {
            prevContainer
                .stop()
                .animate({"marginTop": ($(window).scrollTop() )}, "slow" );
        });
    }
}

/*
Object with all related to the map on create campaign
 */
branchMap =
{
    map:null,
    base_url:"",
    branches:null,

    setBranches:function(branchesJSON)
    {
        branchMap.branches = JSON.parse(branchesJSON);
    },


    setup:function()
    {
        //Map setup
        var mapDiv = document.getElementById("googleMap");
        branchMap.map = new MarkerMap(23.8575691,-101.2433993,5, mapDiv);

        branchMap.createMarkers();

        branchMap.map.onMarkersUpdate.add(function(activeMarkersCount)
        {
            branchMap.validateMakerSelection(activeMarkersCount);
        });

        branchMap.map.clusterMarkers();


        //select all markers or none buttons
        var selectMarkersBtn = $("#select_markers");
        var deselectMarkersBtn = $("#deselect_markers");

        selectMarkersBtn.click(function(){
            branchMap.map.activateAllMarkers();
        });
        deselectMarkersBtn.click(function(){
            branchMap.map.deactivateAllMarkers();
        });


        //radio button actions
        var selectRadioBtn = $('#wizard_location_select');
        selectRadioBtn.on('ifClicked', function(event)
        {
            var modal = UIkit.modal("#modal_map");
            modal.show();
            setTimeout(branchMap.refresh,100);
            //branchMap.enableMap();
            branchMap.validateMakerSelection(branchMap.map.activeMarkers);

        });

        var globalRadioBtn = $('#wizard_location_all');
        globalRadioBtn.on('ifChecked', function(event)
        {
            //branchMap.disableMap();
        });

        //branchMap.disableMap();
    },

    selectMarkers:function ()
    {
        branchMap.validateMakerSelection(branchMap.map.activeMarkers);
        var modal = UIkit.modal("#modal_map");
        if(branchMap.map.activeMarkers>0)
            modal.hide();
    },

    createMarkers:function ()
    {
        var iconBaseURL = branchMap.base_url+"/images/";

        var markerOnImg = iconBaseURL + 'enera_map_marker_on.png';
        var markerOffImg = iconBaseURL + 'enera_map_marker_off.png';

        for(var i=0; i<branchMap.branches.length; i++)
        {
            var branch = branchMap.branches[i];

            var marker = new BooleanMarker(branch.location[0], branch.location[1], markerOnImg, markerOffImg);
            marker.setData(branch._id, branch.name, true);

            branchMap.map.addMarker(marker);
        }
    },

    enableMap:function()
    {
        TweenLite.to(".branchMap",.5, {alpha:1});
        $(".branchMap").css("pointer-events", "auto");

        branchMap.validateMakerSelection(branchMap.map.activeMarkers);
    },

    disableMap:function()
    {
        TweenLite.to(".branchMap",.5, {alpha:.4});
        $(".branchMap").css("pointer-events", "none");

        branchMap.validateMakerSelection(branchMap.map.activeMarkers);
    },

    validateMakerSelection:function(activeBranchesCount)
    {
        var errorDiv = $(".map-errors");
        var global = $("#wizard_location_all");

        if(global.prop("checked") || activeBranchesCount>0)
        {
            //map ok
            errorDiv.html('');
            $("#modal-select-btn").removeClass("disabled");
        }
        else
        {
            //map not ok
            $("#modal-select-btn").addClass("disabled");
            errorDiv.html('<span class="parsley-required uk-text-center md-input-danger">Selecciona al menos una ubicación en el mapa.</span>');
        }
    },


    refresh:function()
    {
        branchMap.map.refresh();
    },
    getMarkersList:function()
    {
        var global = $("#wizard_location_all");

        if(global.prop("checked"))
        {
            return "Global";
        }


        list = branchMap.map.getActiveMarkers();
        var htmlResult="";

        for(var i = 0; i<list.length;i++)
        {
            var marker = list[i];
            htmlResult = htmlResult + marker.name+"<br>";
        }

        return htmlResult;
    }
},

/*
 Utilities to show the summary of the campaign
 */
finalScreen=
{
    translate:{
        'both':'Ambos',
        'women':'Mujeres',
        'men':'Hombres',
        'monday':'Lunes',
        'tuesday':'Martes',
        'wednesday':'Miércoles',
        'thursday':'Jueves',
        'friday':'Viernes',
        'saturday':'Sábado',
        'sunday':'Domingo',
        'repeat':'Mostrar sin restricciones',
        'unique_day':'Mostrar una vez al día',
        'unique':'Mostrar sólo una vez por persona'
    },
    grid_1_1:function(content)
    {
        return '<div class="uk-width-1-1 uk-grid uk-grid-divider">'+content+'</div>';
    },
    grid_2_10:function(content)
    {
        return '<div class="uk-width-2-10">'+content+'</div>';
    },

    grid_1_4:function(content)
    {
        return '<div class="uk-width-1-4">'+content+'</div>';
    },
    format:function(title, content)
    {
        return '<h2 class="heading_a">'+title+'<span class="sub-heading">'+content+'</span></h2>';
    },
    fillData:function()
    {
        var $wizard_advanced_form = $('#wizard_advanced_form');
        //var form_serialized = JSON.stringify($wizard_advanced_form.serializeObject(), null, 2);
        var form_serialized = $wizard_advanced_form.serializeObject();

        var confirmBlock = $("#confirm-block");
        confirmBlock.html("");
        confirmBlock.append(finalScreen.grid_1_1( finalScreen.format('Producto',create_campaign_helper.interaction) ) );

        var props =finalScreen.grid_1_1( finalScreen.format("Imágenes","Una imagen para dispositivos pequeños </br> Una imagen para dispositivos largos") );
        if(create_campaign_helper.interaction=="banner-link")
            props =finalScreen.grid_1_1( finalScreen.format("Link",form_serialized.banner_link)+props );
        if(create_campaign_helper.interaction=="captcha")
            props =finalScreen.grid_1_1( finalScreen.format("Captcha",form_serialized.captcha)+props );
        if(create_campaign_helper.interaction=="survey")
            props =finalScreen.grid_1_1( finalScreen.parseQuestions(form_serialized)+props );

        confirmBlock.append(props);

        var filters =finalScreen.parseFilters(form_serialized);

        confirmBlock.append(finalScreen.grid_1_1( '<h2 class="heading_a">Segmentación</h2>' ));
        confirmBlock.append(filters);

        //style the finish button
        var finishBtn = $(".button_finish");
        finishBtn.addClass("md-btn");
        finishBtn.addClass("md-btn-success");
        finishBtn.find('a').css("color","white");

        //trigger resize of the block containing the data
        $window.resize();

    },
    parseQuestions: function(form_serialized)
    {
        var result=finalScreen.grid_1_1(finalScreen.format("Preguntas",""));
        for(var i=1;i<=5;i++)
        {
            var q = form_serialized['survey_q'+i];
            if(q!="" && q!=undefined)
            {
                var answers = "";
                //questions = questions + "Pregunta "+i+": "+q+"</br>";

                for(var j=1;j<=4;j++)
                {
                    var a = form_serialized['survey_q'+i+'_a'+j];
                    if(a!="" && a!=undefined)
                        answers = answers + "Opción "+j+": "+a+"</br>";

                }

                result = result+finalScreen.grid_2_10( finalScreen.format(i+".-"+q,answers) );
                //questions = questions + "<hr>";
            }

        }

        return result;
    },
    parseFilters: function(form_serialized)
    {
        var res="<div class='uk-grid'>";
        res = finalScreen.grid_1_4( finalScreen.format( "Fecha Inicial", form_serialized.start_date.replace(/\./g, "/") ) );
        res = res+ finalScreen.grid_1_4( finalScreen.format( "Fecha Final", form_serialized.end_date.replace(/\./g, "/") ) );

        res = res+ finalScreen.grid_1_4( finalScreen.format( "Género", finalScreen.translate[form_serialized.gender] ) );
        res = res+ finalScreen.grid_1_4( finalScreen.format( "Restricciones", finalScreen.translate[form_serialized.unique] ) );


        var age = form_serialized.age.split(";");
        if(age[0]!=age[1])
        {
            res = res + finalScreen.grid_1_4(finalScreen.format("Edad", " de " + age[0] + " a " + age[1] + " años"));
        }
        else
        {
            res = res + finalScreen.grid_1_4(finalScreen.format("Edad", age[0] + " años"));
        }

        var hours1 = form_serialized.time.split(";");
        //var hours2 = form_serialized.time_2.split(";");

        var lapse1="";
        if(hours1[0]!=hours1[1])
        {
            lapse1="de "+hours1[0]+":00 a "+hours1[1]+':00';
        }

        var lapse2="";
        /*
        if(hours2[0]!=hours2[1])
        {
            if(lapse1!="") {
                lapse2 = " y ";
            }
            lapse2=lapse2+"de "+hours2[0]+":00 a "+hours2[1]+':00';
        }*/

        res = res+ finalScreen.grid_1_4( finalScreen.format( "Horario",lapse1+lapse2+" horas" ) );

        res = res+ finalScreen.grid_1_4( finalScreen.format( "Días", form_serialized.days.toString().replace(/\,/g, "<br>") ) );
        res = res+ finalScreen.grid_1_4( finalScreen.format( "Ubicaciones", branchMap.getMarkersList() ) );


        return res+"</div>";
    }
}