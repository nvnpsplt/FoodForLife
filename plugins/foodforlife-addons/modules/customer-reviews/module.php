<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Customer_Reviews;

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
			'FoodForLife\Addons\Modules\Customer_Reviews\Settings' => FOODFORLIFE_ADDONS_DIR . 'modules/customer-reviews/settings.php',
			'FoodForLife\Addons\Modules\Customer_Reviews\Meta_Box' => FOODFORLIFE_ADDONS_DIR . 'modules/customer-reviews/meta-box.php',
			'FoodForLife\Addons\Modules\Customer_Reviews\Frontend' => FOODFORLIFE_ADDONS_DIR . 'modules/customer-reviews/frontend.php',
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
			\FoodForLife\Addons\Modules\Customer_Reviews\Settings::instance();

			if ( get_option( 'foodforlife_customer_reviews_upload' ) == 'yes' ) {
				\FoodForLife\Addons\Modules\Customer_Reviews\Meta_Box::instance();
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
		if ( get_option( 'foodforlife_customer_reviews_upload' ) == 'yes' ) {
			\FoodForLife\Addons\Modules\Customer_Reviews\Frontend::instance();
		}
	}
}
