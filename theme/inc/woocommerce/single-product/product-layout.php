<?php
/**
 * Single Product hooks.
 *
 * @package FoodForLife
 */

namespace FoodForLife\WooCommerce\Single_Product;

use FoodForLife\Helper;
use FoodForLife\Icon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of Single Product
 */
class Product_Layout {
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
		\FoodForLife\WooCommerce\Single_Product\Product_Base::instance();
		\FoodForLife\WooCommerce\Single_Product\Related::instance();
		\FoodForLife\WooCommerce\Single_Product\UpSells::instance();
		\FoodForLife\WooCommerce\Single_Product\Recently_Viewed::instance();

		// REMOVED: Ask a Question — feature disabled.
		// if ( intval( Helper::get_option( 'product_ask_question' ) ) && ! empty( Helper::get_option( 'product_ask_question_form' ) ) ) {
		// 	\FoodForLife\WooCommerce\Single_Product\Ask_Question::instance();
		// }

		if ( intval( Helper::get_option( 'product_share' ) ) ) {
			\FoodForLife\WooCommerce\Single_Product\Share::instance();
		}
	}
}
