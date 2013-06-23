<?
	//echo token = $_GET["code"]."assss";
	if ($_GET) {
		$token = $_GET["code"];
	}else{
			//header('Location: https://api.instagram.com/oauth/authorize/?client_id=046bc536069440b686b462b88954ead2&redirect_uri=https://dev.phantasia.pe/instagram/&response_type=code');
		header('Location: https://api.instagram.com/oauth/authorize/?client_id=046bc536069440b686b462b88954ead2&grant_type=authorization_code&redirect_uri=https://dev.phantasia.pe/instagram/&response_type=code');
	}
	//echo $token;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>API Instagram</title>
	<script type="text/javascript" src="jquery-1.8.1.js"></script>
	<style>
		*{
			margin:0;
			padding:0;
			border:none;
		}
		
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
					
			var lat = 52.37518;
			var lng = 4.894356;
			$.ajax({
				type: "GET",
				dataType: "jsonp",
				cache: false,
				url: "https://api.instagram.com/v1/media/search?client_secret=61658f62d9e548f696be60e28a3cb1bc&client_id=046bc536069440b686b462b88954ead2&object=geography&aspect=media&lat="+lat+"&lng="+lng+"&radius=5000&callback_url=https://dev.phantasia.pe/instagram/",
				success: function(data){
					console.log(data.data);
					$.each(data.data, function(index, value) {
						var img = data.data[index].images.low_resolution.url;
						$("#images").append("<div>" +
												"<a target='_blank' href='" + img +"'>" +
												"<img src='" + img +"' /></a>" +
											"</div>"
						);   
					});
				}
			});




		});
	</script>
</head>
<body>
	<div id="images"></div>
</body>
</html>