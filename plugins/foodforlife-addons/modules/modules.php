<?php
/**
 * FoodForLife Addons Modules functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Addons Modules
 */
class Modules {

	/**
	 * Instance
	 *
	 * @var $instance
	 */
	private static $instance;

	/**
	 * Registered modules.
	 *
	 * Holds the list of all the registered modules.
	 *
	 * @var array
	 */
	private $modules = [];

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
		$this->register( 'mega-menu' );

		$this->includes();
		add_action( 'init', [ $this, 'add_actions' ], 20 );
		\FoodForLife\Addons\Modules\Products_Filter\Module::instance();

		add_action( 'init', [ $this, 'activate' ] );

		// Register all custom post types early so they exist during demo import.
		// Modules load at init:20, but the WXR importer needs post types before that.
		$this->register_post_types_for_import();
	}

	/**
	 * Register custom post types from all modules immediately.
	 *
	 * This ensures post types are available during demo import even before
	 * modules fully initialize at init:20.
	 *
	 * @since 1.0.5
	 * @return void
	 */
	private function register_post_types_for_import() {
		\FoodForLife\Addons\Modules\Product_Tabs\Post_Type::instance();
		\FoodForLife\Addons\Modules\Popup\Post_Type::instance();
		\FoodForLife\Addons\Modules\Buy_X_Get_Y\Post_Type::instance();
		\FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Post_Type::instance();
		\FoodForLife\Addons\Modules\Linked_Variant\Post_Type::instance();
		\FoodForLife\Addons\Modules\Size_Guide\Settings::instance();
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
			'FoodForLife\Addons\Modules\Settings'             				=> FOODFORLIFE_ADDONS_DIR . 'modules/settings.php',
			'FoodForLife\Addons\Modules\Base\Variation_Select'             => FOODFORLIFE_ADDONS_DIR . 'modules/base/variation-select.php',
			'FoodForLife\Addons\Modules\Products_Filter\Module'            => FOODFORLIFE_ADDONS_DIR . 'modules/products-filter/module.php',
			'FoodForLife\Addons\Modules\Size_Guide\Module'                 => FOODFORLIFE_ADDONS_DIR . 'modules/size-guide/module.php',
			'FoodForLife\Addons\Modules\Buy_Now\Module'                    => FOODFORLIFE_ADDONS_DIR . 'modules/buy-now/module.php',
			'FoodForLife\Addons\Modules\Sticky_Add_To_Cart\Module'         => FOODFORLIFE_ADDONS_DIR . 'modules/sticky-add-to-cart/module.php',
			'FoodForLife\Addons\Modules\Product_Tabs\Module'               => FOODFORLIFE_ADDONS_DIR . 'modules/product-tabs/module.php',
			// REMOVED: Live Sales Notification — feature disabled.
			// 'FoodForLife\Addons\Modules\Live_Sales_Notification\Module'    => FOODFORLIFE_ADDONS_DIR . 'modules/live-sales-notification/module.php',
			'FoodForLife\Addons\Modules\Variation_Images\Module'           => FOODFORLIFE_ADDONS_DIR . 'modules/variation-images/module.php',
			'FoodForLife\Addons\Modules\Product_Bought_Together\Module'    => FOODFORLIFE_ADDONS_DIR . 'modules/product-bought-together/module.php',
			// REMOVED: Variation Compare — feature disabled.
			// 'FoodForLife\Addons\Modules\Variation_Compare\Module'          => FOODFORLIFE_ADDONS_DIR . 'modules/variation-compare/module.php',
			// REMOVED: People View Fake — feature disabled.
			// 'FoodForLife\Addons\Modules\People_View_Fake\Module'           => FOODFORLIFE_ADDONS_DIR . 'modules/people-view-fake/module.php',
			'FoodForLife\Addons\Modules\Free_Shipping_Bar\Module'          => FOODFORLIFE_ADDONS_DIR . 'modules/free-shipping-bar/module.php',
			'FoodForLife\Addons\Modules\Product_Video\Module'              => FOODFORLIFE_ADDONS_DIR . 'modules/product-video/module.php',
			'FoodForLife\Addons\Modules\Advanced_Linked_Products\Module'   => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-linked-products/module.php',
			// REMOVED: Product 360 View — feature disabled.
			// 'FoodForLife\Addons\Modules\Product_360_View\Module'           => FOODFORLIFE_ADDONS_DIR . 'modules/product-360-view/module.php',
			'FoodForLife\Addons\Modules\Advanced_Search\Module'            => FOODFORLIFE_ADDONS_DIR . 'modules/advanced-search/module.php',
			'FoodForLife\Addons\Modules\Popup\Module'                      => FOODFORLIFE_ADDONS_DIR . 'modules/popup/module.php',
			'FoodForLife\Addons\Modules\Add_To_Cart_Ajax\Module'           => FOODFORLIFE_ADDONS_DIR . 'modules/add-to-cart-ajax/module.php',
			'FoodForLife\Addons\Modules\Recent_Sales_Count\Module'         => FOODFORLIFE_ADDONS_DIR . 'modules/recent-sales-count/module.php',
			'FoodForLife\Addons\Modules\Catalog_Mode\Module'    			  => FOODFORLIFE_ADDONS_DIR . 'modules/catalog-mode/module.php',
			'FoodForLife\Addons\Modules\Inventory\Module'    			  => FOODFORLIFE_ADDONS_DIR . 'modules/inventory/module.php',
			'FoodForLife\Addons\Modules\Linked_Variant\Module'    		  => FOODFORLIFE_ADDONS_DIR . 'modules/linked-variant/module.php',
			'FoodForLife\Addons\Modules\Customer_Reviews\Module'    		  => FOODFORLIFE_ADDONS_DIR . 'modules/customer-reviews/module.php',
			'FoodForLife\Addons\Modules\Pre_Order\Module'    		      => FOODFORLIFE_ADDONS_DIR . 'modules/pre-order/module.php',
			'FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Module'  => FOODFORLIFE_ADDONS_DIR . 'modules/dynamic-pricing-discounts/module.php',
			'FoodForLife\Addons\Modules\Variation_Image_By_Attributes\Module'  => FOODFORLIFE_ADDONS_DIR . 'modules/variation-image-by-attributes/module.php',
			'FoodForLife\Addons\Modules\Buy_X_Get_Y\Module'    		      => FOODFORLIFE_ADDONS_DIR . 'modules/buy-x-get-y/module.php',
		] );
	}


	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function add_actions() {
		\FoodForLife\Addons\Modules\Popup\Module::instance();
		\FoodForLife\Addons\Modules\Advanced_Search\Module::instance();
		\FoodForLife\Addons\Modules\Inventory\Module::instance();
		\FoodForLife\Addons\Modules\Catalog_Mode\Module::instance();
		// REMOVED: Live Sales Notification — feature disabled.
		// \FoodForLife\Addons\Modules\Live_Sales_Notification\Module::instance();
		if( class_exists( '\WCBoost\VariationSwatches\Plugin' ) ) {
			\FoodForLife\Addons\Modules\Multi_Color_Swatches\Module::instance();
		}
		 \FoodForLife\Addons\Modules\Pre_Order\Module::instance();
		 \FoodForLife\Addons\Modules\Checkout_Limit\Module::instance();
		\FoodForLife\Addons\Modules\Product_Video\Module::instance();
		// REMOVED: Product 3D Viewer — feature disabled.
		// \FoodForLife\Addons\Modules\Product_3D_Viewer\Module::instance();
		// REMOVED: Product 360 — feature disabled.
		// \FoodForLife\Addons\Modules\Product_360\Module::instance();
		\FoodForLife\Addons\Modules\Size_Guide\Module::instance();
		\FoodForLife\Addons\Modules\Variation_Images\Module::instance();
		// REMOVED: People View Fake — feature disabled.
		// \FoodForLife\Addons\Modules\People_View_Fake\Module::instance();
		\FoodForLife\Addons\Modules\Products_Stock_Progress_Bar\Module::instance();
		\FoodForLife\Addons\Modules\Linked_Variant\Module::instance();
		\FoodForLife\Addons\Modules\Add_To_Cart_Ajax\Module::instance();
		\FoodForLife\Addons\Modules\Buy_Now\Module::instance();
		// REMOVED: Variation Compare — feature disabled.
		// \FoodForLife\Addons\Modules\Variation_Compare\Module::instance();
		\FoodForLife\Addons\Modules\Model_Sizing\Module::instance();
		\FoodForLife\Addons\Modules\Advanced_Linked_Products\Module::instance();
		\FoodForLife\Addons\Modules\Free_Shipping_Bar\Module::instance();
		\FoodForLife\Addons\Modules\Recent_Sales_Count\Module::instance();
		\FoodForLife\Addons\Modules\Product_Bought_Together\Module::instance();
		\FoodForLife\Addons\Modules\Product_Tabs\Module::instance();
		\FoodForLife\Addons\Modules\Customer_Reviews\Module::instance();
		\FoodForLife\Addons\Modules\Sticky_Add_To_Cart\Module::instance();
		\FoodForLife\Addons\Modules\Variation_Image_By_Attributes\Module::instance();
		\FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts\Module::instance();
		// \FoodForLife\Addons\Modules\Buy_X_Get_Y\Module::instance();

		\FoodForLife\Addons\Modules\Settings::instance();
	}

	/**
	 * Register a module
	 *
	 * @param string $module_name
	 */
	public function register( $module_name ) {
		if ( ! array_key_exists( $module_name, $this->modules ) ) {
			$this->modules[ $module_name ] = null;
		}
	}

	/**
	 * Deregister a moudle.
	 * Only allow deregistering a module if it is not activated.
	 *
	 * @param string $module_name
	 */
	public function deregister( $module_name ) {
		if ( ! array_key_exists( $module_name, $this->modules ) && empty( $this->modules[ $module_name ] ) ) {
			unset( $this->modules[ $module_name ] );
		}
	}

	/**
	 * Active all registered modules
	 *
	 * @return void
	 */
	public function activate() {
		foreach ( $this->modules as $module_name => $instance ) {
			if ( ! empty( $instance ) ) {
				continue;
			}

			$classname = $this->get_module_classname( $module_name );

			if ( $classname ) {
				$this->modules[ $module_name ] = $classname::instance();
			}
		}

	}

	/**
	 * Get module class name
	 *
	 * @param string $module_name
	 * @return string
	 */
	public function get_module_classname( $module_name ) {
		$class_name = str_replace( '-', ' ', $module_name );
		$class_name = str_replace( ' ', '_', ucwords( $class_name ) );
		$class_name = 'FoodForLife\\Addons\\Modules\\' . $class_name . '\\Module';

		return $class_name;
	}
}
