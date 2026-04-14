<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Products_Stock_Progress_Bar;

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
		$this->includes();
		add_action('admin_init', array( $this, 'settings'));
		add_action('template_redirect', array( $this, 'product_single'));
	}

	/**
	 * Includes files
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function includes() {
		\FoodForLife\Addons\Auto_Loader::register( [
			'FoodForLife\Addons\Modules\Products_Stock_Progress_Bar\Frontend'        => FOODFORLIFE_ADDONS_DIR . 'modules/products-stock-progress-bar/frontend.php',
			'FoodForLife\Addons\Modules\Products_Stock_Progress_Bar\Settings'    	=> FOODFORLIFE_ADDONS_DIR . 'modules/products-stock-progress-bar/settings.php',
			'FoodForLife\Addons\Modules\Products_Stock_Progress_Bar\Product_Options' => FOODFORLIFE_ADDONS_DIR . 'modules/products-stock-progress-bar/product-options.php',
		] );
	}


	/**
	 * Settings
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function settings() {
		if ( is_admin() ) {
			\FoodForLife\Addons\Modules\Products_Stock_Progress_Bar\Settings::instance();

			if ( get_option( 'foodforlife_products_stock_progress_bar', 'no' ) === 'yes' ) {
				\FoodForLife\Addons\Modules\Products_Stock_Progress_Bar\Product_Options::instance();
			}
		}
	}

	/**
	 * Single Product
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_single() {
		if ( get_option( 'foodforlife_products_stock_progress_bar' ) == 'yes' && is_singular('product') && ! is_customize_preview() ) {
			\FoodForLife\Addons\Modules\Products_Stock_Progress_Bar\Frontend::instance();
		}
	}
	
}
