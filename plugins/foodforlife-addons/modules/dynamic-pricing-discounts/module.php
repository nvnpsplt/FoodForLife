<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts;

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
			'FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Post_Type' => FOODFORLIFE_ADDONS_DIR . 'modules/dynamic-pricing-discounts/post-type.php',
			'FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Meta_Box'  => FOODFORLIFE_ADDONS_DIR . 'modules/dynamic-pricing-discounts/meta-box.php',
			'FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Frontend'  => FOODFORLIFE_ADDONS_DIR . 'modules/dynamic-pricing-discounts/frontend.php',
			'FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Settings'  => FOODFORLIFE_ADDONS_DIR . 'modules/dynamic-pricing-discounts/settings.php',
		] );
	}


	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function actions() {
		if ( is_admin() ) {
			\FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Settings::instance();
		}

		// Always register the post type so demo imports work on fresh installs.
		\FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Post_Type::instance();

		if ( get_option( 'foodforlife_dynamic_pricing_discounts', 'yes' ) == 'yes' ) {
			\FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Frontend::instance();

			if ( is_admin() ) {
				\FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Meta_Box::instance();
			}
		}

	}

}
