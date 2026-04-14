<?php

/**
 * Template part for displaying the currency
 *
 * @package FoodForLife
 */

if ( ! function_exists( 'WC' ) ) {
	return;
}

?>

<div class="header-currency foodforlife-currency foodforlife-currency-language ffl-color-dark">
	<?php echo \FoodForLife\WooCommerce\Currency::currency_switcher(); ?>
</div>