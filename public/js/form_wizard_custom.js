$(function () {
    // wizard
    altair_wizard.advanced_wizard();
    altair_wizard.vertical_wizard();
});

// wizard
altair_wizard = {
    content_height: function (this_wizard, step) {
        var this_height = $(this_wizard).find('.step-' + step).actual('outerHeight');
        $(this_wizard).children('.content').animate({height: this_height}, 280, bez_easing_swiftOut);
    },
    advanced_wizard: function () {
        var $wizard_advanced = $('#wizard_advanced'),
            $wizard_advanced_form = $('#wizard_advanced_form');

        if ($wizard_advanced.length) {
            $wizard_advanced.steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                trigger: 'change',
                onInit: function (event, currentIndex) {
                    altair_wizard.content_height($wizard_advanced, currentIndex);
                    // initialize checkboxes
                    altair_md.checkbox_radio($(".wizard-icheck"));
                    // reinitialize uikit margin
                    altair_uikit.reinitialize_grid_margin();
                    setTimeout(function () {
                        $window.resize();
                    }, 100)
                },
                onStepChanged: function (event, currentIndex) {

                    altair_wizard.content_height($wizard_advanced, currentIndex);


                    if (currentIndex == 2) {
                        branchMap.refresh();
                    } else if (currentIndex == 3) {
                        finalScreen.fillData();
                    }


                    setTimeout(function () {
                        $window.resize();
                    }, 100)
                },
                onStepChanging: function (event, currentIndex, newIndex) {

                    //skips the parsley for testing purposes
                    return true;

                    var step = $wizard_advanced.find('.body.current').attr('data-step'),
                        $current_step = $('.body[data-step=\"' + step + '\"]');


                    //skip field check when clicking previous steps
                    if (currentIndex > newIndex) {

                        for (var i = newIndex + 1; i <= currentIndex; i++) {
                            //disable button so you can't skip steps not filled
                            disableStep(i + 1);
                        }
                        return true;
                    }
                    else if (create_campaign_helper.interaction == null) {
                        return false;
                    }

                    // check input fields for errors
                    $current_step.find('[data-parsley-id]').each(function () {
                        $(this).parsley().validate();
                    });

                    // adjust content height
                    $window.resize();

                    return $current_step.find('.md-input-danger:visible').length ? false : true;
                },
                onFinished: function () {

                    var formObj = $wizard_advanced_form.serializeObject();


                    formObj.survey = [];

                    for (var i = 1; i <= 5; i++) {
                        var question = formObj["survey_q" + i];
                        delete formObj["survey_q" + i];

                        var answers = [];

                        for (var j = 1; j <= 4; j++) {
                            var answer = formObj["survey_q" + i + "_a" + j];
                            delete formObj["survey_q" + i + "_a" + j];
                            if (answer != "") {
                                answers.push(answer);
                            }
                        }

                        if (question != "") {
                            formObj.survey.push({"question": question, "answers": answers});
                        }

                    }

                    formObj.images = create_campaign_helper.images;


                    //removing fields that don't belong to interaction
                    formObj.interactionId = create_campaign_helper.interaction;

                    if (create_campaign_helper.interaction != "survey") {
                        delete formObj.survey;
                    }
                    if (create_campaign_helper.interaction != "captcha") {
                        delete formObj.captcha;
                    }
                    if (create_campaign_helper.interaction != "banner-link") {
                        delete formObj.banner_link;
                    }

                    // Ajax

                    $.ajax({
                        method: "POST",
                        url: "/campaigns/store",
                        data: formObj,
                    }).done(function (data) {
                        console.log(JSON.stringify(data));
                        //$(this).addClass("done");
                    }).fail(function (data) {
                        console.log(JSON.stringify(data));
                    });

                    //var form_serialized = JSON.stringify(formObj, null, 2);
                    //UIkit.modal.alert('<p>Wizard data:</p><pre>' + form_serialized + '</pre>');

                },
            })/*.steps("setStep", 2)*/;

            $window.on('debouncedresize', function () {
                var current_step = $wizard_advanced.find('.body.current').attr('data-step');
                altair_wizard.content_height($wizard_advanced, current_step);
            });

            // wizard
            $wizard_advanced_form
                .parsley()
                .on('form:validated', function () {
                    setTimeout(function () {
                        altair_md.update_input($wizard_advanced_form.find('.md-input'));
                        // adjust content height
                        $window.resize();
                    }, 100)
                })
                .on('field:validated', function (parsleyField) {

                    var $this = $(parsleyField.$element);
                    setTimeout(function () {
                        altair_md.update_input($this);
                        // adjust content height
                        var currentIndex = $wizard_advanced.find('.body.current').attr('data-step');
                        altair_wizard.content_height($wizard_advanced, currentIndex);
                    }, 100);


                    /*$(parsleyField.$element).each(function() {
                     console.log($this);
                     });*/
                });

        }
    },
    vertical_wizard: function () {
        var $wizard_vertical = $('#wizard_vertical');
        if ($wizard_vertical.length) {
            $wizard_vertical.steps({
                headerTag: "h3",
                bodyTag: "section",
                enableAllSteps: true,
                enableFinishButton: false,
                transitionEffect: "slideLeft",
                stepsOrientation: "vertical",
                onInit: function (event, currentIndex) {
                    altair_wizard.content_height($wizard_vertical, currentIndex);
                },
                onStepChanged: function (event, currentIndex) {
                    altair_wizard.content_height($wizard_vertical, currentIndex);
                }
            });
        }
    }

};

function disableStep(id) {
    setTimeout(function () {
        var currentLi = $(".wizard .steps ul li:nth-child(" + (id) + ")");

        currentLi.removeClass("done");
        currentLi.addClass("disabled");
        currentLi.attr("aria-disabled", "true");
        currentLi.removeAttr("aria-selected");
    }, 10)
}