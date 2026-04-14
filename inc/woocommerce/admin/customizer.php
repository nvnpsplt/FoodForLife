<?php
/**
 * WooCommerce Customizer functions and definitions.
 *
 * @package foodforlife
 */

namespace FoodForLife\WooCommerce\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The foodforlife WooCommerce Customizer class
 */
class Customizer {
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
		add_filter( 'foodforlife_customize_panels', array( $this, 'get_customize_panels' ) );
		add_filter( 'foodforlife_customize_sections', array( $this, 'get_customize_sections' ) );
		add_filter( 'foodforlife_customize_settings', array( $this, 'get_customize_settings' ) );
	}

	/**
	 * Adds theme options panels of WooCommerce.
	 *
	 * @since 1.0.0
	 *
	 * @param array $panels Theme options panels.
	 *
	 * @return array
	 */
	public function get_customize_panels( $panels ) {
		$panels['woocommerce'] = array(
			'priority' => 50,
			'title'    => esc_html__( 'Woocommerce', 'foodforlife' ),
		);

		$panels['shop'] = array(
			'priority' => 55,
			'title'    => esc_html__( 'Shop', 'foodforlife' ),
		);

		if( apply_filters('foodforlife_get_single_product_settings', true ) ) {
			$panels['single_product'] = array(
				'priority' => 60,
				'title'    => esc_html__( 'Single Product', 'foodforlife' ),
			);
		}

		$panels['vendors'] = array(
			'priority' => 60,
			'title'    => esc_html__( 'Vendors', 'foodforlife' ),
		);

		return $panels;
	}

	/**
	 * Adds theme options sections of WooCommerce.
	 *
	 * @since 1.0.0
	 *
	 * @param array $sections Theme options sections.
	 *
	 * @return array
	 */
	public function get_customize_sections( $sections ) {
		// Typography
		$sections['typo_catalog'] = array(
			'title'    => esc_html__( 'Product Catalog', 'foodforlife' ),
			'panel'    => 'typography',
		);
		$sections['typo_product'] = array(
			'title'    => esc_html__( 'Single Product', 'foodforlife' ),
			'panel'    => 'typography',
		);

		// Cart Page
		$sections['woocommerce_cart'] = array(
			'title'    => esc_html__( 'Cart Page', 'foodforlife' ),
			'panel'    => 'woocommerce',
		);

		// Mini Cart
		$sections['mini_cart'] = array(
			'title'    => esc_html__( 'Mini Cart', 'foodforlife' ),
			'panel'    => 'woocommerce',
		);

		// REMOVED: Compare Page section — feature disabled.
		// $sections['compare_page'] = array(
		// 	'title'    => esc_html__( 'Compare Page', 'foodforlife' ),
		// 	'panel'    => 'woocommerce',
		// );

		if( apply_filters( 'foodforlife_shop_header_elementor', true ) ) {
			// Page Header
			$sections['shop_header'] = array(
				'title'    => esc_html__( 'Page Header', 'foodforlife' ),
				'panel'    => 'shop',
			);
		}

		if( apply_filters( 'foodforlife_taxonomy_description_elementor', true ) ) {
			// Taxonomy Description
			$sections['taxonomy_description'] = array(
				'title'    => esc_html__( 'Taxonomy Description', 'foodforlife' ),
				'panel'    => 'shop',
			);
		}

		if( apply_filters( 'foodforlife_top_categories_elementor', true ) ) {
			// Top Categories
			$sections['shop_top_categories'] = array(
				'title'    => esc_html__( 'Top Categories', 'foodforlife' ),
				'panel'    => 'shop',
			);
		}

		if( apply_filters( 'foodforlife_catalog_toolbar_elementor', true ) ) {
			// Catalog Toolbar
			$sections['shop_catalog_toolbar'] = array(
				'title'    => esc_html__( 'Catalog Toolbar', 'foodforlife' ),
				'panel'    => 'shop',
			);
		}

		if( apply_filters( 'foodforlife_product_catalog_elementor', true ) ) {
			// Product Catalog
			$sections['product_catalog'] = array(
				'title'    => esc_html__( 'Product Catalog', 'foodforlife' ),
				'panel'    => 'shop',
			);
		}

		$sections['product_grid_banner'] = array(
			'title'    => esc_html__( 'Product Grid Banner', 'foodforlife' ),
			'panel'    => 'shop',
		);

		// Product Card
		$sections['product_card'] = array(
			'title'    => esc_html__( 'Product Card', 'foodforlife' ),
			'panel'    => 'shop',
		);

		// Product Notifications
		$sections['product_notifications'] = array(
			'title'    => esc_html__( 'Product Notifications', 'foodforlife' ),
			'panel'    => 'shop',
		);

		// Badges
		$sections['badges'] = array(
			'title'    => esc_html__( 'Badges', 'foodforlife' ),
			'panel'    => 'shop',
		);

		$sections['product_gallery'] = array(
			'title'    => esc_html__( 'Product Gallery', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		// Single Product
		$sections['product'] = array(
			'title'    => esc_html__( 'Product Summary', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		// Single Badges
		$sections['product_badges'] = array(
			'title'    => esc_html__( 'Badges', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		// Shipping & Promotions Information
		$sections['product_shipping_promotions'] = array(
			'title'    => esc_html__( 'Shipping & Promotions Information', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		// Guarantee Safe Checkout
		$sections['product_guarantee_safe_checkout'] = array(
			'title'    => esc_html__( 'Guarantee Safe Checkout', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		// Product Highlights
		$sections['product_highlights'] = array(
			'title'    => esc_html__( 'Product Highlights', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		// Product tabs
		$sections['product_tabs'] = array(
			'title'    => esc_html__( 'Product Tabs', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		// Upsells Product
		$sections['upsells_products'] = array(
			'title'    => esc_html__( 'Up-Sells Products', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		// Related Product
		$sections['related_products'] = array(
			'title'    => esc_html__( 'Related Products', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		// Recently Viewed Product
		$sections['recently_viewed_products'] = array(
			'title'    => esc_html__( 'Recently Viewed Products', 'foodforlife' ),
			'panel'    => 'single_product',
		);

		$sections['vendors_store_style'] = array(
			'title'    => esc_html__( 'Store Style', 'foodforlife' ),
			'panel'    => 'vendors',
		);

		return $sections;
	}

	/**
	 * Adds theme options of WooCommerce.
	 *
	 * @since 1.0.0
	 *
	 * @param array $fields Theme options fields.
	 *
	 * @return array
	 */
	public function get_customize_settings( $settings ) {
		// Product Compare Page
		if ( function_exists('wcboost_products_compare') ) {
			$columns = [
				'remove'      => esc_html__( 'Remove', 'foodforlife' ),
				'badge'       => esc_html__( 'Badge', 'foodforlife' ),
				'thumbnail'   => esc_html__( 'Thumbnail', 'foodforlife' ),
				'name'        => esc_html__( 'Name', 'foodforlife' ),
				'rating'      => esc_html__( 'Rating', 'foodforlife' ),
				'price'       => esc_html__( 'Price', 'foodforlife' ),
				'stock'       => esc_html__( 'Availability', 'foodforlife' ),
				'sku'         => esc_html__( 'SKU', 'foodforlife' ),
				'dimensions'  => esc_html__( 'Dimensions', 'foodforlife' ),
				'weight'      => esc_html__( 'Weight', 'foodforlife' ),
				'add-to-cart' => esc_html__( 'Add To Cart', 'foodforlife' ),
			];

			$columns = array_merge( $columns, $this->get_product_attributes() );
			if( isset( $columns[''] ) ) {
				unset($columns['']);
			}
			$settings['compare_page'] = array(
				'compare_page_columns'                => array(
					'type'     => 'multicheck',
					'label'    => esc_html__('Table Columns', 'foodforlife'),
					'default'  => array('remove', 'badge', 'thumbnail', 'name', 'rating', 'price', 'stock', 'sku', 'dimensions', 'weight', 'add-to-cart'),
					'choices'  => $columns,
				)
			);
		}

		// Typography - catalog.
		$settings['typo_catalog'] = array(
			'typo_catalog_page_title'              => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Page Header Title', 'foodforlife' ),
				'description' => esc_html__( 'Customize the font of page header title', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => '600',
					'font-size'      => '36px',
					'line-height'    => '',
					'text-transform' => 'none',
					'color'          => '#111',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing' => '-1.224px',
				),
				'choices'   => \FoodForLife\Options::customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => '.page-header--shop .page-header__title',
					),
				),
			),
			'typo_catalog_page_description'              => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Page Header Description', 'foodforlife' ),
				'description' => esc_html__( 'Customize the font of page header description', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => 'regular',
					'font-size'      => '15px',
					'line-height'    => '',
					'text-transform' => 'none',
					'color'          => '#444',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing' => '',
				),
				'choices'   => \FoodForLife\Options::customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => '.page-header--shop .page-header__description',
					),
				),
			),
			'typo_catalog_product_title'              => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Product Name', 'foodforlife' ),
				'description' => esc_html__( 'Customize the font of product name', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => '600',
					'font-size'      => '15px',
					'line-height'    => '',
					'text-transform' => 'none',
					'color'          => '#111',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing' => '',
				),
				'choices'   => \FoodForLife\Options::customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => 'ul.products li.product h2.woocommerce-loop-product__title a',
					),
				),
			),
		);

		// Typography - product.
		$settings['typo_product'] = array(
			'typo_product_title'              => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Product Name', 'foodforlife' ),
				'description' => esc_html__( 'Customize the font of product name', 'foodforlife' ),
				'default'     => array(
					'font-family'    => 'Instrument Sans',
					'variant'        => '600',
					'font-size'      => '26px',
					'line-height'    => '',
					'text-transform' => 'none',
					'color'          => '#111',
					'subsets'        => array( 'latin-ext' ),
					'letter-spacing' => '-0.884px',
				),
				'choices'   => \FoodForLife\Options::customizer_fonts_choices(),
				'transport' => 'postMessage',
				'js_vars'      => array(
					array(
						'element' => '.single-product div.product .product-gallery-summary h1.product_title',
					),
				),
			),
		);

		// Product Catalog
		$settings['product_catalog'] = array(
			'product_filter_type' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Product Filter', 'foodforlife' ),
				'description'     => esc_html__( 'Go to appearance > widgets find to catalog filters sidebar to edit your sidebar', 'foodforlife' ),
				'default'         => 'no-filter',
				'choices'         => array(
					'content-sidebar' 	=> esc_html__( 'Right Sidebar', 'foodforlife' ),
					'sidebar-content' 	=> esc_html__( 'Left Sidebar', 'foodforlife' ),
					'horizontal'      	=> esc_html__( 'Horizontal', 'foodforlife' ),
					'popup'      		=> esc_html__( 'Popup', 'foodforlife' ),
					'no-filter'      	=> esc_html__( 'No Filter', 'foodforlife' ),
				),
				'priority'        => 10,
			),

			'product_catalog_hr'  => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_catalog_pagination' => array(
				'type'    => 'radio',
				'label'   => esc_html__( 'Pagination Type', 'foodforlife' ),
				'default' => 'numeric',
				'choices' => array(
					'numeric'  => esc_attr__( 'Numeric', 'foodforlife' ),
					'infinite' => esc_attr__( 'Infinite Scroll', 'foodforlife' ),
					'loadmore' => esc_attr__( 'Load More', 'foodforlife' ),
				),
				'priority'        => 40,
			),
			'product_catalog_pagination_ajax_url_change' => array(
				'type'            => 'checkbox',
				'label'           => esc_html__( 'Change the URL after page loaded', 'foodforlife' ),
				'default'         => true,
				'active_callback' => array(
					array(
						'setting'  => 'product_catalog_pagination',
						'operator' => '!=',
						'value'    => 'numeric',
					),
				),
				'priority'        => 50,
			),
		);

		// Product Banner
		$settings['product_grid_banner'] = array(
			'product_grid_banner' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Product Grid Banner', 'foodforlife' ),
				'description' => esc_html__( 'Enable this option to display the product banner on the first page of the product grid loop on the shop page', 'foodforlife' ),
				'default'     => false,
			),
			'category_product_grid_banner_fallback' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Category Product Banner Fallback', 'foodforlife' ),
				'description' => esc_html__( 'Choose what happens if the category has no product banner.', 'foodforlife' ),
				'default'     => 'none',
				'choices'     => array(
					'none'  => esc_html__( 'Do not display banner', 'foodforlife' ),
					'shop'  => esc_html__( 'Show shop banner', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_grid_banner',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_grid_banner_hr'  => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'active_callback' => array(
					array(
						'setting'  => 'product_grid_banner',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_grid_banner_position'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Position', 'foodforlife' ),
				'default'         => '6',
				'active_callback' => array(
					array(
						'setting'  => 'product_grid_banner',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_grid_banner_image'       => array(
				'type'            => 'image',
				'label'           => esc_html__( 'Image', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'product_grid_banner',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_grid_banner_link'       => array(
				'type'            => 'text',
				'label'           => esc_html__( 'Link', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'product_grid_banner',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		// Product Card
		$settings['product_card'] = array(
			'image_rounded_shape_product_card'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Image Corner Radius', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					'' 			=> esc_html__( 'Default', 'foodforlife' ),
					'round'  	=> esc_html__( 'Round', 'foodforlife' ),
					'custom'  	=> esc_html__( 'Custom', 'foodforlife' ),
				),
			),
			'image_rounded_number_product_card'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Number(px)', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'image_rounded_shape_product_card',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'product_card_images_hr' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
			),
			'product_card_layout' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Product Layout', 'foodforlife' ),
				'default' => '1',
				'choices' => array(
					'1' => esc_html__( 'Layout v1', 'foodforlife' ),
					'2' => esc_html__( 'Layout v2', 'foodforlife' ),
				),
			),
			'product_card_hover' => array(
				'type'              => 'select',
				'label'             => esc_html__( 'Product Hover', 'foodforlife' ),
				'description'       => esc_html__( 'Product hover animation.', 'foodforlife' ),
				'default'           => '',
				'choices'           => array(
					''                 => esc_html__( 'Standard', 'foodforlife' ),
					'fadein'           => esc_html__( 'Fadein', 'foodforlife' ),
				),
				'priority'    => 10,
			),
			'product_card_hr' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
			),
			'product_card_quickadd' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Quick Add button', 'foodforlife' ),
				'description' => esc_html__( 'Disable this setting to return to the default button', 'foodforlife' ),
				'default'     => true,
			),
			'product_card_wishlist' => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Wishlist button', 'foodforlife' ),
				'default' => true,
			),
			'product_card_wishlist_display'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Wishlist Display', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					'' 			=> esc_html__( 'Show on Hover', 'foodforlife' ),
					'always'  	=> esc_html__( 'Always Show', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_card_wishlist',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'product_card_layout',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
			// REMOVED: Compare button — feature disabled.
			// 'product_card_compare' => array(
			// 	'type'    => 'toggle',
			// 	'label'   => esc_html__( 'Compare button', 'foodforlife' ),
			// 	'default' => true,
			// ),
			// REMOVED: Quick View button — feature disabled.
			// 'product_card_quick_view' => array(
			// 	'type'    => 'toggle',
			// 	'label'   => esc_html__( 'Quick view button', 'foodforlife' ),
			// 	'default' => true,
			// ),
			'featured_button_rounded_shape_product_card'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Featured Button Corner Radius', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					'' 			=> esc_html__( 'Default', 'foodforlife' ),
					'square'  	=> esc_html__( 'Square', 'foodforlife' ),
					'round'  	=> esc_html__( 'Round', 'foodforlife' ),
					'custom'  	=> esc_html__( 'Custom', 'foodforlife' ),
				),
			),
			'featured_button_rounded_number_product_card'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Number(px)', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'featured_button_rounded_shape_product_card',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
			),
			'product_sale_coundown_hr' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
			),

			'sale_display_type'       => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Sale Display Type', 'foodforlife' ),
				'default'         => 'countdown',
				'choices'         => array(
					'' 			=> esc_html__( 'None', 'foodforlife' ),
					'countdown' => esc_html__( 'Countdown Timer', 'foodforlife' ),
					'marquee' 	=> esc_html__( 'Flash Sale Marquee', 'foodforlife' ),
				),
			),

			'sale_display_marquee_speed' => array(
				'type'            => 'number',
				'label'     	  => esc_html__( 'Speed', 'foodforlife' ),
				'description'     => esc_html__( 'Customize marquee speed (Example: 0.25)', 'foodforlife' ),
				'default'         => 0.1,
				'choices'  => [
					'min'  => 0,
					'max'  => 1,
					'step' => 0.1,
				],
				'active_callback' => array(
					array(
						'setting'  => 'sale_display_type',
						'operator' => '==',
						'value'    => 'marquee',
					),
				),
			),

			'product_card_taxonomy_hr' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
			),
			'product_card_taxonomy'               => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Product Taxonomy', 'foodforlife' ),
				'default'         => '',
				'choices'         => array(
					''   => esc_html__( 'None', 'foodforlife' ),
					'product_cat'   => esc_html__( 'Category', 'foodforlife' ),
					'product_brand' => esc_html__( 'Brand', 'foodforlife' ),
				),
			),
			'product_card_rating_hr' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
			),
			'product_card_rating'          => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Show Rating', 'foodforlife' ),
				'default'     => true,
			),
			'product_card_rating_count'          => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Show Rating Count', 'foodforlife' ),
				'default'     => false,
				'active_callback' => array(
					array(
						'setting'  => 'product_card_rating',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_card_empty_rating'          => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Hide Empty Rating', 'foodforlife' ),
				'default'     => false,
				'active_callback' => array(
					array(
						'setting'  => 'product_card_rating',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_card_title_hr' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
			),
			'product_card_title_heading_tag' => array(
				'type'               => 'select',
				'label'              => esc_html__( 'Product Title HTML Tag', 'foodforlife' ),
				'default'            => 'h2',
				'choices'            => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				),
			),
			'product_card_title_lines' => array(
				'type'               => 'select',
				'label'              => esc_html__( 'Product Title in', 'foodforlife' ),
				'default'            => '',
				'choices'            => array(
					''  => esc_html__( 'Default', 'foodforlife' ),
					'1' => esc_html__( '1 line', 'foodforlife' ),
					'2' => esc_html__( '2 lines', 'foodforlife' ),
					'3' => esc_html__( '3 lines', 'foodforlife' ),
					'4' => esc_html__( '4 lines', 'foodforlife' ),
				),
			),
			'product_card_summary_hr_1' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
				'active_callback' => array(
					array(
						'setting'  => 'product_card_layout',
						'operator' => 'in',
						'value'    => array('1', '2'),
					),
				),
			),
			'product_card_summary' => array(
				'type'              => 'select',
				'label'             => esc_html__( 'Product Summary Alignment', 'foodforlife' ),
				'default'           => 'center',
				'choices'           => array(
					'flex-start' => esc_html__( 'Left', 'foodforlife' ),
					'center'     => esc_html__( 'Center', 'foodforlife' ),
					'flex-end'   => esc_html__( 'Right', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_card_layout',
						'operator' => 'in',
						'value'    => array('1', '2'),
					),
				),
			),
			'product_card_hr_1' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
			),
			'product_card_attribute' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Primary Product Attribute', 'foodforlife' ),
				'default'     => 'none',
				'choices'     => $this->get_product_attributes(),
				'description' => esc_html__( 'Show primary product attribute in the product card', 'foodforlife' ),
			),
			'product_card_attribute_in' => array(
				'type'        => 'multicheck',
				'label'       => esc_html__( 'Product Attribute In', 'foodforlife' ),
				'default'     => array('variable'),
				'choices'  => array(
					'variable' => esc_html__( 'Variable Product', 'foodforlife' ),
					'simple'   => esc_html__( 'Simple Product', 'foodforlife' ),
				),
			),
			'product_card_attribute_number' => array(
				'type'            => 'number',
				'description'     => esc_html__( 'Primary Product Attribute Number', 'foodforlife' ),
				'default'         => 4,
				'choices'  => array(
					'min'  => 1,
				),
			),
			'product_card_attribute_variation_swatches'                => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Variation Swatches Style', 'foodforlife' ),
				'default'     => 'default',
				'choices'     => array(
					'default'  => esc_html__( 'By the Theme', 'foodforlife' ),
					'swatches'  => esc_html__( 'By Variation Swatches plugin', 'foodforlife' ),
				),
			),
			'product_card_attribute_image_swap_hover' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Enable Image Swap on Hover', 'foodforlife' ),
				'default'     => 1,
			),
			'product_card_attribute_tooltip' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Enable Attribute Tooltip', 'foodforlife' ),
				'default'     => 1,
			),
			'product_card_hr_30' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
			),
			'product_list_short_description_line_limit' => array(
				'type'            => 'number',
				'label'           => esc_html__('Short Description Line Limit', 'foodforlife'),
				'description'     => esc_html__( 'Lines of short description in product list and catalog page', 'foodforlife' ),
				'responsive'      => true,
				'choices'     => [
					'min'  => 1,
					'max'  => 10,
					'step' => 1,
				],
				'default'    => [
					'desktop' => 3,
                    'tablet'  => 2,
                    'mobile'  => 3,
				],
			),
		);

		// WCFM
		if ( class_exists( 'WCFMmp' ) ) {
			$settings['product_card']['product_card_vendor_name_custom'] = array(
				'type'            => 'custom',
				'default'         => '<hr/>',
				'priority'    => 42,
			);
			$settings['product_card']['product_card_vendor_name'] = array(
				'type'            => 'select',
				'label'           => esc_html__( 'Vendor Name', 'foodforlife' ),
				'default'         => 'avatar',
				'choices'         => array(
					'none' => esc_html__( 'None', 'foodforlife' ),
					'avatar' => esc_html__( 'Avatar - Vendor Name', 'foodforlife' ),
					'text' => esc_html__( 'By - Vendor Name', 'foodforlife' ),
				),
				'priority'    => 42,
			);
			$settings['product_card']['product_card_vendor_position'] = array(
				'type'            => 'select',
				'label'           => esc_html__( 'Vendor Position', 'foodforlife' ),
				'default'         => 'after-price',
				'choices'         => array(
					'after-price' => esc_html__( 'After Price', 'foodforlife' ),
					'after-thumbnail' => esc_html__( 'After Thumbnail', 'foodforlife' ),
				),
				'priority'    => 42,
			);
			$settings['vendors_store_style']['vendor_store_style_theme'] = array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Enable Style From Theme', 'foodforlife' ),
				'description' => esc_html__( 'Enable the store list and store page style from theme.', 'foodforlife' ),
				'default' => true,
			);
		}

		// Vendor
		if ( class_exists( 'WeDevs_Dokan' ) ) {
			$settings['product_card'] = array_merge(
				$settings['product_card'],
				array(
					'product_card_vendor_custom'      => array(
						'type'     => 'custom',
						'default'  => '<hr/>',
					),
					'product_card_vendor_name'     => array(
						'type'            => 'select',
						'label'           => esc_html__( 'Vendor Name', 'foodforlife' ),
						'default'         => 'avatar',
						'choices'         => array(
							'none' => esc_html__( 'None', 'foodforlife' ),
							'avatar' => esc_html__( 'Avatar - Vendor Name', 'foodforlife' ),
							'text' => esc_html__( 'By - Vendor Name', 'foodforlife' ),
						),
					),
					'product_card_vendor_position'     => array(
						'type'            => 'select',
						'label'           => esc_html__( 'Vendor Position', 'foodforlife' ),
						'default'         => 'after-price',
						'choices'         => array(
							'after-price' => esc_html__( 'After Price', 'foodforlife' ),
							'after-thumbnail' => esc_html__( 'After Thumbnail', 'foodforlife' ),
						),
					),
				)
			);
		};

		// Product Notifications
		$settings['product_notifications'] = array(
			'added_to_cart_notice'                => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Added to Cart Notice', 'foodforlife' ),
				'description' => esc_html__( 'Display a notification when a product is added to cart.', 'foodforlife' ),
				'default'     => 'mini',
				'choices'     => array(
					'mini'  => esc_html__( 'Open mini cart', 'foodforlife' ),
					'none'  => esc_html__( 'None', 'foodforlife' ),
				),
			),
			'added_to_wishlist_custom'                 => array(
				'type'     => 'custom',
				'default'  => '<hr/>',
			),
			'added_to_wishlist_notice' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Added to Wishlist Notification', 'foodforlife' ),
				'description' => esc_html__( 'Display a notification when a product is added to wishlist', 'foodforlife' ),
				'section'     => 'product_notifications',
				'default'     => 0,
			),

			'wishlist_notice_auto_hide'   => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Wishlist Notification Auto Hide', 'foodforlife' ),
				'description'     => esc_html__( 'How many seconds you want to hide the notification.', 'foodforlife' ),
				'section'         => 'product_notifications',
				'active_callback' => array(
					array(
						'setting'  => 'added_to_wishlist_notice',
						'operator' => '==',
						'value'    => 1,
					),
				),
				'default'         => 3,
			),
			// REMOVED: Compare notification settings — feature disabled.
			// 'added_to_compare_custom' => array(
			// 	'type'     => 'custom',
			// 	'default'  => '<hr/>',
			// ),
			// 'added_to_compare_notice' => array(
			// 	'type'        => 'toggle',
			// 	'label'       => esc_html__( 'Added to Compare Notification', 'foodforlife' ),
			// 	'description' => esc_html__( 'Display a notification when a product is added to compare', 'foodforlife' ),
			// 	'section'     => 'product_notifications',
			// 	'default'     => 0,
			// ),
			// 'compare_notice_auto_hide' => array(
			// 	'type'            => 'number',
			// 	'label'           => esc_html__( 'Compare Notification Auto Hide', 'foodforlife' ),
			// 	'description'     => esc_html__( 'How many seconds you want to hide the notification.', 'foodforlife' ),
			// 	'section'         => 'product_notifications',
			// 	'active_callback' => array(
			// 		array(
			// 			'setting'  => 'added_to_compare_notice',
			// 			'operator' => '==',
			// 			'value'    => 1,
			// 		),
			// 	),
			// 	'default'         => 3,
			// ),
		);

		// Badges
		$settings['badges'] = array(
			'badges_sale'          => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Sale Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for sale products.', 'foodforlife' ),
				'default'     => true,
			),
			'badges_sale_type'     => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Type', 'foodforlife' ),
				'default'         => 'percent',
				'choices'         => array(
					'percent'        => esc_html__( 'Percentage', 'foodforlife' ),
					'text'           => esc_html__( 'Text', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'badges_sale',
						'operator' => '=',
						'value'    => true,
					),
				),
			),
			'badges_sale_bg'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_sale',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .onsale',
						'property' => 'background-color',
					),
				),
			),
			'badges_sale_text_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Text Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_sale',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .onsale',
						'property' => 'color',
					),
				),
			),
			'badges_hr_2'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'badges_new'           => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'New Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for new products.', 'foodforlife' ),
				'default'     => true,
			),
			'badges_newness'       => array(
				'type'            => 'number',
				'description'     => esc_html__( 'Display the "New" badge for how many days?', 'foodforlife' ),
				'tooltip'         => esc_html__( 'You can also add the NEW badge to each product in the Advanced setting tab of them.', 'foodforlife' ),
				'default'         => 3,
				'active_callback' => array(
					array(
						'setting'  => 'badges_new',
						'operator' => '=',
						'value'    => true,
					),
				),
			),
			'badges_new_bg'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_new',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .new',
						'property' => 'background-color',
					),
				),
			),
			'badges_new_text_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Text Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_new',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .new',
						'property' => 'color',
					),
				),
			),
			'badges_hr_3'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'badges_featured'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Featured Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for featured products.', 'foodforlife' ),
				'default'     => true,
			),
			'badges_featured_bg'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_featured',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .featured',
						'property' => 'background-color',
					),
				),
			),
			'badges_featured_text_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Text Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_featured',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .featured',
						'property' => 'color',
					),
				),
			),
			'badges_hr_4'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'badges_soldout'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Sold Out Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for out of stock products.', 'foodforlife' ),
				'default'     => true,
			),
			'badges_soldout_bg'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_soldout',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .sold-out, .woocommerce-badges.woocommerce-badges.sold-out--center.sold-out',
						'property' => 'background-color',
					),
				),
			),
			'badges_soldout_text_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Text Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_soldout',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .sold-out',
						'property' => 'color',
					),
				),
			),
			'badges_hr_5'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'badges_preorder'           => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Preorder Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for preorder products.', 'foodforlife' ),
				'default'     => true,
			),
			'badges_preorder_bg'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_preorder',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .pre-order',
						'property' => 'background-color',
					),
				),
			),
			'badges_preorder_text_color'  => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Text Color', 'foodforlife' ),
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'badges_preorder',
						'operator' => '=',
						'value'    => true,
					),
				),
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .pre-order',
						'property' => 'color',
					),
				),
			),
			'badges_custom_badge'       => array(
				'type'    => 'custom',
				'default' => '<hr/><h3>' . esc_html__( 'Custom Badge', 'foodforlife' ) . '</h3>',
			),

			'badges_custom_bg'    => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background', 'foodforlife' ),
				'default'         => '',
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .custom',
						'property' => 'background-color',
					),
				),
			),

			'badges_custom_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Color', 'foodforlife' ),
				'default'         => '',
				'transport'       => 'postMessage',
				'js_vars'         => array(
					array(
						'element'  => '.woocommerce-badges .custom ',
						'property' => 'color',
					),
				),
			),

		);

		// Page Header.
		$settings['shop_header'] = array(
			'shop_header' => array(
				'type'        => 'toggle',
				'default'     => true,
				'label'       => esc_html__('Enable Page Header', 'foodforlife'),
				'description' => esc_html__('Enable to show a shop header for the shop below the site header', 'foodforlife'),
			),
			'shop_header_hr' => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'shop_header_els' => array(
				'type'     => 'multicheck',
				'label'    => esc_html__('Elements', 'foodforlife'),
				'default'  => array( 'title', 'breadcrumb', 'description' ),
				'choices'  => array(
					'title'      => esc_html__('Title', 'foodforlife'),
					'breadcrumb' => esc_html__('BreadCrumb', 'foodforlife'),
					'description' => esc_html__('Description', 'foodforlife'),
				),
				'description'     => esc_html__('Select which elements you want to show.', 'foodforlife'),
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'shop_header_number_lines'                      => array(
				'type'            => 'number',
				'label'           => esc_html__('Description Number Lines', 'foodforlife'),
				'default'         => 5,
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'shop_header_els',
						'operator' => 'in',
						'value'    => 'description',
					),
				),
			),
			'shop_header_hr_1' => array(
				'type'            => 'custom',
				'default'         => '<hr/><h3>' . esc_html__('Custom', 'foodforlife') . '</h3>',
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			'shop_header_background_image'          => array(
				'type'            => 'image',
				'label'           => esc_html__( 'Background Image', 'foodforlife' ),
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'shop_header_background_overlay' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Background Overlay', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'choices'     => [
					'alpha' => true,
				],
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--shop::before',
						'property' => 'background-color',
					),
				),
			),
			'shop_header_title_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Title Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'shop_header_els',
						'operator' => 'in',
						'value'    => 'title',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--shop .page-header__title',
						'property' => 'color',
					),
				),
			),
			'shop_header_breadcrumb_link_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Breadcrumb Link Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'shop_header_els',
						'operator' => 'in',
						'value'    => 'breadcrumb',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header--shop .site-breadcrumb',
						'property' => '--ffl-site-breadcrumb-link-color',
					),
				),
			),
			'shop_header_breadcrumb_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Breadcrumb Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'shop_header_els',
						'operator' => 'in',
						'value'    => 'breadcrumb',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header--shop .site-breadcrumb',
						'property' => '--ffl-site-breadcrumb-color',
					),
				),
			),
			'shop_header_description_color' => array(
				'type'            => 'color',
				'label'           => esc_html__( 'Description Color', 'foodforlife' ),
				'transport'       => 'postMessage',
				'default'         => '',
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'shop_header_els',
						'operator' => 'in',
						'value'    => 'description',
					),
				),
				'js_vars'         => array(
					array(
						'element'  => '.page-header.page-header--shop .page-header__description',
						'property' => 'color',
					),
				),
			),
			'shop_header_padding_top' => array(
				'type'      => 'slider',
				'label'     => esc_html__('Padding Top', 'foodforlife'),
				'transport' => 'postMessage',
				'default'    => [
					'desktop' => 80,
                    'tablet'  => 80,
                    'mobile'  => 60,
				],
				'responsive' => true,
				'choices'   => array(
					'min' => 0,
					'max' => 500,
				),
				'output'         => array(
					array(
						'element'  => '.page-header.page-header--shop',
						'property' => 'padding-top',
						'units'    => 'px',
						'media_query' => [
							'desktop' => '@media (min-width: 1200px)',
							'tablet'  => is_customize_preview() ? '@media (min-width: 699px) and (max-width: 1199px)' : '@media (min-width: 768px) and (max-width: 1199px)',
							'mobile'  => '@media (max-width: 767px)',
						],
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
			'shop_header_padding_bottom' => array(
				'type'      => 'slider',
				'label'     => esc_html__('Padding Bottom', 'foodforlife'),
				'transport' => 'postMessage',
				'default'    => [
					'desktop' => 10,
                    'tablet'  => 10,
                    'mobile'  => 10,
				],
				'responsive' => true,
				'choices'   => array(
					'min' => 0,
					'max' => 500,
				),
				'output'         => array(
					array(
						'element'  => '.page-header.page-header--shop',
						'property' => 'padding-bottom',
						'units'    => 'px',
						'media_query' => [
							'desktop' => '@media (min-width: 1200px)',
							'tablet'  => is_customize_preview() ? '@media (min-width: 699px) and (max-width: 1199px)' : '@media (min-width: 768px) and (max-width: 1199px)',
							'mobile'  => '@media (max-width: 767px)',
						],
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'shop_header',
						'operator' => '==',
						'value'    => '1',
					),
				),
			),
		);

		// Top Categories.
		$settings['shop_top_categories'] = array(
			'top_categories'                    => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Top Categories', 'foodforlife' ),
				'default' => false,
			),
			'show_brand_page'                    => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Show on Brand Page', 'foodforlife' ),
				'default' => true,
			),
			'top_categories_limit' => array(
				'type'            => 'number',
				'label'     	  => esc_html__( 'Limit', 'foodforlife' ),
				'description'     => esc_html__( 'Enter 0 to get all categories. Enter a number to get limit number of top categories.', 'foodforlife' ),
				'default'         => 0,
				'active_callback' => array(
					array(
						'setting'  => 'top_categories',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'top_categories_order' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Order By', 'foodforlife' ),
				'default'         => 'order',
				'choices'         => array(
					'order' => esc_html__( 'Category Order', 'foodforlife' ),
					'name'  => esc_html__( 'Category Name', 'foodforlife' ),
					'id'    => esc_html__( 'Category ID', 'foodforlife' ),
					'count' => esc_html__( 'Product Counts', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'top_categories',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'top_categories_columns' => array(
				'type'      => 'number',
				'label'     => esc_html__('Columns', 'foodforlife'),
				'default'    => [
					'desktop' => 6,
					'tablet'  => 3,
					'mobile'  => 2,
				],
				'responsive' => true,
				'choices'   => array(
					'min' => 1,
					'max' => 10,
				),
				'active_callback' => array(
					array(
						'setting'  => 'top_categories',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'top_categories_title_html_tag' => array(
				'type'      => 'select',
				'label'     => esc_html__('Title HTML Tag', 'foodforlife'),
				'default'    => 'div',
				'choices'   => array(
					'div' => esc_html__( 'Div', 'foodforlife' ),
					'h2'  => esc_html__( 'H2', 'foodforlife' ),
					'h3'  => esc_html__( 'H3', 'foodforlife' ),
					'h4'  => esc_html__( 'H4', 'foodforlife' ),
					'h5'  => esc_html__( 'H5', 'foodforlife' ),
					'h6'  => esc_html__( 'H6', 'foodforlife' ),
					'span'  => esc_html__( 'Span', 'foodforlife' ),
					'p'  => esc_html__( 'P', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'top_categories',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		// Catalog toolbar.
		$settings['taxonomy_description'] = array(
			'taxonomy_description_enable'                    => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Taxonomy Description Below the Products', 'foodforlife' ),
				'description' => esc_html__('Enable this option to show the taxonomy description below the products', 'foodforlife'),
				'default' => false,
			),
			'taxonomy_description_html'               => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Taxonomy Description HTML', 'foodforlife' ),
				'description' => esc_html__('Enable this option to allow HTML in the Taxonomy Description', 'foodforlife'),
				'default' => false,
				'active_callback' => array(
					array(
						'setting'  => 'taxonomy_description_enable',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'taxonomy_description_number_lines'                      => array(
				'type'            => 'number',
				'label'           => esc_html__('Description Number Lines', 'foodforlife'),
				'default'         => 5,
				'active_callback' => array(
					array(
						'setting'  => 'taxonomy_description_enable',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'taxonomy_description_alignment'      => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Description Alignment', 'foodforlife' ),
				'default' => 'left',
				'section' => 'taxonomy_description',
				'choices' => array(
					'left' => esc_html__( 'Left', 'foodforlife' ),
					'center' => esc_html__( 'Center', 'foodforlife' ),
					'right' => esc_html__( 'Right', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'taxonomy_description_enable',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		// Catalog toolbar.
		$settings['shop_catalog_toolbar'] = array(
			'catalog_toolbar'                    => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Catalog Toolbar', 'foodforlife' ),
				'default' => true,
			),
			'catalog_toolbar_list_hr'  => array(
				'type'            => 'custom',
				'default'         => '<hr/>',
			),
			'catalog_toolbar_els'         => array(
				'type'            => 'multicheck',
				'label'           => esc_html__( 'Elements', 'foodforlife' ),
				'default'         => array( 'total', 'sortby', 'view' ),
				'choices'         => array(
					'total'    => esc_html__( 'Total Products', 'foodforlife' ),
					'sortby'    => esc_html__( 'Sort By', 'foodforlife' ),
					'view'  	=> esc_html__( 'View', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'catalog_toolbar',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'catalog_toolbar_views' => array(
				'type'               => 'multicheck',
				'label'              => esc_html__( 'View', 'foodforlife' ),
				'default'            => array( '1', '2', '3', '4' ),
				'choices'            => array(
					'2'       => esc_html__( 'Grid 2 Columns', 'foodforlife' ),
					'3'       => esc_html__( 'Grid 3 Columns', 'foodforlife' ),
					'4'       => esc_html__( 'Grid 4 Columns', 'foodforlife' ),
					'1'       => esc_html__( 'List', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'catalog_toolbar',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'catalog_toolbar_els',
						'operator' => 'in',
						'value'    => 'view',
					),
				),
			),
			'catalog_toolbar_default_view' => array(
				'type'               => 'select',
				'label'              => esc_html__( 'Default View', 'foodforlife' ),
				'default'            => 'grid',
				'choices'            => array(
					'list'       => esc_html__( 'List', 'foodforlife' ),
					'grid'       => esc_html__( 'Grid', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'catalog_toolbar',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'catalog_toolbar_els',
						'operator' => 'in',
						'value'    => 'view',
					),
				),
			),
		);

		// Single Product
		$settings['product'] = array(
			'product_taxonomy'               => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Product Taxonomy', 'foodforlife' ),
				'default'         => 'product_cat',
				'choices'         => array(
					'product_cat'   => esc_html__( 'Category', 'foodforlife' ),
					''              => esc_html__( 'None', 'foodforlife' ),
					'product_brand' => esc_html__( 'Brand', 'foodforlife' ),
				),
				'description' => esc_html__( 'Show a product taxonomy above the product title on the product page.', 'foodforlife' ),
			),
			'product_description_hr'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_description'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Product Description', 'foodforlife' ),
				'default'     => false,
			),
			'product_description_lines'       => array(
				'type'            => 'number',
				'label'           => esc_html__( 'Product Description Lines', 'foodforlife' ),
				'default'         => 4,
				'active_callback' => array(
					array(
						'setting'  => 'product_description',
						'operator' => '==',
						'value'    => true,
					),
				),
			),

			'product_countdown_hr'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_countdown_layout'               => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Product Countdown Layout', 'foodforlife' ),
				'default'         => 'v1',
				'choices'         => array(
					'v1' => esc_html__( 'Layout v1', 'foodforlife' ),
					'v2' => esc_html__( 'Layout v2', 'foodforlife' ),
				),
			),
			'product_share_hr'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_share'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Product Share', 'foodforlife' ),
				'default'     => false,
			),
			// REMOVED: Ask a Question — feature disabled.
			// 'product_ask_question' => array(
			// 	'type'        => 'toggle',
			// 	'label'       => esc_html__( 'Ask a Question', 'foodforlife' ),
			// 	'default'     => false,
			// ),
			// 'product_ask_question_form' => array(
			// 	'type'        => 'textarea',
			// 	'label'       => esc_html__('Contact Form', 'foodforlife'),
			// 	'description' => esc_html__('Please enter the contact form shortcode', 'foodforlife'),
			// 	'default'     => '',
			// 	'input_attrs' => array(
			// 		'placeholder' => '[contact-form-7 id="11" title="Contact form 1"]',
			// 	),
			// 	'active_callback' => array(
			// 		array(
			// 			'setting'  => 'product_ask_question',
			// 			'operator' => '==',
			// 			'value'    => true,
			// 		),
			// 	),
			// ),
			'product_hr'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_meta_heading' => array(
				'type'    => 'custom',
				'label'   => '<h3>' . esc_html__( 'Product Meta', 'foodforlife' ) . '</h3>',
			),
			'product_sku' => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Product SKU', 'foodforlife' ),
				'default' => true,
			),
			'product_stock' => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Product Stock', 'foodforlife' ),
				'default' => true,
			),
			'product_categtories' => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Product Categories', 'foodforlife' ),
				'default' => true,
			),
			'product_brands' => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Product Brands', 'foodforlife' ),
				'default' => false,
			),
			'product_tags' => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Product Tags', 'foodforlife' ),
				'default' => true,
			),
			'product_countdown_hr'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_countdown_layout'               => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Product Countdown Layout', 'foodforlife' ),
				'default'         => 'v1',
				'choices'         => array(
					'v1' => esc_html__( 'Layout v1', 'foodforlife' ),
					'v2' => esc_html__( 'Layout v2', 'foodforlife' ),
				),
			),
			'product_clickable_outofstock_variations_hr' => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_clickable_outofstock_variations' => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Clickable Out of Stock Variations', 'foodforlife' ),
				'default'     => false,
			),
			'product_featured_button_hr'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_wishlist_button'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Wishlist Button', 'foodforlife' ),
				'default'     => true,
			),
			// REMOVED: Compare Button — feature disabled.
			// 'product_compare_button' => array(
			// 	'type'        => 'toggle',
			// 	'label'       => esc_html__( 'Compare Button', 'foodforlife' ),
			// 	'default'     => true,
			// ),
		);

		// Vendor
		if ( class_exists( 'WeDevs_Dokan' ) ) {
			$settings['product'] = array_merge(
				$settings['product'],
				array(
					'single_product_vendor_name_custom' => array(
						'type'        => 'custom',
						'default'  => '<hr/>',
						'priority' => 95,
					),
					'single_product_vendor_name'     => array(
						'type'            => 'select',
						'label'           => esc_html__( 'Vendor Name', 'foodforlife' ),
						'default'         => 'avatar',
						'choices'         => array(
							'none' => esc_html__( 'None', 'foodforlife' ),
							'avatar' => esc_html__( 'Avatar - Vendor Name', 'foodforlife' ),
							'text' => esc_html__( 'By - Vendor Name', 'foodforlife' ),
						),
					),
				)
			);
		};

		$settings['product_gallery'] = array(
			'product_gallery_layout' => array(
				'type'               => 'select',
				'label'              => esc_html__( 'Layout', 'foodforlife' ),
				'default'            => '',
				'choices'            => array(
					''                  => esc_html__( 'Left thumbnails', 'foodforlife' ),
					'bottom-thumbnails' => esc_html__( 'Bottom thumbnails', 'foodforlife' ),
					'grid-1'            => esc_html__( 'Grid 1', 'foodforlife' ),
					'grid-2'            => esc_html__( 'Grid 2', 'foodforlife' ),
					'stacked'           => esc_html__( 'Stacked', 'foodforlife' ),
					'hidden-thumbnails' => esc_html__( 'Hidden thumbnails', 'foodforlife' ),
				),
			),
			'product_image_zoom' => array(
				'type'               => 'select',
				'label'              => esc_html__( 'Zoom', 'foodforlife' ),
				'default'            => 'bounding',
				'choices'            => array(
					'none'  	=> esc_html__( 'None', 'foodforlife' ),
					'bounding'  => esc_html__( 'External zoom', 'foodforlife' ),
					'inner'     => esc_html__( 'Inner zoom square', 'foodforlife' ),
					'magnifier' => esc_html__( 'Inner zoom circle', 'foodforlife' ),
				),
				'description' => esc_html__( 'Zooms in where your cursor is on the image', 'foodforlife' ),
			),
			'product_image_lightbox_hr'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_image_lightbox'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Lightbox', 'foodforlife' ),
				'description' => esc_html__( 'Opens your images against a dark backdrop', 'foodforlife' ),
				'default'     => true,
			),
		);

		// Single Badges
		$settings['product_badges'] = array(
			'product_badges_sale'          => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Sale Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for sale products.', 'foodforlife' ),
				'default'     => true,
			),
			'product_badges_sale_type'     => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Type', 'foodforlife' ),
				'default'         => 'percent',
				'choices'         => array(
					'percent'        => esc_html__( 'Percentage', 'foodforlife' ),
					'text'           => esc_html__( 'Text', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_badges_sale',
						'operator' => '=',
						'value'    => true,
					),
				),
			),
			'product_badges_hr_2'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_badges_new'           => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'New Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for new product.', 'foodforlife' ),
				'default'     => false,
			),
			'product_badges_hr_3'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_badges_featured'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Featured Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for featured product.', 'foodforlife' ),
				'default'     => false,
			),
			'product_badges_hr_4'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_badges_stock'           => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Stock Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for stock product.', 'foodforlife' ),
				'default'     => true,
			),
			'product_badges_hr_5'          => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'product_badges_preorder'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Preorder Badge', 'foodforlife' ),
				'description' => esc_html__( 'Display a badge for preorder product.', 'foodforlife' ),
				'default'     => true,
			),
		);

		// Guarantee Safe Checkout
		$settings['product_guarantee_safe_checkout'] = array(
			'product_guarantee_safe_checkout'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Guarantee Safe Checkout', 'foodforlife' ),
				'description'		=> esc_html__( 'Enable this option to show this section below the product meta', 'foodforlife' ),
				'default'     => false,
			),
			'product_guarantee_safe_checkout_html' => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Insert HTML', 'foodforlife' ),
				'default'     => '',
				'active_callback' => array(
					array(
						'setting'  => 'product_guarantee_safe_checkout',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		// Shipping & Promotions Information
		$settings['product_shipping_promotions'] = array(
			'product_shipping_promotions'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Shipping & Promotions Information', 'foodforlife' ),
				'description'		=> esc_html__( 'Enable this option to show this section(like delivery times, discount codes...) below the product description', 'foodforlife' ),
				'default'     => false,
			),
			'product_shipping_promotions_position' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Position', 'foodforlife' ),
				'default'     => 'description',
				'choices'     => array(
					'description' => esc_html__( 'Below the description', 'foodforlife' ),
					'add_to_cart' => esc_html__( 'Below the add to cart', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_shipping_promotions',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_shipping_promotions_type' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Type', 'foodforlife' ),
				'default'     => 'list',
				'choices'     => array(
					'list' => esc_html__( 'List', 'foodforlife' ),
					'grid' => esc_html__( 'Grid', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_shipping_promotions',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_shipping_promotions_hr' => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'active_callback' => array(
					array(
						'setting'  => 'product_shipping_promotions',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_shipping_promotions_list' => array(
				'type'        => 'repeater',
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
				),
				'default'  => [],
				'fields'      => array(
					'image' => array(
						'type'        => 'image',
						'label'       => esc_html__( 'Image', 'foodforlife' ),
					),
					'description' => array(
						'type'        => 'textarea',
						'label'       => esc_html__( 'Description', 'foodforlife' ),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_shipping_promotions',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		// Product Highlights
		$settings['product_highlights'] = array(
			'product_highlights'      => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Product Highlights', 'foodforlife' ),
				'description'		=> esc_html__( 'Enable this option to show this section(like free returns and delivery options) below the product gallery', 'foodforlife' ),
				'default'     => false,
			),
			'product_highlights_image' => array(
				'type'        => 'image',
				'label'       => esc_html__( 'Image', 'foodforlife' ),
				'active_callback' => array(
					array(
						'setting'  => 'product_highlights',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_highlights_image_dimension' => array(
				'type'            => 'dimensions',
				'label'           => esc_html__( 'Image Dimension', 'foodforlife' ),
				'default'         => array(
					'width'  => '12',
					'height' => '12',
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_highlights',
						'operator' => '==',
						'value'    => true,
					),
					array(
						'setting'  => 'product_highlights_image',
						'operator' => '!=',
						'value'    => '',
					),
				),
			),
			'product_highlights_list' => array(
				'type'        => 'repeater',
				'label'    => esc_html__( 'Items', 'foodforlife' ),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
				),
				'fields'      => array(
					'text' => array(
						'type'        => 'textarea',
						'label'       => esc_html__( 'Text', 'foodforlife' ),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_highlights',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_highlights_speed' => array(
				'type'            => 'number',
				'label'     	  => esc_html__( 'Speed', 'foodforlife' ),
				'description'     => esc_html__( 'Customize marquee speed (Example: 0.25)', 'foodforlife' ),
				'default'         => 0.25,
				'choices'  => [
					'min'  => 0,
					'max'  => 1,
					'step' => 0.1,
				],
				'active_callback' => array(
					array(
						'setting'  => 'product_highlights',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		// Product tabs
		$settings['product_tabs'] = array(
			'product_tabs_layout' => array(
				'type'               => 'select',
				'label'              => esc_html__( 'Layout', 'foodforlife' ),
				'default'            => '',
				'choices'            => array(
					''          => esc_html__( 'Tabs', 'foodforlife' ),
					'accordion' => esc_html__( 'Accordion', 'foodforlife' ),
				),
			),
			'product_tabs_status' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Product Tabs Status', 'foodforlife' ),
				'default' => 'close',
				'choices' => array(
					'close' => esc_html__( 'Close all tabs', 'foodforlife' ),
					'first' => esc_html__( 'Open first tab', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_tabs_layout',
						'operator' => '==',
						'value'    => 'accordion',
					),
				),
			),
			'product_tabs_position' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Product Tabs Position', 'foodforlife' ),
				'default' => '',
				'choices' => array(
					''              => esc_html__( 'Default', 'foodforlife' ),
					'under-summary' => esc_html__( 'Under Summary', 'foodforlife' ),
				),
				'active_callback' => array(
					array(
						'setting'  => 'product_tabs_layout',
						'operator' => '==',
						'value'    => 'accordion',
					),
				),
			),
			'product_tabs_single_open' => array(
				'type'    => 'toggle',
				'label'   => esc_html__( 'Single Open', 'foodforlife' ),
				'default' => false,
				'active_callback' => array(
					array(
						'setting'  => 'product_tabs_layout',
						'operator' => '==',
						'value'    => 'accordion',
					),
				),
			),
		);

		$settings['upsells_products'] = array(
			'upsells_products'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Upsells Products', 'foodforlife' ),
				'default'     => true,
			),
			'upsells_products_numbers' => array(
				'type'            => 'number',
				'label'     	  => esc_html__( 'Numbers', 'foodforlife' ),
				'default'         => 10,
				'active_callback' => array(
					array(
						'setting'  => 'upsells_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'upsells_products_columns' => array(
				'type'        	=> 'number',
				'label' 		=> esc_html__('Columns', 'foodforlife'),
				'default'     	=> [
					'desktop' => 4,
					'tablet'  => 3,
					'mobile'  => 2,
				],
				'responsive'  => true,
				'choices'     => array(
					'min' => 1,
					'max' => 6,
				),
				'active_callback' => array(
					array(
						'setting'  => 'upsells_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'upsells_products_description'           => array(
				'type'        => 'textarea',
				'label'       => esc_html__('Description', 'foodforlife'),
				'description' => esc_html__('Please enter the description', 'foodforlife'),
				'default'     => '',
				'active_callback' => array(
					array(
						'setting'  => 'upsells_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		$settings['related_products']= array(
			'related_products'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Related Products', 'foodforlife' ),
				'default'     => true,
			),
			'related_products_by_cats'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'By Categories', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'related_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'related_products_by_tags'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'By Tags', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'related_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'related_products_show_out_of_stock'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Show Out Of Stock', 'foodforlife' ),
				'default'     => true,
				'active_callback' => array(
					array(
						'setting'  => 'related_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'related_products_numbers' => array(
				'type'        	 => 'number',
				'label' 	 => esc_html__( 'Numbers', 'foodforlife' ),
				'default'     	 => 10,
				'choices'     	 => array(
					'min' => 1,
				),
				'active_callback' => array(
					array(
						'setting'  => 'related_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'related_products_columns' => array(
				'type'        	=> 'number',
				'label' 		=> esc_html__('Columns', 'foodforlife'),
				'default'     	=> [
					'desktop' => 4,
					'tablet'  => 3,
					'mobile'  => 2,
				],
				'responsive'  => true,
				'choices'     => array(
					'min' => 1,
					'max' => 6,
				),
				'active_callback' => array(
					array(
						'setting'  => 'related_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'related_products_description'           => array(
				'type'        => 'textarea',
				'label'       => esc_html__('Description', 'foodforlife'),
				'description' => esc_html__('Please enter the description', 'foodforlife'),
				'default'     => '',
				'active_callback' => array(
					array(
						'setting'  => 'related_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		if ( get_option( 'foodforlife_recently_viewed_enable', 'yes' ) === 'yes' ) {
			$settings['recently_viewed_products']= array(
				'recently_viewed_products'         => array(
					'type'        => 'toggle',
					'label'       => esc_html__( 'Recently Viewed Products', 'foodforlife' ),
					'default'     => true,
				),
				'recently_viewed_products_ajax' => array(
					'type'    => 'toggle',
					'label'   => esc_html__('Load With Ajax', 'foodforlife'),
					'default' => false,
					'active_callback' => array(
						array(
							'setting'  => 'recently_viewed_products',
							'operator' => '==',
							'value'    => true,
						),
					),
				),
				'recently_viewed_products_numbers' => array(
					'type'           => 'number',
					'description'    => esc_html__( 'Numbers', 'foodforlife' ),
					'default'        => 10,
					'choices'     	 => array(
						'min' => 1,
					),
					'active_callback' => array(
						array(
							'setting'  => 'recently_viewed_products',
							'operator' => '==',
							'value'    => true,
						),
					),
				),
				'recently_viewed_products_columns' => array(
					'type'        	=> 'number',
					'label' 		=> esc_html__('Columns', 'foodforlife'),
					'default'     	=> [
						'desktop' => 4,
						'tablet'  => 3,
						'mobile'  => 2,
					],
					'responsive'  => true,
					'choices'     => array(
						'min' => 1,
						'max' => 6,
					),
					'active_callback' => array(
						array(
							'setting'  => 'recently_viewed_products',
							'operator' => '==',
							'value'    => true,
						),
					),
				),
				'recently_viewed_products_description'           => array(
					'type'        => 'textarea',
					'label'       => esc_html__('Description', 'foodforlife'),
					'description' => esc_html__('Please enter the description', 'foodforlife'),
					'default'     => '',
					'active_callback' => array(
						array(
							'setting'  => 'recently_viewed_products',
							'operator' => '==',
							'value'    => true,
						),
					),
				),
			);
		}

		$settings['wcboost_variation_swatches'] = array(
			'wcboost_variation_swatches_label_hr' => array(
				'type' => 'custom',
				'default' => '<hr>',
				'priority' => 50,
			),
			'wcboost_variation_swatches_label_shape' => array(
				'type' => 'select',
				'label' => esc_html__( 'Label Swatches Shape', 'foodforlife' ),
				'default' => '',
				'choices' => array(
					'' => esc_html__( 'Default', 'foodforlife' ),
					'round'   => esc_html__( 'Circle', 'foodforlife' ),
					'rounded' => esc_html__( 'Rounded corners', 'foodforlife' ),
					'square'  => esc_html__( 'Square', 'foodforlife' ),
				),
				'priority' => 55,
			),
		);

		$settings['woocommerce_cart'] = array(
			'update_cart_page_auto'       => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Update Cart Automatically', 'foodforlife' ),
				'description' => esc_html__( 'Check this option to update cart page automatically', 'foodforlife' ),
				'default'     => 0,
			),
			'product_hr_1'                => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'cross_sells_products'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Cross-Sells Products', 'foodforlife' ),
				'default'     => true,
			),
			'cross_sells_empty_type' => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Cross-Sells Empty Products', 'foodforlife' ),
				'description'     => esc_html__( 'If cross-sells are empty, the display style for the product will be selected.', 'foodforlife' ),
				'default'         => 'recent_products',
				'choices'         => array(
					'recent_products' 			=> esc_html__( 'Recent Products', 'foodforlife' ),
					'top_rated_products' 		=> esc_html__( 'Top Rated Products', 'foodforlife' ),
					'sale_products'      		=> esc_html__( 'Sale Products', 'foodforlife' ),
					'featured_products'      	=> esc_html__( 'Featured Products', 'foodforlife' ),
				),
			),
			'cross_sells_products_numbers' => array(
				'type'            => 'number',
				'label'     	  => esc_html__( 'Numbers', 'foodforlife' ),
				'default'         => 4,
				'active_callback' => array(
					array(
						'setting'  => 'cross_sells_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'cross_sells_products_columns' => array(
				'type'        	=> 'number',
				'label' 		=> esc_html__('Columns', 'foodforlife'),
				'default'     	=> [
					'desktop' => 2,
					'tablet'  => 2,
					'mobile'  => 1,
				],
				'responsive'  => true,
				'choices'     => array(
					'min' => 1,
					'max' => 6,
				),
				'active_callback' => array(
					array(
						'setting'  => 'cross_sells_products',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
			'product_hr_2'                => array(
				'type'    => 'custom',
				'default' => '<hr>',
			),
			'cart_service_highlight'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Service Highlight', 'foodforlife' ),
				'description' => esc_html__( 'Check this option to display the service highlight below the cart content in the cart page', 'foodforlife' ),
				'default'     => false,
				'priority' => 30,
			),
			'cart_service_highlight_content'       => array(
				'type'            => 'repeater',
				'label'           => esc_html__( 'Service Highlight Content', 'foodforlife' ),
				'row_label'       => array(
					'type'  => 'field',
					'value' => esc_html__( 'Item', 'foodforlife' ),
					'field' => 'text',
				),
				'fields'          => array(
					'icon' => array(
						'type'    => 'textarea',
						'label'   => esc_html__( 'Icon', 'foodforlife' ),
						'sanitize_callback' => '\FoodForLife\Icon::sanitize_svg',
					),
					'title'          => array(
						'type'    => 'text',
						'label'   => esc_html__( 'Title', 'foodforlife' ),
					),
					'description'          => array(
						'type'    => 'textarea',
						'label'   => esc_html__( 'Description', 'foodforlife' ),
					),
				),
				'active_callback' => array(
					array(
						'setting'  => 'cart_service_highlight',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 35,
			),
			'product_hr_3'                => array(
				'type'    => 'custom',
				'default' => '<hr>',
				'priority' => 40,
			),
			'cart_information_box'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Order Information Box', 'foodforlife' ),
				'description' => esc_html__( 'Check this option to display the order information box below the cart totals in the cart page', 'foodforlife' ),
				'default'     => false,
				'priority' => 45,
			),
			'cart_information_box_content' => array(
				'type' => 'textarea',
				'label' => esc_html__('Order Information Box Content', 'foodforlife'),
				'default' => '',
				'active_callback' => array(
					array(
						'setting'  => 'cart_information_box',
						'operator' => '==',
						'value'    => true,
					),
				),
				'priority' => 50,
			),
		);

		$settings['woocommerce_checkout'] = array(
			'checkout_information_box'         => array(
				'type'        => 'toggle',
				'label'       => esc_html__( 'Order Information Box', 'foodforlife' ),
				'description' => esc_html__( 'Check this option to display the order information box below the cart totals in the checkout page', 'foodforlife' ),
				'default'     => false,
			),
			'checkout_information_box_content' => array(
				'type' => 'textarea',
				'label' => esc_html__('Order Information Box Content', 'foodforlife'),
				'default' => '',
				'active_callback' => array(
					array(
						'setting'  => 'checkout_information_box',
						'operator' => '==',
						'value'    => true,
					),
				),
			),
		);

		return $settings;
	}

	/**
	* Get product attributes
	*
	* @return string
	*/
	public function get_product_attributes() {
		$output = array();
		if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
			$attributes_tax = wc_get_attribute_taxonomies();
			if ( $attributes_tax ) {
				$output[''] = esc_html__( 'None', 'foodforlife' );

				foreach ( $attributes_tax as $attribute ) {
					$output[$attribute->attribute_name] = $attribute->attribute_label;
				}

			}
		}

		return $output;
	}
}
