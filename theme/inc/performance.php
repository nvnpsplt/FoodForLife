<?php
/**
 * Performance optimizations for the FoodForLife theme.
 *
 * @package FoodForLife
 */

namespace FoodForLife;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Performance optimization class
 *
 * Handles resource hints, CSS minification, and structured data.
 *
 * @since 1.8.1
 */
class Performance {

	/**
	 * Instance
	 *
	 * @var $instance
	 */
	protected static $instance = null;

	/**
	 * Initiator
	 *
	 * @since 1.8.1
	 *
	 * @return object
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.8.1
	 *
	 * @return void
	 */
	public function __construct() {
		// Resource hints (preconnect)
		add_filter( 'wp_resource_hints', array( $this, 'resource_hints' ), 10, 2 );

		// Minify dynamic CSS before caching
		add_filter( 'foodforlife_inline_style', array( $this, 'minify_css' ), 999 );

		// Add JSON-LD structured data for product pages
		if ( class_exists( 'WooCommerce' ) ) {
			add_action( 'wp_footer', array( $this, 'product_structured_data' ) );
		}

		// ARIA enhancements
		add_filter( 'nav_menu_item_args', array( $this, 'add_menu_aria' ), 10, 3 );

		// M11: Security headers
		add_filter( 'wp_headers', array( $this, 'security_headers' ) );

		// P1: Dequeue block editor CSS on pages that don't use Gutenberg blocks.
		// Saves ~40KB of unused CSS on WooCommerce/Elementor/classic pages.
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_block_styles' ), 100 );

		// P3: Remove jQuery Migrate on frontend (deprecated since WP 5.5).
		// jQuery Migrate adds ~10KB and is only needed for legacy jQuery plugins.
		add_action( 'wp_default_scripts', array( $this, 'remove_jquery_migrate' ) );
	}

	/**
	 * Add preconnect hints for known external domains.
	 *
	 * This helps the browser establish early connections to origins
	 * that will be used for fonts, analytics, or CDN resources.
	 *
	 * @since 1.8.1
	 *
	 * @param array  $hints URLs to print for resource hints.
	 * @param string $relation_type The relation type the URLs are printed for.
	 *
	 * @return array
	 */
	public function resource_hints( $hints, $relation_type ) {
		if ( 'preconnect' !== $relation_type ) {
			return $hints;
		}

		$preconnect_domains = array();

		// Google Fonts (if custom fonts are configured)
		$body_font = Helper::get_option( 'typo_body' );
		$heading_font = Helper::get_option( 'typo_heading' );

		if ( ! empty( $body_font ) || ! empty( $heading_font ) ) {
			$preconnect_domains[] = array(
				'href'        => 'https://fonts.googleapis.com',
				'crossorigin' => 'anonymous',
			);
			$preconnect_domains[] = array(
				'href'        => 'https://fonts.gstatic.com',
				'crossorigin' => 'anonymous',
			);
		}

		foreach ( $preconnect_domains as $domain ) {
			$hints[] = $domain;
		}

		return $hints;
	}

	/**
	 * Minify CSS by removing comments, whitespace, and unnecessary characters.
	 *
	 * Applied to the dynamic CSS before it gets cached, so the minification
	 * cost is only paid once per cache cycle, not on every page load.
	 *
	 * @since 1.8.1
	 *
	 * @param string $css Raw CSS string to minify.
	 *
	 * @return string Minified CSS string.
	 */
	public function minify_css( $css ) {
		if ( empty( $css ) ) {
			return $css;
		}

		// Remove CSS comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );

		// Remove whitespace around special characters
		$css = preg_replace( '/\s*([{}:;,>~+])\s*/', '$1', $css );

		// Remove remaining multiple whitespace
		$css = preg_replace( '/\s+/', ' ', $css );

		// Trim and remove leading/trailing whitespace
		$css = trim( $css );

		return $css;
	}

	/**
	 * Add JSON-LD structured data for WooCommerce product pages.
	 *
	 * WooCommerce already outputs basic structured data, but this supplements
	 * it with additional breadcrumb schema for better SEO.
	 *
	 * @since 1.8.1
	 *
	 * @return void
	 */
	public function product_structured_data() {
		if ( ! is_product() ) {
			return;
		}

		global $product;

		if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
			return;
		}

		// Add BreadcrumbList schema for product pages
		$breadcrumbs = array();
		$position = 1;

		// Home
		$breadcrumbs[] = array(
			'@type'    => 'ListItem',
			'position' => $position++,
			'name'     => esc_html( get_bloginfo( 'name' ) ),
			'item'     => esc_url( home_url( '/' ) ),
		);

		// Shop page
		$shop_page_id = wc_get_page_id( 'shop' );
		if ( $shop_page_id > 0 ) {
			$breadcrumbs[] = array(
				'@type'    => 'ListItem',
				'position' => $position++,
				'name'     => esc_html( get_the_title( $shop_page_id ) ),
				'item'     => esc_url( get_permalink( $shop_page_id ) ),
			);
		}

