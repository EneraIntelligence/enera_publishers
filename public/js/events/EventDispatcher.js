///<reference path="../campaign_wizard/WizardSteps.ts"/>
var EventDispatcher;
(function (EventDispatcher) {
    function on(event, func) {
        if ($("#event_dispatcher").length === 0) {
            $("body").append('<div id="event_dispatcher"></div>');
        }
        $("#event_dispatcher").on(event, func);
    }
    EventDispatcher.on = on;
    function trigger(event, params) {
        if ($("#event_dispatcher").length === 0) {
            $("body").append('<div id="event_dispatcher"></div>');
        }
        params = params || [];
        $("#event_dispatcher").trigger(event, params);
    }
    EventDispatcher.trigger = trigger;
})(EventDispatcher || (EventDispatcher = {}));
//# sourceMappingURL=EventDispatcher.js.map