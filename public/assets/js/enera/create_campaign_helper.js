$(function() {
    "use strict";

    // page onload functions
    create_campaign_helper.init();

});

create_campaign_helper =
{
    interaction: null,
    init: function()
    {
        console.log("create_campaign_helper.init()");

        //disable button until campaign is selected
        var btnNext = $(".button_next");
        btnNext.addClass("disabled");
        btnNext.attr("aria-disabled","true");

        //set preview when uploading a banner
        $("#file_upload-select").change(function(){
            create_campaign_helper.showPreview(event,'.banner-1', 600,602)
        });

        $("#file_upload-select_2").change(function(){
            create_campaign_helper.showPreview(event,'.banner-2', 684, 864)
        });
    },
    setInteraction: function(interactionId)
    {
        console.log("campaign selected");
        create_campaign_helper.interaction = interactionId;

        //show only the fields that the campaign needs
        $(".preview").css("display","none");
        $(".step2-field").css("display","none");
        $("."+interactionId).css("display","block");

        //enable button
        var btnNext = $(".button_next");
        btnNext.removeClass("disabled");
        btnNext.attr("aria-disabled","false");
    },
    showPreview: function(event, previewId, width, height)
    {
        var input = event.target;

        //load image on input field
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = $(previewId);

            //change every instance where the image should go
            output.each(function()
            {
                $(this).attr("src", dataURL);
            });
        };
        reader.readAsDataURL(input.files[0]);

        //check for image size
        var _URL = window.URL || window.webkitURL;
        image = new Image();
        image.onload = function()
        {
            var errorDiv = $(previewId+"-errors");

            if(this.width==width && this.height==height)
            {
                //image size ok!
                errorDiv.html('');

            }
            else
            {
                //image size is different than expected
                errorDiv.html('<span class="parsley-required uk-text-center md-input-danger">El tamaño de la imagen debe ser de <br>'+width+' pixeles de ancho por '+height+' pixeles de alto.</span>');
                //parsley-errors-list
                /*
                 <span class="parsley-required uk-text-center md-input-danger">
                 El tamaño de la imagen no coincide
                 </span>
                 */
            }
            //console.log("The image width is " +this.width + " and image height is " + this.height);
        };
        image.src = _URL.createObjectURL(input.files[0]);

    }
}