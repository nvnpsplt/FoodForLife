<?php
/**
 * Posts functions and definitions.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Blog;

use FoodForLife\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Posts initial
 *
 */
class Archive {
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
		$this->load_sections();
	}

	/**
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function load_sections() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'foodforlife_wp_script_data', array( $this, 'script_data' ), 10, 3 );

		// Blog content layout
		add_filter('foodforlife_site_layout', array( $this, 'layout' ));


		add_filter( 'post_class', array( $this, 'post_classes' ), 10, 3 );

		// Sidebar
		add_filter( 'foodforlife_get_sidebar', array( $this, 'sidebar' ), 10 );

		// Body Class
		add_filter( 'body_class', array( $this, 'body_classes' ) );

		// Navigation
		add_filter( 'next_posts_link_attributes', array( $this, 'next_posts_link_attributes' ) );
		add_action( 'foodforlife_after_archive_content', array( $this, 'navigation' ), 30 );
		add_action( 'foodforlife_after_search_loop', array( $this, 'navigation' ), 30 );
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		$debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'foodforlife-blog', apply_filters( 'foodforlife_get_style_directory_uri', get_template_directory_uri() ) . '/assets/css/pages/blog' . $debug . '.css', array(), \FoodForLife\Helper::get_theme_version() );
	}

	/**
	 * Script data.
	 *
	 * @since 1.0.0
	 *
	 * @param $data
	 *
	 * @return array
	 */
	public function script_data( $data ) {
		$data['blog_nav_ajax_url_change']    = \FoodForLife\Helper::get_option( 'blog_pagination_ajax_url_change' );

		return $data;
	}

	/**
	 * Layout
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function layout( $layout ) {
		if( ( Helper::get_option( 'blog_layout' ) == 'grid' && in_array( Helper::get_option( 'blog_columns' ), array( '3', '4' ) ) ) || ! is_active_sidebar( 'blog-sidebar' ) ){
			return $layout;
		}

		$layout = Helper::get_option( 'blog_sidebar' );

		return $layout;
	}


	/**
	 * Add a class of blog layout to posts
	 *
	 * @param array $classes
	 * @param array $class
	 * @param int   $post_id
	 *
	 * @return mixed
	 */
	public function post_classes( $classes, $class, $post_id ) {
		if ('post' != get_post_type( $post_id ) || ! is_main_query() ) {
			return $classes;
		}

		$classes[] = 'd-flex flex-column gap-30';

		if( Helper::get_option( 'blog_layout' ) == 'grid' ) {
			if( Helper::get_option( 'blog_columns' ) == '3' ) {
				$classes[] = 'ffl-col ffl-col-12 ffl-col-md-6 ffl-col-lg-4 ffl-col-xl-4';
			} elseif( Helper::get_option( 'blog_columns' ) == '4' ) {
				$classes[] = 'ffl-col ffl-col-12 ffl-col-md-6 ffl-col-lg-4 ffl-col-xl-4 ffl-col-xxl-3';
			} else {
				$classes[] = 'ffl-col ffl-col-12 ffl-col-md-6 ffl-col-lg-6 ffl-col-xl-6';
			}
		}

		if( Helper::get_option( 'blog_layout' ) == 'list' ) {
			$classes[] = 'flex-xl-row align-items-center justify-content-center ffl-col ffl-col-12 ffl-row-cols-2';
		}

		return $classes;
	}


	/**
	 * Get Sidebar
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function sidebar() {
		if ( ! is_active_sidebar( 'blog-sidebar' ) ) {
			return false;
		}

		if ( ( Helper::get_option( 'blog_layout' ) == 'grid' && in_array( Helper::get_option( 'blog_columns' ), array( '3', '4' ) ) ) ) {
			return false;
		}

		if( Helper::get_option( 'blog_sidebar' ) == 'no-sidebar' ) {
			return false;
		}

		return true;
	}

	/**
	 * Classes Body
	 */
	public function body_classes( $classes ) {
		$classes[] = 'foodforlife-blog-page';
		$classes[] = 'blog-' . Helper::get_option( 'blog_layout' );

		if( Helper::get_option( 'blog_layout' ) == 'grid' ) {
			$classes[] = 'ffl-blog-grid-cols-' . Helper::get_option( 'blog_columns' );
		}

		if ( ( Helper::get_option( 'blog_layout' ) == 'grid' && in_array( Helper::get_option( 'blog_columns' ), array( '3', '4' ) ) ) || ! is_active_sidebar( 'blog-sidebar' ) ) {
			$classes[] = 'no-sidebar';
		} else {
			$classes[] = 'ffl-blog-sidebar';
		}

		return $classes;
	}

	/**
	 * Navigation
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function navigation() {
		$pagination_type = Helper::get_option( 'blog_pagination' );

		if ( 'numeric' == $pagination_type ) {
			$args = array(
				'end_size'  => 3,
				'prev_text' => \FoodForLife\Icon::inline_svg( array( 'icon' => 'icon-back' ) ),
				'next_text' => \FoodForLife\Icon::inline_svg( array( 'icon' => 'icon-next' ) ),
				'class' => 'ffl-button-outline'
			);

			the_posts_pagination( $args );
		} else {
			$classes = array(
				'foodforlife-pagination',
				'foodforlife-pagination--blog',
				'next-posts-pagination',
				'foodforlife-pagination--ajax',
				'foodforlife-pagination--' . $pagination_type,
				'text-center',
				'mt-50',
			);

			echo '<nav class="' . esc_attr( implode( ' ', $classes ) ) . '">';
				self::posts_found();
				if ( get_next_posts_link() ) {
					next_posts_link( '<span>' . esc_html__( 'Load more', 'foodforlife' ) . '</span>' );
				}
			echo '</nav>';
		}
	}

	public function next_posts_link_attributes( $attr ) {
		$attr = 'class="ffl-button py-15 px-30 mt-30 min-w-180"';
		return $attr;
	}

	/**
	 * Get post found
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function posts_found() {
		global $wp_query;

		if ( $wp_query && $wp_query->found_posts ) {
			Helper::get_posts_found( $wp_query->post_count, $wp_query->found_posts );
		}
	}
}
