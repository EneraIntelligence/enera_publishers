(function ()
{
    /**
     * USAGE:
     * 1) load spin.min.js and spinnerButton.js in that order
     * 2a) for submit buttons, use the class spinnerForm in the FORM
     * 2b) for regular buttons use the class spinnerButton
     */
    $(document).ready(function ()
    {
        spinButton.spinner = new Spinner(spinButton.opts).spin();

        $(".spinnerForm").submit(spinButton.submit);

        $(".spinnerButton").click(spinButton.click);
    });

    var spinButton = {
        // Initialize
        opts: {
            lines: 11 // The number of lines to draw
            , length: 5 // The length of each line
            , width: 2 // The line thickness
            , radius: 2 // The radius of the inner circle
            , scale: 1 // Scales overall size of the spinner
            , corners: 1 // Corner roundness (0..1)
            , color: '#FFF' // #rgb or #rrggbb or array of colors
            , opacity: 0.25 // Opacity of the lines
            , rotate: 0 // The rotation offset
            , direction: 1 // 1: clockwise, -1: counterclockwise
            , speed: 1 // Rounds per second
            , trail: 78 // Afterglow percentage
            , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
            , zIndex: 2e9 // The z-index (defaults to 2000000000)
            , className: 'spinner' // The CSS class to assign to the spinner
            , display: 'inline-block' // Top position relative to parent
            , top: '-5px' // Top position relative to parent
            , left: '15px' // Left position relative to parent
            , shadow: false // Whether to render a shadow
            , hwaccel: false // Whether to use hardware acceleration
            , position: 'relative' // Element positioning
        },
        spinner: null,
        submit: function (event)
        {

            //force validation before
            $(this).find('[data-parsley-id]').each(function ()
            {
                $(this).parsley().validate();
            });

            var validated = $(this).find('.md-input-danger:visible').length === 0;

            if (validated)
            {
                var button = $(".spinnerForm :submit");
                button.append(spinButton.spinner.el);

                spinButton.disableButton(button);
            }

        },

        click: function (event)
        {
            $(this).append(spinButton.spinner.el);
            spinButton.disableButton($(this));
        },

        disableButton: function (button)
        {
            button.attr('disabled', true);
            button.css('cursor', 'auto');
            button.css('pointer-events', 'none');
        }
    };

})();
