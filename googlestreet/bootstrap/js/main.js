$(document).ready(function(){ obj.onReady();});


obj=(function(){
	main=function(){

	      $("#marker-google").click(getJson);	      
	      $("#my_map").gmap3({
				 map:{
				    options:{
				     center:[22.49156846196823, 89.75802349999992],
				     zoom:2,
				     mapTypeId: google.maps.MapTypeId.SATELLITE,
				     mapTypeControl: true,
				     mapTypeControlOptions: {
				       style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
				     },
				     navigationControl: true,
				     scrollwheel: true,
				     streetViewControl: true
				    }
				 }
			});

	        
	},
	getJson = function () {
		var lat = "-12.079862";
		var lon = "-77.077335";
		var rad = "50000";
		var servicejson = "https://www.googleapis.com/freebase/v1/search?filter=(all type:/travel/tourist_attraction (within radius:"+rad+"ft lat:"+lat+" lon:"+lon+"))";


		$.ajax({
			url: servicejson,
			data: "nocache=" + Math.random(),
			type: "GET",
			dataType: "json",
			success: function(source){
				data = source;
				alert( print_r(data) );

			},
			error: function(dato){
				alert("ERROR");
			}
		});
	},
	showInfo = function () {
		$("#data").append(data['data1']['value']);
	 
		$.each(data['data2'], function(index, value) {
			$("#data").append('<p>index: ' + index + ' value1: ' + data['data2'][index]['value1']  + ' value2: ' + data['data2'][index]['value2'] + '</p>');
	});
}
return {onReady:main}})();



/***************************************************************************************************/
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