<?php
/**
Widget Name: Hello world widget
Description: An example widget which displays 'Hello world!'.
Author: Indibits
Author URI: http://indibits.com
Widget URI: http://indibits.com/hello-world-widget-docs,
Video URI: http://indibits.com/hello-world-widget-video
*/
class Hello_World_Widget extends SiteOrigin_Widget{
	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'hello-world-widget',

			// The name of the widget for display purposes.
			__('Hello World Widget', 'hello-world-widget-text-domain'),

			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('A hello world widget.', 'hello-world-widget-text-domain'),
				'help'        => 'http://example.com/hello-world-widget-docs',
				'instance_storage' => true,
			),

			//The $control_options array, which is passed through to WP_Widget
			array(
			),

			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			// array(
			// 	'text' => array(
			// 		'type' => 'text',
			// 		'label' => __('Hello world! goes here.', 'siteorigin-widgets'),
			// 		'default' => 'Hello world!'
			// 	),
			// ),
			false,

			//The $base_folder path string.
			plugin_dir_path(__FILE__)
		);
	}

	function get_widget_form() {
		return array(
			'text' => array(
				'type' => 'better-text',
				'label' => __('Text', 'so-widgets-bundle'),
			),

			'some_posts' => array(
			    'type' => 'posts',
			    'label' => __('Some posts query', 'widget-form-fields-text-domain'),
			),

			'settings' => array(
				'type'   => 'section',
				'label'  => 'Settings',
				'hide'   => true,
				'fields' => array(
					'description' => array(
						'type' => 'tinymce',
						'label' => __('Description', 'hello-world'),
						'default' => '',
						'row' => 10,
						'default_editor' => 'html',
						'button_filters' => array(
							'mce_buttons' => array($this, 'filter_mce_buttons'),
							'mce_buttons_2' => array($this, 'filter_mce_buttons_2'),
							'mce_buttons_3' => array($this, 'filter_mce_buttons_3'),
							'mce_buttons_4' => array($this, 'filter_mce_buttons_4'),
							'quicktags_settings' => array($this, 'filter_quicktags_settings'),
							),
						)
					)
				),
		
			'design' => array(
				'type' => 'section',
				'label' => __('Design and layout', 'so-widgets-bundle'),
				'hide' => true,
				'fields' => array(
					'align' => array(
						'type' => 'select',
						'label' => __('Align', 'so-widgets-bundle'),
						'default' => 'center',
						'options' => array(
							'left' => __('Left', 'so-widgets-bundle'),
							'right' => __('Right', 'so-widgets-bundle'),
							'center' => __('Center', 'so-widgets-bundle'),
							'justify' => __('Justify', 'so-widgets-bundle'),
						),
					),

					'theme' => array(
						'type' => 'select',
						'label' => __('Text theme', 'so-widgets-bundle'),
						'default' => 'atom',
						'options' => array(
							'atom' => __('Atom', 'so-widgets-bundle'),
							'flat' => __('Flat', 'so-widgets-bundle'),
							'wire' => __('Wire', 'so-widgets-bundle'),
						),
					),

					'text_color' => array(
						'type' => 'color',
						'label' => __('Text color', 'so-widgets-bundle'),
					),

					'font' => array(
						'type' => 'font',
						'label' => __( 'Font', 'so-widgets-bundle' ),
						'default' => 'default'
					),

					'font_size' => array(
						'type' => 'select',
						'label' => __('Font size', 'so-widgets-bundle'),
						'options' => array(
							'1' => __('Normal', 'so-widgets-bundle'),
							'1.15' => __('Medium', 'so-widgets-bundle'),
							'1.3' => __('Large', 'so-widgets-bundle'),
							'1.45' => __('Extra large', 'so-widgets-bundle'),
						),
					),

					'padding' => array(
						'type' => 'select',
						'label' => __('Padding', 'so-widgets-bundle'),
						'default' => '1',
						'options' => array(
							'0.5' => __('Low', 'so-widgets-bundle'),
							'1' => __('Medium', 'so-widgets-bundle'),
							'1.4' => __('High', 'so-widgets-bundle'),
							'1.8' => __('Very high', 'so-widgets-bundle'),
						),
					),

				),
			),

			'attributes' => array(
				'type' => 'section',
				'label' => __('Other attributes and SEO', 'so-widgets-bundle'),
				'hide' => true,
				'fields' => array(
					'id' => array(
						'type' => 'text',
						'label' => __('Text ID', 'so-widgets-bundle'),
						'description' => __('An ID attribute allows you to target this text in Javascript.', 'so-widgets-bundle'),
					),

					'classes' => array(
						'type' => 'text',
						'label' => __('Text Classes', 'so-widgets-bundle'),
						'description' => __('Additional CSS classes added to the text.', 'so-widgets-bundle'),
					),

					'title' => array(
						'type' => 'text',
						'label' => __('Title attribute', 'so-widgets-bundle'),
						'description' => __('Adds a title attribute to the text.', 'so-widgets-bundle'),
					),
				)
			),
		);
	}

	function get_style_name($instance) {
		// echo '<pre>';
		// var_dump($instance);
		// echo '</pre>';
		// exit;
		if(empty($instance['design']['theme'])) return 'atom';
		return $instance['design']['theme'];
	}

	function get_template_name($instance) {
		return 'hello-world-template';
	}

	function get_template_dir($instance) {
		return 'hw-templates';
	}

	function get_template_variables( $instance, $args ) {
		$vars = array();

		if( ! empty( $instance[ 'attributes' ][ 'classes' ] ) ) {
			$vars[ 'classes' ] = explode( ' ', $instance[ 'attributes' ][ 'classes' ] );
		}

		return $vars;
	}


	function initialize() {
	    global $sow_meta_box_manager;

	    $sow_meta_box_manager->append_to_form(
	        $this->id_base,
	        array(
	            'my_widget_fields_section' => array(
	                'type' => 'section',
	                'label' => __( 'My Widget Meta Fields', 'siteorigin-widgets' ),
	                'fields' => array(
	                    'some_post_meta_text' => array(
	                        'type' => 'text',
	                        'label' => __( 'Meta Text', 'siteorigin-widgets' )
	                    ),
	                )
	            )
	        ),
	        array( 'post' )
	    );

	    $this->register_frontend_scripts(
	        array(
	            array( 'hello-world-script', plugin_dir_url(__FILE__) . 'js/script.js', array( 'jquery' ), '1.0' )
	        )
	    );
	    
	    $this->register_frontend_styles(
	        array(
	            array( 'hello-world-style', plugin_dir_url(__FILE__) . 'css/style.css', array(), '1.0' )
	        )
	    );
	}

	/**
	 * Get the variables that we'll be injecting into the less stylesheet.
	 *
	 * @param $instance
	 *
	 * @return array
	 */
	function get_less_variables($instance){
		if( empty( $instance ) || empty( $instance['design'] ) ) return array();

		$less_vars = array(
			'text_color' => $instance['design']['text_color'],
			'font_size' => $instance['design']['font_size'] . 'em',
			'padding' => $instance['design']['padding'] . 'em',
		);

		if ( ! empty( $instance['design']['font'] ) ) {
			$font = siteorigin_widget_get_font( $instance['design']['font'] );
			$less_vars['hello_world_font'] = $font['family'];
			if ( ! empty( $font['weight'] ) ) {
				$less_vars['hello_world_font_weight'] = $font['weight'];
			}
		}
		return $less_vars;
	}

	function get_google_font_fields( $instance ) {
		return array(
			$instance['design']['font'],
		);
	}

	/**
	 * Make sure the instance is the most up to date version.
	 *
	 * @param $instance
	 *
	 * @return mixed
	 */
	function modify_instance($instance){
		
		if( empty($instance['design']) ) {
			$instance['design'] = array();

			if(isset($instance['align'])) $instance['design']['align'] = $instance['align'];
			if(isset($instance['theme'])) $instance['design']['theme'] = $instance['theme'];
			if(isset($instance['button_color'])) $instance['design']['button_color'] = $instance['button_color'];
			if(isset($instance['text_color'])) $instance['design']['text_color'] = $instance['text_color'];
			
			if(isset($instance['font_size'])) $instance['design']['font_size'] = $instance['font_size'];
			unset($instance['align']);
			unset($instance['theme']);
			unset($instance['button_color']);
			unset($instance['text_color']);
			unset($instance['font_size']);
			unset($instance['padding']);
		}

		if( empty($instance['attributes']) ) {
			$instance['attributes'] = array();
			if(isset($instance['id'])) $instance['attributes']['id'] = $instance['id'];
			unset($instance['id']);
		}

		return $instance;
	}
}
//siteorigin_widget_register function uses widget id, widget file path, and widget class name as arguments
siteorigin_widget_register('hello-world-widget', __FILE__, 'Hello_World_Widget');