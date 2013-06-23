<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style type="text/css">

            #message
            {
                color: red;
                text-align: center;
            }

            #data
            {
                width: 600px;
                padding-top: 10px;
                padding-bottom: 10px;
                margin-bottom: 10px;
                text-align: center;
                border: 2px solid orange;
            }

            #location
            {
                width: 400px;
            }

            #map_canvas
            {
                width: 600px; 
                height: 500px;
            }

        </style>
<!--        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=es"></script>-->
        <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAFnFO3ySluSuha6r1vYekiRQNy_ewe8RNLHRa7cwLE-yWPUZNWBSV43OE1hhpvzIXRf04qzvWdmKBEw" type="text/javascript"></script>
        <script type="text/javascript">
            //            var geocoder = new google.maps.Geocoder();
            //            window.onload = function() {  
            //                var options = {  
            //                    zoom: 5,  
            //                    center: new google.maps.LatLng(4, -72),  
            //                    mapTypeId: google.maps.MapTypeId.ROADMAP  
            //                };  
            //                map = new google.maps.Map(document.getElementById('map'), options);
            //                
            //            }
            //            
            // modified from http://www.weltmeer.ch/divelog/
            // globals
            var map=null;
            var geocoder = new GClientGeocoder();
            function initialize() {
                // GLog.write("initialize()");
                if (GBrowserIsCompatible()) {
                    map = new GMap2(document.getElementById("map_canvas"));
                    map.addControl(new GScaleControl());
                    map.addControl(new google.maps.MenuMapTypeControl());
                    map.setCenter (new GLatLng(47.288828765662416, 7.945261001586914), 2);}
            }

            function findAddress() {
                var coun4=document.getElementById("countryselect").value;
                geocoder.getLocations(coun4, function(response)
                {
                    if ((response.Status.code == 200) && 
                        (response.Placemark.length > 0)) {
                        var box = response.Placemark[0].ExtendedData.LatLonBox;
                        var sw=new GLatLng(box.south,box.west);
                        var ne=new GLatLng(box.north,box.east);
                        var bounds = new GLatLngBounds(sw,ne);
                        centerAndZoomOnBounds(bounds);
                    }
                });
            }

            function centerAndZoomOnBounds(bounds) {
                var center = bounds.getCenter();
                var newZoom = map.getBoundsZoomLevel(bounds);
                if (map.getZoom() != newZoom) {
                    map.setCenter(center, newZoom);
                } 	else {
                    map.panTo(center);
                }
            }
        </script>
    </head>
    <body onload="initialize()" onunload="GUnload()">
        <select name="countryselect" id="countryselect" onclick="findAddress();return false"  onchange="findAddress();return false" onfocus="">
            <option>Lima</option>
            <option>Trujillo</option>
            <option>Cajamarca</option>
        </select>
        <div id="map_canvas"></div>  
    </body>
</html>
