<?php

/**
 * Theme Options
 *
 * @package FoodForLife
 */

namespace FoodForLife;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

class Options {
	/**
	 * Instance
	 *
	 * @var $instance
	 */
	protected static $instance = null;

	/**
	 * $foodforlife_customize
	 *
	 * @var $foodforlife_customize
	 */
	protected static $foodforlife_customize = null;

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function instance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * The class constructor
	 *
	 * @since 1.0.0
	 *
	 */
	public function __construct() {
		add_filter('foodforlife_customize_config', array($this, 'customize_settings'));
		self::$foodforlife_customize = \FoodForLife\Customizer::instance();
	}

	/**
	 * This is a short hand function for getting setting value from customizer
	 *
	 * @since 1.0.0
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option($name) {
		if ( is_object( self::$foodforlife_customize ) ) {
			$value = self::$foodforlife_customize->get_option( $name );
		} elseif (false !== get_theme_mod($name)) {
			$value = get_theme_mod($name);
		} else {
			$value = $this->get_option_default($name);
		}
		return apply_filters('foodforlife_get_option', $value, $name);
	}

	/**
	 * Get default option values
	 *
	 * @since 1.0.0
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default($name) {
		if ( is_object( self::$foodforlife_customize ) ) {
			return self::$foodforlife_customize->get_option_default( $name );
		}

		$config   = $this->customize_settings();
		$settings = array_reduce( $config['settings'], 'array_merge', array() );

		if ( ! isset( $settings[ $name ] ) ) {
			return false;
		}

		return isset( $settings[ $name ]['default'] ) ? $settings[ $name ]['default'] : false;
	}

	/**
	 * Options of topbar items
	 *
	 * @return array
	 */
	public static function topbar_items_option() {
		return apply_filters( 'foodforlife_topbar_items_option', array(
			''     			    => esc_html__( 'Select an Item', 'foodforlife' ),
			'language' 			=> esc_html__( 'Language', 'foodforlife' ),
			'currency' 			=> esc_html__( 'Currency', 'foodforlife' ),
			'slides'        	=> esc_html__( 'Slides', 'foodforlife' ),
			'menu'        		=> esc_html__( 'Menu', 'foodforlife' ),
			'custom-html'    	=> esc_html__( 'Custom HTML', 'foodforlife' ),
		) );
	}

	/**
	 * Options of header items
	 *
	 * @return array
	 */
	public static function header_items_option() {
		return apply_filters( 'foodforlife_header_items_option', array(
			''     			 => esc_html__( 'Select an Item', 'foodforlife' ),
			'logo'           => esc_html__( 'Logo', 'foodforlife' ),
			'primary-menu'   => esc_html__( 'Primary Menu', 'foodforlife' ),
			'secondary-menu' => esc_html__( 'Secondary Menu', 'foodforlife' ),
			'search'   		 => esc_html__( 'Search', 'foodforlife' ),
			'account'   	 => esc_html__( 'Account', 'foodforlife' ),
			'wishlist'   	 => esc_html__( 'Wishlist', 'foodforlife' ),
			// REMOVED: Compare — feature disabled.
			// 'compare'   	 => esc_html__( 'Compare', 'foodforlife' ),
			'cart'   	 	 => esc_html__( 'Cart', 'foodforlife' ),
			'language'     	 => esc_html__( 'Language', 'foodforlife' ),
			'currency'     	 => esc_html__( 'Currency', 'foodforlife' ),
			'custom-html' 	 => esc_html__( 'Custom HTML', 'foodforlife' ),
		) );
	}
	/**
	 * Options of header items
	 *
	 * @return array
	 */
	public static function header_mobile_items_option() {
		return apply_filters( 'foodforlife_header_mobile_items_option', array(
			''     			 => esc_html__( 'Select an Item', 'foodforlife' ),
			'logo'           => esc_html__( 'Logo', 'foodforlife' ),
			'hamburger'      => esc_html__( 'Hamburger', 'foodforlife' ),
			'search'         => esc_html__( 'Search', 'foodforlife' ),
			'cart'           => esc_html__( 'Cart', 'foodforlife' ),
			'wishlist'       => esc_html__( 'Wishlist', 'foodforlife' ),
			// REMOVED: Compare — feature disabled.
			// 'compare'        => esc_html__( 'Compare', 'foodforlife' ),
			'account'        => esc_html__( 'Account', 'foodforlife' ),
			'custom-html'    => esc_html__( 'Custom HTML', 'foodforlife' ),
		) );
	}

