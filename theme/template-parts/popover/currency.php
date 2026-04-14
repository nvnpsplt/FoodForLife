<?php
/**
 * Template part for displaying the currency popover
 *
 * @package FoodForLife
 */

if ( ! function_exists( 'WC' ) ) {
	return;
}

?>

<div id="currency-popover" class="popover currency-popover">
	<div class="popover__backdrop"></div>
	<div class="popover__container">
		<?php echo \FoodForLife\Icon::get_svg( 'close', 'ui', array('class' => 'ffl-button ffl-button-icon ffl-button-light popover__button-close') ); ?>
		<div class="popover__content">
        <?php echo \FoodForLife\WooCommerce\Currency::woocs_currency_switcher(); ?>
		</div>
	</div>
</div>