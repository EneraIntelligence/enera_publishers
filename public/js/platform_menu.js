var platformMenu =
{
    barHeight: 0,
    navBars: [],
    open: false,
    initialize: function () {
        platformMenu.navBars = [];

        $(".nav-wrapper").each(function (index) {
            platformMenu.navBars.push(this);

            if (index > 0) {
                platformMenu.barHeight = $(this).outerHeight();
                $(this).css("margin-top", -platformMenu.barHeight * 2);
            }
        });

        $(window).resize(function () {
                platformMenu.open = !platformMenu.open;
                platformMenu.toggle();
            }
        );
    },
    toggle: function (e) {

        if (e)
            e.stopPropagation();

        if (!platformMenu.open) {
            //console.log("open");
            var vHeight = $(window).height();
            var barHeight = vHeight / platformMenu.navBars.length;

            TweenLite.set("nav", {css: {position: "relative"}});
            TweenLite.set("nav", {css: {zIndex: 900}});

            TweenLite.to("nav", .3, {
                y: vHeight - barHeight,
                onComplete: platformMenu.addActions,
                onCompleteParams: [true]
            });
            platformMenu.open = true;

            $("body").css("overflow","hidden");

            platformMenu.iconsHidden(true);
            platformMenu.barsDepth(true);
            platformMenu.barsGrow(true);
        }
        else {
            //console.log("close");

            //TweenLite.set("nav", {css: {position: "inherit"}});
            TweenLite.set("nav", {css: {zIndex: 1}});

            // TweenLite.set("nav", {css: { position:"relative" } });
            // TweenLite.set("nav", {css: { zIndex:auto } });
            TweenLite.to("nav", .3, {
                y: 0,
                onComplete: function(){
                    $("nav").removeAttr( 'style' );
                    platformMenu.addActions(false);
                }
            });
            platformMenu.open = false;

            $("body").css("overflow","auto");


            platformMenu.iconsHidden(false);
            platformMenu.barsDepth(false);
            platformMenu.barsGrow(false);
        }
    },
    iconsHidden: function (hidden) {
        var opacity = "1";
        var pEvents = "auto";
        if (hidden) {
            opacity = "0";
            pEvents = "none";
        }

        $(".platform-hide").each(function () {
            //$(this).css('cssText', $(this).css('cssText') + 'display: ' + display + ' !important');
            // $(this).css("display", display, 'important');

            $(this).css("pointer-events", pEvents);
            $(this).css("opacity",opacity);
            $(this).css("filter","alpha(opacity="+opacity+"00)");
        });
    },
    barsDepth: function (top) {

        var zDepth = "z-depth-1";

        if (top) {
            zDepth = "z-depth-2";
        }

        for (var i = 1; i < platformMenu.navBars.length; i++) {

            var bar = this.navBars[i];
            $(bar).removeClass("z-depth-1");
            $(bar).removeClass("z-depth-2");
            $(bar).addClass(zDepth);

        }
    },
    barsGrow: function (grow) {

        var bar;
        var i;

        if (grow) {
            // set vars
            var vHeight = $(window).height();
            var barHeight = Math.ceil(vHeight / platformMenu.navBars.length);

            //animate logo and text
            $(".menu-logo").each(function () {
                TweenLite.to(this, .2,
                    {
                        marginTop: ( barHeight - $(this).height() ) / 2
                    });
            });

            //grow menu container


            bar = this.navBars[0];
            TweenLite.to(bar, .3, {
                css: {
                    height: barHeight,
                }
            });

            for (i = 1; i < platformMenu.navBars.length; i++) {

                bar = this.navBars[i];
                platformMenu.barHeight = $(bar).outerHeight();


                TweenLite.to(bar, .3, {
                    css: {
                        height: barHeight,
                        marginTop: -barHeight * 2
                    }
                });

            }
        }
        else {

            //animate logo and text
            $(".menu-logo").each(function () {
                TweenLite.to(this, .2,
                    {
                        marginTop: 0
                    });
            });
            //shrink bars

            bar = this.navBars[0];
            TweenLite.to(bar, .3, {
                css: {
                    height: "100%",
                }
            });

            for (i = 1; i < platformMenu.navBars.length; i++) {

                bar = this.navBars[i];
                TweenLite.to(bar, .3, {
                    css: {
                        height: "100%",
                        marginTop: -platformMenu.barHeight * 2
                    }
                });

            }
        }
    },
    addActions: function (val) {
        var i = 0;

        if (val) {

            //add click to toggle platform
            for (i = 0; i < platformMenu.navBars.length; i++) {

                bar = platformMenu.navBars[i];

                $(bar).bind("click", platformMenu.clicked);

            }
        }
        else {
            //remove click event
            //console.log("remove click event");

            for (i = 0; i < platformMenu.navBars.length; i++) {

                bar = platformMenu.navBars[i];

                $(bar).unbind("click", platformMenu.clicked);

            }
        }
    },
    clicked: function (e) {
        e.preventDefault();

        var url = $(this).data("url");

        if (url === undefined) {
            platformMenu.toggle(e);
        }
        else {
            //console.log($(this));
            //console.log(url);
            window.location.href = url;
            platformMenu.closeWith(this);

        }
    },
    closeWith: function (bar) {
        //console.log("close");
        // TweenLite.set("nav", {css: { position:"relative" } });
        // TweenLite.set("nav", {css: { zIndex:auto } });
        TweenLite.to("nav", .3, {
            y: 0,
            onComplete: platformMenu.addActions,
            onCompleteParams: [false]
        });
        platformMenu.open = false;

        TweenLite.set(bar, {css: {zIndex: 999}});

        platformMenu.iconsHidden(false);
        platformMenu.barsDepth(false);
        platformMenu.barsGrow(false);

        var index = platformMenu.navBars.indexOf(bar);
        TweenLite.to(bar, .3, {
            css: {
                height: platformMenu.barHeight,
                marginTop: -platformMenu.barHeight * (2 - index)
            }
        });

        TweenLite.set("main", {alpha: 0});
        TweenLite.set(".page-loader", {css: {display: "block"}});
    }
};