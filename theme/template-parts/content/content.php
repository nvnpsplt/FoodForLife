<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FoodForLife
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<?php \FoodForLife\Blog\Post::thumbnail(); ?>
	<?php } ?>
	<div class="entry-summary d-flex flex-column align-items-center justify-content-center text-center">
		<?php \FoodForLife\Blog\Post::category('fw-medium'); ?>
		<?php \FoodForLife\Blog\Post::title('h3', false, array('mt-0 mb-10 fs-20')); ?>
		<?php \FoodForLife\Blog\Post::excerpt(24, array( 'p' => array( 'mt-0', 'mb-20' ))); ?>
		<div class="entry-meta d-flex flex-wrap align-items-center lh-normal gap-10">
			<?php \FoodForLife\Blog\Post::author(false); ?>
			<?php \FoodForLife\Blog\Post::date(false); ?>
		</div>
	</div>
</article>