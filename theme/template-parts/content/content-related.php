<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FoodForLife
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('ffl-post-grid swiper-slide'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="entry-header mb-30">
			<?php \FoodForLife\Blog\Post::thumbnail(); ?>
		</div>
	<?php } ?>
	<?php \FoodForLife\Blog\Post::title('h6', false, array( 'mt-0', 'mb-10', 'heading-letter-spacing' )); ?>
	<div class="entry-meta d-flex flex-wrap align-items-center lh-normal">
		<?php \FoodForLife\Blog\Post::author(); ?>
		<?php \FoodForLife\Blog\Post::date(false); ?>
	</div>
</article>