<?php
/**
 * The template for displaying Author info
 *
 */

if ( (bool) get_the_author_meta( 'description' ) && (bool) get_theme_mod( 'show_author_bio', true ) ) : ?>
<div class="author-bio">
	<div class="author-avatar vcard">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 160 ); ?>
	</div><!-- .author-name -->
	<div class="author-description">
		<p class="author-title heading-size-4">
			<?php
			printf(
				/* translators: %s: Author name. */
				__( '%s', 'limited' ),
				esc_html( get_the_author() )
			);
			?>
		</p>
		<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
	</div><!-- .author-description -->
</div><!-- .author-bio -->
<?php endif; ?>
