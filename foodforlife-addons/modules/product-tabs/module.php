<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Product_Tabs;

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
		$this->actions();
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
			'FoodForLife\Addons\Modules\Product_Tabs\FrontEnd'        => FOODFORLIFE_ADDONS_DIR . 'modules/product-tabs/frontend.php',
			'FoodForLife\Addons\Modules\Product_Tabs\Settings'    	=> FOODFORLIFE_ADDONS_DIR . 'modules/product-tabs/settings.php',
			'FoodForLife\Addons\Modules\Product_Tabs\Product_Meta'    => FOODFORLIFE_ADDONS_DIR . 'modules/product-tabs/product-meta.php',
			'FoodForLife\Addons\Modules\Product_Tabs\Post_Type'    		=> FOODFORLIFE_ADDONS_DIR . 'modules/product-tabs/post-type.php',
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
		if ( get_option( 'foodforlife_product_tab' ) == 'yes' && is_singular('product') && ! is_customize_preview() ) {
			\FoodForLife\Addons\Modules\Product_Tabs\FrontEnd::instance();
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
		if( is_admin() ) {
			\FoodForLife\Addons\Modules\Product_Tabs\Settings::instance();

			if ( get_option( 'foodforlife_product_tab' ) == 'yes' ) {
				\FoodForLife\Addons\Modules\Product_Tabs\Product_Meta::instance();
			}
		}
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function actions() {
		if ( get_option( 'foodforlife_product_tab' ) == 'yes' ) {
			\FoodForLife\Addons\Modules\Product_Tabs\Post_Type::instance();
		}
	}

}
