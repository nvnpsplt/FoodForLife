<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Buy_X_Get_Y;

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
			'FoodForLife\Addons\Modules\Buy_X_Get_Y\Settings'   => FOODFORLIFE_ADDONS_DIR . 'modules/buy-x-get-y/settings.php',
			'FoodForLife\Addons\Modules\Buy_X_Get_Y\Post_Type' => FOODFORLIFE_ADDONS_DIR . 'modules/buy-x-get-y/post-type.php',
			'FoodForLife\Addons\Modules\Buy_X_Get_Y\Meta_Box'  => FOODFORLIFE_ADDONS_DIR . 'modules/buy-x-get-y/meta-box.php',
			'FoodForLife\Addons\Modules\Buy_X_Get_Y\Frontend'   => FOODFORLIFE_ADDONS_DIR . 'modules/buy-x-get-y/frontend.php',
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
			\FoodForLife\Addons\Modules\Buy_X_Get_Y\Settings::instance();
		}

		if ( get_option( 'foodforlife_buy_x_get_y' ) == 'yes' ) {
			\FoodForLife\Addons\Modules\Buy_X_Get_Y\Post_Type::instance();
			\FoodForLife\Addons\Modules\Buy_X_Get_Y\Frontend::instance();

			if ( is_admin() ) {
				\FoodForLife\Addons\Modules\Buy_X_Get_Y\Meta_Box::instance();
			}
		}
	}

}
