/// imports reference to jquery
/// <reference path="../../../typings/jquery/jquery.d.ts" />
/// <reference path="../../../typings/greensock/greensock.d.ts" />
/// <reference path="../../../typings/materialize-css/materialize-css.d.ts" />
/// <reference path="../../../typings/pickadate/pickadate.d.ts" />

/// <reference path="WizardSteps.ts"/>
/// <reference path="../events/WizardEvents.ts"/>


class WizardSetup {
    private steps:WizardStep[];
    private currentStep:number = 0;
    private interactionId:string = "";

    private nextBtn:JQuery;
    private prevBtn:JQuery;

    private timeoutResize:number;

    constructor(nextBtn:JQuery, prevBtn:JQuery) {
        this.nextBtn = nextBtn;
        this.prevBtn = prevBtn;

        let wizard:WizardSetup = this;
        let goNextFunc = function () { wizard.goNext() };
        let goPrevFunc = function () { wizard.goPrev() };

        this.nextBtn.click(goNextFunc);
        this.prevBtn.click(goPrevFunc);

        let step1 = new Step1();
        let step2 = new Step2();
        let step3 = new Step3();
        let step4 = new Step4();
        let step5 = new Step5();
        this.steps = [step1, step2, step3, step4, step5];

        this.setupEvents();

        this.enableButton(this.nextBtn,false);

        this.setup();

        this.initializeCurrentStep(1);
    }

    public onDocumentReady()
    {
        TweenLite.set(this.prevBtn, {css: {width: "30%", display: "none"}});
        TweenLite.set(this.nextBtn, {css: {width: "70%", display: "none"}});

        //setup initial height
        var currentStepContainer = this.steps[this.currentStep].getContainer();
        this.changeContainerSize(0, currentStepContainer.outerHeight()-7 );
    }

    public onLoad(){
        //setup initial height
        var currentStepContainer = this.steps[this.currentStep].getContainer();
        this.changeContainerSize(0, currentStepContainer.outerHeight()-7 );
/*
        let wiz:WizardSetup=this;
        let func = function(){wiz.onLoad() };
        setTimeout(func,1000);*/
    }

    public onResize()
    {
        if(this.timeoutResize)
            clearTimeout(this.timeoutResize);


        let wiz:WizardSetup=this;
        let func = function(){wiz.onLoad() };
        this.timeoutResize = setTimeout(func,200);
    }

    private setupEvents() {
        let wizard:WizardSetup = this;
        let enableNext = function(event:string){ wizard.enableButton(wizard.nextBtn,true) };
        let disableNext = function(event:string){ wizard.enableButton(wizard.nextBtn,false) };

        let nextFunc = function () { wizard.goNext() };

        //setup events
        let changeInteraction = function(event:string,id:string){ wizard.changeInteraction(event,id) };


        EventDispatcher.on(WizardEvents.interactionSelected, changeInteraction);
        EventDispatcher.on(WizardEvents.validForm, enableNext );
        EventDispatcher.on(WizardEvents.invalidForm, disableNext );
        EventDispatcher.on(WizardEvents.goNext, nextFunc);
    }

    private setup() {
        for (let i = 0; i < this.steps.length; i++) {
            var step:WizardStep = this.steps[i];
            var container = step.getContainer();

            TweenLite.set(container, {css: {display: 'none'}});
        }
    }

    private initializeCurrentStep(direction:number) {
        direction = direction || 0;

        var step:WizardStep = this.steps[this.currentStep];
        step.initialize(this.interactionId);
        var container = step.getContainer();

        TweenLite.set(container, {css: {display: "block"}});

        TweenLite.set(container, {y: 0});

        if (direction == 1) {
            var targetY = $("#wizard-content").offset().top - container.offset().top + 20;
            TweenLite.set(container, {y: targetY});
        }


        TweenLite.fromTo(container, .35,
            {
                x: container.outerWidth() * direction,
                alpha: 0
            },
            {
                x: 0,
                alpha: 1
            });
    }


    private removeCurrentStep(direction) {
        var step:WizardStep = this.steps[this.currentStep];
        var container = step.getContainer();


        if (direction == -1) {
            setTimeout(function () {
//                    console.log(direction);
                var targetY = $("#wizard-content").offset().top - container.offset().top + 20;
                TweenLite.set(container, {y: targetY});
            }, 10);

        }
        else {
            TweenLite.set(container, {y: 0});
        }

        let wizard:WizardSetup=this;

        TweenLite.to(container, .30, {
            x: -(container.outerWidth() + 100) * direction,
            alpha: 1,
            onComplete: function () {
                TweenLite.set(container, {y: 0, css: {display: "none"}});

                var newStep = wizard.steps[wizard.currentStep];
                var newContainer = newStep.getContainer();
                TweenLite.set(newContainer, {y: 0});
            }
        });
    }


    private changeInteraction(event, id) {
        this.interactionId = id;
        console.log(this);
        console.log("interaction changed to " + this.interactionId);
    }


    private goNext() {

        console.log(this);

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
                        let currentStep:WizardStep = this.steps[i];
                        $.extend(true, dataCamp, currentStep.getData());
                    }
//                        console.log(dataCamp);
                    (step as Step5).setSummaryData(dataCamp);
                }

                var currentHeight = step.getContainer().outerHeight();

                this.changeContainerSize(prevHeight, currentHeight);
                this.enableButton(this.nextBtn,false);

                var topWizard = $("#wizard-content").offset().top;
                TweenLite.to(window, .5, {scrollTo: {y: topWizard}, ease: Power2.easeOut});
            }

        }
        else {

            //TODO submit form

            $("#modal-summary-content").html(
                "<pre>" +
                JSON.stringify(this.steps[this.currentStep].getData(), null, '\t') +
                "</pre>"
            );

            $("#modal-summary").openModal();

        }
    }

    private changeContainerSize(currentHeight, nextHeight) {
        //added some padding below
        nextHeight += 25;

        if (currentHeight < nextHeight) {
            TweenLite.to("#wizard-content", .2, {css: {height: nextHeight}});
        }
        else {
            TweenLite.to("#wizard-content", .2, {delay: .35, css: {height: nextHeight}});

        }
    }

    private goPrev() {

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
            TweenLite.to(window, .5, {scrollTo: {y: topWizard}, ease: Power2.easeOut});

        }
    }


    private showPrevButton() {
        TweenLite.set("#prev-btn", {css: {height: "auto", display: "inline-block"}});
        TweenLite.set("#next-btn", {css: {height: "auto", display: "inline-block"}});
    }

    private hidePrevButton() {
        TweenLite.set("#prev-btn", {css: {height: "0", display: "none"}});
        TweenLite.set("#next-btn", {css: {height: "0", display: "none"}});
    }

    private enableButton(btn:JQuery, enable:boolean) {
        if (enable)
            btn.removeClass("disabled");
        else
            btn.addClass("disabled");
    }


}





