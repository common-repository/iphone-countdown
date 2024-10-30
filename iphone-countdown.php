<?php 

/*
Plugin Name: iPhone Countdown
Plugin URI: http://hathology.com/iphone-countdown-plugin
Description: iPhone Countdown allows you to easily add a javascript countdown to your Wordpress blog. It currently works with WordPress 2.0+
Author: Benjamin Hathaway
Author URI: http://hathology.com
Version: 1.0
*/

load_plugin_textdomain('iphone_countdown',$path = 'wp-content/plugins/iphone-countdown');

$iphone_countdown_script_url = get_bloginfo('wpurl') . iphone_countdown_get_plugin_dir() . "/iphone-countdown.js";
$iphone_countdown_image_url = get_bloginfo('wpurl') . iphone_countdown_get_plugin_dir() . "/iphone_countdown_bg.jpg";


/*
This shows the quicktag on the write pages
Based off Buttonsnap Template
http://redalt.com/downloads
*/
include('buttonsnap.php');

add_action('init', 'iphone_countdown_button_init');
add_action('marker_css', 'iphone_countdown_marker_css');

function iphone_countdown_button_init() {
	$iphone_countdown_button_url = buttonsnap_dirname(__FILE__) . '/iphone_countdown_button.png';

	buttonsnap_textbutton($iphone_countdown_button_url, __('Insert iPhone Countdown', 'ipcd'), '<!--iphone countdown-->');
	buttonsnap_register_marker('iphone countdown', 'iphone_countdown_marker');
}

function iphone_countdown_marker_css() {
	$iphone_countdown_marker_url = buttonsnap_dirname(__FILE__) . '/iphone_countdown_marker.gif';
	echo "
		.iphone_countdown_marker {
				display: block;
				height: 15px;
				width: 200px
				margin-top: 5px;
				background-image: url({$iphone_countdown_marker_url});
				background-repeat: no-repeat;
				background-position: center;
		}
	";
}

/*Wrapper function which calls the form.*/
function iphone_countdown_callback( $content )
{
	global $iphone_countdown_script_url;
	
	$code = "<div id=\"iphone_countdown\"><script language=\"javascript\" src=\"" . $iphone_countdown_script_url . "\"></script></div>";
	return str_replace('<!--iphone countdown-->', $code, $content);
}

function iphone_countdown_get_plugin_dir() {
	$plugindir = dirname(__FILE__);
	$pos = strpos(dirname($plugindir), '/wp-content/');
	$path = substr($plugindir, $pos);
	return $path;
}

/*CSS Styling*/
function iphone_countdown_css()
{
	global $iphone_countdown_image_url;
	?>
<style type="text/css" media="screen">

/* Begin iPhone Coutndown CSS */
#iphone_countdown { 
	width: 400px; 
	height: 160px; 
	margin: 0 auto 20px auto; 
	background: url('<?php echo $iphone_countdown_image_url ?>') no-repeat; 
	padding-top: 240px; 
	clear:both; 
	text-align:center;
	font: normal 1.7em "Courier New";
	/*word-spacing: 15px;*/
}
/* End iPhone Coutndown CSS */

</style>

<?php

	}



/* Action calls for all functions */

add_filter('wp_head', 'iphone_countdown_css');
add_filter('the_content', 'iphone_countdown_callback');

?>
