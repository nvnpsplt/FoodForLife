<?php
/**
 * Template part for displaying the search form
 *
 * @package FoodForLife
 */

?>

<div class="header-search">
	<form class="header-search__form ffl-instant-search__form position-relative" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" data-toggle="modal" data-target="search-modal">
		<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'foodforlife' ); ?>" class="header-search__button ffl-instant-search__button ffl-button ffl-button-icon position-absolute start-5 top-0">
			<?php echo \FoodForLife\Icon::inline_svg( [ 'icon' => 'icon-search', 'class' => 'has-vertical-align' ] ); ?>
		</button>
		<input type="text" name="s" class="header-search__field ffl-instant-search__field" placeholder="<?php esc_attr_e("I'm looking for…", 'foodforlife') ?>" autocomplete="off">
		<input type="hidden" name="post_type" class="header-search__post-type" value="product">
		<a href="#" class="close-search-results position-absolute end-5 top-0 ffl-button ffl-button-icon invisible"><?php echo \FoodForLife\Icon::get_svg( 'close', 'ui'); ?></a>
	</form>
</div>
