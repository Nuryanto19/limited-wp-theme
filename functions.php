<?php 

/*
*functions for this theme
*@package Limited

*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

function limited_setup() {

	// This theme uses wp_nav_menu().
	// add_theme_support('menus');
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'limited' ),
			'menu-2' => esc_html__( 'Secondary', 'limited' ),
			'menu-3' => esc_html__( 'Mobile', 'limited' )
		)
	);

	add_theme_support( 'title-tag');
	add_theme_support( 'post-thumbnails');
	add_theme_support( 'align-wide');
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'featured-content');
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'widgets' );

	

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 120,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'limited_setup');




/**
 * Enqueue scripts and styles.
 */
function limited_scripts(){
	wp_enqueue_style( 'limited-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'limited-style', 'rtl', 'replace' );

	wp_enqueue_script( 'limited-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts','limited_scripts');


require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/inc/hooks.php';


/**
 * Filter the excerpt length to 30 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function limited_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'limited_excerpt_length');

add_filter( 'comment_form_defaults', 'custom_reply_title' );
function custom_reply_title( $defaults ){
  $defaults['title_reply_before'] = '<span id="reply-title" class="h4 comment-reply-title">';
  $defaults['title_reply_after'] = '</span>';
  return $defaults;
}

add_filter('comment_form_default_fields', 'unset_url_field');
function unset_url_field($fields){
    if(isset($fields['url']))
       unset($fields['url']);
       return $fields;
}
