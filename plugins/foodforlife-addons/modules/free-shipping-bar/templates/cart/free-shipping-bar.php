<?php
/**
 * Free Shipping bar
 *
 */

defined( 'ABSPATH' ) || exit;

$message = ! empty( $args['message'] ) ? $args['message'] : '';
$percent = ! empty( $args['percent'] ) ? $args['percent'] : '';
$classes = ! empty( $args['classes'] ) ? $args['classes'] : '';
$time 	 = ! empty( $args['time'] ) ? $args['time'] : '';
?>

<div class="foodforlife-free-shipping-bar foodforlife-free-shipping-bar--preload<?php echo esc_attr( $classes );?>" style="--ffl-progress:<?php echo esc_attr( $percent ); ?>">
	<div class="foodforlife-free-shipping-bar__progress">
		<div class="foodforlife-free-shipping-bar__progress-bar">
			<div class="foodforlife-free-shipping-bar__icon"><?php echo \FoodForLife\Addons\Helper::get_svg( 'delivery' ) ?></div>
		</div>
	</div>
	<div class="foodforlife-free-shipping-bar__percent-value"><?php echo $percent; ?></div>
	<div class="foodforlife-free-shipping-bar__message">
		<?php echo $message; ?>
	</div>
</div>