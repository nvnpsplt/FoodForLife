<?php

namespace FoodForLife\Addons\Modules\Variation_Images;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main class of plugin for admin
 */
class Product_Options  {

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
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 50 );


		// Linked Products tab
		add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'variation_images_html' ), 10, 3 );
		// Save product meta
		add_action( 'woocommerce_save_product_variation', array( $this, 'save_product_variation_images' ) );
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
			wp_enqueue_script( 'foodforlife_variation_images', FOODFORLIFE_ADDONS_URL . '/modules/variation-images/assets/admin/variation-images-admin.js', array( 'jquery' ), '20220319', true );
			wp_enqueue_style( 'foodforlife_variation_images', FOODFORLIFE_ADDONS_URL . '/modules/variation-images/assets/admin/variation-images-admin.css', array(), '20220319');
		}
	}

	/**
	 * Add more options to advanced tab.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function variation_images_html($loop, $variation_data, $variation) {
		$variation_id   = absint( $variation->ID );
		$gallery_images = get_post_meta( $variation_id, 'foodforlife_variation_images', true );
		$attachments = $gallery_images ? explode(',', $gallery_images) : '';
		?>
		<div class="form-row form-row-full foodforlife-variation-images-container">
			<h4><?php esc_html_e( 'Variation Images', 'foodforlife-addons' ); ?></h4>
			<ul class="variation-images-list">
				<?php
				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment_id ) {
						$attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );
						if ( empty( $attachment ) ) {
							continue;
						}
						?>
						<li class="image" data-attachment_id="<?php echo esc_attr( $attachment_id ); ?>">
							<?php echo $attachment; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<a href="#" class="delete tips" data-tip="<?php esc_attr_e( 'Delete image', 'foodforlife-addons' ); ?>"></a>
						</li>
						<?php
					}

				}
				?>
			</ul>
			<p class="hide-if-no-js">
				<a href="#" class="foodforlife-variation-images-upload" data-choose="<?php esc_attr_e( 'Add images to variation gallery', 'foodforlife-addons' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'foodforlife-addons' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'foodforlife-addons' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'foodforlife-addons' ); ?>"><?php esc_html_e( 'Add variation images gallery', 'foodforlife-addons' ); ?></a>
			</p>
			<input type="hidden" class="foodforlife_variation_images" name="foodforlife_variation_images[<?php echo esc_attr( $variation->ID ); ?>]" value="<?php echo esc_attr($gallery_images ); ?>" />
		</div>
	<?php
	}

	/**
	 * product_meta_fields_save function.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $post_id
	 *
	 * @return void
	 */
	public function save_product_variation_images( $variation_id ) {
		if ( isset( $_POST['foodforlife_variation_images'][$variation_id ] ) ) {
			$woo_data = $_POST['foodforlife_variation_images'][$variation_id ];
			update_post_meta( $variation_id, 'foodforlife_variation_images', $woo_data );
		} else {
			delete_post_meta( $variation_id, 'foodforlife_variation_images' );
		}

	}

}