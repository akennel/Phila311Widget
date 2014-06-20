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



</head>

<style>

#Phila311LinkBlock{
float:left;
}

</style>

<div id="Phila311Widget" class="PhilaWidget">
	<span id="Phila311MainWindow">
		<h1 class="PhilaWidgetTitle">Philly 311</h1>
		<div id="Phila311LinkBlock">
			<p><a href="http://www.publicstuff.com/pa/philadelphia-pa/report-issues">Submit New Request</a></p>
			<p><a href="http://www.publicstuff.com/pa/philadelphia-pa/issues">Track Request</a></p>
			<p><a href="http://www.publicstuff.com/pa/philadelphia-pa/newsfeed">News</a></p>
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
