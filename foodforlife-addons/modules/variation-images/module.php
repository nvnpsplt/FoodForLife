<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Variation_Images;

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
			'FoodForLife\Addons\Modules\Variation_Images\Frontend'        => FOODFORLIFE_ADDONS_DIR . 'modules/variation-images/frontend.php',
			'FoodForLife\Addons\Modules\Variation_Images\Settings'    	=> FOODFORLIFE_ADDONS_DIR . 'modules/variation-images/settings.php',
			'FoodForLife\Addons\Modules\Variation_Images\Product_Options' => FOODFORLIFE_ADDONS_DIR . 'modules/variation-images/product-options.php',
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
			\FoodForLife\Addons\Modules\Variation_Images\Settings::instance();

			if ( get_option( 'foodforlife_variation_images' ) == 'yes' ) {
				\FoodForLife\Addons\Modules\Variation_Images\Product_Options::instance();
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
		if ( get_option( 'foodforlife_variation_images' ) == 'yes' ) {
			\FoodForLife\Addons\Modules\Variation_Images\Frontend::instance();
		}
	}
}
