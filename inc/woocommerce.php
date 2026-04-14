<?php
/**
 * Woocommerce functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woocommerce initial
 *
 */
class WooCommerce {
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
		add_action( 'after_setup_theme', array( $this, 'woocommerce_setup' ) );
		add_action( 'wp', array( $this, 'add_actions' ), 10 );
		add_action( 'init', array( $this, 'init' ) );

		add_filter( 'woocommerce_get_script_data', array( $this, 'get_script_data' ), 10, 2 );
		add_filter( 'woocommerce_get_image_size_gallery_thumbnail', array( $this, 'get_gallery_thumbnail_size' ) );

		// E9: Declare HPOS (High-Performance Order Storage) compatibility.
		// Required since WooCommerce 8.2+ for custom_order_tables feature.
		add_action( 'before_woocommerce_init', array( $this, 'declare_hpos_compatibility' ) );

		\FoodForLife\WooCommerce\Admin\Customizer::instance();
	}


	/**
	 * WooCommerce Init
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init() {
		\FoodForLife\WooCommerce\Admin\Product_Settings::instance();

		\FoodForLife\WooCommerce\General::instance();
		\FoodForLife\WooCommerce\Dynamic_CSS::instance();
		\FoodForLife\WooCommerce\Badges::instance();
		\FoodForLife\WooCommerce\Login::instance();

		\FoodForLife\WooCommerce\Catalog\Manager::instance();
		\FoodForLife\WooCommerce\Product_Card\Manager::instance();

		\FoodForLife\WooCommerce\Single_Product\ATC_Form::instance();
		\FoodForLife\WooCommerce\Single_Product_Summary::instance();
		// Mini Cart
		\FoodForLife\WooCommerce\Cart\Quick_Edit::instance();
		\FoodForLife\WooCommerce\Cart\Mini_Cart::instance();

		if ( class_exists( 'WCFMmp' ) ) {
			\FoodForLife\Vendors\WCFM::instance();
		}

		if ( class_exists( 'WeDevs_Dokan' ) ) {
			\FoodForLife\Vendors\Dokan::instance();
		}

		if( is_admin() ) {
			\FoodForLife\WooCommerce\Admin\Category_Settings::instance();
		}
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function add_actions() {
		if ( function_exists('wcboost_wishlist') ) {
			\FoodForLife\WooCommerce\Wishlist::instance();
		}

		// REMOVED: Compare feature entirely disabled per user decision.
		// if ( function_exists('wcboost_products_compare') ) {
		// 	\FoodForLife\WooCommerce\Compare::instance();
		// }

		if( function_exists('is_account_page') && is_account_page() ) {
			\FoodForLife\WooCommerce\My_Account::instance();
		}

		if ( $this->is_cart() ) {
			\FoodForLife\WooCommerce\Cart\Cart::instance();
		}

		if ( $this->is_checkout() ) {
			\FoodForLife\WooCommerce\Checkout::instance();
		}

		if ( apply_filters('foodforlife_load_single_product_layout', is_singular( 'product' ) ) ) {
			\FoodForLife\WooCommerce\Single_Product\Product_Layout::instance();
		}

		if( function_exists( 'wcboost_variation_swatches' ) ) {
			\FoodForLife\WooCommerce\Loop\Product_Attribute::instance();
		}

		// REMOVED: Quick View feature entirely disabled per user decision.
		// if( Helper::get_option( 'product_card_quick_view' ) ) {
		// 	\FoodForLife\WooCommerce\Loop\Quick_View::instance();
		// }

		\FoodForLife\WooCommerce\Product_Notices::instance();
		\FoodForLife\WooCommerce\Shoppable_Video_Elementor::instance();

	}

	public function is_checkout() {
		if( function_exists('is_checkout') && is_checkout() ) {
			return true;
		}

		if ( function_exists( 'has_block' ) ) {
			$checkout_id = get_the_ID();
			if ( $checkout_id && has_block( 'woocommerce/checkout', $checkout_id ) ) {
				return true;
			}
		}
		return false;
	}

	public function is_cart() {
		if( function_exists('is_cart') && is_cart() ) {
			return true;
		}

		if ( function_exists( 'has_block' ) ) {
			$cart_id = get_the_ID();
			if ( $cart_id && has_block( 'woocommerce/cart', $cart_id ) ) {
				return true;
			}
		}
		return false;
	}

		/**
	 * WooCommerce setup function.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function woocommerce_setup() {
		add_theme_support( 'woocommerce', array(
			'product_grid' => array(
				'default_rows'    => 4,
				'min_rows'        => 2,
				'max_rows'        => 20,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 7,
			),
			'wishlist' => array(
				'single_button_position' => 'theme',
				'loop_button_position'   => 'theme',
				'button_type'            => 'theme',
			),
		) );

		add_theme_support( 'wc-product-gallery-slider' );

		if ( Helper::get_option( 'product_image_lightbox' ) ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}

	/**
	 * Return data for script handles.
	 *
	 * @param  string $handle Script handle the data will be attached to.
	 * @return array|bool
	 */
	public function get_script_data( $params, $handle ) {
		if( $handle == 'wc-single-product' ) {
			$params['flexslider_enabled'] = false;
			$params['photoswipe_enabled'] = false;
		}

		return $params;
	}

	/**
	 * Set the gallery thumbnail size.
	 *
	 * @since 1.0.0
	 *
	 * @param array $size Image size.
	 *
	 * @return array
	 */
	public function get_gallery_thumbnail_size( $size ) {
		$size['width'] = 130;
		$size['height'] = 0;
		$size['crop']   = 1;

		return $size;
	}

	/**
	 * Declare compatibility with WooCommerce HPOS (High-Performance Order Storage).
	 *
	 * This signals WooCommerce that the theme is compatible with Custom Order Tables,
	 * allowing store owners to enable the high-performance order storage feature.
	 *
	 * @since 1.8.1
	 *
	 * @return void
	 */
	public function declare_hpos_compatibility() {
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility(
				'custom_order_tables',
				get_template_directory() . '/functions.php',
				true
			);
		}
	}
}
