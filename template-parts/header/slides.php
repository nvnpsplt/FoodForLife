<?php

/**
 * Template part for displaying the language
 *
 * @package FoodForLife
 */

?>

<div id="topbar-slides" class="topbar-slides">
	<div class="topbar-slides__inner foodforlife-swiper swiper" data-swiper=<?php echo esc_attr( json_encode( $args ) ); ?> data-desktop="1" data-tablet="1" data-mobile="1">
		<div class="navigation-merged position-absolute-xl top-0 bottom-0 start-0 d-flex align-items-center z-3">
			<?php
				echo \FoodForLife\Icon::get_svg( 'left-mini', 'ui', 'class=swiper-button-text swiper-button-prev position-static-xl-important' );
				echo \FoodForLife\Icon::get_svg( 'right-mini', 'ui', 'class=swiper-button-text swiper-button-next position-static-xl-important' );
			?>
		</div>
		<div class="topbar-slides__wrapper swiper-wrapper">
			<?php echo \FoodForLife\Header\Topbar::slides(); ?>
		</div>
	</div>
</div>