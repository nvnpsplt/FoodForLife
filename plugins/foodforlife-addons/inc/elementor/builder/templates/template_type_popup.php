<?php
/**
 * The Template for displaying all template type
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div id="foodforlife-builder-template-modal" class="foodforlife-builder-template-modal">
	<div class="modal__backdrop"></div>
	<div class="modal__content">
		<span class="foodforlife-svg-icon foodforlife-svg-icon--close modal__button-close"><svg width="24" height="24" aria-hidden="true" role="img" focusable="false" viewBox="0 0 32 32"><path d="M28.336 5.936l-2.272-2.272-10.064 10.080-10.064-10.080-2.272 2.272 10.080 10.064-10.080 10.064 2.272 2.272 10.064-10.080 10.064 10.080 2.272-2.272-10.080-10.064z"></path></svg></span>
		<form class="modal-content__form" action="<?php echo esc_url( admin_url('post.php') ); ?>">
			<input type="hidden" class="_wpnonce" value="<?php echo wp_create_nonce( 'foodforlife_buider_new_template' ); ?>">
			<div class="modal-content-form__title"><?php echo esc_html__( 'Choose Template Type', 'foodforlife-addons' ); ?></div>
			<div  class="elementor-form-field">
				<label for="foodforlife-builder-template-modal-type" class="elementor-form-field__label"><?php echo esc_html__( 'Select the type of template you want to work on', 'foodforlife-addons' ); ?></label>
				<select id="foodforlife-builder-template-modal-type" class="elementor-form-field__select" required>
					<option value="footer"><?php echo esc_html__( 'Footer', 'foodforlife-addons' ); ?></option>
					<option value="navigation_bar"><?php echo esc_html__( 'Navigation Bar', 'foodforlife-addons' ); ?></option>
					<?php
						if( get_option( 'foodforlife_product_builder_enable', false ) ) {
							?><option value="product"><?php echo esc_html__( 'Single Product', 'foodforlife-addons' ); ?></option><?php
						}

						if( get_option( 'foodforlife_product_archive_builder_enable', false ) ) {
							?><option value="archive"><?php echo esc_html__( 'Product Archive ', 'foodforlife-addons' ); ?></option><?php
						}

						if( get_option( 'foodforlife_cart_page_builder_enable', false ) ) {
							?><option value="cart_page"><?php echo esc_html__( 'Cart Page', 'foodforlife-addons' ); ?></option><?php
						}

						if( get_option( 'foodforlife_checkout_page_builder_enable', false ) ) {
							?><option value="checkout_page"><?php echo esc_html__( 'Checkout Page', 'foodforlife-addons' ); ?></option><?php
						}

						if( get_option( 'foodforlife_404_page_builder_enable', false ) ) {
							?><option value="404_page"><?php echo esc_html__( '404 Page', 'foodforlife-addons' ); ?></option><?php
						}
					?>
				</select>
			</div>
			<div class="elementor-form-field">
				<label for="foodforlife-builder-template-modal__post-title" class="elementor-form-field__label">
					<?php echo esc_html__( 'Name your template', 'foodforlife-addons' ); ?>
				</label>
				<input type="text" placeholder="<?php echo esc_attr__( 'Enter template name (optional)', 'foodforlife-addons' ); ?>" required id="foodforlife-builder-template-modal__post-title" class="elementor-form-field__text">
			</div>
			<div class="elementor-form-field">
				<input class="elementor-form-field__checkbox" type="checkbox" name="woolentor-template-enable" id="foodforlife-builder-template-modal__post-enable">
				<label for="foodforlife-builder-template-modal__post-enable" class="elementor-form-field__label">
					<?php echo esc_html__( 'Enable Builder', 'foodforlife-addons' ); ?>
				</label>
			</div>
			<button id="foodforlife-builder-template-modal__submit" class="elementor-button e-primary"><span><?php echo esc_html__( 'Create Template', 'foodforlife-addons' ); ?></span></button>
			<p class="modal-content-form-message"></p>
		</form>
	</div>
</div>
