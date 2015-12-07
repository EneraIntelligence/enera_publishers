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
    url_validator:function()
    {

        window.ParsleyConfig = window.ParsleyConfig || {};
        window.ParsleyConfig.validators = window.ParsleyConfig.validators || {};

        window.ParsleyConfig.validators.url = {

            fn: function (value) {
                //console.log("validating url");
                return /^(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(value);
            },
            priority: 256
        };

        //console.log("setup validator");
    },
    interaction: null,
    images:{},
    init: function()
    {
        var cropBtn = $("#crop-btn");
        cropBtn.click(create_campaign_helper.cropImage);

        //disable button until campaign is selected
        var btnNext = $(".button_next");
        btnNext.addClass("disabled");
        btnNext.attr("aria-disabled","true");

        console.log("create_campaign_helper.init");

        //set preview when uploading a banner
        $("#banner-1").change(function(){
            console.log("create_campaign_helper.change.image small");
            create_campaign_helper.showPreview(event,'.banner-1', 600,602)
        });

        $("#banner-2").change(function(){
            create_campaign_helper.showPreview(event,'.banner-2', 684, 864)
        });

        $("#banner-survey").change(function(){
            create_campaign_helper.showPreview(event,'.banner-survey', 684, 400)
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
    cropData:null,
    cropImage: function()
    {
        create_campaign_helper.modal.hide();

        var modal = UIkit.modal.blockUI('<div class=\'uk-text-center\'>Cargando imagen...<br/>' +
            '<img class=\'uk-margin-top\' src=\''+branchMap.base_url+'/assets/img/spinners/spinner.gif\' alt=\'\'>');

        //get the crop data
        var img = create_campaign_helper.cropData.image;
        var x = create_campaign_helper.cropData.x;
        var y = create_campaign_helper.cropData.y;
        var width = create_campaign_helper.cropData.width;
        var height = create_campaign_helper.cropData.height;
        var expWidth = create_campaign_helper.cropData.imageWidth;
        var expHeight = create_campaign_helper.cropData.imageHeight;
        var previewId = create_campaign_helper.cropData.previewId;
        var input = create_campaign_helper.cropData.input;

        //create canvas
        var resize_canvas = document.createElement('canvas');
        resize_canvas.width = expWidth;
        resize_canvas.height = expHeight;

        //paint canvas with croped portion of image
        resize_canvas.getContext('2d').drawImage(img, x, y, width, height, 0, 0, expWidth, expHeight);
        $(create_campaign_helper.cropData.previewId).attr('src', resize_canvas.toDataURL("image/png"));

        //fill data to send to ajax
        var form_data = new FormData( $('#wizard_advanced_form')[0] );
        form_data.append( "imgType", previewId );
        form_data.append( "imgToSave", resize_canvas.toDataURL("image/png") );

        //div to receive any possible error
        var errorDiv = $(previewId+"-errors");
        var inputId =  "#"+ previewId.substring(1, previewId.length);
        console.log("inputId: "+inputId);
        var inputField = $( inputId );


        //upload item via ajax
        $.ajax({
            url: '/campaigns/save_item',
            type: 'POST',
            dataType: 'JSON',
            data: form_data,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (data) {
            input.value="";
            inputField.removeAttr("required");

            console.log(inputField);
            console.log("success");
            console.log(data);

            create_campaign_helper.images[data.imageType] = data.item_id;
            console.log(create_campaign_helper);

            modal.hide()

        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);

            input.value="";
            inputField.required = true;

            errorDiv.html('<span class="parsley-required uk-text-center md-input-danger">' +
                'Hubo un problema al subir tu imagen.' +
                '</span>');

            setTimeout(function(){
                modal.hide();
            },200);

        });


    },
    showPreview: function(event, previewId, width, height)
    {
        console.log("create_campaign_helper.showPreview");

        create_campaign_helper.modal = UIkit.modal("#modal_image");
        create_campaign_helper.modal.show();

        var imageContainer = $(".crop-image");
        imageContainer.empty();
        imageContainer.append('<img src="" alt="">');

        var output = $(".crop-image>img");
        output.attr("src", "");

        var _URL = window.URL || window.webkitURL;
        var input = event.target;

        var image = new Image();
        image.onload = function()
        {
            //load image on input field
            var reader = new FileReader();
            reader.onload = function(){
                var dataURL = reader.result;

                //change modal image to crop
                output.attr("src", dataURL);

                output.cropper({
                    aspectRatio: width/height,
                    resizable: true,
                    zoomable: false,
                    rotatable: false,
                    multiple: true,
                    crop: function(e) {
                        // save the crop data to have it available when user clicks save
                        create_campaign_helper.cropData = e;
                        create_campaign_helper.cropData.previewId = previewId;
                        create_campaign_helper.cropData.imageWidth = width;
                        create_campaign_helper.cropData.imageHeight = height;
                        create_campaign_helper.cropData.image = image;
                        create_campaign_helper.cropData.previewId = previewId;
                        create_campaign_helper.cropData.input = input;
                    }
                });


            };
            reader.readAsDataURL(input.files[0]);

        };
        image.src = _URL.createObjectURL(input.files[0]);


    }
};


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