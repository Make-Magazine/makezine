<?php
/*
	Plugin Name: Title Experiments Pro
	Plugin URI: http://wpexperiments.com/title-experiments
	Description: A/B test the titles of your pages and posts to get the most page views. More info: http://wpexperiments.com
	Author: Jason Funk
	Author URI: http://jasonfunk.net
	Version: 0.9.0
	License: GPLv3
*/

if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
function titlex_plugin_activation_check(){ 
	if(!is_plugin_active("wp-experiments-free/wp-experiments.php")) {
        deactivate_plugins(basename(__FILE__)); // Deactivate ourself 
        wp_die("Please activate <b>Title Experiments Free</b> before activating <b>Title Experiments Pro</b>. Redirecting... <script>window.setTimeout(function(){history.back();}, 3000);</script>");
	} 
} 
register_activation_hook(__FILE__, 'titlex_plugin_activation_check'); 

require_once('libs/wpph.php');

$wpph = new WPPH(
	plugin_basename(__FILE__),
	"eeaca287-6bc6-4f58-a09e-6c25c99a569e",
	array(
		'enable_license' => TRUE,
		'enable_license_purchase' => TRUE,
		'try_without_license' => FALSE,
		'license_menu_slug' => plugin_basename(__FILE__).'-menu',
		'license_menu_title' => 'License',
		'support_menu_slug' => plugin_basename(__FILE__).'-menu',
		'support_menu_title' => 'Support',
	)
);

require_once('titleex.class.php');
$titleEx = new TitleEx($wpph);