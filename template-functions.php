<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Superminimal
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function spr_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'spr_pingback_header' );

