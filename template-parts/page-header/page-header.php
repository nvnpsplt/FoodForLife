<?php
/**
 * Template part for displaying the blog header
 *
 * @package FoodForLife
 */

?>

<div id="page-header" class="<?php \FoodForLife\Page_Header::classes('page-header'); ?>">
	<div class="container clearfix">
		<?php do_action('foodforlife_before_page_header_content'); ?>
		<div class="page-header__content position-relative d-flex flex-column <?php echo apply_filters('foodforlife_page_header_content_class', 'justify-content-center align-items-center text-center'); ?>">
			<?php \FoodForLife\Page_Header::breadcrumb(); ?>
			<?php echo \FoodForLife\Page_Header::title(); ?>
			<?php echo \FoodForLife\Page_Header::description(); ?>
		</div>
		<?php do_action('foodforlife_after_page_header_content'); ?>
	</div>
</div>