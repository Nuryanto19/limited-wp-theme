<?php 

/*
contains index
*/

//exit if accessed direcly.
defined( 'ABSPATH' ) || exit;

get_header();
?>


	<main class="site-main" id="main">
		<?php 
		if ( have_posts() ) : ?>
			<div class="wrap-home">
				<div class="wrap-content">
				<!-- //start the loop -->
					<?php
					while ( have_posts() ) :
					the_post();

						get_template_part( 'loop-templates/content', get_post_type() );
					endwhile;

					else :
						get_template_part( 'loop-templates/content', 'none' );
						?>
				</div>
		<?php endif; ?>
			</div>
	
		</main>

		<?php limited_pagination(); ?>


<?php
get_footer();