		// Product categories
		$terms = get_the_terms( $product->get_id(), 'product_cat' );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$primary_term = $terms[0];
			$breadcrumbs[] = array(
				'@type'    => 'ListItem',
				'position' => $position++,
				'name'     => esc_html( $primary_term->name ),
				'item'     => esc_url( get_term_link( $primary_term ) ),
			);
		}

		// Current product (no item URL for last breadcrumb)
		$breadcrumbs[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => esc_html( $product->get_name() ),
		);

		$schema = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $breadcrumbs,
		);

		printf(
			'<script type="application/ld+json">%s</script>' . "\n",
			wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
		);
	}

	/**
	 * Add ARIA attributes to navigation menu items.
	 *
	 * Adds aria-haspopup and aria-expanded to menu items that have
	 * submenus for better screen reader support.
	 *
	 * @since 1.8.1
	 *
	 * @param object $args  An object of wp_nav_menu() arguments.
	 * @param object $item  Menu item data object.
	 * @param int    $depth Depth of menu item.
	 *
	 * @return object Modified arguments.
	 */
	public function add_menu_aria( $args, $item, $depth ) {
		$classes = $item->classes ?? array();

		if ( in_array( 'menu-item-has-children', $classes, true ) ) {
			$args->link_after = $args->link_after ?? '';
			// Add aria attributes via a filter on the link attributes instead
			add_filter( 'nav_menu_link_attributes', function( $atts ) use ( $item ) {
				static $processed = array();
				if ( ! isset( $processed[ $item->ID ] ) ) {
					$atts['aria-haspopup'] = 'true';
					$atts['aria-expanded'] = 'false';
					$processed[ $item->ID ] = true;
				}
				return $atts;
			}, 10, 1 );
		}

		return $args;
	}

	/**
	 * Add security headers to all frontend responses.
	 *
	 * These are baseline security headers recommended by OWASP:
	 * - X-Content-Type-Options: Prevents MIME-type sniffing
	 * - X-Frame-Options: Prevents clickjacking via iframe embedding
	 * - Referrer-Policy: Limits referrer data leakage to external sites
	 *
	 * @since 1.8.1
	 *
	 * @param array $headers HTTP headers.
	 *
	 * @return array Modified headers.
	 */
	public function security_headers( $headers ) {
		$security_headers = array(
			'X-Content-Type-Options' => 'nosniff',
			'X-Frame-Options'        => 'SAMEORIGIN',
			'Referrer-Policy'        => 'strict-origin-when-cross-origin',
		);

		/**
		 * Filter the security headers added by the theme.
		 *
		 * @since 1.8.1
		 *
		 * @param array $security_headers Key-value pairs of header name => value.
		 */
		$security_headers = apply_filters( 'foodforlife_security_headers', $security_headers );

		return array_merge( $headers, $security_headers );
	}

	/**
	 * P1: Dequeue Gutenberg block library CSS on pages that don't use blocks.
	 *
	 * The wp-block-library stylesheet (~40KB) provides styling for all core
	 * Gutenberg blocks. On WooCommerce product pages, classic editor pages,
	 * and Elementor-built pages, these styles are unused overhead.
	 *
	 * Filterable: Return false from 'foodforlife_dequeue_block_styles' to disable.
	 *
	 * @since 1.8.2
	 *
	 * @return void
	 */
	public function dequeue_block_styles() {
		if ( is_admin() ) {
			return;
		}

		/**
		 * Filter whether to dequeue block styles on the current page.
		 *
		 * @since 1.8.2
		 *
		 * @param bool $should_dequeue Whether to remove block styles. Default true.
		 */
		if ( ! apply_filters( 'foodforlife_dequeue_block_styles', true ) ) {
			return;
		}

		// Only dequeue on pages that definitely don't use Gutenberg blocks.
		// Bail on singular pages to avoid breaking block content.
		if ( is_singular() ) {
			global $post;
			if ( $post && has_blocks( $post ) ) {
				return; // This page uses blocks, keep the styles.
			}
		}

		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-blocks-style' ); // WooCommerce block styles
	}

	/**
	 * P3: Remove jQuery Migrate from frontend scripts.
	 *
	 * Since WordPress 5.5, jQuery Migrate runs in a "slim" mode and is
	 * deprecated. The FoodForLife theme and its bundled JS do not rely on
	 * deprecated jQuery APIs, so Migrate is pure overhead (~10KB gzipped).
	 *
	 * This does NOT affect the admin area, where Migrate may still be needed
	 * by third-party plugins.
	 *
	 * Filterable: Return false from 'foodforlife_remove_jquery_migrate' to disable.
	 *
	 * @since 1.8.2
	 *
	 * @param \WP_Scripts $scripts The WP_Scripts instance.
	 *
	 * @return void
	 */
	public function remove_jquery_migrate( $scripts ) {
		if ( is_admin() ) {
			return;
		}

		/**
		 * Filter whether to remove jQuery Migrate.
		 *
		 * @since 1.8.2
		 *
		 * @param bool $should_remove Whether to remove jQuery Migrate. Default true.
		 */
		if ( ! apply_filters( 'foodforlife_remove_jquery_migrate', true ) ) {
			return;
		}

		if ( isset( $scripts->registered['jquery'] ) ) {
			$jquery_deps = $scripts->registered['jquery']->deps;
			$scripts->registered['jquery']->deps = array_diff( $jquery_deps, array( 'jquery-migrate' ) );
		}
	}
}
