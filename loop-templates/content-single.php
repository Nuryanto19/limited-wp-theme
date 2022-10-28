<?php
/**
 * Single post partial template
 *
 * @package limited
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('single-post'); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header-single-post">
		<div class="wrap-header-single">
			<?php limited_show_categories(); ?>
			
			<?php the_title( '<h1 class="entry-title">', '</h1>'); ?>
			<div class="entry-meta">
				<?php limited_posted_on(); ?>
			</div>
		</div>
		<div class="featured-image-wrap">
		<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'featured-image' ) ); ?>
		</div>
	</header>


	<div class="entry-content-single-post">
		<?php 
		the_content(); 
		limited_link_pages();
		?>
	</div>

	<footer class="entry-footer">
		
	</footer>

</article>