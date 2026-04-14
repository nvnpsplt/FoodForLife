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
 * Addons Navigation
 */
class Navigation {

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
			'FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Orders_Fake'       => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/navigation/orders-fake.php',
			'FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Orders'    	       => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/navigation/orders.php',
			'FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Product_Type' 	   => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/navigation/product-type.php',
			'FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Selected_Products' => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/navigation/selected-products.php',
			'FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Categories'		   => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/navigation/categories.php',
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
		\FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Orders_Fake::instance();
		\FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Orders::instance();
		\FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Product_Type::instance();
		\FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Selected_Products::instance();
		\FoodForLife\Addons\Modules\Live_Sales_Notification\Navigation\Categories::instance();
	}

}
