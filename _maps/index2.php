<html>
<head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

<script type="text/javascript" src="static/js/gmaps.js"> </script>
<link rel="stylesheet" type="text/css" href="static/css/style.css" />
<link rel="stylesheet" type="text/css" href="static/css/demo.css" />

<script>
$(document).ready(function(){
  map = new GMaps({
    div: '#map',
    lat: -12.043333,
    lng: -77.028333
  });
    
  GMaps.on('click', map.map, function(event) {
    map.removeMarkers();
    var index = map.markers.length;
    var lat = event.latLng.lat();
    var lng = event.latLng.lng();

    var template = $('#edit_marker_template').text();

    var content = template.replace(/{{index}}/g, index).replace(/{{lat}}/g, lat).replace(/{{lng}}/g, lng);

    map.addMarker({
      lat: lat,
      lng: lng,
      icon: "../mostrito_franki/img/marker_blue.png",
      title: 'Marker #' + index,
      infoWindow: {
        content : content
      }
    });
    llamada(lat,lng);
  });

});

function llamada(la,lon){
 
$.ajax({
        type: "POST",
        url: "../mostrito_franki/coordenadas.json",
        success: function(datos){
            var cantidad=datos["a"].length;

  $.each(datos["a"], function(idx,v_coordenada) {
    //alert("Numero primo: " + v_coordenada["latitud"]);
      map.addMarker({
            lat: v_coordenada["latitud"],
            lng: v_coordenada["longitud"],
            draggable: true,
            infoWindow: {
              content: '<div style="width:300px;height:200px;">HTML Content</div>'
            },
             click: function(e) {
              mostrar_datos();
            },
            dragend: function(e) {

              var v_latitud = e.latLng.lat();
              var v_longitud = e.latLng.lng();

              //llamada();
            }
          });

    });
       }
});

}
function mostrar_datos(){

  $("#dv_img").append('<img class="img" src="../mostrito_franki/img/img01.jpg" />');
  $("#dv_img").append('<img class="img" src="../mostrito_franki/img/img02.jpg" />');
  $("#dv_img").append('<img class="img" src="../mostrito_franki/img/img03.jpg" />');
}

</script>
</head>

<body >

	<div id="map" style="width:80%;height:55%;">
		
	</div>
  <br>
	<div id="dv_img" style="width:80%;height:35%;background-color:#E6E6E6;">
		  
	</div>


</body>

</html>