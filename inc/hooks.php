<?php
/*
*@package limited
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'limited_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function limited_site_info() {
		do_action( 'limited_site_info' );
	}

}

do_action( 'limited_site_info', 'limited_add_site_info' );