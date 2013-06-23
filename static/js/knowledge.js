$(document).ready(function(){
 //    var url_base = "https://www.googleapis.com/freebase/v1/search?callback=?"
    
 //    var type = "/travel/tourist_attraction"
 //    var radius = "3000ft"
 //    var lat = "48.8656"
 //    var lon = "2.3211000000000013"

 //    var filter = "(all type:[type] (within radius:[radius] lat:[lat] lon:[lon]))"
 //                .replace("[type]",type)
 //                .replace("[radius]",radius)
 //                .replace("[lat]",lat)
 //                .replace("[lon]",lon)

 //    $.getJSON(url_base, {
 //      'filter': filter,
 //      'output': '(description geocode)'
 //    }, function(response) {
 //        var data = response.result
 //        for (var i=0;i<data.length;i++) {
 //            var item = data[i]
 //            var geolocation = item['output']['geocode']['/location/location/geolocation'][0];
 //            var result_item = "<span>[name] - ([lat],[lon])</span><br>"
 //                        .replace("[name]",item.name)
 //                        .replace("[lat]",geolocation['latitude'])
 //                        .replace("[lon]",geolocation['longitude'])
 //            $("#info").append(result_item)
 //        }

 //      });


 //    var foursquare_client = new FourSquareClient("U0JZ5MBKEX3KULABO0SHF1V3FTTHCSFW4XP4OESFNNUJ3GQQ"
 //                                    , "FNOP14T2FTC4XJMDXIAJUXJZKCP043TKFR2ZO0I0D4N4SYZU"
 //                                    , "http://0.0.0.0:8000/"
 //                                    , true);


 //    foursquare_client.venuesClient.search({ll:'-12.092546,-77.058247'}, {
 //        onSuccess: function(data)
 //        { 
 //            getVenuePictures(data.response.venues,0)
 //        },
 //        onFailure: function(data)
 //        {
 //            alert("Unable to perform search.\nAre you sure you are authenticated and input values are correct?");
 //        }
	// });

 //    var venue_index = 0
 //    function getVenuePictures(venues, index, venue_id) {

 //        venue_index = index

 //        if(venue_index >= venues.length )
 //            return

 //        $("#info").append("<br><br>")
 //        $("#info").append(venues[venue_index].name+"<br>")
 //        console.log(venues[venue_index].id)

 //        foursquare_client.venuesClient.venues(venues[venue_index].id, {
 //                onSuccess: function(data)
 //                { 
 //                    console.log("info venue",venues[venue_index].id, data.response.venue.photos.groups)
 //                    var groups = data.response.venue.photos.groups
 //                    for (var i = 0; i < groups.length; i++) {
 //                        var group_items = groups[i].items
 //                        for (var k = 0; k < group_items.length; k++) {
 //                            var picture = group_items[k].url
 //                            var img = $("<img width='200' >")
 //                            img.attr("src",picture)
 //                            $("#info").append(img)
 //                            $("#info").append("<br>")
 //                        }
 //                    };
                    
                    
 //                    getVenuePictures(venues, ++venue_index)
 //                },
 //                onFailure: function(data)
 //                {
 //                    alert("Unable to perform search.\nAre you sure you are authenticated and input values are correct?");
 //                }
 //            });

 //    }

})
