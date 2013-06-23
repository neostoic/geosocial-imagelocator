var interval = 0;
var counter = 0


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
    //$('#container img').each(function(el,idx){ idx.remove(); });
    knowledge(lat,lng); 
      
    
    $('#container').nested({animate: false,animationOptions: {
    speed: 1000,
    duration: 0
  }})

  $('#prepend').click(function(){
    var boxes = makeBoxes();
    $('#container').prepend(boxes).nested('prepend',boxes);
  })
  $('#append').click(function(){
    var boxes = makeBoxes();
    $('#container').append(boxes).nested('append',boxes);     
  })
  
  });



});

function startInterval(){
 /* $('#container').nested()
  interval = setInterval(function(){
    $('#container').nested()
  },5000)*/
}

function stopInterval(){
  /*if(counter == 2) {
    clearInterval(interval)
    console.log("termino??????")
  }*/
    
}

function getFacebookData (lat,lng) {
    var tk = 'CAAHDKjDwMTcBAEAlZAG9RnqsOxC1And5ZANZAI50oceuJPpkvsDLO27rEkrU6HHB3NeZAqyhqZCm5bOpID8T4vlUPgfPAZBTqGEXHuJm0TfavAmrycsc5H9zdLphHdfr4zjQishH8HTT27d1YfgEkdqE7FqrsKUbUZD';
    var latitude = lat;
    var longitude = lng;
    var lat = [];
    var lon = [];
    
    $.ajax({
      type: "POST",
      url: 'https://graph.facebook.com/oauth/access_token',
      data: 'client_id=496060953801015&client_secret=3d95f8ea61751d121b4ec24ddad7caf5&grant_type=fb_exchange_token&fb_exchange_token='+tk,
      success: function(data){
        dt = data.replace('access_token=','').split('&');
        getDatos(dt[0]);
            }
        });

    function getDatos(str){
      //getLocation();
      $.getJSON('https://graph.facebook.com/fql?q=SELECT+page_id+FROM+place+WHERE+distance(latitude,+longitude,+"'+latitude+'",+"'+longitude+'")+<+50000+&access_token='+str+'&callback=?', function(datos,textStatus){
               $.each(datos.data, function(a,item){
                $.getJSON('https://graph.facebook.com/fql?q=select owner,link,src,created from photo where owner="'+item.page_id+'"+limit+100+&access_token='+str+'&callback=?', function(datosfp,textStatusfp){
                   $.each(datosfp.data, function(a,its){
                    var box = $('<div class="box size11"><img src="'+its.src+'" class="facebook"></div>')
                    $('#container').append(box).nested('append',box)
                   });
                   counter++;
              });
               });
          });
        }
}

function knowledge(lat,lng){
    var url_base = "https://www.googleapis.com/freebase/v1/search?callback=?"
    var foursquare_client = new FourSquareClient("U0JZ5MBKEX3KULABO0SHF1V3FTTHCSFW4XP4OESFNNUJ3GQQ"
                                      , "FNOP14T2FTC4XJMDXIAJUXJZKCP043TKFR2ZO0I0D4N4SYZU"
                                      , "http://0.0.0.0:8000/"
                                      , true);
    var type = "/travel/tourist_attraction"
    var radius = "100000ft"
    var lat = lat
    var lon = lng

    var filter = "(all type:[type] (within radius:[radius] lat:[lat] lon:[lon]))"
                .replace("[type]",type)
                .replace("[radius]",radius)
                .replace("[lat]",lat)
                .replace("[lon]",lon)

    $.getJSON(url_base, {
      'filter': filter,
      'output': '(description geocode)'
    }, function(response) {
        var data = response.result
        for (var i=0;i<data.length;i++) {
            var item = data[i]
            var geolocation = item['output']['geocode']['/location/location/geolocation'][0];

            map.addMarker({
              lat: geolocation['latitude'],//lat,
              lng: geolocation['longitude'],//lng,
              title: item.name, //'Marker #' + index,
              infoWindow: {
                content : item.name
              },
              click: function(e){
                //e.removeMarkers();
                
                getFoursquareImages(lat,lng);
                getFacebookData(lat,lng);
              }
            });
        }

      });

    function getFoursquareImages(lat, lng){
      foursquare_client.venuesClient.search({ll: lat+','+lng}, {
            onSuccess: function(data)
            { 
                getVenuePictures(data.response.venues,0)
            },
            onFailure: function(data)
            {
                alert("Unable to perform search.\nAre you sure you are authenticated and input values are correct?");
            }
      });
    }

    var venue_index = 0
    function getVenuePictures(venues, index, venue_id) {

        venue_index = index

        if(venue_index >= venues.length ) {
            counter++
            stopInterval();
            return 
        }

        foursquare_client.venuesClient.venues(venues[venue_index].id, {
                onSuccess: function(data)
                { 

                    var groups = data.response.venue.photos.groups
                    for (var i = 0; i < groups.length; i++) {
                        var group_items = groups[i].items
                        for (var k = 0; k < group_items.length; k++) {
                            var picture = group_items[k].url
                            var size =  Math.ceil( Math.random()*8 ).toString() +  Math.ceil( Math.random()*8 ).toString()
                            var box = $("<div><img width='"+size+"' class='foursquare'></div>")
                            box.children("img").attr("src",picture)

                            box.addClass('box' );

                          $('#container').append(box).nested('append',box)

                        }
                    };
                
                    startInterval();
                    getVenuePictures(venues, ++venue_index)
                },
                onFailure: function(data)
                {
                    alert("Unable to perform search.\nAre you sure you are authenticated and input values are correct?");
                }
            });
        
    }
}
