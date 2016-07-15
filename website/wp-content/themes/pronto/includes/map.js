    var bliccaThemes = {

        // HTML Elements we'll use later!
        mapContainer   : document.getElementById('map-container'),
        dirContainer   : document.getElementById('dir-container'),
        toInput        : document.getElementById('map-config-address'),
        fromInput      : document.getElementById('from-input'),
        unitInput      : document.getElementById('unit-input'),
        startLatLng    : null,

        // Google Maps API Objects
        dirService     : new google.maps.DirectionsService(),
        dirRenderer    : new google.maps.DirectionsRenderer(),
        map:null,

        showDirections:function (dirResult, dirStatus) {
            if (dirStatus != google.maps.DirectionsStatus.OK) {
                alert('Directions failed: ' + dirStatus);
                return;
            }
            // Show directions
            bliccaThemes.dirRenderer.setMap(bliccaThemes.map);
            bliccaThemes.dirRenderer.setPanel(bliccaThemes.dirContainer);
            bliccaThemes.dirRenderer.setDirections(dirResult);
        },

        getStartLatLng:function () {
            var n = bliccaThemes.toInput.value.split(",");
            bliccaThemes.startLatLng = new google.maps.LatLng(n[0], n[1]);
        },

        getSelectedUnitSystem:function () {
            return bliccaThemes.unitInput.options[bliccaThemes.unitInput.selectedIndex].value == 'metric' ?
                google.maps.DirectionsUnitSystem.METRIC :
                google.maps.DirectionsUnitSystem.IMPERIAL;
        },

        getDirections:function () {

            var fromStr = bliccaThemes.fromInput.value; //Get the postcode that was entered

            var dirRequest = {
                origin      : fromStr,
                destination : bliccaThemes.startLatLng,
                travelMode  : google.maps.DirectionsTravelMode.DRIVING,
                unitSystem  : bliccaThemes.getSelectedUnitSystem()
            };

            bliccaThemes.dirService.route(dirRequest, bliccaThemes.showDirections);
        },

        init:function () {

            //get the content
            var infoWindowContent = bliccaThemes.mapContainer.getAttribute('data-map-infowindow');
            var initialZoom       = bliccaThemes.mapContainer.getAttribute('data-map-zoom');

            bliccaThemes.getStartLatLng();

            //setup the map.
            bliccaThemes.map = new google.maps.Map(bliccaThemes.mapContainer, {
                zoom:parseInt(initialZoom),     //ensure it comes through as an Integer
                center:bliccaThemes.startLatLng,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            });

            //setup the red pin marker
            marker = new google.maps.Marker({
                map:bliccaThemes.map,
                position:bliccaThemes.startLatLng,
                draggable:false
            });

            //set the infowindow content
            infoWindow = new google.maps.InfoWindow({
                content:infoWindowContent
            });
            infoWindow.open(bliccaThemes.map, marker);

            //listen for when Directions are requested
            google.maps.event.addListener(bliccaThemes.dirRenderer, 'directions_changed', function () {

                infoWindow.close();         //close the first infoWindow
                marker.setVisible(false);   //remove the first marker

                //setup strings to be used.
                var distanceString = bliccaThemes.dirRenderer.directions.routes[0].legs[0].distance.text;

                //set the content of the infoWindow before we open it again.
                infoWindow.setContent('Thanks!<br /> It looks like you\'re about <strong> ' + distanceString + '</strong> away from us.');

                //re-open the infoWindow
                infoWindow.open(bliccaThemes.map, marker);
                setTimeout(function () {
                    infoWindow.close()
                }, 8000); //close it after 8 seconds.

            });
        }//init
    };

    google.maps.event.addDomListener(window, 'load', bliccaThemes.init);