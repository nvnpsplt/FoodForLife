<?php

namespace FoodForLife\Addons\Elementor\Modules\Shoppable_Images;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main class of plugin for admin
 */
class Settings  {

	/**
	 * Instance
	 *
	 * @var $instance
	 */
	private static $instance;


	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		add_filter( 'foodforlife_get_sections_theme_features', array( $this, 'shoppable_images_section' ), 30, 2 );
		add_filter( 'foodforlife_get_settings_theme_features', array( $this, 'shoppable_images_settings' ), 30, 2 );
	}

	/**		
	 * Add popup section
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function shoppable_images_section( $sections ) {
		$sections['shoppable_images'] = esc_html__( 'Shoppable Images', 'foodforlife-addons' );

		return $sections;
	}

	/**
	 * Add popup settings
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */	
	public function shoppable_images_settings( $settings, $section ) {
		if ( 'shoppable_images' == $section ) {
			$settings = array();

			$settings[] = array(
				'id'    => 'foodforlife_shoppable_images_options',
				'title' => esc_html__( 'Shoppable Images Content', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_shoppable_images_enable',
				'title'   => esc_html__( 'Enable shoppable images content', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable shoppable images content', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			);


			$settings[] = array(
				'id'   => 'foodforlife_shoppable_images_options_end',
				'type' => 'sectionend',
			);
		}

		return $settings;
	}
}