<?php

namespace FoodForLife\Addons\Modules\Inventory;

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
		add_filter( 'foodforlife_get_sections_theme_features', array( $this, 'shop_out_of_stock_products_section' ), 20, 2 );
		add_filter( 'foodforlife_get_settings_theme_features', array( $this, 'shop_out_of_stock_products_settings' ), 20, 2 );
	}

	/**
	 * Free Shipping Bar section
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function shop_out_of_stock_products_section( $sections ) {
		$sections['shop_out_of_stock_products'] = esc_html__( 'Shop Out of Stock Products', 'foodforlife-addons' );

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
	public function shop_out_of_stock_products_settings( $settings, $section ) {
		if ( 'shop_out_of_stock_products' == $section ) {
			$settings = array();

			$settings[] = array(
				'id'    => 'foodforlife_shop_out_of_stock_products_options',
				'title' => esc_html__( 'Shop Out of Stock Products', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_shop_out_of_stock_last',
				'title'   => esc_html__( 'Out of Stock display', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Show out of stock products at the end of the catalog', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'no',
			);

			$settings[] = array(
				'id'   => 'foodforlife_shop_out_of_stock_products_options',
				'type' => 'sectionend',
			);
		}

		return $settings;
	}
}