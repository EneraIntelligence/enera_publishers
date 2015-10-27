$(function() {
    "use strict";

    // page onload functions
    create_campaign_helper.init();
    survey.init();
    time_sliders.setup();
    preview.init();
    //input_hours.init(); //not used anymore

});

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

/*
input_hours =
{
    init: function()
    {
        var container = $("#input-hours");
        console.log("input_hours.init: "+container);
        container.append(input_hours.createBtns(0,5));
        container.append(input_hours.createBtns(6,11));
        container.append(input_hours.createBtns(12,17));
        container.append(input_hours.createBtns(18,23));

        //activate buttons actions
        $(".time-btn").each(function()
        {
            $(this).hover(function()
            {
                $(this).css("background-color","#C0C0C0")
            }, function()
            {
                $(this).css("background-color","#F0F0F0")
            });
            //$(this).click()
        });

    },
    createBtns: function(start, end)
    {
        var content = '<div class="uk-width-1-4 uk-width-small-1-1">';
        content += '<div class="uk-grid uk-grid-collapse">';


        for(var i = start; i<=end;i++)
        {
            content+='<div id="time_'+i+'" class="time-btn uk-width-1-6 uk-text-center" style="cursor:pointer; background-color: #F0F0F0"><span>'+i+'</span></div>';
        }

        content += '</div>';
        content += '</div>';
        return content;
    }
}
*/

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
        $("#file_upload-select").change(function(){
            create_campaign_helper.showPreview(event,'.banner-1', 600,602)
        });

        $("#file_upload-select_2").change(function(){
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