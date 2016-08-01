/// imports reference to jquery
/// <reference path="../../../typings/jquery/jquery.d.ts" />
/// <reference path="../../../typings/greensock/greensock.d.ts" />
/// <reference path="../../../typings/materialize-css/materialize-css.d.ts" />
/// <reference path="../../../typings/pickadate/pickadate.d.ts" />
/// <reference path="WizardSteps.ts"/>
/// <reference path="../events/WizardEvents.ts"/>
var WizardSetup = (function () {
    function WizardSetup(nextBtn, prevBtn) {
        this.currentStep = 0;
        this.interactionId = "";
        this.nextBtn = nextBtn;
        this.prevBtn = prevBtn;
        var wizard = this;
        var goNextFunc = function () { wizard.goNext(); };
        var goPrevFunc = function () { wizard.goPrev(); };
        this.nextBtn.click(goNextFunc);
        this.prevBtn.click(goPrevFunc);
        var step1 = new Step1();
        var step2 = new Step2();
        var step3 = new Step3();
        var step4 = new Step4();
        var step5 = new Step5();
        this.steps = [step1, step2, step3, step4, step5];
        this.setupEvents();
        this.enableButton(this.nextBtn, false);
        this.setup();
        this.initializeCurrentStep(1);
    }
    WizardSetup.prototype.onDocumentReady = function () {
        TweenLite.set(this.prevBtn, { css: { width: "30%", display: "none" } });
        TweenLite.set(this.nextBtn, { css: { width: "70%", display: "none" } });
        //setup initial height
        var currentStepContainer = this.steps[this.currentStep].getContainer();
        this.changeContainerSize(0, currentStepContainer.outerHeight() - 7);
    };
    WizardSetup.prototype.onLoad = function () {
        //setup initial height
        var currentStepContainer = this.steps[this.currentStep].getContainer();
        this.changeContainerSize(0, currentStepContainer.outerHeight() - 7);
        /*
                let wiz:WizardSetup=this;
                let func = function(){wiz.onLoad() };
                setTimeout(func,1000);*/
    };
    WizardSetup.prototype.onResize = function () {
        if (this.timeoutResize)
            clearTimeout(this.timeoutResize);
        var wiz = this;
        var func = function () { wiz.onLoad(); };
        this.timeoutResize = setTimeout(func, 200);
    };
    WizardSetup.prototype.setupEvents = function () {
        var wizard = this;
        var enableNext = function (event) { wizard.enableButton(wizard.nextBtn, true); };
        var disableNext = function (event) { wizard.enableButton(wizard.nextBtn, false); };
        var nextFunc = function () { wizard.goNext(); };
        //setup events
        var changeInteraction = function (event, id) { wizard.changeInteraction(event, id); };
        EventDispatcher.on(WizardEvents.interactionSelected, changeInteraction);
        EventDispatcher.on(WizardEvents.validForm, enableNext);
        EventDispatcher.on(WizardEvents.invalidForm, disableNext);
        EventDispatcher.on(WizardEvents.goNext, nextFunc);
    };
    WizardSetup.prototype.setup = function () {
        for (var i = 0; i < this.steps.length; i++) {
            var step = this.steps[i];
            var container = step.getContainer();
            TweenLite.set(container, { css: { display: 'none' } });
        }
    };
    WizardSetup.prototype.initializeCurrentStep = function (direction) {
        direction = direction || 0;
        var step = this.steps[this.currentStep];
        step.initialize(this.interactionId);
        var container = step.getContainer();
        TweenLite.set(container, { css: { display: "block" } });
        TweenLite.set(container, { y: 0 });
        if (direction == 1) {
            var targetY = $("#wizard-content").offset().top - container.offset().top + 20;
            TweenLite.set(container, { y: targetY });
        }
        TweenLite.fromTo(container, .35, {
            x: container.outerWidth() * direction,
            alpha: 0
        }, {
            x: 0,
            alpha: 1
        });
    };
    WizardSetup.prototype.removeCurrentStep = function (direction) {
        var step = this.steps[this.currentStep];
        var container = step.getContainer();
        if (direction == -1) {
            setTimeout(function () {
                var targetY = $("#wizard-content").offset().top - container.offset().top + 20;
                TweenLite.set(container, { y: targetY });
            }, 10);
        }
        else {
            TweenLite.set(container, { y: 0 });
        }
        var wizard = this;
        TweenLite.to(container, .30, {
            x: -(container.outerWidth() + 100) * direction,
            alpha: 1,
            onComplete: function () {
                TweenLite.set(container, { y: 0, css: { display: "none" } });
                var newStep = wizard.steps[wizard.currentStep];
                var newContainer = newStep.getContainer();
                TweenLite.set(newContainer, { y: 0 });
            }
        });
    };
    WizardSetup.prototype.changeInteraction = function (event, id) {
        this.interactionId = id;
    };
    WizardSetup.prototype.goNext = function () {
        if (this.currentStep < this.steps.length - 1) {
            var step = this.steps[this.currentStep];
            if (step.isValid()) {
                var prevHeight = step.getContainer().outerHeight();
                this.removeCurrentStep(1);
                this.currentStep++;
                if (this.currentStep > 0)
                    this.showPrevButton();
                this.initializeCurrentStep(1);
                step = this.steps[this.currentStep];
                if (this.currentStep == this.steps.length - 1) {
                    //on summary step
                    var dataCamp = {};
                    for (var i = 0; i < this.steps.length - 1; i++) {
                        var currentStep = this.steps[i];
                        $.extend(true, dataCamp, currentStep.getData());
                    }
                    //                        console.log(dataCamp);
                    step.setSummaryData(dataCamp);
                }
                var currentHeight = step.getContainer().outerHeight();
                this.changeContainerSize(prevHeight, currentHeight);
                this.enableButton(this.nextBtn, false);
                var topWizard = $("#wizard-content").offset().top;
                TweenLite.to(window, .5, { scrollTo: { y: topWizard }, ease: Power2.easeOut });
            }
        }
        else {
            //TODO submit form
            $("#modal-summary-content").html("<pre>" +
                JSON.stringify(this.steps[this.currentStep].getData(), null, '\t') +
                "</pre>");
            $("#modal-summary").openModal();
        }
    };
    WizardSetup.prototype.changeContainerSize = function (currentHeight, nextHeight) {
        //added some padding below
        nextHeight += 25;
        if (currentHeight < nextHeight) {
            TweenLite.to("#wizard-content", .2, { css: { height: nextHeight } });
        }
        else {
            TweenLite.to("#wizard-content", .2, { delay: .35, css: { height: nextHeight } });
        }
    };
    WizardSetup.prototype.goPrev = function () {
        if (this.currentStep > 0) {
            var step = this.steps[this.currentStep];
            var prevHeight = step.getContainer().outerHeight();
            this.removeCurrentStep(-1);
            this.currentStep--;
            if (this.currentStep == 0)
                this.hidePrevButton();
            this.initializeCurrentStep(-1);
            step = this.steps[this.currentStep];
            var currentHeight = step.getContainer().outerHeight();
            this.changeContainerSize(prevHeight, currentHeight);
            var topWizard = $("#wizard-content").offset().top;
            TweenLite.to(window, .5, { scrollTo: { y: topWizard }, ease: Power2.easeOut });
        }
    };
    WizardSetup.prototype.showPrevButton = function () {
        TweenLite.set("#prev-btn", { css: { height: "auto", display: "inline-block" } });
        TweenLite.set("#next-btn", { css: { height: "auto", display: "inline-block" } });
    };
    WizardSetup.prototype.hidePrevButton = function () {
        TweenLite.set("#prev-btn", { css: { height: "0", display: "none" } });
        TweenLite.set("#next-btn", { css: { height: "0", display: "none" } });
    };
    WizardSetup.prototype.enableButton = function (btn, enable) {
        if (enable)
            btn.removeClass("disabled");
        else
            btn.addClass("disabled");
    };
    return WizardSetup;
}());
//# sourceMappingURL=WizardSetup.js.map