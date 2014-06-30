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

<div id="Phila311Widget" class="PhilaWidget">
<h1 class="PhilaWidgetTitle">Philly311</h1>
	<span id="Phila311MainWindow">
		<div id="Phila311LinkBlock">
			<a href="http://www.publicstuff.com/pa/philadelphia-pa/report-issues">Submit New Request</a>
			<a href="http://www.publicstuff.com/pa/philadelphia-pa/issues">Track Request</a>
			<a href="http://www.publicstuff.com/pa/philadelphia-pa/newsfeed">News</a>
		</div>
	</span>
    <div class="recent-requests">
        <h2>Recent Service Requests</h2>
        <ol>
            <li>Maintenance Residential</li>
            <li>Rubbish Collection</li>
            <li>Illegal Dumping</li>
            <li>Abandoned Automobile</li>
            <li>Graffiti Removal</li>

        </ol>
    </div>
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