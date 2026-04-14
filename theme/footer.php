<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FoodForLife
 */

?>

<?php do_action( 'foodforlife_before_site_content_close' ); ?>
</div><!-- #content -->
<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {?>
	<footer id="site-footer" class="site-footer border-top" role="contentinfo" aria-label="<?php esc_attr_e( 'Site Footer', 'foodforlife' ); ?>">
		<?php do_action('foodforlife_footer'); ?>
	</footer>
<?php } ?>
<?php do_action( 'foodforlife_after_close_site_footer' ); ?>

</div><!-- #page -->

<?php do_action( 'foodforlife_after_site' ) ?>

<?php wp_footer(); ?>

</body>
</html>
