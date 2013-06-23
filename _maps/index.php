<html>
<head>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<!-- <script type="text/javascript" src="https://raw.github.com/HPNeo/gmaps/master/gmaps.js"></script>-->
<script type="text/javascript" src="../mostrito_franki/gmaps.js"></script>
 <link rel="stylesheet" type="text/css" href="../mostrito_franki/style.css" />

<link rel="stylesheet" type="text/css" href="css/demo.css"/>

<script>
$(document).ready(function(){
  map = new GMaps({
    div: '#map',
    lat: -12.043333,
    lng: -77.028333
  });

  map.addMarker({
    lat: -12.043333,
    lng: -77.028333,
    draggable: true,
    dragstart: function(e){
          
        },
    dragend: function(e) {
 
      var v_latitud = e.latLng.lat();
      var v_longitud = e.latLng.lng();
       //map.removeMarkers();

      llamada();
    }
  });

});

function llamada(){
 


$.getJSON("../mostrito_franki/coordenadas.json", function(datos) {
  //alert( datos["a"][0]["latitud"]);
  //alert( datos["a"].length);
  var cantidad=datos["a"].length;

  $.each(datos["a"], function(idx,v_coordenada) {
    //alert("Numero primo: " + v_coordenada["latitud"]);
      map.addMarker({
        lat: v_coordenada["latitud"],
        lng: v_coordenada["longitud"],
        draggable: true,
        
        dragend: function(e) {

          var v_latitud = e.latLng.lat();
          var v_longitud = e.latLng.lng();

          //llamada();
        }
      });

});

});

/*$.getJSON("../mostrito_franki/coordenadas.json", function(datos) {
                alert("Dato: " + datos["dato"]);
                $.each(datos["primos"], function(idx,primo) {
                    alert("Numero primo: " + primo);
                });
});
*/
//alert(data_d.length());

}
function print_r(theObj){
   if(theObj.constructor == Array || theObj.constructor == Object){
      document.write("<ul>")
      for(var p in theObj){
         if(theObj[p].constructor == Array || theObj[p].constructor == Object){
            document.write("<li>["+p+"] => "+typeof(theObj)+"</li>");
            document.write("<ul>")
            print_r(theObj[p]);
            document.write("</ul>")
         } else {
            document.write("<li>["+p+"] => "+theObj[p]+"</li>");
         }
      }
      document.write("</ul>")
   }
}

</script>
</head>

<body >

	<div id="map" style="width:80%;height:55%;">
		
	</div>
  <br>
	<div style="width:80%;height:35%;background-color:#E6E6E6;">
		
	</div>


</body>

</html>