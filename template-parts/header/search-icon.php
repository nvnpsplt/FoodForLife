<?php
/**
 * Template part for displaying the search icon
 *
 * @package FoodForLife
 */

?>

<a href="#" class="ffl-button ffl-button-text ffl-button-icon header-search__icon" data-toggle="modal" data-target="search-modal">
	<?php echo \FoodForLife\Icon::get_svg( 'search' ); ?>
	<span class="screen-reader-text"><?php esc_html_e( 'Search', 'foodforlife' ) ?></span>
</a>
