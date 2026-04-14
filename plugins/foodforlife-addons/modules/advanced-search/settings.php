<?php

namespace FoodForLife\Addons\Modules\Advanced_Search;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main class of plugin for admin
 */
class Settings  {

	/**
	 * Instance
	 *
	 * @var $instance
	 */
	private static $instance;


	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
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
		add_filter( 'foodforlife_get_sections_theme_features', array( $this, 'advanced_search_section' ), 20, 2 );
		add_filter( 'foodforlife_get_settings_theme_features', array( $this, 'advanced_search_settings' ), 20, 2 );
	}

	/**
	 * Free Shipping Bar section
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function advanced_search_section( $sections ) {
		$sections['advanced_search'] = esc_html__( 'Advanced Search', 'foodforlife-addons' );

		return $sections;
	}

	/**
	 * Adds settings to product display settings
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings
	 * @param string $section
	 *
	 * @return array
	 */
	public function advanced_search_settings( $settings, $section ) {
		if ( 'advanced_search' == $section ) {
			$settings = array();

			$settings[] = array(
				'id'    => 'foodforlife_advanced_search_options',
				'title' => esc_html__( 'Advanced Search', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_products_by_sku',
				'title'   => esc_html__( 'Search Products by SKU', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_products_by_title',
				'title'   => esc_html__( 'Search Products by Title', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_products_by_content',
				'title'   => esc_html__( 'Search Products by Content', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'no',
			);

			$settings[] = array(
				'id'    => 'foodforlife_ajax_search_options',
				'type'  => 'sectionend',
			);

			$settings[] = array(
				'id'    => 'foodforlife_ajax_search_options',
				'title' => esc_html__( 'Ajax Instant Search', 'foodforlife-addons' ),
				'type'  => 'title',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search',
				'title'   => esc_html__( 'Ajax Instant Search', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_number',
				'title'   => esc_html__( 'Limit', 'foodforlife-addons' ),
				'type'    => 'number',
				'default' => '10',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_products',
				'title'   => esc_html__( 'Autocomplete', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Show Products', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'checkboxgroup' => 'start',
				'default' => 'yes',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_categories',
				'desc'   => esc_html__( 'Show Categories', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => '',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_posts',
				'desc'   => esc_html__( 'Show Posts', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_pages',
				'desc'   => esc_html__( 'Show Pages', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_hidden',
				'type'    => 'hidden',
				'checkboxgroup' => 'end',
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_suggestions',
				'title'   => esc_html__( 'Ajax Search Suggestions', 'foodforlife-addons' ),
				'desc'    => esc_html__( 'Enable', 'foodforlife-addons' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			);

			$option_args = array(
				'featured'     => esc_html__( 'Featured', 'foodforlife-addons' ),
				'best_selling' => esc_html__( 'Best Selling', 'foodforlife-addons' ),
				'top_rated'    => esc_html__( 'Top Rated', 'foodforlife-addons' ),
				'sale'         => esc_html__( 'On Sale', 'foodforlife-addons' ),
			);

			if ( get_option( 'foodforlife_recently_viewed_enable', 'yes' ) === 'yes' ) {
				$option_args['recent'] = esc_html__( 'Recently viewed', 'foodforlife-addons' );
			}

			$settings[] = array(
				'name'    => esc_html__( 'Suggestions type', 'foodforlife-addons' ),
				'id'      => 'foodforlife_ajax_search_suggestions_type',
				'default' => 'best_selling',
				'class'   => 'wc-enhanced-select',
				'type'    => 'multiselect',
				'options' => $option_args,
			);

			$settings[] = array(
				'id'      => 'foodforlife_ajax_search_suggestions_number',
				'title'   => esc_html__( 'Suggestions limit', 'foodforlife-addons' ),
				'type'    => 'number',
				'default' => '5',
			);

			$settings[] = array(
				'id'   => 'foodforlife_advanced_search_options',
				'type' => 'sectionend',
			);
		}

		return $settings;
	}
}