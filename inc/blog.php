<?php
/**
 * Blog functions and definitions.
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
class Blog {

	/**
	 * Instance
	 *
	 * @var $instance
	 */
	private static $instance = null;

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
		add_action('template_redirect', array($this, 'template_hooks'));
	}


	/**
	 * Template hooks
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function template_hooks() {
		if( Helper::is_blog() || (is_search() && 'product' != get_query_var('post_type') ) ) {
			\FoodForLife\Blog\Page_Header::instance();
			\FoodForLife\Blog\Archive::instance();
		} elseif( is_singular('post') ) {
			\FoodForLife\Blog\Single::instance();
			\FoodForLife\Blog\Comments::instance();
		}
	}
}
