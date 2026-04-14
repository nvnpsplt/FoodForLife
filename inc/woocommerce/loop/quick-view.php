<?php
/**
 * Hooks of QuickView.
 *
 * @package FoodForLife
 */

namespace FoodForLife\WooCommerce\Loop;

use \FoodForLife\Helper;
use FoodForLife\Icon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of QuickView template.
 */
class Quick_View extends \FoodForLife\WooCommerce\Single_Product\Product_Base {
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
		add_action( 'wp_enqueue_scripts', array( $this, 'quick_view_scripts' ), 20 );
		add_filter( 'foodforlife_wp_script_data', array( $this, 'quickview_script_data' ), 10, 3 );

		// Quick view AJAX.
		add_action( 'wc_ajax_product_quick_view', array( $this, 'quick_view' ) );

		// Gallery
		add_action( 'foodforlife_woocommerce_before_product_quickview_summary', 'woocommerce_show_product_images', 10 );

		// Summary
		add_action( 'foodforlife_woocommerce_product_quickview_summary', array( $this, 'product_title' ), 5 );
		add_action( 'foodforlife_woocommerce_product_quickview_summary', 'woocommerce_template_single_rating', 7 );
		add_action( 'foodforlife_woocommerce_product_quickview_summary', array( $this, 'open_product_price' ), 9 );
		add_action( 'foodforlife_woocommerce_product_quickview_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'foodforlife_woocommerce_product_quickview_summary', array( $this, 'close_product_price' ), 12 );
		add_action( 'foodforlife_woocommerce_product_quickview_summary', array( $this, 'short_description' ), 20 );
		add_action( 'foodforlife_woocommerce_product_quickview_summary', 'woocommerce_template_single_add_to_cart', 30 );

		// Button view full details
		add_action( 'foodforlife_woocommerce_product_quickview_summary', array( $this, 'view_full_details_button' ), 60 );

	}

	/**
	 * WooCommerce specific scripts & stylesheets.
	 *
	 * @return void
	 */
	public static function quick_view_scripts() {
		// E3b: Add defer strategy to reduce render-blocking JS.
		wp_enqueue_script( 'foodforlife-countdown',  get_template_directory_uri() . '/assets/js/plugins/jquery.countdown.js', array(), '1.0', array( 'strategy' => 'defer' ) );

		if ( wp_script_is( 'wc-add-to-cart-variation', 'registered' ) ) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}

		if ( wp_script_is( 'flexslider', 'registered' ) ) {
			wp_enqueue_script( 'flexslider' );
		}
	}

	/**
	 * Quickview script data.
	 *
	 * @since 1.0.0
	 *
	 * @param $data
	 *
	 * @return array
	 */
	public function quickview_script_data( $data ) {
		$data['product_quickview_nonce'] = wp_create_nonce( 'foodforlife-product-quickview' );
		$data['mobile_single_product_gallery_arrows'] = \FoodForLife\Helper::get_option( 'mobile_single_product_gallery_arrows' );

		return $data;
	}

	/**
	 * Product quick view template.
	 *
	 * @return string
	 */
	public static function quick_view() {
		// S1: Verify nonce to prevent CSRF attacks on the quick-view endpoint.
		// The frontend JS sends the nonce as 'security' (see scripts.js productQuickView).
		if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['security'] ) ), 'foodforlife-product-quickview' ) ) {
			wp_send_json_error( esc_html__( 'Security check failed.', 'foodforlife' ) );
			exit;
		}

		if ( empty( $_POST['product_id'] ) ) {
			wp_send_json_error( esc_html__( 'No product.', 'foodforlife' ) );
			exit;
		}

		// S1: Sanitize product_id as integer to prevent injection.
		$product_id  = absint( $_POST['product_id'] );
		$post_object = get_post( $product_id );

		// S2: Fixed in_array — original had `true` as an array value, which
		// caused loose comparison to always match. Now uses strict check.
		if ( ! $post_object || ! in_array( $post_object->post_type, array( 'product', 'product_variation' ), true ) ) {
			wp_send_json_error( esc_html__( 'Invalid product.', 'foodforlife' ) );
			exit;
		}

		$GLOBALS['post'] = $post_object;
		wc_setup_product_data( $post_object );
		ob_start();
		wc_get_template( 'content-product-quickview.php', array(
			'post_object'      => $post_object,
		) );
		wp_reset_postdata();
		wc_setup_product_data( $GLOBALS['post'] );
		$output = ob_get_clean();

		wp_send_json_success( $output );
		exit;
	}

	/**
	 * Product title
     *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function product_title() {
		the_title( '<h3 class="product_title entry-title">', '</h3>' );
	}

	/**
	 * View full details button
	 *
	 * @return void
	 */
	public function view_full_details_button() {
	?>
		<a class="view-full-details-button ffl-button ffl-button-subtle" href="<?php echo esc_url( get_permalink() ); ?>">
			<?php esc_html_e( 'View Full Details', 'foodforlife' ); ?>
			<?php echo Icon::get_svg( 'double-arrow' ); ?>
		</a>
	<?php
	}

	/**
	 *  Quick view icon
	 */
	protected function quick_view_button_icon($classes = 'ffl-button', $product = false) {
		$classes = 'product-loop-button ffl-button-icon ffl-tooltip-inside ' . $classes;

		$classes = apply_filters( 'foodforlife_quick_view_button_icon_classes', $classes );

		self::quick_view_button_html( $classes, true, $product);
	}

	/**
	 *  Quick view icon
	 */
	public function quick_view_button_icon_light($product = false) {
		$this->quick_view_button_icon( 'ffl-button-light ffl-tooltip-inside', $product );
	}

	/**
	 * Get Quick view icon
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function quick_view_button_html( $classes = '', $only_icon = false, $_product = false ) {
		global $product;

		$_product = empty( $_product  ) ? $product : $_product ;

		$content = \FoodForLife\Icon::inline_svg( 'icon=icon-quickview' );
		if( ! $only_icon ) {
			$content = sprintf(
				'<span class="foodforlife-button__icon">%s</span>
				<span class="foodforlife-quickview-button__text">%s</span>',
				$content,
				esc_html__( 'Quick View', 'foodforlife' )
			);
		}
		\FoodForLife\Theme::set_prop( 'modals', 'quickview' );
		echo sprintf(
			'<a href="%s" class="foodforlife-quickview-button button %s" data-toggle="modal" data-target="quick-view-modal" data-product_id="%d" data-tooltip="%s" data-tooltip_position="%s" aria-label="%s" rel="nofollow">
				%s
			</a>',
			is_customize_preview() ? '#' : esc_url( get_permalink() ),
			esc_attr( $classes ),
			esc_attr( $_product->get_id() ),
			esc_attr__( 'Quick View', 'foodforlife' ),
			apply_filters( 'foodforlife_quickview_tooltip_position', 'left' ),
			esc_attr__( 'Quick View for', 'foodforlife' ) . ' ' . $_product->get_title(),
			$content
		);
	}
}
