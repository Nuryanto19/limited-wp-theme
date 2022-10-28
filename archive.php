<?php 
/*
*this is template for displaying archive pages
*@package Limited
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
 ?>
 		<!-- yoast breadchrumb -->
			<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
			?>
			<!-- end yoast breadchrumb -->

	<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>
			<div class="wrap-archive">
				<header class="archive-page-header">
					<?php 
					the_archive_title( '<h1 class="archive-title">', '</h1>');
					the_archive_description( '<div class="archive-description">', '</div>')

					?>
				</header>
			</div>

			<div class="wrap-content"> <!-- warapper content -->
			<!-- //start the loop -->
			<?php 
			while( have_posts() ) :
				
					the_post();
					get_template_part( 'loop-templates/content', get_post_type() );
			endwhile;

			else :
				get_template_part( 'loop-templates/content', 'none');
			?>
			</div> <!-- warapper archive -->

		<?php  endif; ?> 
	</main>
	<?php limited_pagination(); ?>


 <?php get_footer(); ?>