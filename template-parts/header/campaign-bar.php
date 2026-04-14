<?php
/**
 * Template part for displaying the campaign bar
 *
 * @package FoodForLife
 */

?>
<div id="campaign-bar" class="campaign-bar position-relative d-flex align-items-center justify-content-center campaign-bar-type--<?php echo esc_attr( $args['type'] ) ?>">
	<?php \FoodForLife\Header\Campaign_Bar::content( $args['type'] ); ?>
	<button class="campaign-bar__close ffl-button-text ffl-button-icon px-10 position-absolute top-50 end-0 z-1" aria-label="<?php esc_attr_e('Campaign Bar Close', 'foodforlife') ?>">
		<?php echo \FoodForLife\Icon::get_svg( 'close' ); ?>
	</button>
</div>