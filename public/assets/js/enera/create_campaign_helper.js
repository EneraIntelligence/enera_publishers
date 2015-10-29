$(function() {
    "use strict";

    // page onload functions
    create_campaign_helper.init();
    survey.init();
    time_sliders.setup();
    preview.init();
    //input_hours.init(); //not used anymore
    branchMap.setup();

});

create_campaign_helper =
{
    interaction: null,
    init: function()
    {
        console.log("create_campaign_helper.init()");

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

        //startup slider
        $('[data-ion-slider]').ionRangeSlider();
    },
    setInteraction: function(interactionId)
    {
        console.log("campaign selected");
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

            }
            else
            {
                //image size is different than expected
                errorDiv.html('<span class="parsley-required uk-text-center md-input-danger">El tamaño de la imagen debe ser de <br>'+width+' pixeles de ancho por '+height+' pixeles de alto.</span>');
                //parsley-errors-list
                /*
                 <span class="parsley-required uk-text-center md-input-danger">
                 El tamaño de la imagen no coincide
                 </span>
                 */
            }
            //console.log("The image width is " +this.width + " and image height is " + this.height);
        };
        image.src = _URL.createObjectURL(input.files[0]);

    }
}

finalScreen=
{
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

//      confirmBlock.append('<h2 class="heading_a">Elementos<span class="sub-heading">'+props+'</span></h2>');
        confirmBlock.append(props);

        var filters =finalScreen.parseFilters(form_serialized);

        confirmBlock.append(finalScreen.grid_1_1( '<h2 class="heading_a">Segmentación</h2>' ));
        confirmBlock.append(filters);

        $(".button_finish").addClass("md-btn");
        $(".button_finish").addClass("md-btn-success");
        $(".button_finish").find('a').css("color","white");

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
        res = finalScreen.grid_1_4( finalScreen.format( "Fecha de Inicio", form_serialized.start_date.replace(/\./g, "/") ) );
        res = res+ finalScreen.grid_1_4( finalScreen.format( "Fecha de final", form_serialized.end_date.replace(/\./g, "/") ) );

        res = res+ finalScreen.grid_1_4( finalScreen.format( "Género", form_serialized.gender ) );
        res = res+ finalScreen.grid_1_4( finalScreen.format( "Restricciones", form_serialized.unique ) );


        var age = form_serialized.age.split(";");
        res = res+ finalScreen.grid_1_4( finalScreen.format( "Edad", " de "+age[0]+" a "+age[1]+" años" ) );

        var hours1 = form_serialized.time_1.split(";");
        var hours2 = form_serialized.time_2.split(";");

        var lapse1="";
        if(hours1[0]!=hours1[1])
        {
            lapse1="de "+hours1[0]+":00 a "+hours1[1]+':00';
        }

        var lapse2="";
        if(hours2[0]!=hours2[1])
        {
            if(lapse1!="") {
                lapse2 = " y ";
            }
            lapse2=lapse2+"de "+hours2[0]+":00 a "+hours2[1]+':00';
        }

        res = res+ finalScreen.grid_1_4( finalScreen.format( "Horario",lapse1+lapse2+" horas" ) );

        res = res+ finalScreen.grid_1_4( finalScreen.format( "Días", form_serialized.days.toString().replace(/\,/g, "<br>") ) );
        res = res+ finalScreen.grid_1_4( finalScreen.format( "Ubicaciones", branchMap.markersToList() ) );


        return res+"</div>";
    }
}

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
        });

        removeQuestionBtn.click(function()
        {
            survey.hideQuestion();
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

        console.log("removing q"+survey.currentQuestion);

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

time_sliders=
{
    setup: function()
    {
        $("#time_1_slider").ionRangeSlider({
            type: "double",
            min:0,
            max:24,
            min_interval:1,
            postfix:":00",
            from_min:5,
            from:5,
            to:24,
            step:1,
            force_edges: true,
            onChange: function(data)
            {
                var slider2 = $("#time_2_slider").data("ionRangeSlider");
                slider2.update({
                    from_min: data.to,
                    to_min: data.to,
                });

            }
        });
    }
}

preview =
{
    init:function()
    {
        var prevContainer = $(".preview-container");
        $(window).scroll(function() {
            //console.log( "Handler for .scroll() called. "+ prevContainer.scrollTop() );
            prevContainer
                .stop()
                .animate({"marginTop": ($(window).scrollTop() )}, "slow" );
        });
    }
}



branchMap =
{
    map:null,
    center:null,
    base_url:"",
    branches:null,
    markers:{},
    markersToList:function()
    {
        var list = "";
        for(var key in branchMap.markers)
        {
            var markerObj = branchMap.markers[key];
            if(markerObj.active == true)
            {
                list = list + markerObj.name+"<br>";
            }
        }

        return list;
    },
    setBranches:function(branchesJSON)
    {
        branchMap.branches = JSON.parse(branchesJSON);
        //console.log( branchMap.branches );
    },
    setup:function()
    {
        branchMap.center = new google.maps.LatLng(23.8575691,-101.2433993);

        var mapProp = {
            center:branchMap.center,
            zoom:5,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        branchMap.map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

        var iconBase = branchMap.base_url+"/images/";

        for(var i=0; i<branchMap.branches.length; i++)
        {
            var branch = branchMap.branches[i];

            var marker=new google.maps.Marker({
                position: new google.maps.LatLng(branch.lat, branch.lng),
                animation: google.maps.Animation.DROP,
                icon: iconBase + 'enera_map_marker_off.png',
                //title: branch.name,
                //snippet: "-"
            });

            marker.setMap(branchMap.map);

            branchMap.attachMarkerClick(marker, branch._id, branch.name);

            branchMap.markers[branch._id] = {"marker":marker, "active":false, "name":branch.name};

        }

        var selectMarkersBtn = $("#select_markers");
        var deselectMarkersBtn = $("#deselect_markers");

        selectMarkersBtn.click(function()
        {
            for(var key in branchMap.markers)
            {
                var markerObj = branchMap.markers[key];
                markerObj.active = true;
                markerObj.marker.setIcon( iconBase + 'enera_map_marker_on.png' );
            }
        });

        deselectMarkersBtn.click(function()
        {
            for(var key in branchMap.markers)
            {
                var markerObj = branchMap.markers[key];
                markerObj.active = false;
                markerObj.marker.setIcon( iconBase + 'enera_map_marker_off.png' );
            }
        });

    },
    attachMarkerClick:function(marker, _id, name)
    {
        var iconBase = branchMap.base_url + "/images/";

        google.maps.event.addListener(marker, 'click', function()
        {
            if(branchMap.markers[_id].active)
            {
                marker.setIcon( iconBase + 'enera_map_marker_off.png' );
                branchMap.markers[_id].active = false;
            }
            else
            {
                marker.setIcon( iconBase + 'enera_map_marker_on.png' );
                branchMap.markers[_id].active = true;
            }
        });
/*
        var infowindow = new google.maps.InfoWindow({
            content: "<h4>"+name+"</h4>"
        });*/

        var boxText = document.createElement("div");
        boxText.style.cssText = "text-align:center; margin-top: 8px; background: white; padding: 3px 0 0px; border-radius: 15px;";
        boxText.innerHTML = "<h4>"+name+"</h4>";

        var myOptions = {
            alignBottom: true,
            content: boxText
            ,disableAutoPan: false
            ,maxWidth: 0
            ,pixelOffset: new google.maps.Size(-140, -50)
            ,zIndex: null
            ,boxStyle: {
                //background: "url('tipbox.gif') no-repeat"
                opacity: 0.75,
                width: "280px"
            },
            closeBoxMargin: "10px 2px 2px 2px",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false
        };

        var ib = new InfoBox(myOptions);

        google.maps.event.addListener(marker, 'mouseover', function()
        {
            //infowindow.open(branchMap.map, marker);
            ib.open(branchMap.map, marker);

            //marker.showInfoWindow();
        });

        google.maps.event.addListener(marker, 'mouseout', function()
        {
            //infowindow.close(branchMap.map, marker);
            ib.close(branchMap.map, marker);

            //marker.hideInfoWindow();
        });

    },
    refresh:function()
    {
        branchMap.map.panTo(branchMap.center);

    }
}
