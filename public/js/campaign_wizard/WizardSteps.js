/// imports reference to jquery
/// <reference path="../../../typings/jquery/jquery.d.ts" />
/// <reference path="../events/EventDispatcher.ts"/>
/// <reference path="../events/WizardEvents.ts"/>
var Step1 = (function () {
    function Step1() {
        this.validForm = false;
        console.log("constructor");
        this.validForm = false;
    }
    Step1.prototype.isValid = function () {
        console.log("isValid: " + this.validForm);
        return this.validForm;
    };
    ;
    Step1.prototype.getData = function () {
        return {};
    };
    ;
    Step1.prototype.initialize = function (interacionId) {
        this.validForm = true;
        setTimeout(function () {
            var ev = EventDispatcher;
            ev.trigger(WizardEvents.interactionSelected, "banner_link");
            /*
                         $(this).addClass("indigo active");
            
                         $(this).find("img").removeClass("indigo");
                         $(this).find("img").addClass("white");*/
            ev.trigger(WizardEvents.validForm, null);
            ev.trigger(WizardEvents.goNext, null);
            console.log("event sent");
        }, 5000);
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
        this.validForm = false;
    }
    Step2.prototype.isValid = function () {
        return this.validForm;
    };
    ;
    Step2.prototype.getData = function () {
        return {};
    };
    ;
    Step2.prototype.initialize = function (interacionId) {
    };
    ;
    Step2.prototype.getContainer = function () {
        return $("#step_2");
    };
    ;
    return Step2;
}());
var Step3 = (function () {
    function Step3() {
        this.validForm = false;
    }
    Step3.prototype.isValid = function () {
        return this.validForm;
    };
    ;
    Step3.prototype.getData = function () {
        return {};
    };
    ;
    Step3.prototype.initialize = function (interacionId) {
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
    }
    Step4.prototype.isValid = function () {
        return this.validForm;
    };
    ;
    Step4.prototype.getData = function () {
        return {};
    };
    ;
    Step4.prototype.initialize = function (interacionId) {
    };
    ;
    Step4.prototype.getContainer = function () {
        return $("#step_4");
    };
    ;
    return Step4;
}());
var Step5 = (function () {
    function Step5() {
        this.validForm = false;
    }
    Step5.prototype.isValid = function () {
        return this.validForm;
    };
    ;
    Step5.prototype.getData = function () {
        return {};
    };
    ;
    Step5.prototype.initialize = function (interacionId) {
    };
    ;
    Step5.prototype.getContainer = function () {
        return $("#step_5");
    };
    ;
    Step5.prototype.setSummaryData = function (data) {
    };
    return Step5;
}());
//# sourceMappingURL=WizardSteps.js.map