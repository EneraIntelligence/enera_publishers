$(function() {
    "use strict";

    // page onload functions
    enera_icons_animation.init();

});

enera_icons_animation = {

    //default icon colors
    bgColor:"#fff",
    textColor:"#737373",
    //selected icon colors
    selBgColor:"#1e88e5",
    selTextColor:"#fff",

    init: function() {
        $(".interaction-btn").each(function()
        {
            $(this).click(enera_icons_animation.click);

        });
    },
    click: function()
    {
        var bgColor = enera_icons_animation.bgColor;
        var textColor = enera_icons_animation.textColor;

        var selBgColor = enera_icons_animation.selBgColor;
        var selTextColor = enera_icons_animation.selTextColor;

        //reset btns to default
        var btns = $(".interaction-btn");
        btns.css("background-color", bgColor);
        btns.css("color", textColor);
        //resets svgs color to default
        var svgs = btns.find("svg");
        TweenLite.to(svgs,.3,{stroke:textColor, fill:textColor, scale:1});


        //change clicked btn to selected colors
        $(this).css("background-color", selBgColor);
        $(this).css("color", selTextColor);
        var svg = $(this).find("svg");
        TweenLite.killTweensOf(svg);
        TweenLite.to(svg,.3,{stroke:selTextColor, fill:selTextColor, scale:1.1});

        //get the interaction id
        var interaction = $(this).data("interaction");
        //set the interaction on object
        create_campaign_helper.setInteraction(interaction);


        //animate banner icon
        TweenLite.fromTo(svg.find("#line_banner1"),.7,{y:"-=40", alpha:0},{y:0, alpha:1});
        TweenLite.fromTo(svg.find("#line_banner2"),.7,{y:"-=40", alpha:0},{y:0, alpha:1});

        //animate banner link
        TweenLite.fromTo(svg.find("#chain"),.7,{rotation:0, transformOrigin:"50% 50%"},{rotation:360});

        //animate mailing list
        TweenLite.fromTo(svg.find("#mail"),.5,{rotation:"-10", transformOrigin:"0% 100%"},{rotation:0, ease:Bounce.easeOut});
        TweenLite.fromTo(svg.find("#mail_sheet"),.5,{scaleY:0, transformOrigin:"50% 100%"},{scaleY:1, delay:.3});
        TweenLite.fromTo(svg.find("#mail_lines"),.5,{y:"+=30", alpha:0, transformOrigin:"50% 100%"},{y:0, alpha:1, delay:.3});


        //animate captcha
        TweenLite.fromTo(svg.find("#exe1"),.5,{scale:0, transformOrigin:"50% 50%"},{delay:.25, scale:1, ease:Elastic.easeOut});
        TweenLite.fromTo(svg.find("#exe2"),.5,{scale:0, transformOrigin:"50% 50%"},{delay:.5, scale:1, ease:Elastic.easeOut});

        //animate survey
        for(var i = 1;i<=5;i++)
        {
            //s_line
            TweenLite.fromTo(svg.find("#s_line"+i),.3,{scaleX:0 },{delay:.1*i, scaleX:1});
        }

        //animate video
        TweenLite.fromTo(svg.find("#play_btn"),.3,{x:0, alpha:1, scale:1, transformOrigin:"50% 50%"},{x:"+50", alpha:0, scale:0, ease:Power2.easeIn});
        TweenLite.fromTo(svg.find("#play_btn"),.3,{x:"-90", alpha:0, scale:0, transformOrigin:"50% 50%"},{delay:.51, x:0, alpha:1, scale:1, ease:Power2.easeOut});





    }
};