	/**
	 * Get customize settings
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function customize_settings() {
		$settings = array(
			'theme' => 'foodforlife',
		);

		$panels = array(
			'general'    => array(
				'priority' => 10,
				'title'    => esc_html__( 'General', 'foodforlife' ),
			),
			'styling'    => array(
				'priority' => 15,
				'title'    => esc_html__( 'Styling', 'foodforlife' ),
			),
			'typography' => array(
				'priority' => 20,
				'title'    => esc_html__( 'Typography', 'foodforlife' ),
			),
			'header'       => array(
				'priority' => 20,
				'title'    => esc_html__( 'Header', 'foodforlife' ),
			),
			'page'   => array(
				'title'      => esc_html__('Page', 'foodforlife'),
				'priority'   => 30,
			),
			'blog'    => array(
				'priority' => 30,
				'title'    => esc_html__( 'Blog', 'foodforlife' ),
			),
			'mobile' => array(
				'priority'   => 90,
				'title'      => esc_html__('Mobile', 'foodforlife'),
			),
		);

		$sections = array(
			'maintenance'  => array(
				'title'      => esc_html__('Maintenance', 'foodforlife'),
				'priority'   => 10,
				'capability' => 'edit_theme_options',
			),
			'color_scheme' => array(
				'title'    => esc_html__('Color Scheme', 'foodforlife'),
				'panel'    => 'styling',
			),
			'styling_images' => array(
				'title'    => esc_html__('Images', 'foodforlife'),
				'panel'    => 'styling',
			),
			'styling_buttons' => array(
				'title'    => esc_html__('Buttons', 'foodforlife'),
				'panel'    => 'styling',
			),
			'styling_form_fields' => array(
				'title'    => esc_html__('Form Fields', 'foodforlife'),
				'panel'    => 'styling',
			),
			'backtotop' => array(
				'title'    => esc_html__( 'Back To Top', 'foodforlife' ),
				'panel'    => 'general',
			),
			// Typography
			'typo_font_family'         => array(
				'title'    => esc_html__( 'Font Family', 'foodforlife' ),
				'panel'    => 'typography',
			),
			'typo_main'         => array(
				'title'    => esc_html__( 'Main', 'foodforlife' ),
				'panel'    => 'typography',
			),
			'typo_headings'     => array(
				'title'    => esc_html__( 'Headings', 'foodforlife' ),
				'panel'    => 'typography',
			),
			'typo_header_logo'         => array(
				'title'    => esc_html__( 'Header Logo Text', 'foodforlife' ),
				'panel'    => 'typography',
			),
			'typo_header_menu_primary'       => array(
				'title'    => esc_html__( 'Header Primary Menu', 'foodforlife' ),
				'panel'    => 'typography',
			),
			'typo_page'         => array(
				'title'    => esc_html__( 'Page', 'foodforlife' ),
				'panel'    => 'typography',
			),
			'typo_posts'        => array(
				'title'    => esc_html__( 'Blog', 'foodforlife' ),
				'panel'    => 'typography',
			),
			'typo_widget'       => array(
				'title'    => esc_html__( 'Widgets', 'foodforlife' ),
				'panel'    => 'typography',
			),
			// Header
			'header_top'        => array(
				'title'    => esc_html__( 'Topbar', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_campaign'   => array(
				'title'    => esc_html__( 'Campaign Bar', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_layout'        => array(
				'title'    => esc_html__( 'Header Layout', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_main'       => array(
				'title'    => esc_html__( 'Header Main', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_bottom'       => array(
				'title'    => esc_html__( 'Header Bottom', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_sticky'       => array(
				'title'    => esc_html__( 'Sticky Header', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_background'       => array(
				'title'    => esc_html__( 'Header Background', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_logo'       => array(
				'title'    => esc_html__( 'Logo', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_account'    => array(
				'title'    => esc_html__( 'Account', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_wishlist'    => array(
				'title'    => esc_html__( 'Wishlist', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_compare'    => array(
				'title'    => esc_html__( 'Compare', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_cart'    => array(
				'title'    => esc_html__( 'Cart', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_search'    => array(
				'title'    => esc_html__( 'Search', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_product_categories'    => array(
				'title'    => esc_html__( 'Product Categories', 'foodforlife' ),
				'panel'    => 'header',
			),
			'header_custom_html'    => array(
				'title'    => esc_html__( 'Custom HTML', 'foodforlife' ),
				'panel'    => 'header',
			),
			// Blog
			'post_card'       => array(
				'title'    => esc_html__( 'Post Card Images', 'foodforlife' ),
				'panel'    => 'blog',
			),
			'blog_header'       => array(
				'title'    => esc_html__( 'Blog Header', 'foodforlife' ),
				'panel'    => 'blog',
			),
			'blog_page'       => array(
				'title'    => esc_html__( 'Blog Page', 'foodforlife' ),
				'panel'    => 'blog',
			),
			'blog_single'       => array(
				'title'    => esc_html__( 'Blog Single', 'foodforlife' ),
				'panel'    => 'blog',
			),
			'share_socials' => array(
				'title'    => esc_html__( 'Share Socials', 'foodforlife' ),
				'panel'    => 'general',
			),
			// Page
			'page_header'       => array(
				'title'    => esc_html__( 'Page Header', 'foodforlife' ),
				'panel'    => 'page',
			),
			// Mobile
			'topbar_mobile'        => array(
				'title'    => esc_html__( 'Topbar', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'header_mobile_layout'        => array(
				'title'    => esc_html__( 'Header Layout', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'header_mobile_main'       => array(
				'title'    => esc_html__( 'Header Main', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'header_mobile_bottom'       => array(
				'title'    => esc_html__( 'Header Bottom', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'header_mobile_elements'        => array(
				'title'    => esc_html__( 'Header Elements', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'header_mobile_sticky'       => array(
				'title'    => esc_html__( 'Sticky Header', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'header_mobile_background'       => array(
				'title'    => esc_html__( 'Header Background', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'header_mobile_menu'    => array(
				'title'    => esc_html__( 'Header Mobile Menu', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'mobile_product_catalog'        => array(
				'title'    => esc_html__( 'Product Catalog', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'mobile_product_card'        => array(
				'title'    => esc_html__( 'Product Card', 'foodforlife' ),
				'panel'    => 'mobile',
			),
			'mobile_single_product'        => array(
				'title'    => esc_html__( 'Single Product', 'foodforlife' ),
				'panel'    => 'mobile',
			),
		);

		$settings   = array();

		// C5: Settings are split into domain-specific partials for maintainability.
		// Each partial populates $settings[] arrays in the caller's scope.
		// The $this context is available inside partials for method calls.
		$options_dir = get_template_directory() . '/inc/options/';

		require $options_dir . 'styling.php';      // maintenance, color_scheme, images, buttons, form_fields
		require $options_dir . 'typography.php';    // typo_main, font_family, headings, logo, menu, page, posts
		require $options_dir . 'header.php';        // header_top through header_mobile_menu (~1,780 settings)
		require $options_dir . 'blog.php';          // post_card, blog_header, blog_page, blog_single, backtotop, share_socials
		require $options_dir . 'page.php';          // page_header
		require $options_dir . 'mobile.php';        // topbar_mobile through mobile_single_product


		return array(
			'theme'    => 'foodforlife',
			'panels'   => apply_filters( 'foodforlife_customize_panels', $panels ),
			'sections' => apply_filters( 'foodforlife_customize_sections', $sections ),
			'settings' => apply_filters( 'foodforlife_customize_settings', $settings ),
		);

	}

	/**
	 * Get nav menus
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function get_menus() {
		if ( ! is_admin() ) {
			return [];
		}

		$menus = wp_get_nav_menus();
		if ( ! $menus ) {
			return [];
		}

		$output = array(
			0 => esc_html__( 'Select Menu', 'foodforlife' ),
		);
		foreach ( $menus as $menu ) {
			$output[ $menu->slug ] = $menu->name;
		}

		return $output;
	}

	/**
	 * Get the list of fonts for Kirki
	 *
	 * @return array
	 */
	public static function customizer_fonts_choices() {
		if( get_theme_mod('typo_font_family', true) ) {
			$args_fonts = array(
				'families' => array(
					array( 'id' => 'Instrument Sans', 'text' => 'Instrument Sans' ),
				),
				'variants' => array(
					'Instrument Sans' => array( 'regular', '500', '600', '700', '800' ),
				),
			);
		} else {
			$args_fonts = array();
		}

		// Compatible custom fonts plugin
		if( defined( 'BSF_CUSTOM_FONTS_POST_TYPE' ) ) {
			$args                 = array(
				'post_type'      => BSF_CUSTOM_FONTS_POST_TYPE,
				'post_status'    => 'publish',
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'posts_per_page' => apply_filters( 'foodforlife_custom_fonts_admin_query_limit', 100 ),
			);

			$query = new \WP_Query( $args );
			$bsf_fonts = $query->posts;

			if ( ! empty( $bsf_fonts ) ) {
				foreach ( $bsf_fonts as $key => $post_id ) {
					$bsf_font_data = get_post_meta( $post_id, 'fonts-data', true );
					$variants = [];
					foreach( $bsf_font_data['variations'] as $variations ) {
						$variants[] = $variations['font_weight'] == '400' ? 'regular' : $variations['font_weight'];
					}

					$args_fonts['families'][] = array(
						'id' => $bsf_font_data['font_name'],
						'text' => $bsf_font_data['font_name']
					);

					$args_fonts['variants'][$bsf_font_data['font_name']] = $variants;
				}
			}

			wp_reset_postdata();
		}

		$custom_fonts = apply_filters( 'foodforlife_custom_fonts_options', $args_fonts );

		$fonts = array(
			'standard' => array( 'serif', 'sans-serif', 'monospace' ),
			'google'   => array(),
		);

		if ( ! empty( $custom_fonts) && ! empty( $custom_fonts['families'] ) ) {
			$fonts['families'] = array(
				'custom' => array(
					'text'     => esc_html__( 'FoodForLife Custom Fonts', 'foodforlife' ),
					'children' => $custom_fonts['families'],
				),
			);

			if ( ! empty( $custom_fonts['variants'] ) ) {
				$fonts['variants'] = $custom_fonts['variants'];
			}
		}

		return apply_filters( 'foodforlife_customize_fonts_choices', array(
			'fonts' => $fonts,
		) );
	}

	/**
	 * Display header search
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function display_header_search_option() {
		if ( 'custom' == get_theme_mod( 'header_present' ) ) {
			if ( 'icon' == get_theme_mod( 'header_search_layout' ) ) {
				return true;
			}

			return false;
		} 

		return true;
	}
	
}
