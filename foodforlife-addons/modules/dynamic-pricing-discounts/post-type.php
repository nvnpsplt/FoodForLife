<?php

namespace FoodForLife\Addons\Modules\Dynamic_Pricing_Discounts;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main class of plugin for admin
 */
class Post_Type {

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

	const POST_TYPE = 'gz_pricing_discount';

	/**
	 * Instantiate the object.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
			// Make sure the post types are loaded for imports
		add_action( 'import_start', array( $this, 'register_post_type' ) );
		$this->register_post_type();

	}

	/**
	 * Register product tabs post type
     *
	 * @since 1.0.0
     *
     * @return void
	 */
	public function register_post_type() {
		if( post_type_exists(self::POST_TYPE) ) {
			return;
		}

		register_post_type( self::POST_TYPE, array(
			'description'         => esc_html__( 'Dynamic Pricing Discounts', 'foodforlife-addons' ),
			'labels'              => array(
				'name'                  => esc_html__( 'Dynamic Pricing Discounts', 'foodforlife-addons' ),
				'singular_name'         => esc_html__( 'Dynamic Pricing Discounts', 'foodforlife-addons' ),
				'menu_name'             => esc_html__( 'Dynamic Pricing Discounts', 'foodforlife-addons' ),
				'all_items'             => esc_html__( 'Dynamic Pricing Discounts', 'foodforlife-addons' ),
				'add_new'               => esc_html__( 'Add New', 'foodforlife-addons' ),
				'add_new_item'          => esc_html__( 'Add New Item', 'foodforlife-addons' ),
				'edit_item'             => esc_html__( 'Edit Item', 'foodforlife-addons' ),
				'new_item'              => esc_html__( 'New Item', 'foodforlife-addons' ),
				'view_item'             => esc_html__( 'View Item', 'foodforlife-addons' ),
				'search_items'          => esc_html__( 'Search items', 'foodforlife-addons' ),
				'not_found'             => esc_html__( 'No item found', 'foodforlife-addons' ),
				'not_found_in_trash'    => esc_html__( 'No item found in Trash', 'foodforlife-addons' ),
				'filter_items_list'     => esc_html__( 'Filter items list', 'foodforlife-addons' ),
				'items_list_navigation' => esc_html__( 'Items list navigation', 'foodforlife-addons' ),
				'items_list'            => esc_html__( 'Items list', 'foodforlife-addons' ),
			),
			'supports'            => array( 'title' ),
			'rewrite'             => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'show_in_menu'        => 'edit.php?post_type=product',
			'menu_position'       => 30,
			'capability_type'     => 'page',
			'query_var'           => is_admin(),
			'map_meta_cap'        => true,
			'exclude_from_search' => false,
			'hierarchical'        => false,
			'has_archive'         => false,
			'show_in_nav_menus'   => false,
		) );
	}
}