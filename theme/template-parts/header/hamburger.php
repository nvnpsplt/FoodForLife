<?php
/**
 * Template part for displaying the hamburger menu
 *
 * @package FoodForLife
 */

?>

<button class="header-hamburger hamburger-menu ffl-button-text" aria-label="<?php esc_attr_e('Header Hamburger', 'foodforlife'); ?>" data-toggle="off-canvas" data-target="mobile-menu-panel">
	<?php echo \FoodForLife\Icon::get_svg( 'hamburger', 'ui', 'class=hamburger__icon' ); ?>
	<?php echo ! empty( \FoodForLife\Helper::get_option( 'mobile_header_hamburger_menu_text') ) ? '<span class="hamburger-menu__text fw-600">' . \FoodForLife\Helper::get_option( 'mobile_header_hamburger_menu_text' ) . '</span>' : ''; ?>
</button>