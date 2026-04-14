<?php
/**
 * Catalog hooks.
 *
 * @package FoodForLife
 */

namespace FoodForLife\WooCommerce\Catalog;

use \FoodForLife\Helper;
use FoodForLife\Icon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of Catalog
 */

class Manager {
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
		add_action('wp', array( $this, 'add_actions' ));
		\FoodForLife\WooCommerce\Catalog\Product_Grid_Banner::instance();
	}

	public function add_actions() {
		if ( apply_filters( 'foodforlife_load_catalog_layout', \FoodForLife\Helper::is_catalog() ) ) {
			\FoodForLife\WooCommerce\Catalog\Layout::instance();
			if ( Helper::get_option( 'top_categories' ) ) {
				\FoodForLife\WooCommerce\Catalog\Top_Categories::instance();
			}

			if ( Helper::get_option( 'catalog_toolbar' ) ) {
				\FoodForLife\WooCommerce\Catalog\Toolbar::instance();
			}

			if ( Helper::get_option( 'product_filter_type' ) == 'horizontal' ) {
				\FoodForLife\WooCommerce\Catalog\Filter_Horizontal::instance();
			}
			\FoodForLife\WooCommerce\Catalog\Products_Grid::instance();
			\FoodForLife\WooCommerce\Catalog\Pagination::instance();
			\FoodForLife\WooCommerce\Catalog\Page_Header::instance();
			\FoodForLife\WooCommerce\Catalog\Sidebar::instance();
		}

		if ( \FoodForLife\Helper::is_catalog() ) {
			\FoodForLife\WooCommerce\Catalog\View::instance();
			\FoodForLife\WooCommerce\Catalog\Products_List::instance();
		}
	}

}