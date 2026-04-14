<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Add_To_Cart_Ajax;

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
			'FoodForLife\Addons\Modules\Add_To_Cart_Ajax\Settings'   => FOODFORLIFE_ADDONS_DIR . 'modules/add-to-cart-ajax/settings.php',
			'FoodForLife\Addons\Modules\Add_To_Cart_Ajax\Frontend'   => FOODFORLIFE_ADDONS_DIR . 'modules/add-to-cart-ajax/frontend.php',
		] );
	}

	public function settings() {
		if ( is_admin() ) {
			\FoodForLife\Addons\Modules\Add_To_Cart_Ajax\Settings::instance();
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
		if ( get_option( 'foodforlife_add_to_cart_ajax_enable', 'yes' ) == 'yes' ) {
			\FoodForLife\Addons\Modules\Add_To_Cart_Ajax\Frontend::instance();
		}
	}

}
