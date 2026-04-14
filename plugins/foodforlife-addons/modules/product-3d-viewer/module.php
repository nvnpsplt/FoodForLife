<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Product_3D_Viewer;

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
			'FoodForLife\Addons\Modules\Product_3D_Viewer\Settings'        => FOODFORLIFE_ADDONS_DIR . 'modules/product-3d-viewer/settings.php',
			'FoodForLife\Addons\Modules\Product_3D_Viewer\Frontend'        => FOODFORLIFE_ADDONS_DIR . 'modules/product-3d-viewer/frontend.php',
			'FoodForLife\Addons\Modules\Product_3D_Viewer\Product_Options' => FOODFORLIFE_ADDONS_DIR . 'modules/product-3d-viewer/product-options.php',
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
			\FoodForLife\Addons\Modules\Product_3D_Viewer\Settings::instance();

			if ( get_option( 'foodforlife_product_3d_viewer', 'no' ) === 'yes' ) {
				\FoodForLife\Addons\Modules\Product_3D_Viewer\Product_Options::instance();
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
		if ( get_option( 'foodforlife_product_3d_viewer' ) == 'yes' && is_singular('product') ) {
			\FoodForLife\Addons\Modules\Product_3D_Viewer\FrontEnd::instance();
		}
	}
}
