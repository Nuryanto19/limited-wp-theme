<?php 

/*
contain footer
*/
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
	<footer id="colophon" class="site-footer">
			<nav class="footer-menu">
				<?php  
				wp_nav_menu(
	 			array(
	 				'theme_location' => 'menu-2',
	 				'menu-id' 		=> 'secondary-menu',
	 			)
	 		); 
	 		?>
			</nav>
		<div class="site-info">
			<p class="footer-copyright">&copy;
				<?php
				echo date_i18n(
				/* translators: Copyright date format, see https://www.php.net/manual/datetime.format.php */
					_x( 'Y', 'copyright date format', 'twentytwenty' )
					);
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>