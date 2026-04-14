<?php
namespace FoodForLife\Addons\Elementor\AJAX;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Products {
	use \FoodForLife\Addons\WooCommerce\Products_Base;

	/**
	 * The single instance of the class
	 */
	protected static $instance = null;

	/**
	 * Initialize
	 */
	static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		add_action( 'wp_ajax_nopriv_foodforlife_get_products_tab', [ $this, 'ajax_get_products_tab' ] );
		add_action( 'wp_ajax_foodforlife_get_products_tab', [ $this, 'ajax_get_products_tab' ] );
		add_action( 'wc_ajax_foodforlife_get_products_tab', [ $this, 'ajax_get_products_tab' ] );

		// Add to cart
		add_action( 'wc_ajax_foodforlife_ajax_add_to_cart', [ $this, 'ajax_add_to_cart' ] );

		// Products without Load more button
		add_action( 'wc_ajax_foodforlife_elementor_load_products', [ $this, 'elementor_load_products' ] );

		if ( get_option( 'foodforlife_recently_viewed_enable', 'yes' ) === 'yes' ) {
			add_action('wc_ajax_load_recently_viewed_products_elementor', [ $this, 'load_recently_viewed_products' ]);
		}

		// Shoppable video carousel
		add_action( 'wc_ajax_foodforlife_load_shoppable_video_elementor', [ $this, 'load_shoppable_video_elementor' ] );
	}

	/**
	 * Ajax load products tab
	 */
	public function ajax_get_products_tab() {
		if ( empty( $_POST['atts'] ) ) {
			wp_send_json_error( esc_html__( 'No matching products found.', 'foodforlife-addons' ) );
			exit;
		}

		// S-ADDON: Sanitize atts before passing to render.
		$raw_atts = wp_unslash( $_POST['atts'] );
		$safe_atts = is_array( $raw_atts )
			? array_map( 'sanitize_text_field', $raw_atts )
			: sanitize_text_field( $raw_atts );

		$output = self::render_products( $safe_atts );
		$output = ! empty( $output ) ? $output : [ 'error' => '<p class="text-center">'. esc_html__( 'No matching products found.', 'foodforlife-addons' ) . '</p>' ];

		wp_send_json_success( $output );
	}

	/**
	 * Ajax add to cart
	 */
	public function ajax_add_to_cart() {
		// S-ADDON: Verify via WooCommerce nonce (already present in frontend via wc_add_to_cart_params).
		if ( function_exists( 'wc_get_var' ) && isset( $_POST['security'] ) ) {
			if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['security'] ) ), 'foodforlife-add-to-cart-nonce' ) ) {
				wp_send_json( false );
				die();
			}
		}

		$action = isset( $_POST['action'] ) ? sanitize_text_field( wp_unslash( $_POST['action'] ) ) : '';
		if ( empty( $action ) ) {
			return;
		}

		if( $action !== 'foodforlife_ajax_add_to_cart' ) {
			return;
		}

		wc_nocache_headers();

		$products = isset( $_POST['data_products'] ) ? (array) json_decode( stripslashes( $_POST['data_products'] ), true ) : array(); // S-ADDON: isset check.
		$quantity = 1;
		$success = false;

		foreach ( $products as $product ) {
            if( $product['type'] == 'variable' ) {
				$variation_id  = $product['variation_id'];
				$variation  = $product['variation_attributes'];
				$adding_to_cart = wc_get_product( $variation_id );

				if ( $adding_to_cart ) {
					$product_id = $adding_to_cart->get_parent_id();
					if( false !== WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation ) ) {
						wc_add_to_cart_message( array( $product_id => $quantity ), true );
						$success = true;
					}
				}
			} else {
				if( false !== WC()->cart->add_to_cart( $product['product_id'], $quantity ) ) {
					wc_add_to_cart_message( array( $product['product_id'] => $quantity ), true );
                    $success = true;
				}
			}

			if( ! $success ) {
				break;
			}
		}

		wp_send_json( $success );
		die();
	}

	/**
	 * Load products
	 *
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function elementor_load_products() {
		// S-ADDON: Sanitize all settings from POST.
		$raw_settings = isset( $_POST['settings'] ) ? wp_unslash( $_POST['settings'] ) : array();
		if ( ! is_array( $raw_settings ) ) {
			wp_send_json_error();
			return;
		}
		$settings = array_map( 'sanitize_text_field', $raw_settings );

		$atts = array(
			'type'     => isset( $settings['type'] ) ? $settings['type'] : '',
			'columns'  => isset( $settings['columns'] ) ? absint( $settings['columns'] ) : '',
			'products' => isset( $settings['products'] ) ? $settings['products'] : '',
			'order'    => isset( $settings['order'] ) ? $settings['order'] : '',
			'orderby'  => isset( $settings['orderby'] ) ? $settings['orderby'] : '',
			'per_page' => isset( $settings['per_page'] ) ? absint( $settings['per_page'] ) : '',
			'limit'    => isset( $settings['limit'] ) ? absint( $settings['limit'] ) : '',
			'category' => isset( $settings['category'] ) ? $settings['category'] : '',
			'tag'      => isset( $settings['tag'] ) ? $settings['tag'] : '',
			'brand'    => isset( $settings['brand'] ) ? $settings['brand'] : '',
			'page'     => isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1,
			'paginate' => true,
		);

		$settings['per_page'] = empty($settings['per_page']) ? ( isset( $settings['limit'] ) ? absint( $settings['limit'] ) : '' ) : absint( $settings['per_page'] );
		$settings['page']     = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;
		$settings['paginate'] = true;

		$results = self::products_shortcode( $settings );

		if ( ! $results ) {
			return;
		}

		$product_ids  = $results['ids'];
		$current_page = $settings['page'] + 1;
		$data_text    = 'data-text = ""';

		if ( $results['current_page'] >= $results['total_pages'] ) {
			$current_page = 0;
			$data_text    = esc_html__( 'No products were found', 'foodforlife-addons' );
		}

		$products = '<div class="products-loadmore">';

		ob_start();

		wc_setup_loop(
			array(
				'columns' => $settings['columns']
			)
		);

		self::get_template_loop( $product_ids );

		$products .= ob_get_clean();
		$products .= '<span class="page-number" data-page="' . esc_attr( $current_page ) . '" data-text="' . $data_text . '"></span>';
		$products .= '</div>';

		wp_send_json_success( $products );
	}

	public function load_recently_viewed_products() {
		$limit = isset($_POST['limit']) ? absint($_POST['limit']) : 5;
		$columns = isset($_POST['columns']) ? absint($_POST['columns']) : 4;
		$pagination = isset($_POST['pagination']) ? sanitize_text_field( wp_unslash( $_POST['pagination'] ) ) : ''; // S-ADDON: Sanitize.
		$page = isset($_POST['page']) ? absint($_POST['page']) : 1;

		$settings = array(
			'limit' => $limit,
			'columns' => $columns,
			'pagination' => $pagination,
			'page' => $page,
		);

		ob_start();
		self::get_recently_viewed_products( $settings );

		wp_send_json( ob_get_clean() );
		die();
	}

	// Shoppable video carousel
	public function load_shoppable_video_elementor() {
		$action = isset( $_POST['action'] ) ? sanitize_text_field( wp_unslash( $_POST['action'] ) ) : ''; // S-ADDON: Sanitize.
		if( empty( $action ) || $action !== 'foodforlife_load_shoppable_video_elementor' ) {
			return;
		}

		if ( empty( $_POST['product_id'] ) ) {
			wp_send_json_error( esc_html__( 'No product.', 'foodforlife-addons' ) );
			exit;
		}

		$product_id = absint( $_POST['product_id'] ); // S-ADDON: Sanitize.
		add_filter( 'foodforlife_buy_now_button', '__return_false' );
		$post_object = get_post( $product_id );
		$GLOBALS['post'] = $post_object;
		wc_setup_product_data( $post_object );
		ob_start();
		wc_get_template( 'content-product-shoppable-video.php', array(
			'post_object'      => $post_object,
		) );
		wp_reset_postdata();
		wc_setup_product_data( $GLOBALS['post'] );
		$output = ob_get_clean();
		remove_filter( 'foodforlife_buy_now_button', '__return_false' );
		wp_send_json_success( $output );
		exit;
	}
}