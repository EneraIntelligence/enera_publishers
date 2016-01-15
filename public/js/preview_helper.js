$( window ).load(function()
{
    preview_helper.init();
});

preview_helper = {
    init : function()
    {
        console.log("preview_helper.js :: preview_helper.init() ");
        var phoneWidth = $(".phone").width();
        var interactionWidth = $(".interaction-image").width();

        if(phoneWidth>0&&interactionWidth>0)
        {
            //make sure everything is loaded before resizing
            preview_helper.resize();
            //set resize listener
            $( window ).resize(function() {
                preview_helper.resize();
            });
        }
        else
        {
            setTimeout(preview_helper.init,100);
        }
    },
    resize : function()
    {
        console.log("preview_helper.js :: preview_helper.resize() ");
        var phoneImg = $(".phone");
        var interactionImg = $(".interaction-image");
        var interactionContainer = $(".interaction");
        var mainContainer = $(".preview-container");

        var phoneOrigHeight = 469;
        var phoneResizePerc = phoneImg.height()/phoneOrigHeight;

        phoneImg.css("margin-bottom","0");
        interactionContainer.css("height",phoneImg.height()-(149*phoneResizePerc));
        interactionContainer.css("margin-top",-phoneImg.height()+(75*phoneResizePerc) );
        interactionContainer.css("width",phoneImg.width()-(37*phoneResizePerc) );

        interactionImg.css("margin-bottom",10*phoneResizePerc);

        mainContainer.css("height",phoneImg.height());
        mainContainer.css("margin","25px 0 15px");

        $(".interaction-imgs").each(function(){

            // Create new offscreen image to test
            var theImage = new Image();
            theImage.src = $(this).attr("src");

            // Get accurate measurements from that.
            var imageWidth = theImage.width;
            var imageHeight = theImage.height;

            $(this).css("width", imageWidth*phoneResizePerc);
            $(this).css("height", imageHeight*phoneResizePerc);

        });
    },
}