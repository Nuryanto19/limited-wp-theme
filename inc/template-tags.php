<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package limited
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'limited_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function limited_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s"> Update: %2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="updated" datetime="%3$s"> Update: %4$s </time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on   = apply_filters(
			'limited_posted_on',
			sprintf(
				'<div class="posted-on"><a href="%2$s" rel="bookmark">%3$s</a></div>',
				esc_html_x( 'post date', 'limited' ),
				esc_url( get_permalink() ),
				apply_filters( 'limited_posted_on_time', $time_string )
			)
		);
		$byline      = apply_filters(
			'limited_posted_by',
			sprintf(
				'<div class="byline"><a class="url fn n" href="%2$s"> %3$s %1$s %4$s</a></div>',
				$posted_on ? esc_html_x( 'by','', 'post author', 'limited' ) : esc_html_x( 'Posted by','','post author', 'limited' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_avatar(get_the_author_meta( 'ID' ), 40, array('scheme' => 'https') ),
				esc_html__( get_the_author() )
			)
		);
		echo $byline . $posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


if ( ! function_exists('limited_show_categories') ) {
	function limited_show_categories() {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'limited' ) );
			if ( $categories_list && limited_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<span class="cat-links">' . esc_html__( ' %s', 'limited' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
	
}

if ( ! function_exists( 'limited_categorized_blog' ) ) {
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function limited_categorized_blog() {
		$all_the_cool_cats = get_transient( 'limited_categories' );
		if ( false === $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'limited_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so limited_categorized_blog should return true.
			return true;
		}
		// This blog has only 1 category so limited_categorized_blog should return false.
		return false;
	}
}

add_action( 'edit_category', 'limited_category_transient_flusher' );
add_action( 'save_post', 'limited_category_transient_flusher' );

if ( ! function_exists( 'limited_category_transient_flusher' ) ) {
	/**
	 * Flush out the transients used in limited_categorized_blog.
	 */
	function limited_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'limited_categories' );
	}
}

if ( ! function_exists( 'limited_body_attributes' ) ) {
	/**
	 * Displays the attributes for the body element.
	 */
	function limited_body_attributes() {
		/**
		 * Filters the body attributes.
		 *
		 * @param array $atts An associative array of attributes.
		 */
		$atts = array_unique( apply_filters( 'limited_body_attributes', $atts = array() ) );
		if ( ! is_array( $atts ) || empty( $atts ) ) {
			return;
		}
		$attributes = '';
		foreach ( $atts as $name => $value ) {
			if ( $value ) {
				$attributes .= sanitize_key( $name ) . '="' . esc_attr( $value ) . '" ';
			} else {
				$attributes .= sanitize_key( $name ) . ' ';
			}
		}
		echo trim( $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}

if ( ! function_exists( 'limited_comment_navigation' ) ) {
	/**
	 * Displays the comment navigation.
	 *
	 * @param string $nav_id The ID of the comment navigation.
	 */
	function limited_comment_navigation( $nav_id ) {
		if ( get_comment_pages_count() <= 1 ) {
			// Return early if there are no comments to navigate through.
			return;
		}
		?>
		<nav class="comment-navigation" id="<?php echo esc_attr( $nav_id ); ?>">

			<div class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'limited' ); ?></div>

			<?php if ( get_previous_comments_link() ) { ?>
				<div class="nav-previous">
					<?php previous_comments_link( __( '&larr; Older Comments', 'limited' ) ); ?>
				</div>
			<?php } ?>

			<?php if ( get_next_comments_link() ) { ?>
				<div class="nav-next">
					<?php next_comments_link( __( 'Newer Comments &rarr;', 'limited' ) ); ?>
				</div>
			<?php } ?>

		</nav><!-- #<?php echo esc_attr( $nav_id ); ?> -->
		<?php
	}
}

if ( ! function_exists( 'limited_edit_post_link' ) ) {
	/**
	 * Displays the edit post link for post.
	 */
	function limited_edit_post_link() {
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'limited' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}


if ( ! function_exists( 'limited_link_pages' ) ) {
	/**
	 * Displays/retrieves page links for paginated posts (i.e. including the
	 * `<!--nextpage-->` Quicktag one or more times). This tag must be
	 * within The Loop. Default: echo.
	 *
	 * @return void|string Formatted output in HTML.
	 */
	function limited_link_pages() {
		$args = apply_filters(
			'limited_link_pages_args',
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'limited' ),
				'after'  => '</div>',
			)
		);
		wp_link_pages( $args );
	}
}
