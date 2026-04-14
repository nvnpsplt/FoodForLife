<?php
/**
 * WooCommerce additional settings.
 *
 * @package FoodForLife
 */

 namespace FoodForLife\Addons\Modules\Variation_Compare;

use \FoodForLife\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class of Product Settings
 */
class Product_Options {
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
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 50 );

		add_filter( 'woocommerce_product_data_tabs', [ $this, 'variation_compare_tab' ] );
		add_action( 'woocommerce_product_data_panels', array( __CLASS__, 'product_variation_compare_options' ) );
		add_action( 'woocommerce_process_product_meta', array( __CLASS__, 'save_product_data' ) );

		// Atribute
		// S-ADDON: Removed nopriv — this is admin-only.
		add_action( 'wp_ajax_foodforlife_wc_product_variation_compare', array( $this, 'wc_product_variation_compare' ) );
	}

	/**
	 * Enqueue Scripts
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_scripts( $hook ) {
		$screen = get_current_screen();
		if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) && $screen->post_type == 'product' ) {
			wp_enqueue_script( 'foodforlife_wc_variation_compare_js', FOODFORLIFE_ADDONS_URL . 'modules/variation-compare/assets/admin/variation-compare-admin.js', array( 'jquery' ), '20220318', true );
		}
	}

	/**
	 * Add new product data tab for swatches
	 *
	 * @param array $tabs
	 *
	 * @return array
	 */
	public function variation_compare_tab( $tabs ) {
		$tabs['product_variation_compare'] = [
			'label'    => esc_html__( 'Variation Compare', 'foodforlife-addons' ),
			'target'   => 'product_variation_compare_data',
			'class'    => [ 'variation_compare_tab', 'show_if_variable' ],
			'priority' => 61,
		];

		return $tabs;
	}

	/**
	 * Add more options to advanced tab.
	 */
	public static function product_variation_compare_options() {
		?>
		<div id="product_variation_compare_data" class="panel woocommerce_options_panel wc-metaboxes-wrapper hidden">
			<div class="options_group product-variation-compare" id="foodforlife-variation-compare">
			<?php
			self::get_product_attributes(get_the_ID());
			?>
			</div>
		</div>
		<?php
	}

	/**
	 * Save product data.
	 *
	 * @param int $post_id The post ID.
	 */
	public static function save_product_data( $post_id ) {
		if ( 'product' !== get_post_type( $post_id ) ) {
			return;
		}

		if ( isset( $_POST['foodforlife_product_variation_attribute'] ) ) {
			// S-ADDON: Sanitize before saving to DB.
			$woo_data = sanitize_text_field( wp_unslash( $_POST['foodforlife_product_variation_attribute'] ) );
			update_post_meta( $post_id, 'foodforlife_product_variation_attribute', $woo_data );
		}

	}

	/**
	 * Get Product Attributes AJAX function.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function wc_product_variation_compare() {
		// S-ADDON: Verify nonce.
		check_ajax_referer( 'foodforlife-variation-compare-nonce', 'security' );

		// S-ADDON: Sanitize post_id as integer.
		$post_id = absint( $_POST['post_id'] );

		if ( empty( $post_id ) ) {
			return;
		}
		ob_start();
		$this->get_product_attributes($post_id);
		$response = ob_get_clean();
		wp_send_json_success( $response );
		die();
	}

	/**
	 * Get Product Attributes function.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function get_product_attributes ($post_id) {
		$product_object = wc_get_product( $post_id );
		if( ! $product_object ) {
			return;
		}
		$attributes = $product_object->get_attributes();

		if( ! $attributes ) {
			return;
		}
		$options         = array();
		$options['']     = esc_html__( 'Default', 'foodforlife-addons' );
		$options['none'] = esc_html__( 'None', 'foodforlife-addons' );
		foreach ( $attributes as $attribute ) {
			$options[ sanitize_title( $attribute['name'] ) ] = wc_attribute_label( $attribute['name'] );
		}
		woocommerce_wp_select(
			array(
				'id'       => 'foodforlife_product_variation_attribute',
				'label'    => esc_html__( 'Primary Attribute', 'foodforlife-addons' ),
				'desc_tip'    => true,
				'description' => esc_html__( 'Display the primary attribute for comparison on the product page', 'foodforlife-addons' ),
				'options'  => $options
			)
		);

	}
}
