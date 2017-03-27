<?php
/**
* Plugin Name: SiteOrigin Hello World
* Plugin URI: https://siteorigin.com/widgets/siteorigin-hello-world
* Description: 
* Version: 1.0
* Author: Indibits
* Author URI: https://siteorigin.com/indibits
* License: GPLv2 or later
* Text Domain: hello-world
*/
function add_hello_world_widget($folders){
	$folders[] = plugin_dir_path(__FILE__) . 'widgets/';
	return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'add_hello_world_widget');
