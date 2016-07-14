var EventDispatcher = (function () {
    var instance;

    function createInstance() {

        $( "body" ).append( "<div id='event_dispatcher'></div>" );

        return {
            on:function (event, func) {
                $("#event_dispatcher").on(event,func);
            },
            trigger:function(event, params)
            {
                params = params||[];
                $("#event_dispatcher").trigger(event,params);
            }
        };
    }

    return {
        getInstance: function () {
            if (!instance) {
                instance = createInstance();
            }
            return instance;
        }
    };
})();

