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
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=es"></script>
        <script language="JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<!--        <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAFnFO3ySluSuha6r1vYekiRQNy_ewe8RNLHRa7cwLE-yWPUZNWBSV43OE1hhpvzIXRf04qzvWdmKBEw" type="text/javascript"></script>-->
        <script type="text/javascript">
            geocoder = new google.maps.Geocoder();
           
            tiendas_lima = [
                ['Javier Prado', -12.09115,-77.029395, 2],
                ['Arequipa', -12.087835,-77.033215, 1]               
            ];
            
            tiendas_trujillo = [
                ['Av. España', -8.113785,-79.024615, 2],
                ['Av. America Sur', -8.126106,-79.029937, 1]
            ];
            
            
         
            
            window.onload = function() { 
                address = document.getElementById("countryselect").value;
                
                switch(address)
                {
                    case "Lima":
                        tiendas_geocode=tiendas_lima;
                        break;
                    case "Trujillo":
                        tiendas_geocode=tiendas_trujillo;
                        break;
                }
                var place = new google.maps.LatLng(-12.047817,-77.062204);
                var options = {  
                    zoom: 12,  
                    center: place,  
                    mapTypeId: google.maps.MapTypeId.ROADMAP  
                };  
                map = new google.maps.Map(document.getElementById('map_canvas'), options);
                //setMarkers(map, beaches);
                
                /*google.maps.event.addListener(map, 'click', function(event) {
                    console.log('click en el mapa');
                });*/
                
            }
        
        
            /*function getMaps() {
                
                var place = new google.maps.LatLng(-12.047817,-77.062204);
                var options = {  
                    zoom: 12,  
                    center: place,  
                    mapTypeId: google.maps.MapTypeId.ROADMAP  
                };  
                map = new google.maps.Map(document.getElementById('map_canvas'), options);
                switch(address)
                {
                    case "Lima":
                        var tiendas_geocode=tiendas_lima;
                        break;
                    case "Trujillo, La Libertad":
                        var tiendas_geocode=tiendas_trujillo;
                        break;
                    default:
                        var tiendas_geocode=tiendas_lima;
                }
                setMarkers(map, tiendas_geocode);
                
                
            }*/

            function findAddress() {
                var image = 'images/beachflag.png';
                
                //var address = beaches[0[1]];
                //geocoder.geocode( { 'address': address}, function(results, status) {                   
                geocoder.geocode( { 'address': address}, function(results, status) {                   
                    if (status == google.maps.GeocoderStatus.OK) {
                        setMarkers(map, tiendas_geocode);
                        map.setCenter(results[0].geometry.location);
                        /*var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title:'test',
                            animation: google.maps.Animation.DROP,
                            icon: image
                        });
                        marker.setMap(map);
                        console.log(marker);*/
                        var description = $("#description");
                        $(".link").remove();
                        //description.append("<a href='#' class='link'>"+results[0].address_components[0].long_name+"</br></a>");
                        for(var i=0;i<=1;i++){
                            description.append("<a href='#' class='link'>"+tiendas_geocode[i][0]+"</br></a>");
                        }
                        
                        
                        

                    } else {
                        console.log("Geocode was not successful for the following reason: " + status);
                    }
                });
                
            }
            
            function toggleBounce() {
                //console.log("click en la marca");
                var description = $("#description");
                description.append("chiii");
                //console.log(description);
                if (marker.getAnimation() != null) {
                    marker.setAnimation(null);
                } else {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                }
            }

            function setMarkers(map, locations) {
                //console.log(map);
                //console.log(locations);
                // Add markers to the map

                // Marker sizes are expressed as a Size of X,Y
                // where the origin of the image (0,0) is located
                // in the top left of the image.

                // Origins, anchor positions and coordinates of the marker
                // increase in the X direction to the right and in
                // the Y direction down.
                var image = new google.maps.MarkerImage('images/beachflag.png',
                // This marker is 20 pixels wide by 32 pixels tall.
                new google.maps.Size(20, 32),
                // The origin for this image is 0,0.
                new google.maps.Point(0,0),
                // The anchor for this image is the base of the flagpole at 0,32.
                new google.maps.Point(0, 32));
                var shadow = new google.maps.MarkerImage('images/beachflag_shadow.png',
                // The shadow image is larger in the horizontal dimension
                // while the position and offset are the same as for the main image.
                new google.maps.Size(37, 32),
                new google.maps.Point(0,0),
                new google.maps.Point(0, 32));
                // Shapes define the clickable region of the icon.
                // The type defines an HTML &lt;area&gt; element 'poly' which
                // traces out a polygon as a series of X,Y points. The final
                // coordinate closes the poly by connecting to the first
                // coordinate.
                var shape = {
                    coord: [1, 1, 1, 20, 18, 20, 18 , 1],
                    type: 'poly'
                };
                locations=tiendas_geocode;
                console.log(locations);
                for (var i = 0; i < locations.length; i++) {
                    var beach = locations[i];
                    var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        shadow: shadow,
                        icon: image,
                        shape: shape,
                        title: beach[0],
                        zIndex: beach[3]
                    });
                    google.maps.event.addListener(marker, 'click', function(event) {
                        console.log('click en el mapa');
                        marker.openInfoWindowHtml("<b>"+locations[i][0]+"<b><br/>");
                    });    
                }
                //marker.setMap(map);
            }

        </script>
    </head>
    <body>
        <select name="countryselect" id="countryselect"onchange="findAddress();return false" onfocus="">
            <option selected="selected" value="Lima">Lima</option>
            <option value="Trujillo">Trujillo</option>
        </select>
        <div id="map_canvas"></div>
        <div id="description"></div>
    </body>
</html>
