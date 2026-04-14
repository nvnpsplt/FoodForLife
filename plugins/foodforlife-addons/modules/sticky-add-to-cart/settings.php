<?php

namespace FoodForLife\Addons\Modules\Sticky_Add_To_Cart;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main class of plugin for admin
 */
class Settings {

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
		add_filter( 'foodforlife_get_sections_theme_features', array( $this, 'sticky_add_to_cart_section' ), 20, 2 );
		add_filter( 'foodforlife_get_settings_theme_features', array( $this, 'sticky_add_to_cart_settings' ), 20, 2 );
	}

	/**
	 * Buy Now section
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function sticky_add_to_cart_section( $sections ) {
		$sections['sticky_add_to_cart'] = esc_html__( 'Sticky Add To Cart', 'foodforlife-addons' );

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
	public function sticky_add_to_cart_settings( $settings, $section ) {
		if ( 'sticky_add_to_cart' == $section ) {
			$settings = array();

			$settings[] = array(
				'id'    => 'foodforlife_sticky_add_to_cart_options',
				'title' => esc_html__( 'Sticky Add To Cart', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_sticky_add_to_cart_toggle',
				'title'   => esc_html__( 'Sticky Add To Cart', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable Sticky Add To Cart', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			);

			$settings[] = array(
				'id'      => 'foodforlife_sticky_add_to_cart_elements',
				'title'   => esc_html__( 'Sticky Cart Elements', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable the Buy Now feature to make the Buy Now button available for selection', 'foodforlife-addons' ),
				'type'    => 'select',
				'default' => 'quantity_and_add_to_cart',
				'options' => array(
					'quantity_and_add_to_cart' => esc_html__( 'Quantity and Add To Cart', 'foodforlife-addons' ),
					'quantity_and_buy_now'  => esc_html__( 'Quantity and Buy Now', 'foodforlife-addons' ),
					'buy_now_and_add_to_cart'  => esc_html__( 'Buy Now and Add To Cart', 'foodforlife-addons' ),
				),
			);

			$settings[] = array(
				'id'   => 'foodforlife_sticky_add_to_cart_options',
				'type' => 'sectionend',
			);
		}

		return $settings;
	}
}