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
class Share {
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
		add_action( 'foodforlife_product_extra_link', array( $this, 'product_share' ), 28 );
	}

	/**
	 * Product Share
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function product_share() {
		if( ! apply_filters( 'foodforlife_product_share_content', true ) ) {
			return;
		}

		\FoodForLife\Theme::set_prop( 'modals', 'product-share' );

		echo '<a href="#" class="foodforlife-extra-link-item foodforlife-extra-link-item--share d-inline-flex align-items-center gap-10 lh-normal text-base text-hover-color" data-toggle="modal" data-target="product-share-modal">'. Icon::get_svg( 'share' ) . esc_html__( 'Share', 'foodforlife' ) . '</a>';
	}

	/**
	 * Product Share data
	 */
	public static function product_share_data() {
		return Helper::share_socials();
	}
}
