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

//Activating widget using action hook
// function wbexample_activate_bundled_widgets(){
//     if( !get_theme_mod('bundled_widgets_activated') ) {
//         SiteOrigin_Widgets_Bundle::single()->activate_widget( 'hello-world-widget' );
//         set_theme_mod( 'bundled_widgets_activated', true );
//     }
// }
// add_filter('admin_init', 'wbexample_activate_bundled_widgets');



/**
* Banner to widget
*/
// function my_awesome_widget_banner_img_src( $banner_url, $widget_meta ) {
// 	if( $widget_meta['ID'] == 'my-awesome-widget') {
// 		$banner_url = plugin_dir_url(__FILE__) . 'images/awesome_widget_banner.svg';
// 	}
// 	return $banner_url;
// }
// add_filter( 'siteorigin_widgets_widget_banner', 'my_awesome_widget_banner_img_src', 10, 2);


//extending button widget
function mytheme_extend_button_form( $form_options, $widget ){
	// Lets add a new theme option
	if( !empty($form_options['design']['fields']['theme']['options']) ) {
		$form_options['design']['fields']['theme']['options']['test'] = __('Test Style', 'mytheme');
	}

	return $form_options;
}
add_filter('siteorigin_widgets_form_options_sow-button', 'mytheme_extend_button_form', 10, 2);

function mytheme_button_template_file( $filename, $instance, $widget ){
	if( !empty($instance['design']['theme']) && $instance['design']['theme'] == 'test' ) {
		// This option works for plugins
		$filename = plugin_dir_path( __FILE__ ) . 'tpl/button.php';
		
		// And this one for themes
		//$filename = get_stylesheet_directory() . '/tpl/button.php'; 
	}
	return $filename;
}
add_filter( 'siteorigin_widgets_template_file_sow-button', 'mytheme_button_template_file', 10, 3 );

function mytheme_button_less_file( $filename, $instance, $widget ){
	if( !empty($instance['design']['theme']) && $instance['design']['theme'] == 'test' ) {
		$filename = plugin_dir_path( __FILE__ ) . 'less/test.less';
		
		// And this one for themes
		//$filename = get_stylesheet_directory() . '/less/test.less'; 
	}
	return $filename;
}
add_filter( 'siteorigin_widgets_less_file_sow-button', 'mytheme_button_less_file', 10, 3 );

//Adding custom filed type
function my_custom_fields_class_prefixes( $class_prefixes ) {
	$class_prefixes[] = 'My_Custom_Field_';
	return $class_prefixes;
}
add_filter( 'siteorigin_widgets_field_class_prefixes', 'my_custom_fields_class_prefixes' );


//Custom field path
function my_custom_fields_class_paths( $class_paths ) {
	$class_paths[] = plugin_dir_path( __FILE__ ) . 'custom-fields/';
	return $class_paths;
}
add_filter( 'siteorigin_widgets_field_class_paths', 'my_custom_fields_class_paths' );