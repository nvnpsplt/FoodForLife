<?php
/**
 * Template part for displaying the product share modal
 *
 * @package FoodForLife
 */

?>

<div id="product-share-modal" class="product-share-modal modal product-extra-link-modal">
	<div class="modal__backdrop"></div>
	<div class="modal__container">
		<div class="modal__wrapper">
			<div class="modal__header">
				<h3 class="modal__title h5"><?php esc_html_e( 'Copy link', 'foodforlife' ); ?></h3>
				<a href="#" class="modal__button-close">
					<?php echo \FoodForLife\Icon::get_svg( 'close', 'ui' ); ?>
				</a>
			</div>
			<div class="modal__content">
				<div class="product-share__copylink">
					<form class="ffl-responsive d-flex align-items-center gap-10 mb-20">
						<input class="product-share__copylink--link foodforlife-copylink__link flex-1" type="text" value="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>" readonly="readonly" />
						<button class="product-share__copylink--button foodforlife-copylink__button ffl-button ffl-button-icon" data-icon="<?php echo esc_attr( \FoodForLife\Icon::get_svg( 'copy' ) ); ?>" data-icon_copied="<?php echo esc_attr( \FoodForLife\Icon::inline_svg( ['icon' => 'check', 'class' => 'has-vertical-align'] ) ); ?>"><?php echo \FoodForLife\Icon::get_svg( 'copy' ); ?></button>
					</form>
				</div>
				<div class="product-share__share">
					<div class="product-share__copylink-heading h6 mb-15 mt-0"><?php echo esc_html__( 'Share', 'foodforlife' ); ?></div>
					<?php echo ! empty( $args ) ? $args : '' ; ?>
				</div>
			</div>
		</div>
	</div>
	<span class="modal__loader"><span class="foodforlifeSpinner"></span></span>
</div>