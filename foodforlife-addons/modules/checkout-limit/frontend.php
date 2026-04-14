<?php
/**
 * Single Product hooks.
 *
 * @package FoodForLife
 */

namespace FoodForLife\Addons\Modules\Checkout_Limit;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of Single Product
 */
class Frontend {
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
		// Enqueue scripts
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		// Display checkout limit
		add_action( 'woocommerce_before_cart', [ $this, 'checkout_limit' ] );
		add_action( 'woocommerce_before_checkout_form', [ $this, 'checkout_limit' ] );
		add_action( 'foodforlife_before_woocommerce_mini_cart_items', [ $this, 'checkout_limit_mini_cart' ], 15 );

		// Empty cart ajax
		add_action( 'wc_ajax_foodforlife_checkout_limit_empty_cart', [ $this, 'foodforlife_checkout_limit_empty_cart' ] );
	}

	/**
	 * Enqueue scripts
	 */
	public function enqueue_scripts() {
		if( is_cart() && ! in_array( 'cart', get_option( 'foodforlife_checkout_limit_display_on' ) ) ) {
			return;
		}

		if( is_checkout() && ! in_array( 'checkout', get_option( 'foodforlife_checkout_limit_display_on' ) ) ) {
			return;
		}
		$debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'foodforlife-checkout-limit-frontend', FOODFORLIFE_ADDONS_URL . 'modules/checkout-limit/assets/checkout-limit' . $debug . '.css', [], '20250325' );
		wp_enqueue_script( 'foodforlife-checkout-limit-frontend', FOODFORLIFE_ADDONS_URL . 'modules/checkout-limit/assets/checkout-limit' . $debug . '.js', [ 'jquery' ], '20250325', array('strategy' => 'defer') );

		wp_localize_script( 'foodforlife-checkout-limit-frontend', 'foodforlifeCL', [
			'action'        => get_option( 'foodforlife_checkout_limit_action', '' ),
			'message'       => __( "You're out of time! Checkout now to avoid losing your order!", 'foodforlife-addons' ),
			'time'          => get_option( 'foodforlife_checkout_limit_time', 120 ),
			'emptyCartTime' => get_option( 'foodforlife_checkout_limit_empty_cart_time', 3 ),
			'nonce'         => wp_create_nonce( 'foodforlife-checkout-limit-nonce' ), // S-ADDON: Nonce for AJAX.
		]);
	}

	/**
	 * Checkout limit for mini cart
	 */
	public function checkout_limit_mini_cart() {
		if( ! in_array( 'minicart', get_option( 'foodforlife_checkout_limit_display_on' ) ) ) {
			return;
		}

		$limit_text = get_option( 'foodforlife_checkout_limit_countdown_text_mini_cart' );
		$this->checkout_limit( $limit_text );
	}

	/**
	 * Checkout limit
	 */
	public function checkout_limit( $limit_text = '' ) {
		if( is_cart() && ! in_array( 'cart', get_option( 'foodforlife_checkout_limit_display_on' ) ) ) {
			return;
		}

		if( is_checkout() && ! in_array( 'checkout', get_option( 'foodforlife_checkout_limit_display_on' ) ) ) {
			return;
		}

		if ( is_cart() ) {
			$limit_text = get_option( 'foodforlife_checkout_limit_countdown_text_cart_page' );
		}

		if ( is_checkout() ) {
			$limit_text = get_option( 'foodforlife_checkout_limit_countdown_text_checkout_page' );
		}

		if( empty( $limit_text ) ) {
			$limit_text = esc_html__( "Products are limited, checkout within {time}", 'foodforlife-addons' );
		}

		$text = array(
			'days'    => esc_html__( 'd', 'foodforlife' ),
			'hours'   => esc_html__( 'h', 'foodforlife' ),
			'minutes' => esc_html__( 'm', 'foodforlife' ),
			'seconds' => esc_html__( 's', 'foodforlife' ),
		);
		$time_html = '';
		if( ! empty( $limit_text ) ) {
			$time_html = '<div class="foodforlife-checkout-limit__time foodforlife-countdown d-inline-flex justify-content-center text-primary lh-1" data-expire="' . esc_attr( get_option( 'foodforlife_checkout_limit_time', 120 ) ) . '" data-text="' . esc_attr( wp_json_encode( $text ) ) . '">';
			$time_html .= '<span class="minutes timer d-flex align-items-end text-inherit">';
			$time_html .= '<span class="digits fs-inherit fw-inherit text-transform-inherit m-0">' . esc_html( get_option( 'foodforlife_checkout_limit_time', 120 ) > 60 ? str_pad(intval( get_option( 'foodforlife_checkout_limit_time', 120 ) / 60 ), 2, '0', STR_PAD_LEFT) : 00 ) . '</span>';
			$time_html .= '<span class="text fs-14 fw-inherit text-transform-inherit m-0 ps-2">' . esc_html( $text['minutes'], 'foodforlife-addons' ) . '</span>';
			$time_html .= '<span class="divider d-inline fs-inherit fw-normal text-transform-inherit m-0 ps-4 pe-5">:</span>';
			$time_html .= '</span>';
			$time_html .= '<span class="seconds timer d-flex align-items-end text-inherit">';
			$time_html .= '<span class="digits fs-inherit fw-inherit text-transform-inherit m-0">' . esc_html( get_option( 'foodforlife_checkout_limit_time', 120 ) < 60 ? str_pad( get_option( 'foodforlife_checkout_limit_time', 120 ), 2, '0', STR_PAD_LEFT) : 00 ) . '</span>';
			$time_html .= '<span class="text fs-14 fw-inherit text-transform-inherit m-0 ps-2">' . esc_html( $text['seconds'], 'foodforlife-addons' ) . '</span>';
			$time_html .= '</span>';
			$time_html .= '</div>';
			$limit_text = str_replace( '{time}', $time_html, $limit_text );
		}
		?>
		<div class="foodforlife-checkout-limit d-flex align-items-center <?php echo is_cart() || is_checkout() ? 'justify-content-center mt-10 mb-20' : 'foodforlife-checkout-limit--mini-cart border-bottom-dashed pt-20'; ?>">
			<div class="foodforlife-checkout-limit__wrapper d-inline-flex align-items-center gap-5 fw-semibold pt-17 pb-15 <?php echo is_cart() || is_checkout() ? 'justify-content-center px-15 w-100 rounded-30' : ''; ?>">
				<?php echo \FoodForLife\Addons\Helper::get_svg( 'fire', 'ui', [ 'class' => 'foodforlife-checkout-limit__icon fs-18' ] ); ?>
				<div class="foodforlife-checkout-limit__message">
					<?php echo $limit_text; ?>
				</div>
				
			</div>
		</div>
		<?php
	}

	/**
	 * Empty cart
	 */
	public function foodforlife_checkout_limit_empty_cart() {
		// S-ADDON: Verify nonce.
		check_ajax_referer( 'foodforlife-checkout-limit-nonce', 'security' );

		$action = isset( $_POST['action'] ) ? sanitize_text_field( wp_unslash( $_POST['action'] ) ) : ''; // S-ADDON: Sanitize.
		if( $action !== 'foodforlife_checkout_limit_empty_cart' ) {
			return;
		}

		WC()->cart->empty_cart();
		wp_send_json_success();
	}
}