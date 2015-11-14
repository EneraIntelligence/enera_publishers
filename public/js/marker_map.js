/**
 * Created by Eder on 06/11/2015.
 */
(function(window)
{
    /*
     Marker Map
     */
    function MarkerMap(lat,lng, zoom, DOMElement)
    {
        this.markers = [];
        this.originalMarkers = [];
        this.activeMarkers = 0;
        this.center = new google.maps.LatLng(lat,lng);
        this.zoom = zoom;
        this.onMarkersUpdate = new signals.Signal();
        var properties = {
            center:this.center,
            zoom:this.zoom,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        this.map = new google.maps.Map(DOMElement, properties);

    }

    MarkerMap.prototype.addMarker = function(marker)
    {
        this.originalMarkers.push(marker.marker);
        this.markers.push(marker);
        var bMap = this;

        marker.toggleSignal.add(function(clickedMarker){
            bMap.updatedMarker(clickedMarker);
        });
        marker.setMap(this.map);
    };

    MarkerMap.prototype.updatedMarker = function(marker)
    {
        if(marker.active)
        {
            this.activeMarkers++;
        }
        else
        {
            this.activeMarkers--;
        }

        this.onMarkersUpdate.dispatch(this.activeMarkers);
    };

    MarkerMap.prototype.getActiveMarkers = function()
    {
        var activeMarkers = [];

        for(var i=0; i<this.markers.length;i++)
        {
            var marker= this.markers[i];
            if(marker.active)
            {
                activeMarkers.push(marker);
            }
        }

        return activeMarkers;
    };

    MarkerMap.prototype.clusterMarkers = function()
    {
        this.markerCluster = new MarkerClusterer(this.map, this.originalMarkers);
    }

    MarkerMap.prototype.refresh = function()
    {
        google.maps.event.trigger(this.map, 'resize');

        this.map.panTo(this.center);
        this.map.setZoom(this.zoom);

        this.map.disableKeyDragZoom();



        var thisMap = this;

        setTimeout(function(){
            thisMap.map.enableKeyDragZoom({boxStyle: {
                borderColor: "blue",
                backgroundColor: "blue",
                opacity: 0.3
            },
            paneStyle: {
                backgroundColor: "black",
                opacity: 0.1
            }
            });

            var dz = thisMap.map.getDragZoomObject();
            google.maps.event.addListener(dz, 'dragend', function(event) {
                /*
                console.log("drag end");
                console.log(event.O.O);
                console.log(event.j.O);
                console.log(event.O.j);
                console.log(event.j.j);
                */

                thisMap.selectMarkersInArea(event.O.O, event.j.O, event.O.j, event.j.j);

            });

        }, 1000);

        $(window).scrollTop(0);

        this.onMarkersUpdate.dispatch(this.activeMarkers);
    };

    MarkerMap.prototype.selectMarkersInArea = function(x1,y1,x2,y2)
    {
        var activatedMarkers = 0;
        for(var i=0; i<this.markers.length;i++)
        {
            var marker= this.markers[i];
            if(marker.isInside(x1,y1,x2,y2))
            {
                marker.setActive(true);
                activatedMarkers++;
            }
        }

        var activeMarkers = this.getActiveMarkers();
        this.activeMarkers=activeMarkers.length;
        this.onMarkersUpdate.dispatch(this.activeMarkers);

        if(activatedMarkers==1)
        {
            UIkit.notify("<i class='uk-icon-check' style='color:#FFFFFF'> </i>  Seleccionaste "+activatedMarkers+" ubicación", {status:'success', timeout: 3000});
        }
        else if(activatedMarkers>1)
        {
            UIkit.notify("<i class='uk-icon-check' style='color:#FFFFFF'> </i>  Seleccionaste "+activatedMarkers+" ubicaciones", {status:'success', timeout: 3000});
        }

        $(".uk-notify").css("z-index",999999);

        //console.log("activatedMarkers: "+activatedMarkers);

    };

    MarkerMap.prototype.activateAllMarkers = function()
    {
        for(var i=0; i<this.markers.length;i++)
        {
            var marker= this.markers[i];
            marker.setActive(true);
        }

        this.activeMarkers=this.markers.length;
        this.onMarkersUpdate.dispatch(this.activeMarkers);
    };

    MarkerMap.prototype.deactivateAllMarkers = function()
    {
        for(var i=0; i<this.markers.length;i++)
        {
            var marker= this.markers[i];
            marker.setActive(false);
        }

        this.activeMarkers=0;
        this.onMarkersUpdate.dispatch(this.activeMarkers);
    };

    window.MarkerMap = MarkerMap;


    /*
    Boolean Marker
     */
    function BooleanMarker(lat,lng, imgOn, imgOff)
    {
        this.position = new google.maps.LatLng(lat,lng);
        this.active = false;
        this.imgOn = imgOn;
        this.imgOff = imgOff;

        this.toggleSignal = new signals.Signal();

        this.marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            animation: google.maps.Animation.DROP,
            icon: imgOff,
        });

        var bMarker = this;

        google.maps.event.addListener(this.marker, 'click', function()
        {
            bMarker.toggle();

        });
    }

    BooleanMarker.prototype.toggle = function()
    {
        if(this.active)
        {
            this.marker.setIcon( this.imgOff );
            this.active = false;
        }
        else
        {
            this.marker.setIcon( this.imgOn );
            this.active = true;
        }

        this.toggleSignal.dispatch(this);
    };

    BooleanMarker.prototype.setActive = function(val)
    {
        if(val)
        {
            this.marker.setIcon( this.imgOn );
            this.active = true;
        }
        else
        {
            this.marker.setIcon( this.imgOff );
            this.active = false;
        }
    };

    BooleanMarker.prototype.isInside = function(x1,y1,x2,y2)
    {
        var pos = this.marker.position;
        var lat = pos.lat();
        var lng = pos.lng();

        var aux;
        if(x1>x2)
        {
            aux=x1;
            x1=x2;
            x2=aux;
        }

        if(y1>y2)
        {
            aux=y1;
            y1=y2;
            y2=aux;
        }

        if(lat>x1 && lat<x2)
        {
            if(lng>y1 && lng<y2)
            {
                return true;
            }
        }

        return false;
    };

    BooleanMarker.prototype.setMap = function(map)
    {
        this.map = map;
        this.marker.setMap(map);
    };

    BooleanMarker.prototype.setData = function(id, name, showInfoBox)
    {
        this.id = id;
        this.name = name;

        if(showInfoBox)
        {
            //show infobox with name on hover
            var ibOptions = BooleanMarker.generateInfoBoxOptions(this.name);

            var ib = new InfoBox(ibOptions);

            var bMarker = this;
            var marker = this.marker;

            google.maps.event.addListener(marker, 'mouseover', function()
            {
                ib.open(bMarker.map, marker);
            });

            google.maps.event.addListener(marker, 'mouseout', function()
            {
                ib.close(bMarker.map, marker);
            });
        }
    };

    BooleanMarker.generateInfoBoxOptions = function(name)
    {
        var boxText = document.createElement("div");
        boxText.style.cssText = "text-align:center; margin-top: 8px; background: white; padding: 3px 0 0px; border-radius: 15px;";
        boxText.innerHTML = "<h4>"+name+"</h4>";

        var myOptions = {
            alignBottom: true,
            content: boxText
            ,disableAutoPan: false
            ,maxWidth: 0
            ,pixelOffset: new google.maps.Size(-140, -50)
            ,zIndex: null
            ,boxStyle: {
                opacity: 0.75,
                width: "280px"
            },
            closeBoxMargin: "10px 2px 2px 2px",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false
        };

        return myOptions;
    };

    window.BooleanMarker = BooleanMarker;

}(window));
