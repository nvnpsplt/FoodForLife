<?php
/**
 * Footer functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Footer initial
 *
 */
class Footer {
		/**
	 * Instance
	 *
	 * @var $instance
	 */
	protected static $instance = null;


	/**
	 * Footer ID
	 *
	 * @var $post_id
	 */
	protected static $footer_id = null;


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
		add_action( 'foodforlife_after_close_site_footer', array( $this, 'gotop_button' ) );
		add_action( 'foodforlife_after_close_site_footer', array( $this, 'progress_bar' ) );
	}

	/**
	 * Add this back-to-top button to footer
	 *
	 * @since 1.0.0
	 *
	 * @return  void
	 */
	public function gotop_button() {
		if ( apply_filters( 'foodforlife_get_back_to_top', \FoodForLife\Helper::get_option( 'backtotop' ) ) ) {
			echo '<a href="#page" id="gotop" class="ffl-button ffl-button-outline ffl-button-icon ffl-button-go-top position-fixed end-30 shadow invisible overflow-hidden z-3"><span class="gotop-height-scroll position-absolute bottom-0 start-0 w-100 bg-dark"></span>' . \FoodForLife\Icon::get_svg( 'double-arrow' ) . '</a>';
		}

	}

	/**
	 * Progress bar start
	 *
	 * @since 1.0.0
	 *
	 * @return  void
	 */
	public function progress_bar() {
		echo '<div id="ffl-progress-container" class="ffl-progress-container">
			<div id="ffl-progress-bar" class="ffl-progress-bar"></div>
		</div>';
	}
}
