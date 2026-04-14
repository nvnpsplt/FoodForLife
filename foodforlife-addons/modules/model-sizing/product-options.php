<?php

namespace FoodForLife\Addons\Modules\Model_Sizing;

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

		add_filter( 'woocommerce_product_data_tabs', [ $this, 'model_sizing_tab' ] );
		add_action( 'woocommerce_product_data_panels', array( $this, 'model_sizing_options' ) );
		add_action( 'woocommerce_process_product_meta', array( $this, 'save_product_data' ) );
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
			wp_enqueue_script( 'foodforlife_wc_model_sizing_js', FOODFORLIFE_ADDONS_URL . 'modules/model-sizing/assets/admin/model-sizing-admin.js', array( 'jquery' ), '20240506', true );
			wp_enqueue_style( 'foodforlife_wc_model_sizing_css', FOODFORLIFE_ADDONS_URL . 'modules/model-sizing/assets/admin/model-sizing-admin.css' );
		}
	}

	/**
	 * Add new product data tab for swatches
	 *
	 * @param array $tabs
	 *
	 * @return array
	 */
	public function model_sizing_tab( $tabs ) {
		$tabs['product_model_sizing'] = [
			'label'    => esc_html__( "Model's Sizing", 'foodforlife-addons' ),
			'target'   => 'product_model_sizing_data',
			'class'    => [ 'model_sizing_tab' ],
			'priority' => 62,
		];

		return $tabs;
	}

	/**
	 * Add more options to advanced tab.
	 */
	public static function model_sizing_options() {
		$model_sizing_id = get_post_meta( get_the_ID(), 'model_sizing_thumbnail_id', true );
		$attachment = wp_get_attachment_image( $model_sizing_id, 'thumbnail' );
		$remove_class = $model_sizing_id ? '' : 'hidden';
		$informations_custom = get_post_meta( get_the_ID(), 'model_sizing_informations_custom', true );
		?>
		<div id="product_model_sizing_data" class="panel woocommerce_options_panel wc-metaboxes-wrapper hidden">
		<div class="options_group">
				<p class=" form-field">
					<label><?php esc_html_e( 'Thumbnail', 'foodforlife-addons' ); ?></label>
					<span class="hide-if-no-js">
						<a href="#" id="set-model_sizing-thumbnail">
							<?php if( $model_sizing_id ) : ?>
								<?php echo $attachment; ?>
							<?php else : ?>
								<?php esc_html_e('Set thumbnail', 'foodforlife-addons'); ?>
							<?php endif; ?>
						</a>
						<br/>
						<a href="#" id="remove-model_sizing-thumbnail" class="<?php echo esc_attr($remove_class); ?>" data-set-text="<?php esc_attr_e('Set thumbnail', 'foodforlife-addons'); ?>">
							<?php esc_html_e('Remove thumbnail', 'foodforlife-addons'); ?>
						</a>
					</span>
					</span>
					<input type="hidden" id="model_sizing_thumbnail_id" name="model_sizing_thumbnail_id" value="<?php echo esc_attr($model_sizing_id); ?>">
				</p>
			</div>
			<div class="options_group">
				<?php
					woocommerce_wp_text_input(
						array(
							'id'       => 'model_sizing_wearing',
							'label'    => esc_html__( 'Model is Wearing', 'foodforlife-addons' ),
							'data_type'    => 'text',
						)
					);
					woocommerce_wp_text_input(
						array(
							'id'       => 'model_sizing_height',
							'label'    => esc_html__( 'Height', 'foodforlife-addons' ),
							'data_type'    => 'text',
						)
					);
					woocommerce_wp_text_input(
						array(
							'id'       => 'model_sizing_weight',
							'label'    => esc_html__( 'Weight', 'foodforlife-addons' ),
							'data_type'    => 'text',
						)
					);
					woocommerce_wp_text_input(
						array(
							'id'       => 'model_sizing_shoulder_width',
							'label'    => esc_html__( 'Shoulder width', 'foodforlife-addons' ),
							'data_type'    => 'text',
						)
					);
					woocommerce_wp_text_input(
						array(
							'id'       => 'model_sizing_bust_waist_hip',
							'label'    => esc_html__( 'Bust/waist/hip', 'foodforlife-addons' ),
							'data_type'    => 'text',
						)
					);
				?>
			</div>
			<div class="options_group">
				<h4 class="custom-information-item__title"><?php esc_html_e( 'Custom informations', 'foodforlife-addons' ); ?></h4>
				<?php if( ! empty( $informations_custom ) ) : ?>
					<?php foreach( (array) $informations_custom as $key => $information ) : ?>
						<div class="custom-information-item" data-remove="<?php esc_attr_e( 'Remove', 'foodforlife-addons' ); ?>">
							<input type="text" name="model_sizing_informations_custom_label[]" value="<?php echo esc_attr( $information['label'] ); ?>">
							<input type="text" name="model_sizing_informations_custom_value[]" value="<?php echo esc_attr( $information['value'] ); ?>">
							<?php if( $key > 0 ) : ?>
								<button type="button" class="button remove-custom-information">
									<?php esc_html_e( 'Remove', 'foodforlife-addons' ); ?>
								</button>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="custom-information-item" data-remove="<?php esc_attr_e( 'Remove', 'foodforlife-addons' ); ?>">
						<input type="text" name="model_sizing_informations_custom_label[]" value="">
						<input type="text" name="model_sizing_informations_custom_value[]" value="">
					</div>
				<?php endif; ?>
				<button type="button" class="button add-custom-information">
					<?php esc_html_e( 'Add custom information', 'foodforlife-addons' ); ?>
				</button>
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

		// S-ADDON: Sanitize all model sizing fields.
		if ( isset( $_POST['model_sizing_thumbnail_id'] ) ) {
			update_post_meta( $post_id, 'model_sizing_thumbnail_id', absint( $_POST['model_sizing_thumbnail_id'] ) );
		}

		$text_fields = array( 'model_sizing_wearing', 'model_sizing_height', 'model_sizing_weight', 'model_sizing_shoulder_width', 'model_sizing_bust_waist_hip' );
		foreach ( $text_fields as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			} else {
				update_post_meta( $post_id, $field, '' );
			}
		}

		$args = [];
		if ( isset( $_POST['model_sizing_informations_custom_value'] ) && isset( $_POST['model_sizing_informations_custom_label'] ) ) {
			$custom_values = array_map( 'sanitize_text_field', wp_unslash( $_POST['model_sizing_informations_custom_value'] ) );
			$custom_labels = array_map( 'sanitize_text_field', wp_unslash( $_POST['model_sizing_informations_custom_label'] ) );
			foreach( $custom_values as $key => $value ) {
				$args[] = [
					'value' => $value,
					'label' => isset( $custom_labels[ $key ] ) ? $custom_labels[ $key ] : '',
				];
			}
		}

		update_post_meta( $post_id, 'model_sizing_informations_custom', $args );
	}
}
