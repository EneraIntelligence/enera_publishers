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


        this.findCityExpress();
    }

    MarkerMap.prototype.findCityExpress = function()
    {
        var geocoder = new google.maps.Geocoder();

        var address = "City express";

        console.log("searching city express");

        var restr= {country: 'MX'};

        geocoder.geocode( { 'keyword': address,'partialmatch': true, 'componentRestrictions':restr, 'region':'mx'}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                console.log("results: ");

                console.log(results);
                //var latitude = results[0].geometry.location.lat();
                //var  longitude = results[0].geometry.location.lng();
            }


        });

    }

    MarkerMap.prototype.addMarker = function(marker)
    {
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

    MarkerMap.prototype.refresh = function()
    {
        google.maps.event.trigger(this.map, 'resize');

        this.map.panTo(this.center);
        this.map.setZoom(this.zoom);

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
    }

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
