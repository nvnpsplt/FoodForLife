<?php
/**
 * Hooks of Account.
 *
 * @package FoodForLife
 */

namespace FoodForLife\WooCommerce;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of Account template.
 */
class My_Account {
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
		add_filter('foodforlife_site_content_container_class', array( $this, 'site_content_container_class' ));

		add_filter('get_the_archive_title', array( $this, 'page_header_title' ), 40);

		add_filter('body_class', array( $this, 'body_class' ));
	}

	public function site_content_container_class( $classes ) {
		$classes = 'container';

		return $classes;
	}

	/**
	 * Page Title
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function page_header_title($title) {
		if( is_user_logged_in() ) {
			return $title;
		}

		if( function_exists('is_lost_password_page') && is_lost_password_page() ) {
			return esc_html__('Lost Password', 'foodforlife');
		}

		$mode = isset( $_GET['mode'] ) ? sanitize_text_field( wp_unslash( $_GET['mode'] ) ) : ''; // S-THEME: Sanitize.
		if( $mode == 'register' ) {
			$title = esc_html__('Register', 'foodforlife');
		} elseif( empty( $mode ) || $mode == 'login' ) {
			$title = esc_html__('Login', 'foodforlife');
		}

		return $title;
	}

	/**
	 * Body Class
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function body_class( $classes ) {
		$mode = isset( $_GET['mode'] ) ? sanitize_text_field( wp_unslash( $_GET['mode'] ) ) : ''; // S-THEME: Sanitize.
		if( $mode == 'register' ) {
			$classes[] = 'woocommerce-account-register';
		}

		return $classes;
	}
}
