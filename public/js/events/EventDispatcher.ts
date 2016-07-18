///<reference path="../campaign_wizard/WizardSteps.ts"/>

interface eventFunction {
    (event:string, params?);
}

namespace EventDispatcher {



    export function on(event, func:eventFunction) {
        if( $("#event_dispatcher").length===0 )
        {
            $("body").append('<div id="event_dispatcher"></div>');
            
        }

        $("#event_dispatcher").on(event,func);
    }
    export function trigger(event:string, params?)
    {
        if( $("#event_dispatcher").length===0 )
        {
            $("body").append('<div id="event_dispatcher"></div>');
        }

        params = params||[];
        $("#event_dispatcher").trigger(event,params);
    }
}

