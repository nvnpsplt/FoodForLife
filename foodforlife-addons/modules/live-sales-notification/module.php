<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Live_Sales_Notification;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
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
			'FoodForLife\Addons\Modules\Live_Sales_Notification\Settings'   => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/settings.php',
			'FoodForLife\Addons\Modules\Live_Sales_Notification\Frontend'   => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/frontend.php',
			'FoodForLife\Addons\Modules\Live_Sales_Notification\Helper'     => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/helper.php',
			'FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation' => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/navigation/navigation.php',
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
			\FoodForLife\Addons\Modules\Live_Sales_Notification\Settings::instance();
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
		if ( get_option( 'foodforlife_live_sales_notification' ) == 'yes' && ! is_customize_preview()) {
			\FoodForLife\Addons\Modules\Live_Sales_Notification\Helper::instance();
			\FoodForLife\Addons\Modules\Live_Sales_Notification\Frontend::instance();
			\FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation::instance();
		}
	}

}
