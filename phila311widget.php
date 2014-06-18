<?php
/* Plugin Name: Phila 311 Widget
Plugin URI: localhost/wordpress
Description: Front Page Widget, displays new tickets, map and links to site.
Version: 1.0
Author: Andrew Kennel
Author URI: localhost/wordpress
*/
add_shortcode('Phila311Widget', 'phila311Widget_handler');

function phila311Widget_handler(){
    $message = <<<EOM

<head>
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>  
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<script type="text/javascript">
	function GetRecent() {
		var recentAPI = "https://www.publicstuff.com/api/2.0/requests_list?return_type=json&limit=3&lat=39.9488597&lon=-75.1650253&nearby=5";
		
		var myLatlng = new google.maps.LatLng(39.9488597,-75.1650253);
		var mapOptions = {
			zoom: 10,
			center: myLatlng
		}
		
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		google.maps.event.trigger(map, "resize");
		$.ajax({
                url:        recentAPI,
                dataType:   "json", // <== JSON-P request
                success:    function(data){
					$("#Phila311RecentList").empty();
					var i = 0;
					while(i < 3)
					{
						var newEntry = "<p><strong>" + data.response.requests[i].request.title + "</strong></p>" + "<p>" + data.response.requests[i].request.description + "</p>";
						$("#Phila311RecentList").append(newEntry);
												
						var marker = new google.maps.Marker({    
							position: new google.maps.LatLng(data.response.requests[i].request.lat, data.response.requests[i].request.lon),    
							map: map    
						}); 
						
						i++;						
					}
                }
        });
	}
</script>

<script type="text/javascript">
    $(document).ready(function () {	
		google.maps.event.addDomListener(window, 'load', GetRecent);
		//GetRecent();
    });
</script>

</head>

<style>

#map-canvas {
        height: 200px;
		width: 250px;
        margin: 0px;
        padding: 0px
		overflow-x:visible;
		overflow-y:visible;
		float:left;
}

#Phila311MapBlock{
float:left;
}

#Phila311LinkBlock{
float:left;
}

#Phila311MapBlock{
float:left;
}

#Phila311RecentBlock{
float:left;
}

</style>

<div id="Phila311Widget">
	<span id="Phila311MainWindow">
		<h1>Philly 311</h1>
		<div id="Phila311LinkBlock">
			<p><a href="http://www.publicstuff.com/pa/philadelphia-pa/report-issues">Submit New Request</a></p>
			<p><a href="http://www.publicstuff.com/pa/philadelphia-pa/issues">Track Request</a></p>
			<p><a href="http://www.publicstuff.com/pa/philadelphia-pa/newsfeed">News</a></p>
		</div>
		<div id="Phila311MapBlock">
			<div id="map-canvas" style="width:250px; height:200px"></div> 
		</div>
		<div id="Phila311RecentBlock">
			<ul id="Phila311RecentList">
			</ul>
		</div>
	</span>
</div>


EOM;

return $message;
}

function phila311Widget($args, $instance) { // widget sidebar output
  extract($args, EXTR_SKIP);
  echo $before_widget; // pre-widget code from theme
  echo phila311Widget_handler();
  echo $after_widget; // post-widget code from theme
}
?>
