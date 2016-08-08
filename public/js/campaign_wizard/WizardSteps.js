/// imports reference to jquery
/// <reference path="../../../typings/jquery/jquery.d.ts" />
/// <reference path="../../../typings/jquery.validation/jquery.validation.d.ts" />
/// <reference path="../../../typings/cropperjs/cropperjs.d.ts" />
/// <reference path="../../../typings/nouislider/nouislider.d.ts" />
/// <reference path="../events/EventDispatcher.ts"/>
/// <reference path="../events/WizardEvents.ts"/>
/// <reference path="../../../typings/materialize-css/materialize-css.d.ts" />
/// <reference path="../../../typings/tinymce/tinymce.d.ts" />
var interactionSelected = WizardEvents.interactionSelected;
var Step1 = (function () {
    function Step1() {
        this.validForm = false;
        var step1 = this;
        //setup clicks on interactions
        this.getContainer().find(".collection-item").each(function (index) {
            $(this).click(function () {
                var ev = EventDispatcher;
                ev.trigger(WizardEvents.interactionSelected, $(this).data("interaction"));
                step1.validForm = true;
                ev.trigger(WizardEvents.validForm);
                ev.trigger(WizardEvents.goNext);
                step1.interaction = $(this).data("interaction");
            });
        });
    }
    Step1.prototype.isValid = function () {
        return this.validForm;
    };
    ;
    Step1.prototype.getData = function () {
        return { "interaction": this.interaction };
    };
    ;
    Step1.prototype.initialize = function (interacionId) {
        this.validForm = false;
    };
    ;
    Step1.prototype.getContainer = function () {
        return $("#step_1");
    };
    ;
    return Step1;
}());
var Step2 = (function () {
    function Step2() {
        this.numQuestions = 5;
        this.images = [];
        this.dataMasks = {
            "banner_link": { "link": true, "image_small": true, "image_large": true },
            "like": { "like": true, "image_small": true, "image_large": true },
            "mailing_list": { "mail_name": true, "mail_address": true, "mail_subject": true, "mailing_content": true },
            "captcha": { "captcha": true, "image_small": true, "image_large": true },
            "survey": { "image_survey": true },
            "video": { "video": true, "image_video": true }
        };
        //initialize mask with all the question fields
        for (var q = 1; q <= this.numQuestions; q++) {
            var surveyMask = this.dataMasks['survey'];
            surveyMask["question_" + q] = true;
            for (var ans = 1; ans <= 4; ans++) {
                surveyMask["answer_" + q + "_" + ans] = true;
            }
        }
        var step2 = this;
        //initialize image changes
        $("#image-small").change(function () {
            step2.showPreview(event, "#image-small", 600, 602);
        });
        $("#image-large").change(function () {
            step2.showPreview(event, "#image-large", 684, 864);
        });
        $("#image-survey").change(function () {
            step2.showPreview(event, "#image-survey", 684, 400);
        });
        $("#image-video").change(function () {
            step2.showPreview(event, "#image-video", 640, 360);
        });
        //video upload
        $("#video-input").change(function () {
            step2.uploadVideo();
        });
        $("#crop-btn").click(function () {
            //crop button pressed
            step2.cropUploadImage();
        });
    }
    Step2.prototype.isValid = function () {
        if (!this.form.valid()) {
            //fields not valid
            this.validator.focusInvalid();
            Materialize.updateTextFields();
        }
        else if (this.interactionId == "mailing_list" && tinymce.activeEditor.getContent() == "") {
            //text area not valid
            Materialize.toast('¡Debes llenar el contenido del correo!', 4000);
            tinymce.execCommand('mceFocus', false, '#mailing_content');
            return false;
        }
        return this.form.valid();
    };
    ;
    Step2.prototype.getData = function () {
        //return the json form data
        var serialized = $("#data-form").serializeArray();
        var jsonCam = {};
        var mask = this.currentMask;
        // build key-values
        $.each(serialized, function () {
            if (mask[this.name] && this.value != "")
                jsonCam[this.name] = this.value;
        });
        //inject images to data
        if (mask["image_small"] && this.images['small'])
            jsonCam["image_small"] = this.images['small'];
        if (mask["image_large"] && this.images['large'])
            jsonCam["image_large"] = this.images['large'];
        if (mask["image_survey"] && this.images['survey'])
            jsonCam["image_survey"] = this.images['survey'];
        if (mask["image_video"] && this.images['video'])
            jsonCam["image_video"] = this.images['video'];
        if (mask["video"] && this.video)
            jsonCam["video"] = this.video;
        return jsonCam;
    };
    ;
    Step2.prototype.initialize = function (interactionId) {
        this.interactionId = interactionId;
        //initialize rules for the form depending on the interaction
        this.currentMask = this.dataMasks[interactionId];
        setTimeout(function () {
            $("#link-input").focus();
            var ev = EventDispatcher;
            ev.trigger(WizardEvents.validForm);
        }, 400);
        //hide unnecesary fields and set validation rules
        this.hideAllExcept(interactionId);
        this.form = $("#data-form");
        this.validator = this.getValidator(interactionId);
    };
    ;
    Step2.prototype.getContainer = function () {
        return $("#step_2");
    };
    ;
    Step2.prototype.showPreview = function (event, previewId, width, height) {
        //initialize and clear image cropper
        var imageContainer = $("#image-cropper");
        imageContainer.empty();
        imageContainer.append('<img class="responsive-img" src="" alt="">');
        var output = imageContainer.find("img");
        output.attr("src", "");
        var _URL = window.URL;
        var input = event.target;
        var image = new Image();
        image.src = _URL.createObjectURL(input.files[0]);
        var step2 = this;
        image.onload = function () {
            //load image on input field
            var reader = new FileReader();
            reader.onload = function () {
                var dataURL = reader.result;
                //change modal image to crop
                output.attr("src", dataURL);
                $('#modal-image').openModal({
                    dismissible: false,
                    complete: function () {
                        //close on cancel
                        input.value = "";
                    }
                });
                output.cropper({
                    aspectRatio: width / height,
                    viewMode: 1,
                    resizable: true,
                    zoomable: false,
                    rotatable: false,
                    multiple: true,
                    crop: function (e) {
                        // save the crop data to have it available when user clicks save
                        step2.cropData = e;
                        step2.cropData.previewId = previewId;
                        step2.cropData.imageWidth = width;
                        step2.cropData.imageHeight = height;
                        step2.cropData.image = image;
                        step2.cropData.previewId = previewId;
                        step2.cropData.input = input;
                    }
                });
            };
            reader.readAsDataURL(input.files[0]);
        };
    };
    Step2.prototype.cropUploadImage = function () {
        //show loader
        $('#modal-loader').openModal({
            dismissible: false // Modal can't be dismissed by clicking outside of the modal
        });
        //get the crop data
        var img = this.cropData.image;
        var x = Math.round(this.cropData.x);
        var y = Math.round(this.cropData.y);
        var width = Math.round(this.cropData.width);
        var height = Math.round(this.cropData.height);
        var expWidth = Math.round(this.cropData.imageWidth);
        var expHeight = Math.round(this.cropData.imageHeight);
        var previewId = this.cropData.previewId;
        var input = this.cropData.input;
        if (x < 0)
            x = 0;
        if (y < 0)
            y = 0;
        if (y + height > img.naturalHeight) {
            height = img.naturalHeight - y;
        }
        if (x + width > img.naturalWidth) {
            width = img.naturalWidth - x;
        }
        //create canvas
        var resize_canvas = document.createElement('canvas');
        resize_canvas.width = expWidth;
        resize_canvas.height = expHeight;
        //paint canvas with croped portion of image
        resize_canvas.getContext('2d').drawImage(img, x, y, width, height, 0, 0, expWidth, expHeight);
        var pic = resize_canvas.toDataURL("image/png");
        $(this.cropData.previewId + "-cropped").attr('src', pic);
        //fill data to send to ajax
        input.value = "";
        var form_data = new FormData($('#data-form')[0]);
        form_data.append("imgType", previewId);
        form_data.append("imgToSave", pic);
        var inputId = "#" + previewId.substring(1, previewId.length);
        //console.log("inputId: " + inputId);
        var inputField = $(inputId);
        var step2 = this;
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
            if (data.success) {
                step2.images[data.imageType] = data;
                inputField.rules("remove");
                $('#modal-loader').closeModal();
                $('#modal-image').closeModal();
            }
            else {
                console.log("ajax success, image upload fail: " + data.msg);
                alert("Hubo un problema al subir la imagen. Revisa tu conexión a internet e intenta de nuevo.");
                setTimeout(function () {
                    $('#modal-loader').closeModal();
                }, 200);
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            alert("Hubo un problema al subir la imagen. Revisa tu conexión a internet e intenta de nuevo.");
            setTimeout(function () {
                $('#modal-loader').closeModal();
            }, 200);
        });
    };
    Step2.prototype.uploadVideo = function () {
        //show loader
        $('#modal-loader').openModal({
            dismissible: false // Modal can't be dismissed by clicking outside of the modal
        });
        var form_data = new FormData($('#data-form')[0]);
        var inputId = "#video-input";
        var inputField = $(inputId);
        //upload item via ajax
        $.ajax({
            url: '/campaigns/save-video',
            type: 'POST',
            dataType: 'JSON',
            data: form_data,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (data) {
            inputField.rules("remove");
            this.video = data;
            this.validator.element("#video-input");
            $('#modal-loader').closeModal();
            Materialize.toast('Video subido exitosamente.', 4000);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert("Hubo un problema al subir el video. Verifica que el peso del archivo sea menor a 10mb.");
            setTimeout(function () {
                $('#modal-loader').closeModal();
            }, 200);
            //inputField.value = "";
        });
    };
    Step2.prototype.hideAllExcept = function (interaction) {
        $(".data-field").css("display", "none");
        $(".data-" + interaction).css("display", "block");
    };
    Step2.prototype.labelFix = function (element, event) {
        //console.log("herp: "+this);
        //console.log("derp: "+this.validator);
        this.validator.element(element);
        Materialize.updateTextFields();
    };
    ;
    Step2.prototype.getValidator = function (interactionId) {
        if (this.validator)
            return this.validator;
        var step = this;
        var labelFixFunc = function (element, event) {
            step.labelFix(element, event);
        };
        // var validatorObject = wizard_validators.validators[interactionId];
        var validatorObject = {
            onsubmit: false,
            onfocusout: labelFixFunc,
            rules: {
                link: {
                    required: true,
                    url: true
                },
                like: {
                    required: true,
                    url: true
                },
                captcha: {
                    required: true
                },
                mail_name: {
                    required: true
                },
                mail_subject: {
                    required: true
                },
                mailing_content: {
                    required: true
                },
                mail_address: {
                    required: true,
                    email: true
                },
                question_1: {
                    required: true
                },
                answer_1_1: {
                    required: true
                },
                answer_1_2: {
                    required: true
                },
                image_small: {
                    required: true
                },
                image_large: {
                    required: true
                },
                image_survey: {
                    required: true
                },
                image_video: {
                    required: true
                },
                video: {
                    required: true
                }
            }
        };
        if (validatorObject) {
            this.validator = this.form.validate(validatorObject);
            return this.validator;
        }
        else {
            console.log("Error:  wizard_validators.validator for --> " + interactionId + " not created");
            return null;
        }
    };
    return Step2;
}());
var Step3 = (function () {
    function Step3() {
        this.validForm = false;
        this.age_start = 13;
        this.age_end = 100;
        this.maleSelected = true;
        this.femaleSelected = true;
        //initialize rules for the form depending on the interaction
        var slider = document.getElementById('slider');
        var step3 = this;
        this.setupGenreButtons();
        noUiSlider.create(slider, {
            start: [13, 100],
            connect: true,
            step: 1,
            margin: 1,
            range: {
                'min': 0,
                'max': 100
            },
            format: wNumb({
                decimals: 0
            })
        });
        slider.noUiSlider.on('slide', function () {
            //console.log(slider.noUiSlider.get());
            if (slider.noUiSlider.get()[0] < 13)
                slider.noUiSlider.set([13]);
            step3.age_start = slider.noUiSlider.get()[0];
            step3.age_end = slider.noUiSlider.get()[1];
            $("#age_text").text("Personas de  " + slider.noUiSlider.get()[0] + " a " + slider.noUiSlider.get()[1] + " años.");
        });
        $('#all').change(function () {
            var checkboxes = $(this).closest('form').find(':checkbox');
            if ($(this).is(':checked')) {
                checkboxes.prop('checked', true);
            }
            else {
                checkboxes.prop('checked', false);
            }
        });
        $('#sel').change(function () {
            var checkboxes = $(this).closest('form').find(':checkbox');
            if ($(this).is(':checked')) {
                checkboxes.prop('checked', false);
            }
            else {
                checkboxes.prop('checked', true);
            }
        });
        $(':checkbox').change(function () {
            $("#sel").prop("checked", true);
            $("#all").prop("checked", false);
        });
        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate() - 1;
        var year = d.getFullYear();
        var $input_date = $('#start').pickadate({
            selectMonths: true,
            selectYears: 15,
            container: "body",
            monthsFull: ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
            monthsShort: ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'],
            weekdaysFull: ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'],
            weekdaysShort: ['dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb'],
            formatSubmit: 'dd.mm.yyyy',
            today: 'hoy',
            clear: 'borrar',
            close: 'cerrar',
            onSet: function (arg) {
                $("#end").prop('disabled', false);
                if ('select' in arg) {
                    this.close();
                }
                var endDay = parseInt(picker_ini.get('select', 'dd'));
                var endMonth = parseInt(picker_ini.get('select', 'mm'));
                var endYear = parseInt(picker_ini.get('select', 'yyyy'));
                var ev = EventDispatcher;
                ev.trigger(WizardEvents.invalidForm);
                step3.validForm = false;
                picker_end.clear();
                picker_end.set("min", [endYear, endMonth - 1, endDay + 1]);
                step3.start_date = picker_ini.get("select", "dd.mm.yyyy");
            },
            disable: [
                true,
                { from: ['year', 'month', 'day'], to: [2300, 11, 31] }
            ]
        });
        var picker_ini = $input_date.pickadate('picker');
        var $input_end = $('#end').pickadate({
            selectMonths: true,
            selectYears: 15,
            container: "body",
            monthsFull: ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
            monthsShort: ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'],
            weekdaysFull: ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'],
            weekdaysShort: ['dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb'],
            formatSubmit: 'dd.mm.yyyy',
            today: 'hoy',
            clear: 'borrar',
            close: 'cerrar',
            onSet: function (arg) {
                if ('select' in arg) {
                    var ev = EventDispatcher;
                    ev.trigger(WizardEvents.validForm);
                    step3.validForm = true;
                    step3.end_date = picker_end.get("select", "dd.mm.yyyy");
                    this.close();
                }
            },
            onOpen: function () {
                this.render(true);
            }
        });
        var picker_end = $input_end.pickadate('picker');
    }
    ;
    Step3.prototype.setupGenreButtons = function () {
        var femaleBtn = $(".female-btn");
        var maleBtn = $(".male-btn");
        var step3 = this;
        femaleBtn.click(function () {
            step3.toggleGenre(0);
        });
        maleBtn.click(function () {
            step3.toggleGenre(1);
        });
    };
    Step3.prototype.toggleGenre = function (btnId) {
        if (btnId == 0) {
            if (this.maleSelected || !this.femaleSelected) {
                //toggle only if there will be a genre selected
                this.femaleSelected = !this.femaleSelected;
            }
        }
        else {
            if (this.femaleSelected || !this.maleSelected) {
                //toggle only if there will be a genre selected
                this.maleSelected = !this.maleSelected;
            }
        }
        var femaleBtn = $(".female-btn");
        var maleBtn = $(".male-btn");
        var text = $("#genres-text");
        text.html("");
        if (this.femaleSelected && this.maleSelected) {
            femaleBtn.removeClass("grey");
            maleBtn.removeClass("grey");
            text.append("Mujeres y hombres");
        }
        else if (this.femaleSelected) {
            femaleBtn.removeClass("grey");
            maleBtn.addClass("grey");
            text.append("Sólo mujeres");
        }
        else {
            maleBtn.removeClass("grey");
            femaleBtn.addClass("grey");
            text.append("Sólo hombres");
        }
    };
    Step3.prototype.isValid = function () {
        return this.validForm;
    };
    ;
    Step3.prototype.getData = function () {
        //return the json form data
        var step3 = this;
        var serialized = $("#data-filters").serializeArray();
        var campData = new CampaignData();
        campData.age_start = step3.age_start;
        campData.age_end = step3.age_end;
        // build key-values
        $.each(serialized, function () {
            campData[this.name] = this.value;
        });
        campData.start_date = step3.start_date;
        campData.end_date = step3.end_date;
        return campData;
    };
    ;
    Step3.prototype.initialize = function (interacionId) {
        //initialize
        if (this.validForm) {
            setTimeout(function () {
                $("#link-input").focus();
                var ev = EventDispatcher;
                ev.trigger(WizardEvents.validForm);
            }, 400);
        }
    };
    ;
    Step3.prototype.getContainer = function () {
        return $("#step_3");
    };
    ;
    return Step3;
}());
var Step4 = (function () {
    function Step4() {
        this.validForm = false;
        this.interactionPrice = 0;
        var step4 = this;
        $("#budget_input").keyup(function () {
            step4.validForm = step4.updateBudget(this.value);
        });
    }
    Step4.prototype.isValid = function () {
        return this.validForm;
    };
    ;
    Step4.prototype.getData = function () {
        var step4 = this;
        return { budget: step4.amount };
    };
    ;
    Step4.prototype.initialize = function (interacionId) {
        //hide other prices
        this.hideAllExcept(interacionId);
        var step4 = this;
        step4.validForm = step4.updateBudget($("#budget_input").val());
    };
    ;
    Step4.prototype.getContainer = function () {
        return $("#step_4");
    };
    ;
    Step4.prototype.hideAllExcept = function (interaction) {
        $(".data-field").css("display", "none");
        $(".data-" + interaction).css("display", "block");
        var step4 = this;
        step4.interactionPrice = Number($("#price-" + interaction).html().trim().substr(1).replace(",", ""));
        // console.log( "derp:"+interaction+" - price:"+$("#price-" + interaction).html() )
    };
    Step4.prototype.updateBudget = function (val) {
        var current = $("#currentBalance");
        var balance = Step4.moneyToNumber(current.html());
        var amount = Step4.moneyToNumber(val);
        var total = balance - amount;
        var balanceHtml = $("#balance");
        balanceHtml.removeClass("red-text");
        var numInteractions = $("#num_interactions");
        numInteractions.html("0");
        if (total < 0 || isNaN(total) || amount < 100) {
            balanceHtml.html("Cantidad inválida (mínimo $100.00)");
            balanceHtml.addClass("red-text");
            EventDispatcher.trigger(WizardEvents.invalidForm);
            return false;
        }
        balanceHtml.html("$" + total);
        numInteractions.html("" + Math.floor(amount / this.interactionPrice));
        EventDispatcher.trigger(WizardEvents.validForm);
        this.amount = amount;
        return true;
    };
    Step4.moneyToNumber = function (money) {
        var cleanStr = money.trim();
        if (cleanStr.indexOf("$") !== -1)
            cleanStr = cleanStr.substr(1);
        return Number(cleanStr.replace(",", ""));
    };
    return Step4;
}());
var Step5 = (function () {
    function Step5() {
        //Summary step screen
        this.validForm = true;
        this.dictInteractions = {
            "banner_link": "Banner + Link",
            "like": "Like",
            "mailing_list": "Mailing list",
            "captcha": "Captcha",
            "survey": "Encuesta",
            "video": "Video"
        };
    }
    Step5.prototype.isValid = function () {
        return this.validForm;
    };
    ;
    Step5.prototype.getData = function () {
        var data = this.data;
        //console.log(data);
        var gender = "both";
        if (data.sex == "caballeros") {
            gender = "male";
        }
        else if (data.sex == "damas") {
            gender = "female";
        }
        //Not yet implemented branch selection
        var branches = "global";
        var survey = [];
        for (var q = 1; q <= 5; q++) {
            if (data["question_" + q]) {
                var obj = {
                    question: data["question_" + q],
                    answers: []
                };
                for (var ans = 1; ans <= 4; ans++) {
                    if (data["answer_" + q + "_" + ans]) {
                        obj.answers.push(data["answer_" + q + "_" + ans]);
                    }
                }
                survey.push(obj);
            }
        }
        var images = {};
        if (data.image_small)
            images['small'] = data.image_small.item_id;
        if (data.image_large)
            images['large'] = data.image_large.item_id;
        if (data.image_survey)
            images['survey'] = data.image_survey.item_id;
        if (data.image_video)
            images['video'] = data.image_video.item_id;
        var video = null;
        if (data.video)
            video = data.video.item_id;
        var campaignData = {
            "title": this.getUrlParameter("name"),
            'start_date': data.start_date,
            'end_date': data.end_date,
            'time': '0;23',
            'days': ["1", "2", "3", "4", "5", "6", "7"],
            'gender': gender,
            'age': data.age_start + ";" + data.age_end,
            'images': images,
            'ubication': 'select',
            'interactionId': data.interaction,
            'budget': data.budget,
            'banner_link': data.link,
            'from': data.mail_name,
            'from_mail': data.mail_address,
            'subject': data.mail_subject,
            'mailing_content': data.mailing_content,
            'survey': survey,
            'captcha': data.captcha,
            'video': video,
            'branches': branches
        };
        return campaignData;
    };
    ;
    Step5.prototype.getUrlParameter = function (sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)), sURLVariables = sPageURL.split('&'), sParameterName, i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
    };
    ;
    Step5.prototype.initialize = function (interactionId) {
        //this step is always valid
        setTimeout(function () {
            //activate send btn
            var ev = EventDispatcher;
            ev.trigger(WizardEvents.validForm);
        }, 400);
    };
    ;
    Step5.prototype.getContainer = function () {
        return $("#step_5");
    };
    ;
    Step5.prototype.setSummaryData = function (data) {
        var step5 = this;
        step5.data = data;
        var campaignData = step5.getCampaignDataHTML(data);
        var filtersData = Step5.getFiltersDataHTML(data);
        $("#summary_container").html("<div>" +
            "<h4>Resumen</h4> " +
            "<div class='divider'></div>" +
            "<h5>Interacción</h5><span>" + step5.dictInteractions[data.interaction] + "</span>" +
            "<div class='row'>" +
            "<div class='col s12 m6'>" +
            "<h5>Contenido</h5>" +
            campaignData +
            "<br>" +
            "</div> " +
            "<div class='col s12 m6'>" +
            "<h5>Segmentacion</h5>" +
            filtersData +
            "</div>" +
            "</div>" +
            "</div>");
    };
    Step5.prototype.getCampaignDataHTML = function (data) {
        var step5 = this;
        var content = "";
        if (data.link) {
            content += "<span><strong>Enlace:</strong> <a target='_blank' href='" + data.link + "'>" + data.link + "</a></span><br>";
        }
        if (data.like) {
            content += "<span><strong>Página de fb:</strong> <a target='_blank' href='" + data.like + "'>" + data.like + "</a></span><br>";
        }
        if (data.captcha) {
            content += "<span><strong>Captcha:</strong> " + data.captcha + "</span><br>";
        }
        if (data.mail_name) {
            content += "<span><strong>Remitente:</strong> " + data.mail_name + "</span><br>";
            content += "<span><strong>Email:</strong> " + data.mail_address + "</span><br>";
            content += "<span><strong>Asunto:</strong> " + data.mail_subject + "</span><br>";
            content += "<span> <a href='#!' onclick='wizardSetup.openMailModal()'> <strong>Correo </strong><i class='material-icons v-middle'>link</i> </a>  </span> <br>";
        }
        if (data.image_small) {
            content += "<span> <a href='#!' onclick='wizardSetup.openImgSmallModal()'> <strong>Banner </strong>(600x602) <i class='material-icons v-middle'>link</i> </a>  </span> <br>";
        }
        if (data.image_large) {
            content += "<span> <a href='#!' onclick='wizardSetup.openImgLargeModal()'>  <strong>Banner </strong>(684x864) <i class='material-icons v-middle'>link</i> </a> </span> <br>";
        }
        if (data.image_survey) {
            content += "<span> <a href='#!' onclick='wizardSetup.openImgSurveyModal()'>  <strong>Imagen de encuesta </strong><i class='material-icons v-middle'>link</i> </a> </span> <br>";
        }
        if (data.video) {
            content += "<span> <a href='#!' onclick='wizardSetup.openVideoModal()'>  <strong>Video </strong><i class='material-icons v-middle'>link</i> </a> </span> <br>";
        }
        if (data.image_video) {
            content += "<span> <a href='#!' onclick='wizardSetup.openImgVideoModal()'>  <strong>Imagen de video</strong> <i class='material-icons v-middle'>link</i> </a> </span> <br>";
        }
        if (data.question_1) {
            content += "<span> <a href='#!' onclick='wizardSetup.openSurveyModal()'> <strong>Encuesta </strong><i class='material-icons v-middle'>link</i> </a> </span> <br>";
        }
        return content;
    };
    Step5.getFiltersDataHTML = function (data) {
        var content = "";
        if (data.sex == "damas") {
            content += "<span>Mujeres </span>";
        }
        else if (data.sex == "caballeros") {
            content += "<span>Hombres </span>";
        }
        else {
            content += "<span>Mujeres y hombres </span>";
        }
        content += "<span>de " + data.age_start + " a " + data.age_end + " años</span><br>";
        var startDate = data.start_date.replace(".", " de ");
        startDate = startDate.replace(".", " de ");
        var endDate = data.end_date.replace(".", " de ");
        endDate = endDate.replace(".", " de ");
        content += "<span>del " + startDate + " al " + endDate + ".</span><br>";
        //no branches in publisher yet (Eder)
        //content+=" <a href='#!' onclick='wizard_summary.openNodesModal()'> <span>Nodos ("+data.branches.length+") <i class='material-icons v-middle'>link</i></span>  </a> <br><br>";
        return content;
    };
    Step5.prototype.openMailModal = function () {
        $("#modal-summary-content").html(this.data.mailing_content);
        $("#modal-summary").openModal();
    };
    Step5.prototype.openImgSmallModal = function () {
        $("#modal-summary-content").html("<img class='responsive-img img-modal' src='https://s3-us-west-1.amazonaws.com/enera-publishers/items/" + this.data.image_small.filename + "' >");
        $("#modal-summary").openModal();
    };
    Step5.prototype.openImgLargeModal = function () {
        $("#modal-summary-content").html("<img class='responsive-img img-modal' src='https://s3-us-west-1.amazonaws.com/enera-publishers/items/" + this.data.image_large.filename + "' >");
        $("#modal-summary").openModal();
    };
    Step5.prototype.openImgSurveyModal = function () {
        $("#modal-summary-content").html("<img class='responsive-img img-modal' src='https://s3-us-west-1.amazonaws.com/enera-publishers/items/" + this.data.image_survey.filename + "' >");
        $("#modal-summary").openModal();
    };
    Step5.prototype.openImgVideoModal = function () {
        $("#modal-summary-content").html("<img class='responsive-img img-modal' src='https://s3-us-west-1.amazonaws.com/enera-publishers/items/" + this.data.image_video.filename + "' >");
        $("#modal-summary").openModal();
    };
    Step5.prototype.openVideoModal = function () {
        $("#modal-summary-content").html("<video class='responsive-video' id='myvideo' controls style='display:block; margin:0 auto;'>" +
            "<source src='https://s3-us-west-1.amazonaws.com/enera-publishers/items/" + this.data.video.filename + "' type='video/mp4'>" +
            "Tu navegador no soporta reproduccion de video." +
            "</video>");
        $("#modal-summary").openModal();
    };
    Step5.prototype.openSurveyModal = function () {
        var survey = "";
        for (var q = 1; q <= 5; q++) {
            if (this.data["question_" + q]) {
                survey += "<ul class='collection with-header'>";
                survey += "<li class='collection-header'><h4>" + this.data["question_" + q] + "</h4></li>";
                for (var ans = 1; ans <= 4; ans++) {
                    if (this.data["answer_" + q + "_" + ans]) {
                        survey += "<li class='collection-item'>" + this.data["answer_" + q + "_" + ans] + "</li>";
                    }
                }
                survey += "</ul>";
            }
        }
        $("#modal-summary-content").html(survey);
        $("#modal-summary").openModal();
    };
    return Step5;
}());
var CampaignData = (function () {
    function CampaignData() {
    }
    return CampaignData;
}());
//# sourceMappingURL=WizardSteps.js.map