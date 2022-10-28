<?php 

/*single page template
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
 ?>
<div id="primary" class="content-area">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
				  yoast_breadcrumb( '<p id="breadcrumbs" class="breadcrumbs">','</p>' );
				}
			?>

		<main id="single-main" class="single-main">
			
			<!-- yoast breadchrumb -->
	 		
			<!-- end yoast breadchrumb -->
			
			<?php

			while( have_posts() ) {
				the_post();
				get_template_part( 'loop-templates/content', 'single' );
			}

			//if commnet are open then we can show the comments template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
				
			

			 ?>
		</main>
</div>


 <?php 
 get_footer();
  ?>