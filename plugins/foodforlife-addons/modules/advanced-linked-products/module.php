<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Advanced_Linked_Products;

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
			'FoodForLife\Addons\Modules\Advanced_Linked_Products\Frontend'     => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-linked-products/frontend.php',
			'FoodForLife\Addons\Modules\Advanced_Linked_Products\Settings'     => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-linked-products/settings.php',
			'FoodForLife\Addons\Modules\Advanced_Linked_Products\Product_Meta' => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-linked-products/product-meta.php',
		] );
	}


	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function settings() {
		if ( is_admin() ) {
			\FoodForLife\Addons\Modules\Advanced_Linked_Products\Settings::instance();

			if ( get_option( 'foodforlife_advanced_linked_products', 'no' ) === 'yes' ) {
				\FoodForLife\Addons\Modules\Advanced_Linked_Products\Product_Meta::instance();
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
		if ( get_option( 'foodforlife_advanced_linked_products', 'no' ) == 'yes' && is_singular('product') && ! is_customize_preview() ) {
			\FoodForLife\Addons\Modules\Advanced_Linked_Products\Frontend::instance();
		}
	}

}
