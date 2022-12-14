<?php 

/* 
contain the header
*/
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
 ?>

 <!DOCTYPE html>
 <html <?php language_attributes(); ?>>
 <head>
 	<meta charset="<?php bloginfo('charset') ?>">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	
 	<?php wp_head(); ?>

 </head>

 <body <?php body_class(); ?> <?php limited_body_attributes(); ?>>
 <?php do_action( 'wp_body_open') ?>

 <div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'limited' ); ?></a>
	<header id="masthead" class="site-header">
		<div class="wrapper-header">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$limited_description = get_bloginfo( 'description', 'display' );
				if ( $limited_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $limited_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->


			<div class="wrapper-nav" id="nav">
				<button class="menu-toggle" id="menu" title="menu" aria-controls="primary-menu" aria-expanded="false">
					<svg viewBox='0 0 10 8' width='30'>
					  <path d='M1 1h8M1 4h 8M1 7h8' 
					        stroke='#fff' 
					        stroke-width='1.5' 
					        stroke-linecap='round'/>
						</svg> 
				</button>
				<nav id="site-navigation" class="main-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							)

						);
						?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->
	<nav id="mobile-navigation" class="mobile-navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-3',
							'menu_id'        => 'mobile-menu',
						)

					);
					?>
				</nav>