<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Variation_Compare;


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

		add_action('template_redirect', array( $this, 'product_single'));

		add_action('admin_init', array( $this, 'settings'));
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
			'FoodForLife\Addons\Modules\Variation_Compare\Frontend'      => FOODFORLIFE_ADDONS_DIR . 'modules/variation-compare/frontend.php',
			'FoodForLife\Addons\Modules\Variation_Compare\Settings'    	=> FOODFORLIFE_ADDONS_DIR . 'modules/variation-compare/settings.php',
			'FoodForLife\Addons\Modules\Variation_Compare\Product_Options'    	=> FOODFORLIFE_ADDONS_DIR . 'modules/variation-compare/product-options.php',
			'FoodForLife\Addons\Modules\Variation_Compare\Variation_Select'    => FOODFORLIFE_ADDONS_DIR . 'modules/variation-compare/variation-select.php',
		] );
	}

	/**
	 * Single Product
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_single() {
		if ( get_option( 'foodforlife_variation_compare_toggle', 'yes' ) == 'yes' && is_singular('product') ) {
			\FoodForLife\Addons\Modules\Variation_Compare\Frontend::instance();
		}
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
			\FoodForLife\Addons\Modules\Variation_Compare\Settings::instance();
			\FoodForLife\Addons\Modules\Variation_Compare\Product_Options::instance();
		}
	}

}
