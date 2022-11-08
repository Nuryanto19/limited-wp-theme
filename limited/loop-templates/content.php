<?php
/**
 * Partial template for content in index.php dan archive
 *
 
 * @package Limited
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="card">
 <article <?php post_class('homefeed'); ?> id="post-<?php the_ID(); ?>">

	<div class="wrapper-excerpt">
		<?php limited_show_categories(); ?>
	 		<header class="entry-header">

				<?php
				the_title(
					sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h2>'
				);
				?>

			</header><!-- .entry-header -->

			<div class="entry-content">

				<?php
				the_excerpt();
				limited_link_pages();
				?>

			</div><!-- .entry-content -->
			
			<div class="entry-footer-wrap">
				<footer class="entry-footer">
					<?php if ( 'post' === get_post_type() ) : ?>

						<div class="entry-meta-home">
							<?php limited_posted_on(); ?>
						</div><!-- .entry-meta -->

					<?php endif; ?>

				</footer><!-- .entry-footer -->
			</div>
	</div>

</article><!-- #post-## -->
</div>