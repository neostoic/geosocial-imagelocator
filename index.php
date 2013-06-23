<?php
include('ip2locationlite.class.php');
$ipLite = new ip2location_lite;
$ipLite->setKey('ae5111594813034255a95abcb5d085ee6daa5e71a63f0303642b0ba3b2013f2f');
$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
?>
<!doctype html>
<!--[if lt IE 7]> <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<title>document</title>
	</head>
<body>

<div id="resultado" style="width:100%;"></div>
<div id="cordenadas">
<span class="lat"></span> - <span class="long"></span>
</div>
<div id="error"></div>
<div id="php"> <? echo 'por php:'.$locations['latitude'].' / '.$locations['longitude']; ?></div>
<div id="token"></div>
<div id="ip">la IP: <?php echo $_SERVER['REMOTE_ADDR']; ?></div>

<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>

<script>
	$(document).ready(function(){
		var tk = 'CAAHDKjDwMTcBAEAlZAG9RnqsOxC1And5ZANZAI50oceuJPpkvsDLO27rEkrU6HHB3NeZAqyhqZCm5bOpID8T4vlUPgfPAZBTqGEXHuJm0TfavAmrycsc5H9zdLphHdfr4zjQishH8HTT27d1YfgEkdqE7FqrsKUbUZD';
		var latitude = '-12.092556';
		var longitude = '-77.058384';
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
			getLocation();
			$.getJSON('https://graph.facebook.com/fql?q=SELECT+page_id+FROM+place+WHERE+distance(latitude,+longitude,+"'+latitude+'",+"'+longitude+'")+<+50000+&access_token='+str+'&callback=?', function(datos,textStatus){
	             $.each(datos.data, function(a,item){
	             	$.getJSON('https://graph.facebook.com/fql?q=select owner,link,src,created from photo where owner="'+item.page_id+'"+limit+100+&access_token='+str+'&callback=?', function(datosfp,textStatusfp){
			             $.each(datosfp.data, function(a,its){
			             	$('#resultado').append('<img src="'+its.src+'">');
			             });
			        });
	             });
	        });
        }

		function getLocation(){
			try{
				var geo = google.gears.factory.create('beta.geolocation');
				geo.getCurrentPosition(successCallback, errorCallback);
			}
			catch(e){
				try{
					navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
				}
				catch(e){
					errorCallback({code:2,message:e.message});
				}
			}
		}

		function errorCallback(err){
			$('#error').text(err.message)
		}

		function successCallback(r){
			$('.lat').text(r.coords.latitude);
			lat.push(r.coords.latitude);
			$('.long').text(r.coords.longitude);
			lon.push(r.coords.longitude);
		}
		
		getLocation();

	});
		
</script>
</body>
</html>