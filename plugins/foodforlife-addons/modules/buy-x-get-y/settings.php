<?php

namespace FoodForLife\Addons\Modules\Buy_X_Get_Y;

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
		add_filter( 'foodforlife_get_sections_theme_features', array( $this, 'buy_x_get_y_section' ), 20, 2 );
		add_filter( 'foodforlife_get_settings_theme_features', array( $this, 'buy_x_get_y_settings' ), 20, 2 );
	}

	/**
	 * Free Shipping Bar section
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function buy_x_get_y_section( $sections ) {
		$sections['foodforlife_buy_x_get_y'] = esc_html__( 'Buy X Get Y', 'foodforlife-addons' );

		return $sections;
	}

	/**
	 * Adds settings to product display settings
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings
	 * @param string $section
	 *
	 * @return array
	 */
	public function buy_x_get_y_settings( $settings, $section ) {
		if ( 'foodforlife_buy_x_get_y' == $section ) {
			$settings = array();

			$settings[] = array(
				'id'    => 'foodforlife_buy_x_get_y_options',
				'title' => esc_html__( 'Buy X Get Y', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_buy_x_get_y',
				'title'   => esc_html__( 'Buy X Get Y', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable Buy X Get Y', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'no',
			);

			$settings[] = array(
				'id'   => 'foodforlife_buy_x_get_y_options',
				'type' => 'sectionend',
			);
		}

		return $settings;
	}
}