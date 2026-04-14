<?php

namespace FoodForLife\Addons\Modules\Pre_Order;

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
		add_filter( 'foodforlife_get_sections_theme_features', array( $this, 'pre_order_section' ), 20, 2 );
		add_filter( 'foodforlife_get_settings_theme_features', array( $this, 'pre_order_settings' ), 20, 2 );
	}

	/**
	 * Free Shipping Bar section
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function pre_order_section( $sections ) {
		$sections['pre_order'] = esc_html__( 'Pre-Order', 'foodforlife-addons' );

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
	public function pre_order_settings( $settings, $section ) {
		if ( 'pre_order' == $section ) {
			$settings = array();

			$settings[] = array(
				'id'    => 'foodforlife_pre_order_options',
				'title' => esc_html__( 'Pre-Order', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_pre_order',
				'title'   => esc_html__( 'Pre-Order', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable Pre-Order', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'no',
			);

			$settings[] = array(
				'id'      => 'foodforlife_pre_order_auto_status',
				'title'   => esc_html__( 'Automatic status', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable automatic status changes when release date arrives', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'no',
			);

			$settings[] = array(
				'id'   => 'foodforlife_pre_order_options',
				'type' => 'sectionend',
			);
		}

		return $settings;
	}
}