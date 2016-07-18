/// imports reference to jquery
/// <reference path="../../../typings/jquery/jquery.d.ts" />
/// <reference path="../events/EventDispatcher.ts"/>
/// <reference path="../events/WizardEvents.ts"/>

interface WizardInitFunc {
    (interactionId:string):void;
}

interface getContainerFunc {
    ():JQuery;
}

interface BoolFunc {
    ():boolean;
}

interface WizardStep{
    initialize:WizardInitFunc;
    getContainer:getContainerFunc;
    getData:any;
    isValid:BoolFunc;
}

class Step1 implements WizardStep
{
    validForm:boolean=false;

    constructor() {
        console.log("constructor");
        this.validForm=false;
    }

    isValid()
    {
        console.log("isValid: "+this.validForm);

        return this.validForm;
    };

    getData()
    {
        return {};
    };

    initialize(interacionId:string)
    {

        this.validForm=true;

        setTimeout(function()
        {
            var ev = EventDispatcher;
            ev.trigger(WizardEvents.interactionSelected, "banner_link" );
/*
             $(this).addClass("indigo active");

             $(this).find("img").removeClass("indigo");
             $(this).find("img").addClass("white");*/

            ev.trigger(WizardEvents.validForm,null);
            ev.trigger(WizardEvents.goNext,null);

            console.log("event sent");

        },5000);
    };

    getContainer()
    {
        return $("#step_1");
    };

}

class Step2 implements WizardStep
{
    validForm:boolean=false;

    isValid()
    {
        return this.validForm;
    };

    getData()
    {
        return {};
    };

    initialize(interacionId:string)
    {

    };

    getContainer()
    {
        return $("#step_2");
    };
}

class Step3 implements WizardStep
{
    validForm:boolean=false;

    isValid()
    {
        return this.validForm;
    };

    getData()
    {
        return {};
    };

    initialize(interacionId:string)
    {

    };

    getContainer()
    {
        return $("#step_3");
    };
}

class Step4 implements WizardStep
{
    validForm:boolean=false;

    isValid()
    {
        return this.validForm;
    };

    getData()
    {
        return {};
    };

    initialize(interacionId:string)
    {

    };

    getContainer()
    {
        return $("#step_4");
    };
}

class Step5 implements WizardStep
{
    validForm:boolean=false;

    isValid()
    {
        return this.validForm;
    };

    getData()
    {
        return {};
    };

    initialize(interacionId:string)
    {

    };

    getContainer()
    {
        return $("#step_5");
    };

    setSummaryData(data:{})
    {
        
    }
}