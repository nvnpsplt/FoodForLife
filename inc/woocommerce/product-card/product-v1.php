<?php
/**
 * Product Card v1 hooks.
 *
 * @package FoodForLife
 */

 namespace FoodForLife\WooCommerce\Product_Card;

use FoodForLife\Helper;
use FoodForLife\Icon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of Product Card v1
 */
class Product_V1 extends Base {
	/**
	 * Instance
	 *
	 * @var $instance
	 */
	protected static $instance = null;

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
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
		add_action( 'foodforlife_product_loop_thumbnail', array( $this, 'product_featured_icons_open' ), 5 );
		if(class_exists( '\WCBoost\Wishlist\Frontend' ) && Helper::get_option('product_card_wishlist') ) {
			add_action( 'foodforlife_product_loop_thumbnail', array( \WCBoost\Wishlist\Frontend::instance(), 'loop_add_to_wishlist_button' ), 10 );
		}
		// REMOVED: Compare & Quick View features entirely disabled.
		// if(class_exists( '\WCBoost\ProductsCompare\Frontend' ) && Helper::get_option('product_card_compare')) {
		// 	add_action( 'foodforlife_product_loop_thumbnail', array( \WCBoost\ProductsCompare\Frontend::instance(), 'loop_add_to_compare_button' ), 15 );
		// }
		// if( Helper::get_option('product_card_quick_view')) {
		// 	add_action( 'foodforlife_product_loop_thumbnail', array( \FoodForLife\WooCommerce\Loop\Quick_View::instance(), 'quick_view_button_icon_light' ), 20 );
		// }
		add_action( 'foodforlife_product_loop_thumbnail', 'woocommerce_template_loop_add_to_cart', 25 );
		add_action( 'foodforlife_product_loop_thumbnail', array( $this, 'product_featured_icons_close' ), 30 );
		add_action( 'foodforlife_product_loop_thumbnail', array( $this, 'product_featured_icons_second_open' ), 35 );
		add_action( 'foodforlife_product_loop_thumbnail', 'woocommerce_template_loop_add_to_cart', 40 );
		add_action( 'foodforlife_product_loop_thumbnail', array( $this, 'product_featured_icons_close' ), 50 );
		
		add_action( 'woocommerce_after_shop_loop_item', array( \FoodForLife\WooCommerce\Loop\Product_Attribute::instance(), 'loop_primary_attribute' ), 10 );
		
		if( Helper::get_option( 'mobile_product_card_atc' )) {	
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'add_to_cart_button_base' ), 30 );
		}
	}
}
