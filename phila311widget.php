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
<script type="text/javascript">
	function GetRecent() {
		var recentAPI = "http://www.publicstuff.com/api/open311/services.json?jurisdiction_id=philadelphia-pa";
		
		$.ajax({
                url:        recentAPI,
                dataType:   "json", // <== JSON-P request
                success:    function(data){
					$("#Phila311RecentList").empty();
					var i = 0;
					while(i < 3)
					{
						var newEntry = "<p><strong>" + data[i].group + ": " + data[i].service_name + "</p></strong><p>" + data[i].description + "</p>";
						$("#Phila311RecentList").append(newEntry);
						i++;
					}
                }
        });
		
		
//		$.getJSON(recentAPI, function (data) {
//			$("#Phila311RecentList").empty();
//			var i = 0;
//			while(i < data.response.requests.length)
//			{
//				var newEntry = "<p><h3>" + data.response.requests[i].request.title + "</h3></p>";
//				$("#Phila311RecentList").append(newEntry);
//				i++;
//			}	
//		});
	}
</script>

<script type="text/javascript">
    $(document).ready(function () {	
		GetRecent();
    });
</script>

</head>

<style>

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
		<div id="Phila311LinkBlock">
		<p><a href="http://www.publicstuff.com/pa/philadelphia-pa/report-issues">Submit New Request</a></p>
		<p><a href="http://www.publicstuff.com/pa/philadelphia-pa/issues">Track Request</a></p>
		<p><a href="http://www.publicstuff.com/pa/philadelphia-pa/newsfeed">News</a></p>
		</div>
		<div id="Phila311MapBlock">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d97819.35772666815!2d-75.16781474931638!3d39.989347190470745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c6b7d8d4b54beb%3A0x89f514d88c3e58c1!2sPhiladelphia%2C+PA!5e0!3m2!1sen!2sus!4v1402504176386" width=auto height=auto frameborder="0" style="border:0"></iframe>	
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
