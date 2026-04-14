<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Products_Filter;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Addons Modules
 */
class Module {

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
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}


	/**
	 * Register widgets
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_widgets() {
		if( apply_filters( 'foodforlife_product_filter_widgets_elementor', true) ) {
			\FoodForLife\Addons\Auto_Loader::register( [
				'FoodForLife\Addons\Modules\Products_Filter\Widget'    => FOODFORLIFE_ADDONS_DIR . 'modules/products-filter/widget.php',
			] );

			if ( class_exists( 'WooCommerce' ) ) {
				register_widget( new \FoodForLife\Addons\Modules\Products_Filter\Widget() );
			}
		}
	}

}
